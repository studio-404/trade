<?php if(!defined("DIR")){ exit(); }
class get_page_title extends connection{
	public function get($c,$idx){
		$conn = $this->conn($c);
		$sql = 'SELECT `title` FROM `studio404_pages` WHERE `idx`=:idx ';
		$prepare = $conn->prepare($sql);
		$prepare->execute(array(
			":idx"=>$idx
		));
		if($prepare->rowCount() > 0){
			$fetch = $prepare->fetch(PDO::FETCH_ASSOC);
			$out = $fetch["title"];
		}else{ $out = ""; }

		return $out;
	}
}
?>