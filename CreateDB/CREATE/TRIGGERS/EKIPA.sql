CREATE OR REPLACE FUNCTION ekipa_usun_fun()   RETURNS TRIGGER AS'
	DECLARE
		w funkcje_ekipa_kurs%rowtype;
	BEGIN
		DELETE FROM funkcje_ekipa_kurs WHERE id_ekipa   = OLD.id;
		RETURN OLD;
	END
' LANGUAGE 'plpgsql';

CREATE TRIGGER ekipa_usun   BEFORE DELETE on ekipa
FOR EACH ROW EXECUTE PROCEDURE ekipa_usun_fun  (); 
