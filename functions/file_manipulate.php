<?php if(!defined("DIR")){ exit(); }
class file_manipulate{
	function __destruct(){

	}

	public function insertLog($text){
		$file = fopen('log.txt', 'a+');
		fwrite($file, $text."\n");
		fclose($file);
	}
}
?>