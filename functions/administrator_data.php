<?php if(!defined("DIR")){ exit(); }
class administrator_data extends connection{
	public function getter($c,$id,$user_type){
		$conn = $this->conn($c); 
		$sql = 'SELECT * FROM `studio404_users` WHERE `id`=:id AND `user_type`=:user_type';
		$prepare = $conn->prepare($sql); 
		$prepare->execute(array(
			":id"=>$id, 
			":user_type"=>$user_type
		));
		$fetch = $prepare->fetch(PDO::FETCH_ASSOC);
		return $fetch;
	}
}
?>