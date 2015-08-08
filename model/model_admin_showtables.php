<?php if(!defined("DIR")){ exit(); } 
class model_admin_showtables extends connection{

	public function showtables($c){
		$conn = $this->conn($c);
		$sql = 'SELECT * FROM information_schema.tables WHERE TABLE_SCHEMA="geoweb_trade"';
		$prepare = $conn->prepare($sql);
		$prepare->execute();
		if($prepare->rowCount()>0){
			$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC);
		}else{ $fetch = array(); }
		return $fetch;
	}

}

?>