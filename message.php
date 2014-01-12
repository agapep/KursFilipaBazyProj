<?php

	function ok_db ($database) {
		$out = '<h2>Pomyślnie dodano dane do bazy</h2>';
		$out .='<p>Kolejna porcja danych dotarła do bazy. To się robi nudne. </p>';
		return $out;
	}
	
	function add_ok ($table) {
		$out = '<h3>Pomyślnie dodano dane do Bazy</h3>';
		$out .='<p>Udało się dodać/zaaktualizować dane w tabeli:'.$table.'</p>';
		return $out;
	}
	function add_nok ($table, $error_code, $error_message) {
		$out = '<h3>Błąd'.$error_code.'</h3>';
		$out .='<p>Nie udało się dodać danych do tabeli '.$table.':<br/>'.$error_message.'</p>';
		return $out;
	}
	
	
	function nieok_db ($database) {
		$out = '<h2>Nie udało się dodać danych do bazy!!!</h2>';
		$out .='<p>Niestety, tak jak w temacie, nie udało mi się dodać 
		danych które podałeś do Bazy danych. Zapewne jest to twoja wina 
		i nie powinienem się tym przejmować, ale jeśli odpowiednio dużo 
		zapłacisz czy coś tam to mogę się tym zainteresować. 
		Maila do mnie możesz wysłać klikając na dole strony na takie
		Niebieskie co jak najedziesz myszką to się podkreśli... tak, tak
		tam gdzie jest napisane Krzysztof Pecyna. Jak już wspomniałem to 
		nie jest moją winą, że coś się nie udało. </p>';
		return $out;
	}
?>
