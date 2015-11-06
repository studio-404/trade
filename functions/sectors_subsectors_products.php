<?php if(!defined("DIR")){ exit(); }
class sectors_subsectors_products extends connection{
	function __construct(){
	}
	public function sectors($c){
		$conn = $this->conn($c);
		$sql = 'SELECT `idx`,`title` FROM `studio404_pages` WHERE `cid`=:cid AND `visibility`!=:visibility AND `status`!=:status ORDER BY `title` ASC';
		$prepare = $conn->prepare($sql); 
		$prepare->execute(array(
			":cid"=>30, 
			":visibility"=>1, 
			":status"=>1
		));
		$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC);
		return $fetch;
	}
	public function subsector($c,$idx=''){
		$conn = $this->conn($c);
		if($idx==''){
			$sql = 'SELECT `idx` FROM `studio404_pages` WHERE `cid`=:cid AND `visibility`!=:visibility AND `status`!=:status ORDER BY `title` ASC';
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":cid"=>30, 
				":visibility"=>1, 
				":status"=>1
			));
			$fe = $prepare->fetchAll(PDO::FETCH_ASSOC);
			$i = '';
			foreach($fe as $val){
				$i .= $val["idx"].","; 
			}
		}else{ $i=implode(",",$idx); }
		$in = rtrim($i,",");
		
		$sql2 = 'SELECT `idx`,`title` FROM `studio404_pages` WHERE `cid` IN ('.$in.') AND `visibility`!=:visibility AND `status`!=:status ORDER BY `title` ASC';
		$prepare2 = $conn->prepare($sql2); 
		$prepare2->execute(array(
			":visibility"=>1, 
			":status"=>1
		));
		$fetch = $prepare2->fetchAll(PDO::FETCH_ASSOC);
		return $fetch;
	}
	public function products($c,$idx=''){
		$conn = $this->conn($c);
			if($idx==''){
			$fe = $this->subsector($c);
			$i = '';
			foreach($fe as $val){
				$i .= $val["idx"].",";
			}
		}else{
			$i=implode(",",$idx);
		}
		$in = rtrim($i,",");
		$sql2 = 'SELECT `idx`,`cid`,`title` FROM `studio404_pages` WHERE `cid` IN ('.$in.') AND `visibility`!=:visibility AND `status`!=:status ORDER BY `title` ASC';
		$prepare2 = $conn->prepare($sql2); 
		$prepare2->execute(array(
			":visibility"=>1, 
			":status"=>1
		));
		$fetch = $prepare2->fetchAll(PDO::FETCH_ASSOC);
		return $fetch;
	}
	public function countries($c){
		$conn = $this->conn($c);
		$sql = 'SELECT `idx`,`title` FROM `studio404_pages` WHERE `cid`=:cid AND `visibility`!=:visibility AND `status`!=:status ORDER BY `title` ASC';
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
		$sql = 'SELECT `idx`,`title` FROM `studio404_pages` WHERE `cid`=:cid AND `visibility`!=:visibility AND `status`!=:status ORDER BY `title` ASC';
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