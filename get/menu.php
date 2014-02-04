<?php
	
function menu() {
							
	$out = '<table><tr>';
	$out .= '<td><a href="index.php?kursy_lista=0">wyświetl liste kursów</a> </td><td>::::</td>';
	$out .= '<td><a href="index.php?domy_lista=0">wyświetl domy rekolekcyjne</a> </td><td>::::</td>';
	$out .= '<td><a href="index.php?ekipa_lista=0">wyświetl ekipe</a> </td><td>::::</td>';
	$out .= '<td><a href="index.php?funkcje_lista=0">wyświetl funkcje</a> </td><td>::::</td>';
	$out .= '<td><a href="index.php?add_kurs=0">dodaj kurs</a> </td><td>::::</td>';
	$out .= '<td><a href="index.php?add_dom=0">dodaj dom rekolekcyjny</a> </td><td>::::</td>';
	$out .= '<td><a href="index.php?add_uczestnik=0">dodaj uczestnika</a> </td><td>::::</td>';
	$out .= '<td><a href="index.php?add_ekipa=0">dodaj ekipe</a> </td><td>::::</td>';
	$out .= '<td><a href="index.php?add_funkcje=0">dodaj funkcje</a> </td><td>::::</td>';

	$out .= '</tr></table>';
	return $out;
};

?>

