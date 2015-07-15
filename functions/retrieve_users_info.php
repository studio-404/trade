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
		$sql = 'SELECT `title` FROM `studio404_pages` WHERE `idx` IN ('.$idx_array.') AND `status`!=:one';
		$prepare = $conn->prepare($sql); 
		$prepare->execute(array(
			":one"=>1
		));
		$f = $prepare->fetchAll(PDO::FETCH_ASSOC);
		foreach ($f as $value) {
			$out .=  $value["title"].", ";
		}
		return rtrim($out,",");
		endif;
	}
}
?>