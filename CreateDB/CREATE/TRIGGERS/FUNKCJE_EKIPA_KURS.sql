CREATE OR REPLACE FUNCTION funkcje_ekipa_kurs_fun() RETURNS TRIGGER AS'
	DECLARE
		temp INTEGER;
		w funkcje_ekipa_kurs%rowtype;
	BEGIN
		SELECT id_kursy FROM funkcje_ekipa_kurs
		INTO temp
		WHERE id_kursy = NEW.id_kursy and id_funkcje = NEW.id_funkcje and id_ekipa = NEW.id_ekipa; 
		IF FOUND THEN
			RAISE EXCEPTION ''Ta osoba już jest przypisana do funkcji % na tym kursie'', NEW.id_funkcje;
		ELSE 
			RETURN NEW;
		END IF;
	END
' LANGUAGE 'plpgsql';

CREATE TRIGGER funkcje_ekipa_kurs_trig BEFORE INSERT on funkcje_ekipa_kurs
FOR EACH ROW EXECUTE PROCEDURE funkcje_ekipa_kurs_fun(); 
