<?php
	
// 	ini_set('display_errors',1);
// 	ini_set('log_errors',1);
// 	error_reporting(E_ALL);
	
	require_once('./klasy/Template.php');
	require_once('./klasy/DB.php');
	require_once('./get/all.php');
	require_once('./add/all.php');
	require_once('./del/del_kurs.php');
	require_once('./message.php');
	
	$db = new DB();
	$tmpl = new Template('template.tmpl');
	
//-----------------------------------------------------------------
//-----------------------UZUPEŁNIAMY GŁÓWNĄ TREŚĆ------------------
//-----------------------------------------------------------------

//-----------------------------------------------------------------
//-----------------------KOMUNIKATY--------------------------------
//-----------------------------------------------------------------
	if(isset($_POST['err_code'])) {
		if($_POST['err_code'] > 0)
			$tmpl->add('err',add_nok("tab", $_POST['err_code'], $_POST['err_message']));
		else
			$tmpl->add('err',add_ok("tab"));
	} else $tmpl->add('err',"");
	
	if(isset($_GET['ok_db']))
		$tmpl->add('main',ok_db());
		
	else if(isset($_GET['nieok_db']))
		$tmpl->add('main',nieok_db());
	
//-----------------------------------------------------------------
//-----------------------GETY--------------------------------------
//-----------------------------------------------------------------
	else if(isset($_GET['ekipa']))
		$tmpl->add('main',ekipa($db,$_GET['ekipa']));
		
	else if(isset($_GET['kursy_lista']))
		$tmpl->add('main',kursy_lista($db));
		
	else if (isset($_GET['funkcje']))
		$tmpl->add('main',funkcja($db, $_GET['funkcje']));
		
	else if (isset($_GET['ekipa_lista']))
		$tmpl->add('main',ekipa_lista($db));
		
	else if (isset($_GET['kurs']))
		$tmpl->add('main',kurs($db, $_GET['kurs']));
		
	else if(isset($_GET['uczestnik']))
		$tmpl->add('main',uczestnik($db,$_GET['uczestnik']));
		
	else if(isset($_GET['domy_lista']))
		$tmpl->add('main',domy_lista($db,$_GET['domy_lista']));
		
	else if(isset($_GET['domy_rekolekcyjne']))
		$tmpl->add('main',domy_rekolekcyjne($db,$_GET['domy_rekolekcyjne']));


//-----------------------------------------------------------------
//------------------------ADDY-------------------------------------
//-----------------------------------------------------------------
    else if(isset($_GET['add_dom']))
		$tmpl->add('main',add_dom($db, reset($_GET)));
		
	else if(isset($_GET['add_ekipa']))
		$tmpl->add('main',add_ekipa($db, reset($_GET)));
		
	else if(isset($_GET['add_funkcje']))
		$tmpl->add('main',add_funkcja($db, reset($_GET)));
		
	else if(isset($_GET['add_kurs']))
		$tmpl->add('main',add_kurs($db, reset($_GET)));
		
	else if(isset($_GET['add_uczestnik']))
		if(isset($_GET['add_uczestnik_kurs']))
			$tmpl->add('main',add_uczestnik($db, $_GET['add_uczestnik'],$_GET['add_uczestnik_kurs']));
		else
			$tmpl->add('main',add_uczestnik($db,$_GET['add_uczestnik']));
	
	else if(isset($_GET['add_ekipa_kurs']))
		$tmpl->add('main',add_ekipa_kurs($db,$_GET['add_ekipa_kurs']));
		
//-----------------------------------------------------------------
//------------------------DELETY-----------------------------------
//-----------------------------------------------------------------
	else if(isset($_GET['del_kurs']))
		$tmpl->add('main',del($db,'del_kursy',$_GET['del_kurs']));
	
	else if(isset($_GET['del_uczestnik']))
		$tmpl->add('main',del($db,'del_uczestnicy',$_GET['del_uczestnik']));
	
	else if(isset($_GET['del_domy_rekolekcyjne']))
		$tmpl->add('main',del($db,'del_domy_rekolekcyjne',$_GET['del_domy_rekolekcyjne']));
	
	else if(isset($_GET['del_funkcje']))
		$tmpl->add('main',del_funkcje_ekipa_kurs($db,$_GET['idFunkcje'],$_GET['idEkipa'],$_GET['idKursy'])); 
		
	else if(isset($_GET['del_ekipa']))
		$tmpl->add('main',del($db,'del_ekipa',$_GET['del_ekipa']));

//-----------------------------------------------------------------
//-----------------------UNIWERSALNY-------------------------------
//-----------------------------------------------------------------
	else
		$tmpl->add('main',kursy_lista($db));
//-----------------------------------------------------------------
//-----------------------WKLEJAMY MENU-----------------------------
//-----------------------------------------------------------------
	    $tmpl->add('menu',menu());
	
	echo $tmpl->execute();

?>
