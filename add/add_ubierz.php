<?php

	function validateDate($date, $format = 'Y-m-d H:i:s')
	{
		$d = DateTime::createFromFormat($format, $date);
		return $d && $d->format($format) == $date;
	}

	function add_ubierz ($a, $database, $id, $redirect) {
		if ($id == 0) $id = null;
		$ratiobox = Array();
		$data = $a->fetchAll( PDO::FETCH_NAMED );
		$row = $data[0];
		foreach ($row as $key => $value) {
			//print $key. " ".$value." | ";
			if(! is_int($key) && $key !='id') {
// 				var_dump("key:".$key);
// 				var_dump("val:".$value);
// 				var_dump("validate:".validateDate($value));
				if (!preg_match('/^id/',$key, $matches)){
					$out .= '<tr><td>'.$key."</td>".PHP_EOL;
					
					if(validateDate($value)) {
						$out .= '<td><input type="date" name="'.$key.'" value='.(isset($id)?$value:"").' /></td></tr>'.PHP_EOL;
					} else {
						$out .= '<td><input type="text" name="'.$key.'" value="'.(isset($id)?$value:"").'" /></td></tr>'.PHP_EOL;
					}
				} else {
					$ratiobox[$key]=$value;
				}
			} else {
				$out .= '<td><input type="hidden" name="'.$key.'" value="'.$value."\" /></td></tr>".PHP_EOL;
			}
		}
			
		foreach ($ratiobox as $key2 => $value2) {
			$key3 = substr($key2,3);
			
			$query = 'SELECT * FROM '.$key3;
			$data2 = $database->query($query);
			$data = $data2->fetchAll( PDO::FETCH_NAMED );	
			$out .= '<tr><td colspan="3"><h3>Wybierz '.$key3.'</h3><td></tr>';
			foreach ($data as $row){
				//print_r($id." ".$row['id']." |");
				if(isset($id) && $id == $row['id'])
					$out .= '<tr><td><input type="radio" name="'.$key2.'" value="'.$row['id'].'" checked="checked" /></td>';
				else
					$out .= '<tr><td><input type="radio" name="'.$key2.'" value="'.$row['id'].'" /></td>';
				foreach ($row as $key => $value) {
					if(! is_int( $key) && $key !='id' )
					$out .= '<td> '.$value.' </td>';
					//print_r("kkk");
				}
				$out .= '</td></tr>';
			}
			//print_r("kkk");
			
		}
		$out .= '<tr><td><input type="hidden" name="redirect" value="'.$redirect."\" /></td></tr>".PHP_EOL;
		$out .= '<tr><td><input type="hidden" name="id" value="'.$id."\" /></td></tr>".PHP_EOL;
		return $out;
	};
	
	function add_create_form_inner($schema, $database, $item, $redirect) {
		foreach ($schema as $field) {
			$key = $field['column_name'];
			$db_type = $field['data_type'];
				
			//input standard values
			$value = $item[$key];
			if(substr($db_type, 0 , 9) == "timestamp") {
				date_default_timezone_set("Europe/Belgrade");
				$value = date_format(date_create($value), 'Y-m-d');
			}
			
			$valueStr = isset($item[$key]) ? " value='".$value."' ": " ";
			if(! is_int($key) && $key !='id') {
				if (!preg_match('/^id/',$key, $matches)){
					$out .= '<tr><td>'.$key."</td>".PHP_EOL;
					switch ($db_type) {
						case 'integer':
						case 'smallint': $type = 'number'; break;
						case 'text': $type = 'email'; break;
						case 'character varying':
						case 'character': $type = 'text'; break;
						case 'timestamp without time zone':
						case 'timestamp': $type = 'date'; break;
					}
					$out .= '<td><input type="'.$type.'" name="'.$key.'" '.$valueStr.' /></td></tr>'.PHP_EOL;
				} else {
					$ratiobox[$key]=$db_type;
				}
			} else {
				$out .= '<td><input type="hidden" name="'.$key.'" value="'.$item[$key]."\" /></td></tr>".PHP_EOL;
			}
		}
		
		foreach ($ratiobox as $key2 => $value2) {
			$id = $item[$key2];
			$key3 = substr($key2,3);
			//print_r($item[$key2]);
			$query = 'SELECT * FROM '.$key3;
			$data2 = $database->query($query);
			$data = $data2->fetchAll( PDO::FETCH_NAMED );
			$out .= '<tr><td colspan="3"><h3>Wybierz '.$key3.'</h3><td></tr>';
			foreach ($data as $row){
				//print_r($id." ".$row['id']." |");
				if(isset($id) && $id == $row['id'])
					$out .= '<tr class="hl"><td><input type="radio" name="'.$key2.'" value="'.$row['id'].'" checked="checked" /></td>';
				else
					$out .= '<tr class="hl"><td><input type="radio" name="'.$key2.'" value="'.$row['id'].'" /></td>';
				foreach ($row as $key => $value) {
					if(! is_int( $key) && $key !='id' && $value!="" )
						$out .= '<td><b> '.$key.":</b> ".$value.' </td>';
					//print_r("kkk");
				}
				$out .= '</td></tr>';
			}
			//print_r("kkk");
		
		}
		$out .= '<tr><td><input type="hidden" name="redirect" value="'.$redirect."\" /></td></tr>".PHP_EOL;
		return $out;
	}
	
	function add_create_form ($schema, $database, $item, $redirect) {
		$ratiobox = Array();
		return add_create_form_inner(array_reverse($schema), $database, $item, $redirect);
	}
	
?>
