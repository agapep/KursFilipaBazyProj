CREATE OR REPLACE FUNCTION funkcje_usun_fun() RETURNS TRIGGER AS'
	DECLARE
		temp INTEGER;
		w funkcje_ekipa_kurs%rowtype;
	BEGIN
		SELECT id FROM (
			SELECT id_kursy as id 
			FROM funkcje_ekipa_kurs fek 
			WHERE fek.id_funkcje = old.id) as t 
		INTO temp
		WHERE id in (SELECT id FROM kursy_aktualne); 
		IF FOUND THEN
			RAISE EXCEPTION ''Nie możesz usunąć funkcji % . Aktualnie odbywają się kursy które jej używają! Usuń najpierw wszystkie odwołania do tej funkcji w aktualnych kursach. <br/> Do informacji: Możesz usunąć funkcje jeśli odwołuje się tylko do minionych kursów. Zniknie wtedy jakikolwiek ślad po niej.'', OLD.id;
		ELSE 
			DELETE FROM funkcje_ekipa_kurs WHERE id_funkcje = OLD.id;
			RETURN OLD;
		END IF;
	END
' LANGUAGE 'plpgsql';

CREATE TRIGGER funkcje_usun BEFORE DELETE on funkcje
FOR EACH ROW EXECUTE PROCEDURE funkcje_usun_fun(); 
