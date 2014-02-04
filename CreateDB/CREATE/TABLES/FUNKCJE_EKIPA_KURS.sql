CREATE SEQUENCE funkcje_ekipa_kurs_id_seq START WITH 1;
--SELECT nextVal(funkcje_ekipa_kurs_id_seq);
/* 
 * Opisuje relacje członka ekipy kursu filipa, do konkretnego kursu, 
 * i sprawowanych przez niego funkcji
 */
CREATE TABLE funkcje_ekipa_kurs (
	id_kursy INTEGER NOT NULL,
	id_ekipa INTEGER NOT NULL,
	id_funkcje INTEGER NOT NULL,
	FOREIGN KEY (id_kursy) REFERENCES kursy ON DELETE CASCADE,
	FOREIGN KEY (id_ekipa) REFERENCES ekipa ON DELETE CASCADE,
	FOREIGN KEY (id_funkcje) REFERENCES funkcje ON DELETE CASCADE
);
