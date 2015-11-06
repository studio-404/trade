<?php if(!defined("DIR")){ exit(); }
class retrieve_users_info extends connection{
	public function __construct(){
		
	}

	public function retrieveDb($idx_array){
		global $c;
		$conn = $this->conn($c);
		$out = '';
		$idx_array = preg_replace(
		  array(
		    '/[^\d,]/',    // Matches anything that's not a comma or number.
		    '/(?<=,),+/',  // Matches consecutive commas.
		    '/^,+/',       // Matches leading commas.
		    '/,+$/'        // Matches trailing commas.
		  ),
		  '',              // Remove all matched substrings.
		  $idx_array
		);
		if(!empty($idx_array)) : 
		$sql = 'SELECT `title` FROM `studio404_pages` WHERE `idx` IN ('.$idx_array.') AND `status`!=:one ORDER BY `title` ASC';
		$prepare = $conn->prepare($sql); 
		$prepare->execute(array(
			":one"=>1
		));
		$f = $prepare->fetchAll(PDO::FETCH_ASSOC);
		foreach ($f as $value) {
			$out .=  $value["title"].", ";
		}
		return rtrim($out,", ");
		endif;
	}

	public function retrieve_subsector_from_product($product_ids,$column = "title"){
		global $c;
		$conn = $this->conn($c);
		$out = '';
		$product_ids = preg_replace(
		  array(
		    '/[^\d,]/',    // Matches anything that's not a comma or number.
		    '/(?<=,),+/',  // Matches consecutive commas.
		    '/^,+/',       // Matches leading commas.
		    '/,+$/'        // Matches trailing commas.
		  ),
		  '',              // Remove all matched substrings.
		  $product_ids
		);	
		
		if(!empty($product_ids)) : 
		$sql = 'SELECT `cid` FROM `studio404_pages` WHERE `idx` IN ('.$product_ids.') AND `status`!=:one';
		$prepare = $conn->prepare($sql); 
		$prepare->execute(array(
			":one"=>1
		));
		$f = $prepare->fetchAll(PDO::FETCH_ASSOC);
		foreach ($f as $value) {
			$out .=  $value["cid"].", ";
		}
		$cids = rtrim($out,", ");

		$out2 = ''; 
		$sql2 = 'SELECT `'.$column.'` FROM `studio404_pages` WHERE `idx` IN ('.$cids.') AND `status`!=:one ORDER BY `title` ASC';
		$prepare2 = $conn->prepare($sql2); 
		$prepare2->execute(array(
			":one"=>1
		));
		$f2 = $prepare2->fetchAll(PDO::FETCH_ASSOC);
		foreach ($f2 as $value2) {
			$out2 .=  $value2[$column].", ";
		}
		return rtrim($out2,", ");
		endif;	

	}
}
?>