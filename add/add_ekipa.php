<?php
	require_once('./add/add_ubierz.php');
	
	function add_ekipa ($database,$id) {
		$out = '<h2>Dodaj członka ekipy</h2><table>';
		$out .= '<form action="./senddata.php?where=ekipa" method="post">';
		
		$item = $database->getItem("ekipa",$id);
		$schema = $database -> getInfo('ekipa');
		$out .= add_create_form($schema, $database, $item);
		
		$out .= '<tr><td></td><td><input type="submit" value="wyślij" /></td></tr></form>';
		$out .= '</table>';
		return $out;
	}
?>
