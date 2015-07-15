<?php if(!defined("DIR")){ exit(); }
class company extends connection{
	function __construct($c){
		$this->template($c);
	}
	
	public function template($c){
		$conn = $this->conn($c); // connection

		$cache = new cache();
		$text_general = $cache->index($c,"text_general");
		$data["text_general"] = json_decode($text_general,true);

		// $text_files = $cache->index($c,"text_files");
		// $data["text_files"] = json_decode($text_files);

		// $text_documents = $cache->index($c,"text_documents");
		// $data["text_documents"] = json_decode($text_documents);

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

		/* website left menu */
		// $left_menu = $cache->index($c,"left_menu");
		// $left_menu = json_decode($left_menu);
		// $data["left_menu"] = $model_template_main_menu->left($left_menu);

		/* breadcrups */
		$breadcrups = $cache->index($c,"breadcrups");
		$data["breadcrups"] = json_decode($breadcrups);

		/* components */
		$components = $cache->index($c,"components");
		$data["components"] = json_decode($components); 

		/*company*/
		$data["get_view"] = (Input::method("GET","view")) ? (int)Input::method("GET","view") : 1;
		$data["get_token"] = (Input::method("GET","token")) ? Input::method("GET","token") : '';

		
		$sql = 'SELECT 
		`studio404_users`.*
		FROM 
		`studio404_users` 
		WHERE 
		`studio404_users`.`user_type`=:user_type AND 
		`studio404_users`.`id`=:idx AND 
		`studio404_users`.`allow`!=:one AND 
		`studio404_users`.`status`!=:one 
		';
		$prepare = $conn->prepare($sql); 
		$prepare->execute(array(
			":user_type"=>'website', 
			":idx"=>$data["get_view"], 
			":one"=>1
		));
		$data["fetch"] = $prepare->fetch(PDO::FETCH_ASSOC);		
		$retrieve_users_info = new retrieve_users_info();
		// echo "<pre>";
		// print_r($data["fetch"]); 
		// echo "</pre>";
		@include($c["website.directory"]."/company.php");
	}
}
?>