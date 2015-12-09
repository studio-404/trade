<?php if(!defined("DIR")){ exit(); }
class calculate_pre extends connection{
	public function calc($c,$userid){
		$conn = $this->conn($c);
		$sql = 'SELECT * FROM `studio404_users` WHERE `id`=:id';
		$prepare = $conn->prepare($sql);
		$prepare->execute(array(
			":id"=>$userid
		));
		$fetch = array();
		if($prepare->rowCount() > 0){
			$fetch = $prepare->fetch(PDO::FETCH_ASSOC);
		}
		return $fetch;
	}
}
?>