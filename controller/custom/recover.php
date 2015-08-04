<?php if(!defined("DIR")){ exit(); }
class recover extends connection{
	function __construct($c){
		if(isset($_SESSION["tradewithgeorgia_username"]) || !isset($_GET["rl"]) || !isset($_GET['ui']) || !is_numeric($_GET['ui']) ){ 
			redirect::url(WEBSITE);
		}
		$this->template($c);
	}
	
	public function template($c){
		$conn = $this->conn($c); // connection

		$module_template_recoverpassword = new module_template_recoverpassword();
		$data["message"] = $module_template_recoverpassword->change($c);
		
		$cache = new cache();
		$text_general = $cache->index($c,"text_general");
		$data["text_general"] = json_decode($text_general,true);

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
		$model_template_main_menu = new model_template_main_menu();
		$data["main_menu"] = $model_template_main_menu->nav($menu_array,"header");
		$data["footer_menu"] = $model_template_main_menu->nav($menu_array,"footer");

		/* components */
		$components = $cache->index($c,"components");
		$data["components"] = json_decode($components); 
		


		@include($c["website.directory"]."/recover.php"); 
	}
}
?>