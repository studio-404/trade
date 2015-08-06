<?php if(!defined("DIR")){ exit(); }
class businessportal extends connection{
	function __construct($c){
		$this->template($c,"businessportal");
	}
	
	public function template($c,$page){
		$conn = $this->conn($c); // connection

		$cache = new cache();
		$text_general = $cache->index($c,"text_general");
		$data["text_general"] = json_decode($text_general,true);

		/* sector */
		$sector = $cache->index($c,"sector");
		$data["sector"] = json_decode($sector); 

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


		$data["get_view"] = (Input::method("GET","view")) ? Input::method("GET","view") : '';
		$data["get_type"] = (Input::method("GET","type")) ? urlencode(Input::method("GET","type")) : '';
		$data["get_sector"] = (Input::method("GET","sector")) ? Input::method("GET","sector") : '';
		$data["get_search"] = (Input::method("GET","search")) ? Input::method("GET","search") : '';
		$data["get_pn"] = (Input::method("GET","pn")) ? Input::method("GET","pn") : 1;
		$data["get_token"] = (Input::method("GET","token")) ? Input::method("GET","token") : '';
		$db_count = new db_count();
		$data["count"] = $db_count->retrieve($c,'studio404_module_item',' `status`!=1 AND `visibility`=2 AND `module_idx`=5');

		$limit = ' LIMIT '.(($data["get_pn"]-1)*10).', 10';
		$orderBy = ' ORDER BY `studio404_module_item`.`date` DESC';
		$sector = ($data["get_sector"] && is_numeric($data["get_sector"])) ? ' FIND_IN_SET('.$data["get_sector"].',`studio404_module_item`.`sector_id`) AND ' : '';
		$ctype = ($data["get_type"]) ? '`studio404_users`.`company_type`="'.$data["get_type"].'" AND ' : '';
		$type = ($data["get_view"]) ? '`studio404_module_item`.`type`="'.$data["get_view"].'" AND ' : '';
		$search = (!empty($data["get_search"])) ? '`studio404_module_item`.`title` LIKE "%'.$data["get_search"].'%" AND ' : '';
		try{
		$sql = 'SELECT 
		`studio404_module_item`.`id`, 
		`studio404_module_item`.`idx`, 
		`studio404_module_item`.`date`, 
		`studio404_module_item`.`title`, 
		`studio404_module_item`.`type`, 
		`studio404_module_item`.`long_description`, 
		`studio404_users`.`id` AS users_id,
		`studio404_users`.`namelname` AS users_name, 
		`studio404_users`.`company_type` AS su_companytype, 
		(SELECT `title` FROM `studio404_pages` WHERE `studio404_pages`.`idx`=`studio404_module_item`.`sector_id` AND `lang`=:lang) AS sector_name 
		FROM 
		`studio404_module_item`, `studio404_users`
		WHERE 
		`studio404_module_item`.`module_idx`=5 AND 
		'.$sector.' 
		'.$type.'
		'.$search.' 
		`studio404_module_item`.`visibility`=:two AND 
		`studio404_module_item`.`status`!=:one AND 
		`studio404_module_item`.`insert_admin`=`studio404_users`.`id` AND 
		'.$ctype.'
		`studio404_users`.`status`!=:one  
		'.$orderBy.' '.$limit.'
		';
		// echo $sql;
		$prepare = $conn->prepare($sql); 
		$prepare->execute(array(
			":lang"=>LANG_ID, 
			":two"=>2, 
			":one"=>1
		));
		$data["fetch"] = $prepare->fetchAll(PDO::FETCH_ASSOC);
		}catch(Exception $e){
			$redirect = new redirect();
			$redirect->go(WEBSITE);
			die(); 
		}
		
		

		@include($c["website.directory"]."/businessportal.php"); 
	}
}
?>