/**
 * dodajemy Funkcje. Z regóły nie będą zmieniane zatem będą dodawane tylko statycznie
 * w tym pliku. stąd też DELET :D
 */

DELETE FROM funkcje; --tylko świeży zestaw danych.

INSERT INTO funkcje (nazwa, opis, typ, istotnosc) 
VALUES ( 'Szef', 'Ogarnia wszystko', 'Organizacja', 100);

INSERT INTO funkcje (nazwa, opis, typ, istotnosc) 
VALUES ( 'Przywitanie Uczestników', '', 'Organizacja', 80);

INSERT INTO funkcje (nazwa, opis, typ, istotnosc) 
VALUES ( 'Zbiurka przy transporcie', 
		 'Osoba odpowiada za przywiezienie osób na miejsce', 
		 'Organizacja', 80);

INSERT INTO funkcje (nazwa, opis, typ, istotnosc) 
VALUES ( 'Filip i Etiop', 'Konferencja wprowadzająca.', 'Konferencja', 100);

INSERT INTO funkcje (nazwa, opis, typ, istotnosc) 
VALUES ( 'Miłość Boża', '', 'Konferencja', 100);

INSERT INTO funkcje (nazwa, opis, typ, istotnosc) 
VALUES ( 'Grzech', '', 'Konferencja', 100);

INSERT INTO funkcje (nazwa, opis, typ, istotnosc) 
VALUES ( 'Sąd Boży', 'Scenka grana przez ekipę.', 'Show', 80);

INSERT INTO funkcje (nazwa, opis, typ, istotnosc) 
VALUES ( 'Zbawienie w Jezusie', '', 'Konferencja', 100);

INSERT INTO funkcje (nazwa, opis, typ, istotnosc) 
VALUES ( 'Pogodny Wieczór', 'Grupki na kursie, prezentują swoje prace', 'Show', 90);

INSERT INTO funkcje (nazwa, opis, typ, istotnosc) 
VALUES ( 'Wiara i Nawrócenie', '', 'Konferencja', 100);

INSERT INTO funkcje (nazwa, opis, typ, istotnosc) 
VALUES ( 'Duch Święty', '', 'Konferencja', 100);
