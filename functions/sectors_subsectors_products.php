<?php if(!defined("DIR")){ exit(); }
class sectors_subsectors_products extends connection{

	function __construct(){

	}

	public function sectors($c){
		$conn = $this->conn($c);
		$sql = 'SELECT `idx`,`title` FROM `studio404_pages` WHERE `cid`=:cid AND `visibility`!=:visibility AND `status`!=:status ORDER BY `position` ASC';
		$prepare = $conn->prepare($sql); 
		$prepare->execute(array(
			":cid"=>30, 
			":visibility"=>1, 
			":status"=>1
		));
		$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC);
		return $fetch;
	}

	public function countries($c){
		$conn = $this->conn($c);
		$sql = 'SELECT `idx`,`title` FROM `studio404_pages` WHERE `cid`=:cid AND `visibility`!=:visibility AND `status`!=:status ORDER BY `position` ASC';
		$prepare = $conn->prepare($sql); 
		$prepare->execute(array(
			":cid"=>561, 
			":visibility"=>1, 
			":status"=>1
		));
		$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC);
		return $fetch;
	}

	public function certificates($c){
		$conn = $this->conn($c);
		$sql = 'SELECT `idx`,`title` FROM `studio404_pages` WHERE `cid`=:cid AND `visibility`!=:visibility AND `status`!=:status ORDER BY `position` ASC';
		$prepare = $conn->prepare($sql); 
		$prepare->execute(array(
			":cid"=>755, 
			":visibility"=>1, 
			":status"=>1
		));
		$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC);
		return $fetch;
	}

	public function companysize($c){
		$conn = $this->conn($c);
		$sql = 'SELECT `idx`,`title` FROM `studio404_pages` WHERE `cid`=:cid AND `visibility`!=:visibility AND `status`!=:status ORDER BY `position` ASC';
		$prepare = $conn->prepare($sql); 
		$prepare->execute(array(
			":cid"=>765, 
			":visibility"=>1, 
			":status"=>1
		));
		$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC);
		return $fetch;
	}

}
?>
