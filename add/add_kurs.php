<?php
	require_once('./add/add_ubierz.php');
	
	function add_kurs ($database, $id) {
		$out = '<h2>Dodaj członka ekipy</h2><table>';
		$out .= '<form action="./senddata.php?where=kursy" method="post">';

		$item = $database->getItem("kursy",$id);
		$schema = $database -> getInfo('kursy');
		if (is_object($item)) {
			$temp = $item->fetchAll( PDO::FETCH_NAMED );
			$itemT = $temp[0];
		} else {
			$itemT = Array();
			$itemT['id_domy_rekolekcyjne'] = 0;
		}
		$out .= add_create_form($schema, $database, $item, $itemT['id_domy_rekolekcyjne']);
		
		$out .= '<tr><td></td><td><input type="submit" value="wyślij" /></td></tr></form>';
		$out .= '</table>';
		return $out;
	}
?>


