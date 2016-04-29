<?php if(!defined("DIR")){ exit(); }
class clear{
	function __construct($c){
		$this->template($c,"clear");
	}
	
	public function template($c,$page){
		$files = glob(DIR . "_cache/*"); 
		array_map('unlink', $files);
	}
}
?>