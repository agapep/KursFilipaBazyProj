--SELECT * FROM kursy;
/*
CREATE or REPLACE View miejs_data_Fkurs AS (
	SELECT d.miejscowosc,date( k.data_beg ) as data_beg, k.id
	FROM domy_rekolekcyjne d, kursy k
	Where k.id=1 and k.id_domy_rekolekcyjne = d.id
	);
*/
	
CREATE OR REPLACE VIEW temp1 AS
SELECT d.miejscowosc , date( k.data_beg ) as data_beg,
	date( k.data_end ) as data_end, k.id
FROM domy_rekolekcyjne d 
	INNER JOIN kursy k 
	ON d.id=k.id_domy_rekolekcyjne;
--Where k.id=2;
	
--SELECT * FROM temp1;
	
CREATE OR REPLACE VIEW temp2 AS
SELECT fek.id_kursy, fek.id_funkcje, f.nazwa
FROM funkcje f
	INNER JOIN funkcje_ekipa_kurs fek
	ON f.id = fek.id_funkcje
Where fek.id_ekipa=2;

--SELECT * FROM temp2;

SELECT id_funkcje as id, miejscowosc, data_beg as data, nazwa 
FROM temp1 t1 
INNER JOIN temp2 t2 
ON t1.id = t2.id_kursy 
WHERE (t1.id = t2.id_kursy)
AND (t1.data_end < NOW());
DROP VIEW temp1, temp2;

--SELECT * FROM miejs_data_kursu;
/*
SELECT miejscowosc, data_beg 
FROM miejs_data_Fkurs md
INNER JOIN
SELECT 
*/

--DROP VIEW miejs_data_Fkurs;
