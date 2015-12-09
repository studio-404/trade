<?php if(!defined("DIR")){ exit(); }
class get_sub_menus_by_idx extends connection{
	public function sub_menu($c,$idx,$filejson){
		$cache_file = "_cache/".$filejson; 

		if(file_exists($cache_file)){
			$output = @file_get_contents($cache_file); 
			$decode = json_decode($output,true);
		}else{
			$conn = $this->conn($c); 
			$sql = 'SELECT `title`,`slug` FROM `studio404_pages` WHERE `cid`=:cid AND `visibility`!=:one AND `status`!=:one ORDER BY `position` ASC';
			$prepare = $conn->prepare($sql);
			$prepare->execute(array(
				":cid"=>$idx, 
				":one"=>1
			));
			if($prepare->rowCount() > 0){
				$decode = $prepare->fetchAll(PDO::FETCH_ASSOC);
				$fh = @fopen($cache_file, 'w') or die("Error opening output file");
				@fwrite($fh, json_encode($decode,JSON_UNESCAPED_UNICODE));
				@fclose($fh);
			}else{ $decode = array(); }
		}
		

		return $decode;
	}
}
?>