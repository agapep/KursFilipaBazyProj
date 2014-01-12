CREATE SEQUENCE kursy_id_seq;
CREATE TABLE kursy (
	id INTEGER NOT NULL PRIMARY KEY DEFAULT nextval('kursy_id_seq') UNIQUE,
	data_beg TIMESTAMP without time zone NOT NULL, --data początku kursu
	data_end TIMESTAMP without time zone, --data zakończenia kursu
	cena INTEGER NOT NULL,
	data_zapisy TIMESTAMP without time zone, --data do której będą zbierane zapisy
	max_ludzi INTEGER, --maksymalna liczba uczestników
	id_domy_rekolekcyjne INTEGER NOT NULL, --dom rekolekcyjny
	FOREIGN KEY (id_domy_rekolekcyjne) REFERENCES domy_rekolekcyjne ON DELETE CASCADE
);
