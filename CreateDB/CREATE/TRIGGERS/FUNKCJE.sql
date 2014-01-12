CREATE OR REPLACE FUNCTION funkcje_usun_fun() RETURNS TRIGGER AS'
	DECLARE
		w funkcje_ekipa_kurs%rowtype;
	BEGIN
		DELETE FROM funkcje_ekipa_kurs WHERE id_funkcje = OLD.id;
		RETURN OLD;
	END
' LANGUAGE 'plpgsql';

CREATE TRIGGER funkcje_usun BEFORE DELETE on funkcje
FOR EACH ROW EXECUTE PROCEDURE funkcje_usun_fun(); 
