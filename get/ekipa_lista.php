<?php
	require_once('./get/ubierz.php');
	
function ekipa_lista ($database) {
	$out = '<h2>Funkcja</h2>';
	$a = $database->query("SELECT id ,imie, nazwisko, email
							FROM ekipa e");
							
	$out .= ubierz($a,"ekipa_lista","ekipa");
	
	return $out;
};

?>

