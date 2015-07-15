<?php if(!defined("DIR")){ exit(); }
class exportcatalog extends connection{
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

		/* components */
		$components = $cache->index($c,"components");
		$data["components"] = json_decode($components); 
		
		/* sector */
		$sector = $cache->index($c,"sector");
		$data["sector"] = json_decode($sector); 

		/* certificates */
		$certificates = $cache->index($c,"certificates");
		$data["certificates"] = json_decode($certificates); 

		$data["get_view"] = (Input::method("GET","view")) ? Input::method("GET","view") : 'companies';
		$data["get_sort"] = (Input::method("GET","sort")) ? strtoupper(Input::method("GET","sort")) : 'ASC';
		$data["get_sector"] = (Input::method("GET","sector")) ? Input::method("GET","sector") : '';
		$data["get_certificate"] = (Input::method("GET","certificate")) ? Input::method("GET","certificate") : '';
		$data["get_search"] = (Input::method("GET","search")) ? Input::method("GET","search") : '';
		$data["get_pn"] = (Input::method("GET","pn")) ? Input::method("GET","pn") : 1;
		$data["get_token"] = (Input::method("GET","token")) ? Input::method("GET","token") : '';

		$limit = ' LIMIT '.(($data["get_pn"]-1)*10).', 10';
		$orderBy = ' ORDER BY `studio404_users`.`namelname` '.$data["get_sort"];
		$sectors = ($data["get_sector"] && is_numeric($data["get_sector"])) ? ' FIND_IN_SET('.$data["get_sector"].',`studio404_users`.`sector_id`) AND ' : '';
		$certificates = ($data["get_certificate"] && is_numeric($data["get_certificate"])) ? ' FIND_IN_SET('.$data["get_certificate"].',`studio404_users`.`certificates`) AND ' : '';
		$search = (!empty($data["get_search"])) ? '`studio404_users`.`namelname` LIKE "%'.$data["get_search"].'%" AND ' : '';
		 
		$sql = 'SELECT 
		`studio404_users`.`id` AS su_id,
		`studio404_users`.`username` AS su_username,
		`studio404_users`.`sector_id` AS su_sector_id,
		`studio404_users`.`namelname` AS su_namelname,
		`studio404_users`.`picture` AS su_picture,
		`studio404_users`.`products` AS su_products, 
		`studio404_users`.`export_markets_id` AS su_export_markets_id, 
		`studio404_users`.`certificates` AS su_certificates
		FROM 
		`studio404_users` 
		WHERE 
		`studio404_users`.`user_type`=:user_type AND 
		`studio404_users`.`allow`!=:one AND 
		'.$sectors.' 
		'.$certificates.' 
		'.$search.' 
		`studio404_users`.`status`!=:one '.$orderBy.' '.$limit.'
		';
		$prepare = $conn->prepare($sql); 
		$prepare->execute(array(
			":user_type"=>'website', 
			":one"=>1
		));
		$data["fetch"] = $prepare->fetchAll(PDO::FETCH_ASSOC);
		// echo "<pre>";
		// print_r($data["fetch"]); 
		// echo "</pre>";

		@include($c["website.directory"]."/exportcatalog.php"); 
	}
}
?>