<?php if(!defined("DIR")){ exit(); }
class homepage extends connection{
	function __construct($c){
		$this->template($c);
	}

	public function template($c){
		$conn = $this->conn($c); // connection
		$cache = new cache();
		$data["homepage_general"] = $cache->index($c,"homepage_general");
		$data["homepage_files"] = $cache->index($c,"homepage_files");

		/* languages */
		$languages = $cache->index($c,"languages");
		$data["languages"] = json_decode($languages); 

		/* language variables */
		$language_data = $cache->index($c,"language_data");
		$language_data = json_decode($language_data);
		$model_template_makevars = new  model_template_makevars();
		$data["language_data"] = $model_template_makevars->vars($language_data); 
	
		/* website menu header & footer */
		$menu_array = $cache->index($c,"main_menu");
		$menu_array = json_decode($menu_array);
		if($menu_array){
			$model_template_main_menu = new model_template_main_menu();
			$data["main_menu"] = $model_template_main_menu->nav($menu_array,"header");
			$data["footer_menu"] = $model_template_main_menu->nav($menu_array,"footer");
		}

		/* components */
		$components = $cache->index($c,"components");
		$data["components"] = json_decode($components); 

		/* multimedia */
		$multimedia = $cache->index($c,"multimedia");
		$data["multimedia"] = json_decode($multimedia); 

		$news = $cache->index($c,"news");
		$data["news"] = json_decode($news);

		$events = $cache->index($c,"events");
		$data["events"] = json_decode($events);

		@include($c["website.directory"]."/homepage.php"); 
	}
}
?>