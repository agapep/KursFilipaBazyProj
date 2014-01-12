<?php
	require_once('./get/ubierz.php');
	
function funkcja ($database, $id) {
	$out = '<h2>Funkcja</h2>';
	$a = $database->query("SELECT *
							FROM funkcje f
							WHERE f.id = ".$id);
							
	$out .= ubierz_dlugi($a,"funkcje","funkcje");
	
	return $out;
};

?>
