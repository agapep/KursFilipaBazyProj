CREATE OR REPLACE FUNCTION domy_usun_fun() RETURNS TRIGGER AS'
	DECLARE
		temp INTEGER;
		w funkcje_ekipa_kurs%rowtype;
	BEGIN
		SELECT id FROM kursy_aktualne k INTO temp
		WHERE k.id_domy_rekolekcyjne = OLD.id;
		IF FOUND THEN
			RAISE EXCEPTION ''Nie możesz usunąć domu rekolekcyjnego %. W bazie wciąż są <b>aktualne</b> kursy które z nich korzystają! Usuń najpierw wszystkie kursy w <b>aktualnych</b> kursach. <br/> Do informacji: Możesz usunąć dom rekolekcyjny jeśli odwołuje się tylko do minionych kursów. Zniknie wtedy jakikolwiek ślad po nim, podobnie znikną kursy, które w nich się odbywały zatem uważaj.'', OLD.nazwa;
		ELSE 
			RETURN OLD;
		END IF;
	END
' LANGUAGE 'plpgsql';

CREATE TRIGGER domy_usun BEFORE DELETE on domy_rekolekcyjne
FOR EACH ROW EXECUTE PROCEDURE domy_usun_fun(); 
