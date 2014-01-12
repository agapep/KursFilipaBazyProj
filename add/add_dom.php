<?php
	require_once('./add/add_ubierz.php');
function add_dom ($database,$id) {
	$out = '<h2>Dodaj dom rekolekcyjny</h2><table>';
	$out .= '<form action="./senddata.php?where=domy_rekolekcyjne" method="post">';
	
	$item = $database->getItem("domy_rekolekcyjne",$id);
	$schema = $database -> getInfo('domy_rekolekcyjne');
	$out .= add_create_form($schema, $database, $item, null);

	$out .= '<tr><td></td><td><input type="submit" value="wyślij" /></td></tr></form>';
	$out .= '</table>';
	return $out;
};

?>

