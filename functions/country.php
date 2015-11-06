<?php if(!defined("DIR")){ exit(); }
class country{

	public function get($ip){
		$content = @file_get_contents("http://ipinfo.io/{$ip}");
		if($content){
			$details = json_decode($content);
			return $details->country; 
		}
		return "";
	}

}
?>