<?php
	require_once('./get/ubierz.php');
	
function kursy_lista ($database) {
	$out = '<h2>Lista Kursów</h2>';
	$out .= '<h3>aktualne</h3>';
	$a = $database->query("SELECT 
							k.id, DATE(k.data_beg) as data ,d.miejscowosc as miejscowość
							FROM kursy k,domy_rekolekcyjne d 
							WHERE d.id=k.id_domy_rekolekcyjne AND DATE(k.data_end) > NOW()
							ORDER BY k.data_beg ");
	
	$out .= ubierz($a,"lista_kursow","kurs");
	$out .= '<h3>zakończone</h3>';
	$a = $database->query("SELECT 
							k.id, DATE(k.data_beg) as data ,d.miejscowosc as miejscowość
							FROM kursy k,domy_rekolekcyjne d 
							WHERE d.id=k.id_domy_rekolekcyjne AND DATE(k.data_end) < NOW()
							ORDER BY k.data_beg ");
	
	$out .= ubierz($a,"lista_kursow","kurs");
	
	return $out;
};
?>
