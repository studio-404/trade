<?php if(!defined("DIR")){ echo "Sorry, You dont have a permittion !"; exit(); }
class src_share_sendmail{
	public function sendMail($fromname,$frommail,$subject,$message,$where_to_send){
		$from_user = "=?utf-8?B?".base64_encode($fromname)."?=";
	    $subject = "=?utf-8?B?".base64_encode($subject)."?=";
		$headers = "From: $from_user <".$frommail.">\r\n". 
	               "MIME-Version: 1.0" . "\r\n" . 
	               "Content-type: text/html; charset=utf-8" . "\r\n"; 
	     
		if(mail($where_to_send, $subject, base64_decode($message), $headers)){
			return true;
		}
		return false;
	}
}
?>