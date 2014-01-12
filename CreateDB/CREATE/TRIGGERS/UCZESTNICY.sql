/**
 * sprawdza czy podano id_kursy, jesli nie to nadaje id ostatnio dodanego 
 * kursu (z sekwencji bierze to info). Ważne sekwencja zadziała i 
 * się zinkrementuje nawet jeśli się INSERTNEŁO. 
 * Jeśli nie znajdzie się w tabeli Kursy to wyrzuca Errora.
 */

--DROP TRIGGER uzytkownicy_data on kursy;
--DROP FUNCTION uzytkownicy_data_id_kursy();

--CREATE LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION uczestnicy_data_id_kursy() RETURNS TRIGGER AS'
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
