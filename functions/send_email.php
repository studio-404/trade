<?php if(!defined("DIR")){ exit(); }
class send_email{
	public $outMessage = 2; 
	function __construct(){

	}

	public function send($host,$user,$pass,$from,$fromname,$where_to_send,$subject,$message){
		$message = html_entity_decode($message);
		$msg = wordwrap($message,70);
		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		// More headers
		$headers .= 'From: <'.$from.'>' . "\r\n";
		//$headers .= 'Cc: myboss@example.com' . "\r\n";
		if(is_array($where_to_send)){
			foreach ($where_to_send as $value) {
				@mail($value,$subject,$msg,$headers);
			}
		}else{
			@mail($where_to_send,$subject,$msg,$headers);
		}
		$this->outMessage = 1;
		return $this->outMessage;
	}

	function __destruct(){

	}
}
?>