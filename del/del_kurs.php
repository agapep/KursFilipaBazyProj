<?php
	
	function del ($database, $delFullName, $id) {
		$delName = substr($delFullName,4);
		$message = '<h2>Usuwanie '.$delName.'</h2>';
		try {
			$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$a = $database->exec('DELETE FROM '.$delName.' WHERE id='.$id);
			$message .= '<p>hurra... usuneliśmy</p>';
		} catch(Exception $e) {
			$message .= '<p>coś poszło nie tak. Nie udało sie wszystkiego pousuwać</p>' ;
			$message .= '<p>'.$e->getMessage()."</p>" ;
		}
		return $message;
	}
	
	function del_domy_rekolekcyjne($database, $id) {
		$a = $database->exec('DELETE FROM kursy WHERE id_domy_rekolekcyjne='.$id);
	}
	
	function del_funkcje_ekipa_kurs ($database, $id_funkcji , $id_ekipy, $id_kursu ) {
		$delName = substr('del_funkcje',4); //WTF
		$out = '<h2>Usunięto '.$delName.'</h2>';
		$out = '<h2>Usuwanie FROM '.$delName.'</h2>';
		$a = $database->exec('DELETE FROM funkcje_ekipa_kurs WHERE 
			id_ekipa='.$id_ekipy.' AND id_kursy = '.$id_kursu.' AND id_funkcje= '.$id_funkcji);
		if($a) 
			$out .= '<p>hurra... usuneliśmy</p>';
		else
			$out .= '<p>sorry coś poszło nie tak . Nie udało mi się usunąć tego co chciałeś/aś. To nie moja wina jak zwykle.</p>';
		return $out;
	};
?>
