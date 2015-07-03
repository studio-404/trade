<?php if(!defined("DIR")){ exit(); }
class search extends connection{
	function __construct($c){
		$this->template($c);
	}

	public function template($c){
		$conn = $this->conn($c); // connection

		$cache = new cache();
		$text_general = $cache->index($c,"text_general");
		$data["text_general"] = json_decode($text_general,true);

		$text_files = $cache->index($c,"text_files");
		$data["text_files"] = json_decode($text_files);

		$text_documents = $cache->index($c,"text_documents");
		$data["text_documents"] = json_decode($text_documents);

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
		$s = filter_input(INPUT_GET, "s");
		if(isset($s) && !empty($s)){
			$s = strip_tags($s);
			$s = str_replace("\\","",$s);
			$s = str_replace("..","",$s);
			$s = str_replace("-","",$s);
			$model_template_search = new model_template_search();
			$data["result"] = $model_template_search->studio404_search($c,$s);
		}else{
			$data["result"] = array();
		}


		@include($c["website.directory"]."/search.php"); 
	}
}
?>