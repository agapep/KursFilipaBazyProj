<?php
	require_once('./get/ubierz.php');
	
function kurs ($database, $id) {
	//----------informacje o kursie--------------------
	$out = '<h2>Kurs</h2>';
	$out .= '<h3>informacje o kursie</h3>';
	$zapytanie="SELECT k.id,
				  DATE(k.data_beg) as od , 
				  DATE(k.data_end) as do , 
				  DATE(k.data_zapisy) as zapisy_do,
				  k.cena,
				  max_ludzi as pojemnosc,
				  d.miejscowosc as miejscowość 
				FROM kursy k, domy_rekolekcyjne d 
				WHERE d.id=k.id_domy_rekolekcyjne and k.id = ".$id."
				ORDER BY k.data_beg";
	$a = $database->query($zapytanie);	
	
	//$data = $a->fetchAll( PDO::FETCH_BOTH );	
	//print_r("kurde ");
	//print_r($zapytanie);	
	//print_r($data);								
	$out .= ubierz_dlugi($a, 'kurs_lista', 'kurs');
	
	
	$out .= '<h3>informacje o ekipie</h3>';
	
		//----------informacje o ekipie--------------------
	$a = $database->query("SELECT ekipa.id, ekipa.imie , ekipa.nazwisko, funkcje.nazwa as funkcja
	from ekipa, funkcje, funkcje_ekipa_kurs as fek 
	WHERE fek.id_kursy=".$id." AND ekipa.id=fek.id_ekipa AND funkcje.id=fek.id_funkcje
	ORDER BY ekipa.nazwisko");

	$out .= ubierz($a,'ekipa', 'ekipa');
	$out .= '<p>[<a href="index.php?add_ekipa_kurs='.$id.'">dodaj ekipe</a>]</p>';

//----------informacje o uczestnikach--------------------
	$out .= '<h3>informacje o uczestnikach</h3>';//todo
	$a = $database->query("SELECT 
							imie, nazwisko, id
							FROM uczestnicy 
							WHERE id_kursy = ".$id." 
							ORDER BY nazwisko ");
	$out .= ubierz($a,'uczestnik', 'uczestnik');	
	$out .= '<p>[<a href="index.php?add_uczestnik=0&add_uczestnik_kurs='.$id.'">dodaj uczestnika</a>]</p>';
	return $out;
};
?>
