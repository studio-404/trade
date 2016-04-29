<?php if(!defined("DIR")){ exit(); }
class newsletteremail extends connection{
	function __construct($c){
		$this->template($c,"newsletteremail");
	}
	
	public function template($c,$page){
		
		if(Input::method("GET","id") && is_numeric(Input::method("GET","id")))
		{
			$conn = $this->conn($c); 
			$sql = 'SELECT `productlist` FROM `studio404_newsletter_sended` WHERE `id`=:idx';
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":idx"=>Input::method("GET","id")
			));
			if($prepare->rowCount() > 0){
				$fetch = $prepare->fetch(PDO::FETCH_ASSOC); 
				echo $fetch['productlist'];
			}
		}else{
			$controller = new error_page(); 
		}
	}
}
?>