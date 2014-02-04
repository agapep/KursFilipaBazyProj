CREATE OR REPLACE FUNCTION ekipa_usun_fun()   RETURNS TRIGGER AS'
	DECLARE
		temp INTEGER;
		w funkcje_ekipa_kurs%rowtype;
	BEGIN
		SELECT id FROM (
			SELECT id_kursy as id 
			FROM funkcje_ekipa_kurs fek 
			WHERE fek.id_ekipa = old.id) as t 
		INTO temp
		WHERE id in (SELECT id FROM kursy_aktualne); 
		IF FOUND THEN
			RAISE EXCEPTION ''Nie możesz usunąć członka ekipy % %. Aktualnie odbywają się kursy w których bierze udział! Usuń najpierw wszystkie odwołania do tego człowieka w <b>aktualnych</b> kursach. <br/> Do informacji: Możesz usunąć członka ekipy jeśli odwołuje się tylko do minionych kursów. Zniknie wtedy jakikolwiek ślad po niej.'', OLD.imie, Old.nazwisko;
		ELSE 
			DELETE FROM funkcje_ekipa_kurs WHERE id_ekipa   = OLD.id;
			RETURN OLD;
		END IF;
	END
' LANGUAGE 'plpgsql';

CREATE TRIGGER ekipa_usun   BEFORE DELETE on ekipa
FOR EACH ROW EXECUTE PROCEDURE ekipa_usun_fun(); 
