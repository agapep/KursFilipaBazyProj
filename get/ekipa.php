
<?php
	require_once('./get/ubierz.php');

function ekipa ($database ,$id, $id_kursy) {
	$out .= '<h3>informacje o członku Ekipy kursu</h3>';//todo
	$a = $database->query("SELECT id , imie, nazwisko, email
							FROM ekipa 
							WHERE id = ".$id);
							
	$out .= ubierz_dlugi($a,'ekipa','ekipa');
	
	$out .= '<h3>Aktualnie pełnione funkcje:</h3>';
	//tworzymy widok 1 (miejscowość data)
	
	$database->query("CREATE OR REPLACE VIEW temp1 AS
					SELECT d.miejscowosc , date( k.data_beg ) as data_beg,
					    date( k.data_end ) as data_end, k.id
					FROM domy_rekolekcyjne d 
						INNER JOIN kursy k 
						ON d.id=k.id_domy_rekolekcyjne"); 
	//tworzymy widok 1 (nazwa funkcji, id_funkcji)				
	$database->query("CREATE OR REPLACE VIEW temp2 AS
					SELECT fek.id_kursy, fek.id_funkcje , f.nazwa
					FROM funkcje f
						INNER JOIN funkcje_ekipa_kurs fek
						ON f.id = fek.id_funkcje
					Where fek.id_ekipa=".$id); //id ekipy
	
	$a = $database->query("SELECT id_funkcje as id, id_kursy , miejscowosc, data_beg as data, nazwa 
							FROM temp1 t1 
							INNER JOIN temp2 t2 
							ON t1.id = t2.id_kursy 
							WHERE (t1.id = t2.id_kursy)
							AND (t1.data_end > NOW())");					
	
	$out .= ubierz_funkcje_ekipa_kurs($a,'funkcje','funkcje_ekipa_kurs',$id);
	
	$out .= '<h3>funkcje pełniłnione kiedyś:</h3>';
	$a = $database->query("SELECT id_funkcje as id, id_kursy, miejscowosc, data_beg as data, nazwa 
							FROM temp1 t1 
							INNER JOIN temp2 t2 
							ON t1.id = t2.id_kursy 
							WHERE t1.id = t2.id_kursy
							   AND data_end < NOW()");					
	
	$out .= ubierz_funkcje_ekipa_kurs($a,'funkcje','funkcje_ekipa_kurs',$id);
	return $out;

};
?>
