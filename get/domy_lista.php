<?php
	require_once('./get/ubierz.php');
	
function domy_lista ($database) {
	$out = '<h2>Domy rekolekcyjne</h2>';
	$a = $database->query("SELECT id, nazwa, miejscowosc, cena, pojemnosc 
							FROM domy_rekolekcyjne");
							
	$out .= ubierz($a,"domy_rekolekcyjne","domy_rekolekcyjne", "del_dom");
	
	return $out;
};

?>


