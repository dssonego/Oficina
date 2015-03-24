<?php
class Connection{
	public static $db;
	
	public function instance(){
		if(!self::$db){
			$db = new Connection();
			self::$db = $db->connect();
		}
		return self::$db;
	}

	private function connect(){
		$db = new PDO("mysql:host=localhost;dbname=oficina","root","");
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $db;
	}
}


?>