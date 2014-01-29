<?php
	require_once('./add/add_ubierz.php');
	
	function add_uczestnik ($database,$id , $idkursu) {
		$out = '<h2>Dodaj Uczestnika kursu</h2><table>';
		$out .= '<form action="./senddata.php?where=uczestnicy" method="post">';
		
		$item = $database->getItem("uczestnicy",$id, array("id_kursy" => $idkursu));
		$schema = $database -> getInfo('uczestnicy'); 
		$out .= add_create_form($schema, $database, $item, "kursy");
		
		if(isset( $_GET['add_uczestnik_kurs'])) {
		$out .= '<tr><td colspan="5">Domyślnie wybrany kurs ma nr '.$_GET['add_uczestnik_kurs'];
		$out .= ' to ten z którego tu przybyłeś.';
		$out .= '</td></tr>';}
		
		$out .= '<tr><td></td><td><input type="submit" value="wyślij" /></td></tr></form>';
		$out .= '</table>';
		return $out;
	}
?>


