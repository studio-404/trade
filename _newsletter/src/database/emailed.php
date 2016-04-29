<?php if(!defined("DIR")){ echo "Sorry, You dont have a permittion !"; exit(); }
class src_database_emailed extends src_database_connection{
	
	public $db_handler;

	public function insert($email,$data){	
		$this->db_handler = $this->conn();	
		$insert = 'INSERT INTO `studio404_newsletter_sended` SET `data`=:datax, `emailto`=:emailto, `productlist`=:productlist';
		$pre = $this->db_handler->prepare($insert);
		$pre->execute(array(
			":datax"=>time(), 
			":emailto"=>$email, 
			":productlist"=>$data
		));
	}
}
?>