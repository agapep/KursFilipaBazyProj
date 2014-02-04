<?php
	require_once('./get/ubierz.php');
	
function funkcje_lista ($database) {
	$out = '<h2>Funkcje</h2>';
	$a = $database->query("SELECT * FROM funkcje f");
							
	$out .= ubierz($a,"funkcje_lista","funkcje");
	
	return $out;
};

?>
