<?php if(!defined("DIR")){ echo "Sorry, You dont have a permittion !"; exit(); }
class src_database_connection{
	public $HANDLER;

	function __construct(){
		$this->conn();
	}

	public function conn(){
		try{
			$host = 'mysql:host='.DATABASE_HOSTNAME.';dbname='.DATABASE_NAME.";charset=".DATABASE_CHARSET; 
			$this->HANDLER = new PDO($host,DATABASE_USERNAME,DATABASE_PASSWORD); 
			$this->HANDLER->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->HANDLER->exec("set names ".DATABASE_CHARSET); 
		}catch(PDOException $e){
			die("Sorry, Database connection problem.."); 
		}
		return $this->HANDLER;
	}

	function __destruct(){
		
	}
}
?>