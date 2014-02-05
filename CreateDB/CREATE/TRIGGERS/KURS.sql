/**
 * dodajemy kurs, 
 * -data początku nie może być wcześniej niż teraz.
 * -data końca (data_end) powinna może być obliczona
 *  jeśli nie zostanie podana (data_beg+=2)
 * -ostateczna data zbierania zapisów (data_zapisy) również może być 
 *  określona automatycznie jeśli nie zostanie podana. (data_beg-=5)
 */

--DROP TRIGGER kursy_data on kursy;
--DROP FUNCTION kursy_data_calc();

--CREATE LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION kursy_uzupelnij_dane() RETURNS TRIGGER AS'
	DECLARE
		w domy_rekolekcyjne%rowtype;
	BEGIN
		--wykluczenie dodania kursów wstecz
		IF ( (NEW.data_beg - current_timestamp) < interval ''6 day''  ) THEN
			RAISE NOTICE ''Nie można ustalić kursu na tydzień przed! Nie zdążysz go przygotować?'';
			RETURN NULL;
		END IF;
		
		--dodanie data_end
		IF (NEW.data_end IS NULL ) THEN 
			RAISE NOTICE ''Nie dałeś daty końca... ale spox. sam sobie wylicze :D'';
			NEW.data_end := NEW.data_beg + interval ''2 day'';
		    --ELSE 
			--RAISE NOTICE ''Podano Date Końca: % '', NEW.data_end;
		END IF;

		--testowanie daty końca
		IF NOT (NEW.data_beg < NEW.data_end ) THEN 
			RAISE EXCEPTION ''Data końca nie może być późniejsza niż data początku!'';
			RETURN NULL;
		END IF;
		
		--dodanie data_zapisy
		IF (NEW.data_zapisy IS NULL ) THEN 
			RAISE NOTICE ''Nie dałeś ostatecznej daty zbierania zapisów. Ustalam to na 5 dni przed początkiem kursu'';
			NEW.data_zapisy := NEW.data_beg - interval ''5 day'';
		END IF;
		
		--testowanie data_zapisy
		IF (NEW.data_zapisy > NEW.data_beg ) THEN 
			RAISE EXCEPTION ''Data końca zbierania zapisów nie może być późniejsza niż data początku!'';
			RETURN NULL;
		END IF;
			
		RETURN NEW;
	END
' LANGUAGE 'plpgsql';

CREATE TRIGGER kursy_data BEFORE INSERT OR UPDATE on kursy
FOR EACH ROW EXECUTE PROCEDURE kursy_uzupelnij_dane(); 

--podczas usuwania 

CREATE OR REPLACE FUNCTION kursy_usun_fun() RETURNS TRIGGER AS'
	DECLARE
		w funkcje_ekipa_kurs%rowtype;
	BEGIN
		DELETE FROM funkcje_ekipa_kurs WHERE id_kursy = OLD.id;
		RETURN OLD;
	END
' LANGUAGE 'plpgsql';

CREATE TRIGGER kursy_dusun BEFORE DELETE on kursy
FOR EACH ROW EXECUTE PROCEDURE kursy_usun_fun(); 

 
--INSERT INTO kursy (data_beg, cena, id_domy_rekolekcyjne) VALUES ('15-01-2011', 65 , 1);
--UPDATE kursy SET data_beg='15-01-2011 15:00' WHERE id=1;
 
