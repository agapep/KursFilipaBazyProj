--pierwsze testy. Tworzenie potrzebnych tabel
--w prawdzie nie jest zaprojektowany ten projekt ale
--zabieram się za naukę na nim.

--założenia projektu:
--obsługa strony Kurs-filipa.pl która to zarządzałaby 
--organizowanymi kursami, świadectwami z tych kursów, 
--materiałami do kursów, wpłatami itd.

--tabele
--domy_rekolekcyjne (id,nazwa , cena, pojemność, Miejscowość, ulica, nr, kod_pocztowy)
--Kursy (id, data_beg , data_end, data_zb_zapisów, maksymalna_liczba uczestników, dom_rekolekcyjny_id, koszt, cena);
--Uczestnicy (id, id_kursy, imie, nazwisko, email, nr_telefonu, wiek , na_ile_pewne , zapłacono(kwota));
--Ekipa (id, imie, nazwisko,email, password_hash, który_raz_na_filipie, który_raz_w_ekipie ) 
--Funkcje (id , typ?, opis , nazwa); --typ na przykład konferencja... nie wiem (wielokrotnego wykorzystania)
--Funkcje_Ekipa_Kurs (id kursu, id_elementu , id_ekipy );
--materiały (id, nazwa, link, idFunkcji);

--================================--
----- CREATE ALL TABLES ------------
--================================--

\i ./CREATE/TABLES/DOMY.sql
\i ./CREATE/TABLES/FUNKCJE.sql
\i ./CREATE/TABLES/KURSY.sql
\i ./CREATE/TABLES/UCZESTNICY.sql
\i ./CREATE/TABLES/EKIPA.sql
\i ./CREATE/TABLES/FUNKCJE_EKIPA_KURS.sql









