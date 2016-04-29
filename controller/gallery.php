<?php if(!defined("DIR")){ exit(); }
class gallery extends connection{
	function __construct(){
		global $c;
		$this->template($c);
	}

	public function template($c){
		$conn = $this->conn($c); // connection

		$cache = new cache();

		/* contact_page_data */
		$contact_page_data = $cache->index($c,"contact_page_data");
		$data["contact_data"] = json_decode($contact_page_data,true); 

		$files_ = $cache->index($c,"files_");
		$data["files_"] = json_decode($files_);

		/* breadcrups */
		$breadcrups = $cache->index($c,"breadcrups");
		$data["breadcrups"] = json_decode($breadcrups);

		@include($c["website.directory"]."/gallery.php"); 
	}
}
?>