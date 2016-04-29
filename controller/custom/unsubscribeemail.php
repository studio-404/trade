<?php if(!defined("DIR")){ exit(); }
class unsubscribeemail extends connection{
	function __construct($c){
		$this->template($c);
	}
	
	public function template($c){
		//if someone try to unsibscrime others emails
    	if(!$_SESSION['countme']){ $_SESSION['countme'] = $_SESSION['countme']+1; }
    	if(isset($_SESSION['countme']) && $_SESSION['countme']>100){ die(); }
    	
    	$conn = $this->conn($c); 
    	$sql = 'UPDATE `studio404_newsletter_emails` SET `status`=:status WHERE `unsubscribe`=:unsubscribe AND `status`!=:one';
    	$prepare = $conn->prepare($sql); 
    	$prepare->execute(array(
    		":status"=>1, 
    		":unsubscribe"=>Input::method("GET","e"), 
    		":one"=>1
    	));
    	if($prepare->rowCount()){
    		$data["website_title"] = "Your email unsubscribed !";
    		$data["website_text"] = "Your email unsubscribed !";
    		@include($c["website.directory"]."/unsubscribe.php"); 
    	}else{
    		@include($c["website.directory"]."/error_page.php"); 
    	}
	}
}
?>