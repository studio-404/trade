<?php if(!defined("DIR")){ exit(); }
class ajax extends connection{
	function __construct($c){
		$this->requests($c);
	}

	public function requests($c){
		$conn = $this->conn($c); 
		$email = Input::method("POST","email");
		echo $email; 		
	}
}
?>