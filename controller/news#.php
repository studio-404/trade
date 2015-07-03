<?php if(!defined("DIR")){ exit(); }
class news extends connection{
	function __construct($c){
		$this->template($c);
	}

	public function template($c){
		$conn = $this->conn($c); // connection

		$cache = new cache();
		$data["news_general"] = $cache->index($c,"news_general");
		$data["news_list"] = $cache->index($c,"news_list");
		$data["components"] = $cache->index($c,"components");
		$data["languages"] = $cache->index($c,"languages");
		$data["language_data"] = $cache->index($c,"language_data");
		$data["main_menu"] = $cache->index($c,"main_menu");
		
		@include($c["website.directory"]."/news.php"); 
	}
}
?>