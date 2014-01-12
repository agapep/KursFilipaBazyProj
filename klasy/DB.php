<?php

class DB extends \PDO {
	public function __construct( ){
		include('db_inc.php');
		parent::__construct('pgsql:dbname='.$database.';host='.$host, $username, $password);
	}
	
	public function getInfo($column) {
		$q = $this->query("SELECT column_name, data_type FROM information_schema.columns WHERE table_name ='".$column."'");
		return $q->fetchAll( PDO::FETCH_NAMED );
	}
	
	public function getItem($column, $id, $obj) {
		if ($id==null || $id==0) return $obj;
		$q = $this->query("SELECT * FROM ".$column." WHERE id=".$id);
		if($q != null) {
			$temp =$q->fetchAll( PDO::FETCH_NAMED ); 
			return $temp[0];
		} else return $obj;
	}
}
?>
