<?php
ini_set ( 'display_errors', 1 );
ini_set ( 'log_errors', 1 );
error_reporting ( E_ALL );
require_once ('./klasy/DB.php');
$i = 0;
//print_r($_POST);
//echo " ----- ";
//var_dump($_POST);

function testKeyVal($key, $value) {
	if ($key != 'id' && $key != 'redirect' && $value != '') return true;
	else return false;	
}

function insert($GET, $POST) {
	$i = 0;
	$zapytanie = 'INSERT INTO ' . $GET['where'] . ' ( ';
	foreach ( $POST as $key => $value ) {
		if (testKeyVal($key, $value)) {
			if ($i == 0)
				$zapytanie .= $key . ' ';
			else
				$zapytanie .= ', ' . $key;
			++ $i;
		}
	}
	$zapytanie .= ') VALUES ( ';
	$i = 0;
	foreach ( $POST as $key => $value ) {
		if (testKeyVal($key, $value)) {
			if ($i == 0)
				$zapytanie .= '\'' . $value . '\' ';
			else
				$zapytanie .= ', \'' . $value . '\'';
			++ $i;
		}
	}
	$zapytanie .= ')';
	return $zapytanie;
}

function update($GET, $POST, $id) {
	$i = 0;
	$zapytanie = 'UPDATE ' . $GET ['where'] . ' SET ';
	foreach ( $POST as $key => $value ) {
		if (testKeyVal($key, $value)) {
			if ($i == 0)
				$zapytanie .= $key."='".$value."' ";
			else
				$zapytanie .= ', '.$key."='".$value."' ";
			++ $i;
		}
	}
	$zapytanie .= 'WHERE id='.$id;
	return $zapytanie;
}

$id = $_POST ['id'];
print_r($_POST);
if (!isset ( $id ) || $id == 0) {
	$zapytanie = insert ( $_GET, $_POST, $id );
} else {
	$zapytanie = update ( $_GET, $_POST, $id );
}
//~ 
$db = new DB ();
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//$q = $db->prepare($zapytanie);
try {
	$db->exec($zapytanie);
	print_r("ok");
	$errCode = 0;
	$message = "poprawnie dodano ";
	
	//if (!isset ( $id ) || $id == 0) $id = $db -> lastInsertId($_GET['where']."_id_seq");
	$redirect_to = "index.php?";
	if( isset($_POST['redirect']) && $_POST['redirect'] ) {
		$redirect_to .= $_POST['redirect'];
		if (isset($_POST['id_'.$_POST['redirect']])) 
			$redirect_to .= "=".$_POST['id_'.$_POST['redirect']];
	} else {
		if (!isset ( $id ) || $id == 0) $id = $db -> lastInsertId($_GET['where']."_id_seq");
		$redirect_to .= $_GET['where']."=".$id; 
	}
} catch (Exception $e) {
	print_r($e);
	$errCode = 1;
	$redirect_to = $_SERVER['HTTP_REFERER'];
	//temp = $db->errorInfo();
	$message = $e->getMessage(); //$temp[2];
	if ( $message == null ) $message = "Niestety nie udało się dodać/zaaktualizować danych.
			Niestety brak jakichkolwiek informacji co poszło nie tak.";
	else {
		$temp = $db->errorInfo();
		$err_code = $temp[0];
	}
}
print_r($message);
//$a = $db->exec ( $zapytanie );
//echo $zapytanie;
//echo $_SERVER['HTTP_REFERER'];
// echo(" ".$a) ;
// echo " ok";
// else
// echo " nieok";

echo "<form action='".$redirect_to."' method='post' name='frm'>";
echo "<input type='hidden' name='err_code' value='".$errCode."'>";
echo "<input type='hidden' name='err_message' value='".$message."'>";
echo "</form><script language='JavaScript'>".
	"document.frm.submit();".
	"</script>";

// if ($a)
// 	header ( "Location: index.php?ok_db" );
// else
// 	header ( "Location: ".$_SERVER['HTTP_REFERER'] );

?>
