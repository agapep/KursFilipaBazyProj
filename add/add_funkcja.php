<?php
	require_once('./add/add_ubierz.php');
	
	function add_funkcja ($database,$id) {
		$out = '<h2>Dodaj Funkcje</h2><table>';
		$out .= '<form action="./senddata.php?where=funkcje" method="post">';

		$item = $database->getItem("funkcje",$id);
		$schema = $database -> getInfo('funkcje');
		$out .= add_create_form($schema, $database, $item);
		
		$out .= '<tr><td></td><td><input type="submit" value="wyślij" /></td></tr></form>';
		$out .= '</table>';
		return $out;
	}
?>

