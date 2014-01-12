<?php
	require_once('./add/add_ubierz.php');
	
	function add_ekipa_kurs ($database,$id) {
		$out = '<h2>Dodaj Ekipe do kursu</h2><table>';
		$out .= '<form action="./senddata.php?where=funkcje_ekipa_kurs" method="post">';
		$a = $database->query("SELECT id as id_ekipa
							FROM ekipa" );
		$out .= add_ubierz($a, $database);
		
		$a = $database->query("SELECT id as id_funkcje
							FROM funkcje" );
		$out .= add_ubierz($a, $database);
		//print_r($out.'kurde');
		$out .= '<tr><td><input type="hidden" name="id_kursy" value="'.$id.'" checked="checked"/>';
		$out .= '</td><td><input type="submit" value="wyślij" /></td></tr></form>';
		$out .= '</table>';
		return $out;
	}
?>



