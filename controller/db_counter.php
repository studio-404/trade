<?php if(!defined("DIR")){ exit(); }
class db_counter extends connection{
	public function sq($c,$column,$table,$where){
		$conn = $this->conn($c); 
		$sql = 'SELECT '.$column.' AS counted FROM '.$table.' WHERE '.$where;
		$prepare = $conn->prepare($sql); 
		$prepare->execute(); 
		if($prepare->rowCount()>0){
			$counted = $prepare->rowCount(); 
		}else{
			$counted = 0;
		}
		return $counted;
	}
}
?>