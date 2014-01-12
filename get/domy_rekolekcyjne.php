<?php
	require_once('./get/ubierz.php');
	
function domy_rekolekcyjne ($database, $id) {
	$out = '<h2>Dom Rekolekcyjny</h2>';
	$a = $database->query("SELECT *
							FROM domy_rekolekcyjne
							WHERE id = ".$id);
							
	$out .= ubierz_dlugi($a,"ekipa_lista","dom");
	
	return $out;
};

?>


