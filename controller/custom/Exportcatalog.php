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

		/* sub sector */
		$subsector = $cache->index($c,"subsector");
		$data["subsector"] = json_decode($subsector); 

		/* products */
		$products = $cache->index($c,"products");
		$data["products"] = json_decode($products); 

		/* countries */
		$countries = $cache->index($c,"countries");
		$data["countries"] = json_decode($countries); 

		/* certificates */
		$certificates = $cache->index($c,"certificates");
		$data["certificates"] = json_decode($certificates); 

		$db_count = new db_count();
		if(Input::method("GET","view")=="companies" OR empty(Input::method("GET","view"))) : 
			$data["get_view"] = (Input::method("GET","view")) ? Input::method("GET","view") : 'companies';
			$data["get_sort"] = (Input::method("GET","sort") && Input::method("GET","sort")=="desc") ? "DESC" : 'ASC';
			$data["get_subsector"] = (Input::method("GET","subsector")) ? urlencode(Input::method("GET","subsector")) : '';
			$data["get_products"] = (Input::method("GET","products")) ? Input::method("GET","products") : '';
			$data["get_exportmarkets"] = (Input::method("GET","exportmarkets")) ? Input::method("GET","exportmarkets") : '';
			$data["get_certificate"] = (Input::method("GET","certificate")) ? Input::method("GET","certificate") : '';
			$data["get_search"] = (Input::method("GET","search")) ? Input::method("GET","search") : '';
			$data["get_pn"] = (Input::method("GET","pn")) ? Input::method("GET","pn") : 1;
			$data["get_token"] = (Input::method("GET","token")) ? Input::method("GET","token") : '';
			$data["count"] = $db_count->retrieve($c,'studio404_users',' `status`!=1 AND `user_type`="website" AND (`company_type`="manufacturer" OR `company_type`="serviceprovider")');

			$limit = ' LIMIT '.(($data["get_pn"]-1)*10).', 10';
			$orderBy = ' ORDER BY `studio404_users`.`id` DESC';
			$subsectors = ($data["get_subsector"] && is_numeric($data["get_subsector"])) ? ' FIND_IN_SET('.$data["get_subsector"].',`studio404_users`.`sub_sector_id`) AND ' : '';
			$products = ($data["get_products"] && is_numeric($data["get_products"])) ? ' FIND_IN_SET('.$data["get_products"].',`studio404_users`.`products`) AND ' : '';
			$exportmarkets = ($data["get_exportmarkets"] && is_numeric($data["get_exportmarkets"])) ? ' FIND_IN_SET('.$data["get_exportmarkets"].',`studio404_users`.`export_markets_id`) AND ' : '';
			$certificates = ($data["get_certificate"] && is_numeric($data["get_certificate"])) ? ' FIND_IN_SET('.$data["get_certificate"].',`studio404_users`.`certificates`) AND ' : '';
			$search = (!empty($data["get_search"])) ? '`studio404_users`.`namelname` LIKE "%'.$data["get_search"].'%" AND ' : '';
			 
			$sql = 'SELECT 
			`studio404_users`.`id` AS su_id,
			`studio404_users`.`username` AS su_username,
			`studio404_users`.`sub_sector_id` AS su_sub_sector_id,
			`studio404_users`.`namelname` AS su_namelname,
			`studio404_users`.`picture` AS su_picture,
			`studio404_users`.`products` AS su_products, 
			`studio404_users`.`export_markets_id` AS su_export_markets_id, 
			`studio404_users`.`certificates` AS su_certificates, 
			`studio404_users`.`company_type` AS su_companytype
			FROM 
			`studio404_users`
			WHERE 
			`studio404_users`.`user_type`=:user_type AND 
			`studio404_users`.`allow`!=:one AND 
			'.$subsectors.' 
			'.$products.' 
			'.$exportmarkets.' 
			'.$certificates.' 
			'.$search.' 
			(`studio404_users`.`company_type`=:manufacturer OR `studio404_users`.`company_type`=:serviceprovider) AND 
			`studio404_users`.`status`!=:one '.$orderBy.' '.$limit.'
			';
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":manufacturer"=>'manufacturer', 
				":serviceprovider"=>'serviceprovider', 
				":user_type"=>'website', 
				":one"=>1
			));
			$data["fetch"] = $prepare->fetchAll(PDO::FETCH_ASSOC);
		endif;


		if(Input::method("GET","view")=="products") : 
			$data["get_view"] = (Input::method("GET","view")) ? Input::method("GET","view") : 'companies';
			$data["get_sort"] = (Input::method("GET","sort") && Input::method("GET","sort")=="asc") ? "ASC" : 'DESC';
			$data["get_subsector"] = (Input::method("GET","subsector")) ? urlencode(Input::method("GET","subsector")) : '';
			$data["get_products"] = (Input::method("GET","products")) ? Input::method("GET","products") : '';
			$data["get_search"] = (Input::method("GET","search")) ? Input::method("GET","search") : '';
			$data["get_pn"] = (Input::method("GET","pn")) ? Input::method("GET","pn") : 1;
			$data["get_token"] = (Input::method("GET","token")) ? Input::method("GET","token") : '';
			$data["count"] = $db_count->retrieve($c,'studio404_module_item',' `status`!=1 AND `visibility`=2 AND `module_idx`=3');

			$limit = ' LIMIT '.(($data["get_pn"]-1)*10).', 10';
			$orderBy = ' ORDER BY `studio404_module_item`.`date` '.urlencode($data["get_sort"]);
			$subsectors = ($data["get_subsector"] && is_numeric($data["get_subsector"])) ? ' FIND_IN_SET('.$data["get_subsector"].',`studio404_module_item`.`sub_sector_id`) AND ' : '';
			$products = ($data["get_products"] && is_numeric($data["get_products"])) ? ' FIND_IN_SET('.$data["get_products"].',`studio404_module_item`.`products`) AND ' : '';
			$search = (!empty($data["get_search"])) ? '`studio404_module_item`.`title` LIKE "%'.$data["get_search"].'%" AND ' : '';
			 
			$sql = 'SELECT 
			`studio404_module_item`.`id`, 
			`studio404_module_item`.`idx`, 
			`studio404_module_item`.`title`, 
			`studio404_module_item`.`picture`, 
			`studio404_module_item`.`sub_sector_id`, 
			`studio404_module_item`.`hscode`, 
			`studio404_module_item`.`products`, 
			`studio404_module_item`.`shelf_life`, 
			`studio404_module_item`.`packaging`, 
			`studio404_module_item`.`awards`, 
			`studio404_module_item`.`long_description`, 
			`studio404_users`.`id` AS users_id,
			`studio404_users`.`namelname` AS users_name, 
			`studio404_users`.`company_type` AS su_companytype
			FROM 
			`studio404_module_item`, `studio404_users`
			WHERE 
			`studio404_module_item`.`module_idx`=3 AND 
			'.$subsectors.' 
			'.$products.' 
			'.$search.' 
			`studio404_module_item`.`visibility`=:two AND 
			`studio404_module_item`.`status`!=:one AND 
			`studio404_module_item`.`insert_admin`=`studio404_users`.`id` AND 
			`studio404_users`.`status`!=:one  
			'.$orderBy.' '.$limit.'
			';
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":two"=>2, 
				":one"=>1
			));
			$data["fetch"] = $prepare->fetchAll(PDO::FETCH_ASSOC);

		endif;

		if(Input::method("GET","view")=="services") : 
			$data["get_view"] = (Input::method("GET","view")) ? Input::method("GET","view") : 'services';
			$data["get_sort"] = (Input::method("GET","sort") && Input::method("GET","sort")=="asc") ? "ASC" : 'DESC';
			$data["get_subsector"] = (Input::method("GET","subsector")) ? urlencode(Input::method("GET","subsector")) : '';
			$data["get_services"] = (Input::method("GET","products")) ? Input::method("GET","products") : '';
			$data["get_search"] = (Input::method("GET","search")) ? Input::method("GET","search") : '';
			$data["get_pn"] = (Input::method("GET","pn")) ? Input::method("GET","pn") : 1;
			$data["get_token"] = (Input::method("GET","token")) ? Input::method("GET","token") : '';
			$data["count"] = $db_count->retrieve($c,'studio404_module_item',' `status`!=1 AND `visibility`=2 AND `module_idx`=4');

			$limit = ' LIMIT '.(($data["get_pn"]-1)*10).', 10';
			$orderBy = ' ORDER BY `studio404_module_item`.`date` '.urlencode($data["get_sort"]);
			$subsectors = ($data["get_subsector"] && is_numeric($data["get_subsector"])) ? ' FIND_IN_SET('.$data["get_subsector"].',`studio404_module_item`.`sub_sector_id`) AND ' : '';
			$services = ($data["get_services"] && is_numeric($data["get_services"])) ? ' FIND_IN_SET('.$data["get_services"].',`studio404_module_item`.`products`) AND ' : '';
			$search = (!empty($data["get_search"])) ? '`studio404_module_item`.`long_description` LIKE "%'.$data["get_search"].'%" AND ' : '';
			 
			$sql = 'SELECT 
			`studio404_module_item`.`id`, 
			`studio404_module_item`.`idx`, 
			`studio404_module_item`.`title`, 
			`studio404_module_item`.`picture`, 
			`studio404_module_item`.`sub_sector_id`, 
			`studio404_module_item`.`hscode`, 
			`studio404_module_item`.`products`, 
			`studio404_module_item`.`shelf_life`, 
			`studio404_module_item`.`packaging`, 
			`studio404_module_item`.`awards`, 
			`studio404_module_item`.`long_description`, 
			`studio404_users`.`id` AS users_id,
			`studio404_users`.`namelname` AS users_name, 
			`studio404_users`.`picture` AS users_picture, 
			`studio404_users`.`company_type` AS su_companytype
			FROM 
			`studio404_module_item`, `studio404_users`
			WHERE 
			`studio404_module_item`.`module_idx`=4 AND 
			'.$subsectors.' 
			'.$services.' 
			'.$search.' 
			`studio404_module_item`.`visibility`=:two AND 
			`studio404_module_item`.`status`!=:one AND 
			`studio404_module_item`.`insert_admin`=`studio404_users`.`id` AND 
			`studio404_users`.`status`!=:one  
			'.$orderBy.' '.$limit.'
			';
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":two"=>2, 
				":one"=>1
			));
			$data["fetch"] = $prepare->fetchAll(PDO::FETCH_ASSOC);

		endif;

		@include($c["website.directory"]."/exportcatalog.php"); 
	}
}
?>