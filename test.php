<?php 

ini_set( 'display_errors', 'On' ); 
error_reporting( E_ALL );

require_once('./DB/DB.php');
require_once('kursy_lista.php');
//header("Location: index.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
 <title>Logowanie</title>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <head/>
 <body>
 <?php
 
	$baza = new DB();
	$data2 = $baza->query("SELECT imie, nazwisko FROM ekipa");
	$data = $data2->fetch( PDO::FETCH_ASSOC );
	print_r(" <br/> ".$data['imie']);
	print_r(kursy_lista($baza));
	//print("co do mada kurna\n");
	//"pgsql:dbname=i8pecyna;port=5434;host=localhost", "i8pecyna", "banan2"
	
	?>
 </body>
<html/>
