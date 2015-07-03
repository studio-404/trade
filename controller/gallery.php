<?php if(!defined("DIR")){ exit(); }
class gallery extends connection{
	function __construct(){
		global $c;
		$this->template($c);
	}

	public function template($c){
		$conn = $this->conn($c); // connection

		$cache = new cache();

		// $text_general = $cache->index($c,"text_general");
		// $data["text_general"] = json_decode($text_general,true);

		$files_ = $cache->index($c,"files_");
		$data["files_"] = json_decode($files_);

		/* breadcrups */
		$breadcrups = $cache->index($c,"breadcrups");
		$data["breadcrups"] = json_decode($breadcrups);

		@include($c["website.directory"]."/gallery.php"); 
	}
}
?>