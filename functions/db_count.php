<?php if(!defined("DIR")){ exit(); }
class db_count extends connection{
	public function retrieve($c,$table, $where = false){
		$conn = $this->conn($c);
		if($where){ $where = ' WHERE '.$where; }else{ $where = ''; }
		$sql = 'SELECT `id` FROM `'.$table.'` '.$where;
		
		$prepare = $conn->prepare($sql); 
		$prepare->execute();
		return $prepare->rowCount(); 
	}
}
?>