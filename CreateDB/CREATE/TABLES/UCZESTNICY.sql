
CREATE SEQUENCE uczestnicy_id_seq;

CREATE TABLE uczestnicy (
	--Uczestnicy (id, id_kursy, imie, nazwisko, email, nr_telefonu, wiek , na_ile_pewne , zapłacono(kwota));
	id INTEGER NOT NULL PRIMARY KEY DEFAULT nextval('uczestnicy_id_seq') UNIQUE,
	id_kursy INTEGER NOT NULL REFERENCES kursy ON DELETE CASCADE,
	imie CHAR(30) NOT NULL,
	nazwisko CHAR(30),
	email email_adress NOT NULL,
	nrTelefonu tel_number, --forma telefonu komurkowego np 663326434
	wiek SMALLINT DEFAULT NULL,
	na_ile_pewne SMALLINT DEFAULT 100, --[0-100%]
	zaplacono SMALLINT DEFAULT 0 --ile zapłacił do tej pory. 
);

-- przykładowy insert
--INSERT INTO uczestnicy (imie, nazwisko, id_kursy, email) VALUES ('Franek', 'Podpity', 1, 'franekpodpity@gmail.com');
