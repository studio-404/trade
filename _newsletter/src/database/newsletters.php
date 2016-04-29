<?php if(!defined("DIR")){ echo "Sorry, You dont have a permittion !"; exit(); }
class src_database_newsletters extends src_database_connection{
	function __construct(){
		
	}

	public function newsletters($limit = "LIMIT 0,25"){
		$db_handler = $this->conn();
		$sql = 'SELECT `id`,`email`,`unsubscribe` FROM `'.NEWSLETTER_TABLE_NAME.'` WHERE `email` REGEXP "^[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$" AND `pending`=:zero ORDER BY id ASC '.$limit;
		$prepare = $db_handler->prepare($sql); 
		$prepare->execute(array(
			":zero"=>"0"
		));
		if($prepare->rowCount() > 0){
			$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC);
			return $fetch;
		}else{
			return false;
		}
	}

	public function sended($id){
		$db_handler = $this->conn();
		$sql = 'UPDATE `'.NEWSLETTER_TABLE_NAME.'` SET `pending`=:one WHERE `id`=:id';
		$prepare = $db_handler->prepare($sql); 
		$prepare->execute(array(
			":one"=>1,
			":id"=>$id 
		));
	}

	public function reset(){
		$db_handler = $this->conn();
		$sql = 'UPDATE `'.NEWSLETTER_TABLE_NAME.'` SET `pending`=:zero WHERE 1';
		$prepare = $db_handler->prepare($sql); 
		$prepare->execute(array(
			":zero"=>"0"
		));
	}
}
?>