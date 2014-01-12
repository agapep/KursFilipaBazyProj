/*
 * Przykładowe Kursy.
 * Są dodawane aby testować Bazę.
 */
DELETE FROM kursy;
Set DATESTYLE='DMY';

INSERT INTO kursy (data_beg, cena, id_domy_rekolekcyjne) 
VALUES ('21-02-2014', 65 , 
	(SELECT id FROM domy_rekolekcyjne d WHERE d.nazwa ~ 'Pcim' )
);

INSERT INTO kursy (data_beg, cena, id_domy_rekolekcyjne) 
VALUES ('21-11-2014', 68 , 
	(SELECT id FROM domy_rekolekcyjne d WHERE d.nazwa ~ 'Spytkowice' )
);


INSERT INTO kursy (data_beg, cena, id_domy_rekolekcyjne) 
VALUES ('21-11-2015', 200 , 
	(SELECT id FROM domy_rekolekcyjne d WHERE d.nazwa ~ 'Madagaskar' )
);
