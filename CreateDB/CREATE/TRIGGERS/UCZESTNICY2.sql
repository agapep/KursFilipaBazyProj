
--Tworzymy Trigger który nie pozwoli nam dodać dwuch takich samych użytkowników do bazy danych.

CREATE OR REPLACE FUNCTION uczestnicy_tel() RETURNS TRIGGER AS '
	BEGIN
		IF (NEW.nrTelefonu > 100) THEN
			RAISE NOTICE ''Użytkownik nie może być przekonany na więcej niż 100. Ucinam do 100'';
			NEW.na_ile_pewne = 100;
		END IF;
		RETURN NEW;
	END
' LANGUAGE 'plpgsql';

CREATE TRIGGER uzytkownicy_naIlePewne_trig BEFORE INSERT OR UPDATE on uczestnicy
FOR EACH ROW EXECUTE PROCEDURE uczestnicy_naIlePewne(); 
