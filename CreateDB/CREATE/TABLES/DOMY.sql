
CREATE SEQUENCE domy_rekolekcyjne_id_seq;

CREATE TABLE domy_rekolekcyjne (
	id INTEGER NOT NULL PRIMARY KEY DEFAULT nextval('domy_rekolekcyjne_id_seq') UNIQUE,
	nazwa CHAR(20) UNIQUE, --chyba zbędne. Zazwyczaj używa się nazwy miejscowości.
	cena INTEGER DEFAULT 15, --cena za nocke.
	pojemnosc INTEGER DEFAULT 30,
	miejscowosc CHAR(20) NOT NULL, --w sumie ważniejsze niż nazwa
	ulica VARCHAR(20) DEFAULT NULL,
	nr INTEGER,
	opis VARCHAR(255) DEFAULT NULL,
	kod_pocztowy CHAR(6) DEFAULT NULL --w sumie nie potrzebny chyba.
);

-- przykładowy insert
--INSERT INTO domy_rekolekcyjne VALUES (DEFAULT , 'Pcim-Krzywica', DEFAULT , 35, 'Pcim', 'krzywica', NULL, NULL );
