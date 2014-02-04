
--================================--
------- DROP ALL DOMAIN ------------
--================================--
DROP DOMAIN email_adress CASCADE;
DROP DOMAIN tel_number CASCADE;

--================================--
------- DROP ALL TABLES ------------
--================================--

Drop Table domy_rekolekcyjne CASCADE;
Drop Table kursy CASCADE;
Drop Table uczestnicy CASCADE;
Drop Table ekipa CASCADE;
Drop Table funkcje CASCADE;
Drop Table funkcje_ekipa_kurs CASCADE;
--Drop Table materiały CASCADE;

--================================--
------- DROP ALL FUNCTIONS ---------
--================================--

DROP FUNCTION kursy_uzupelnij_dane() CASCADE;
DROP FUNCTION uczestnicy_data_id_kursy() CASCADE;
DROP FUNCTION ekipa_usun_fun() CASCADE;
DROP FUNCTION kursy_usun_fun() CASCADE;
DROP FUNCTION funkcje_usun_fun() CASCADE;

--================================--
------- DROP ALL TRIGGERS-----------
--================================--

--DROP TRIGGER KURS_TRIGGER CASCADE;
--DROP TRIGGER EKIPA_TRIGGER CASCADE;
--DROP TRIGGER UCZESTNICY_TRIGGER CASCADE;

--================================--
------- DROP ALL SEQUENCE ----------
--================================--

DROP SEQUENCE ekipa_id_seq CASCADE;
DROP SEQUENCE kursy_id_seq CASCADE;
DROP SEQUENCE domy_rekolekcyjne_id_seq CASCADE;
DROP SEQUENCE uczestnicy_id_seq CASCADE;
DROP SEQUENCE funkcje_id_seq CASCADE;
DROP SEQUENCE funkcje_ekipa_kurs_id_seq CASCADE;

--================================--
------- RESTART ALL SEQUENCE -------
--================================--

--ALTER SEQUENCE EKIPA_seq  RESTART; 
--ALTER SEQUENCE KURSY_seq  RESTART; 
--ALTER SEQUENCE DOMY_seq  RESTART;
--ALTER SEQUENCE UCZESTNICY_seq  RESTART;
--ALTER SEQUENCE FUNKCJE_seq RESTART;
