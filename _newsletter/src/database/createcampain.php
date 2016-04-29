<?php if(!defined("DIR")){ echo "Sorry, You dont have a permittion !"; exit(); }
class src_database_createcampain extends src_database_connection{
	
	public $db_handler;

	function __construct(){
		$this->db_handler = $this->conn();
		$sql = "CREATE TABLE IF NOT EXISTS `studio404_campain` (
		    `id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		    `uid` varchar(255) NOT NULL default '',
		    `date` int(11) NOT NULL,
		    `status` varchar(3) NOT NULL default 'off'
		)";
		$prepare = $this->db_handler->prepare($sql); 
		$prepare->execute();
	}

	public function campain(){
		$uid = src_functions_uniqueid::generate(9);
		$select = 'SELECT `uid` FROM `studio404_campain` WHERE `status`=:status';
		$prepare = $this->db_handler->prepare($select);
		$prepare->execute(array(
			":status"=>"on"
		));
		if($prepare->rowCount()){
			return false;
		}else{
			$insert = 'INSERT INTO `studio404_campain` SET `uid`=:uid, `date`=:datex, `status`=:status';
			$pre = $this->db_handler->prepare($insert);
			$pre->execute(array(
				":uid"=>$uid, 
				":datex"=>time(), 
				":status"=>"on"
			));
			$update = 'UPDATE `studio404_newsletter_emails` SET `pending`=0';
			$upd = $this->db_handler->prepare($update);
			$upd->execute();
			return true;
		}
	}
}
?>