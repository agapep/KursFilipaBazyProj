/**
 * sprawdza czy podano id_kursy, jesli nie to nadaje id ostatnio dodanego 
 * kursu (z sekwencji bierze to info). Ważne sekwencja zadziała i 
 * się zinkrementuje nawet jeśli się INSERTNEŁO. 
 * Jeśli nie znajdzie się w tabeli Kursy to wyrzuca Errora.
 */

--DROP TRIGGER uzytkownicy_data on kursy;
--DROP FUNCTION uzytkownicy_data_id_kursy();
--CREATE LANGUAGE plpgsql;

--jeśli uczestnikowi nie został ustaiony kurs zostanie on ustawiony jako ostatni.
CREATE OR REPLACE FUNCTION uczestnicy_data_id_kursy() RETURNS TRIGGER AS '
	DECLARE
		temp INTEGER;
		--ret ROW;
	BEGIN
		IF (NEW.id_kursy IS NULL) THEN
			  select into NEW.id_kursy currval(''KURSY_seq'');
			RAISE NOTICE ''% : Autoset idKursy : %'' ,NEW.imie, NEW.id_kursy;
		END IF;
		SELECT id FROM kursy k INTO temp WHERE k.id = new.id_kursy;
		IF NOT FOUND THEN
			RAISE EXCEPTION ''Nie ma kursu % !'', NEW.id_kursy;
		END IF;
		
		RETURN NEW;
	END
' LANGUAGE 'plpgsql';

CREATE TRIGGER uzytkownicy_data BEFORE INSERT OR UPDATE on uczestnicy
FOR EACH ROW EXECUTE PROCEDURE uczestnicy_data_id_kursy(); 

--testowanie czy taki uczestnik znajduje się już w bazie danych (i został przypisany do tego samego kursu).
CREATE OR REPLACE FUNCTION uczestnicy_multi() RETURNS TRIGGER AS '
	DECLARE
		temp VARCHAR;
		--ret ROW;
	BEGIN
		SELECT email FROM uczestnicy u INTO temp WHERE NEW.id_kursy = u.id_kursy and u.email = NEW.email;
		IF FOUND THEN
			RAISE EXCEPTION ''W tym kursie istnieje już uczestnik o takim adresie email: % !'', temp;
		END IF;
		
		RETURN NEW;
	END
' LANGUAGE 'plpgsql';

CREATE TRIGGER uzytkownicy_email BEFORE INSERT OR UPDATE on uczestnicy
FOR EACH ROW EXECUTE PROCEDURE uczestnicy_multi(); 

--Tworzymy Trigger który nie pozwoli nam dodać dwuch takich samych użytkowników do bazy danych.

CREATE OR REPLACE FUNCTION uczestnicy_zaplacono() RETURNS TRIGGER AS '
	DECLARE
		temp INTEGER;
		--ret ROW;
	BEGIN
		SELECT cena FROM kursy k INTO temp WHERE NEW.id_kursy = k.id;
		IF (NEW.zaplacono > temp) THEN
			RAISE EXCEPTION ''Uczestnik nie powinien móc zapłacić więcej niż kosztuje kurs: cena:% < zaplacono:%!'', temp, NEW.zaplacono;
		END IF;
		RETURN NEW;
	END
' LANGUAGE 'plpgsql';

CREATE TRIGGER uzytkownicy_zaplacono_trig BEFORE INSERT OR UPDATE on uczestnicy
FOR EACH ROW EXECUTE PROCEDURE uczestnicy_zaplacono(); 


--Na ile pewne nie może być za duże ani za małe. Pewnie dało się to zrobić 100 razy prościej ale to jest projekt
--Który jest skazany na nieużywanie. To samo można 100* prościej napisać w scali - slick.
CREATE OR REPLACE FUNCTION uczestnicy_naIlePewne() RETURNS TRIGGER AS '
	BEGIN
		IF (NEW.na_ile_pewne > 100) THEN
			RAISE NOTICE ''Użytkownik nie może być przekonany na więcej niż 100. Ucinam do 100'';
			NEW.na_ile_pewne = 100;
		END IF;
		IF (NEW.na_ile_pewne < 0) THEN
			RAISE NOTICE ''Użytkownik nie może być przekonany na mniej niż 0. Ucinam do 0'';
			NEW.na_ile_pewne = 0;
		END IF;
		RETURN NEW;
	END
' LANGUAGE 'plpgsql';

CREATE TRIGGER uzytkownicy_naIlePewne_trig BEFORE INSERT OR UPDATE on uczestnicy
FOR EACH ROW EXECUTE PROCEDURE uczestnicy_naIlePewne(); 

--Na ile pewne nie może być za duże ani za małe. Pewnie dało się to zrobić 100 razy prościej ale to jest projekt
--Który jest skazany na nieużywanie. To samo można 100* prościej napisać w scali - slick.
CREATE OR REPLACE FUNCTION uczestnicy_max() RETURNS TRIGGER AS '
	DECLARE
		temp INTEGER;
		poj INTEGER;
	BEGIN
		SELECT count(id) FROM uczestnicy INTO temp WHERE id_kursy = NEW.id_kursy;
		SELECT pojemnosc FROM domy_rekolekcyjne INTO poj WHERE id = (
			SELECT id_domy_rekolekcyjne from kursy WHERE id = NEW.id_kursy);
		IF (poj <= temp) THEN
			RAISE EXCEPTION ''Osiągnięto maksymalną liczbę uczestników (%). Nie da się więcej.'', temp;
		END IF;
		RETURN NEW;
	END
' LANGUAGE 'plpgsql';

CREATE TRIGGER uczestnicy_max_trig BEFORE INSERT OR UPDATE on uczestnicy
FOR EACH ROW EXECUTE PROCEDURE uczestnicy_max(); 


