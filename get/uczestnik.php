<?php
	require_once('./get/ubierz.php');
	
function uczestnik ($database ,$id) {
	$out .= '<h3>informacje o uczestniku Kursu</h3>';//todo
	$a = $database->query("SELECT *
							FROM uczestnicy 
							WHERE id = ".$id);
							
	$out .= ubierz_dlugi($a,'uczestnik','uczestnik');
	return $out;
};
?>
