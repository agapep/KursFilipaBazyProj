
CREATE SEQUENCE ekipa_id_seq;
Create Table ekipa (
	id INTEGER NOT NULL PRIMARY KEY DEFAULT nextval('ekipa_id_seq') UNIQUE,
	imie CHAR(20),
	nazwisko CHAR(20),
	email email_adress NOT NULL UNIQUE --potrzebne do kontaktu, i do logowania
	--passwd CHAR(255) DEFAULT NULL   --hash hasła. gdy null nie można się logować.
			  --można wysłać na email zresetowane hasło 	.
);

-- insert do tej tabeli
-- INSERT INTO ekipa (imie, nazwisko, email) VALUES ('Kasia', 'Zduniak' ,'kajacostam@gmail.com');
