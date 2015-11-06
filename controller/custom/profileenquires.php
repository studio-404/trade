<?php if(!defined("DIR")){ exit(); }
class profileenquires extends connection{
	function __construct($c){ 
		if(isset($_SESSION["tradewithgeorgia_company_type"]) && $_SESSION["tradewithgeorgia_company_type"]!="company" && $_SESSION["tradewithgeorgia_company_type"]!="individual"){
			$redirect = new redirect();
			$redirect->go(WEBSITE);
			die(); 
		}else{
			$this->template($c);
		}
	}
	
	public function template($c){
		$conn = $this->conn($c); // connection

		// upload function 
		// $model_template_upload_user_logo = new model_template_upload_user_logo();
		// $upload = $model_template_upload_user_logo->upload($c);
		
		$cache = new cache();
		$text_general = $cache->index($c,"text_general");
		$data["text_general"] = json_decode($text_general,true);

		/* sector */
		$sector = $cache->index($c,"sector");
		$data["sector"] = json_decode($sector); 

		/* countries */
		$countries = $cache->index($c,"countries");
		$data["countries"] = json_decode($countries); 

		/* certificates */
		$certificates = $cache->index($c,"certificates");
		$data["certificates"] = json_decode($certificates); 

		/* Company size */
		$companysize = $cache->index($c,"companysize");
		$data["companysize"] = json_decode($companysize); 

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
		

		if(!isset($_SESSION["user_data"]["companyname"]) && isset($_SESSION["tradewithgeorgia_username"])){
			$sql = 'SELECT * FROM `studio404_users` WHERE `id`=:companyId AND `username`=:username AND `allow`!=:one AND `status`!=:one';
			$prepare = $conn->prepare($sql);
			$prepare->execute(array(
				":username"=>$_SESSION["tradewithgeorgia_username"], 
				":companyId"=>$_SESSION["tradewithgeorgia_user_id"], 
				":one"=>1
			));
			$fetch = $prepare->fetch(PDO::FETCH_ASSOC); 
			$_SESSION["user_data"]["picture"] = $fetch["picture"];
			$_SESSION["user_data"]["companyname"] = $fetch["namelname"];
			$_SESSION["user_data"]["sector"] = $fetch["sector_id"];
			$_SESSION["user_data"]["subsector"] = $fetch["sub_sector_id"];
			$_SESSION["user_data"]["establishedin"] = $fetch["established_in"];
			$_SESSION["user_data"]["productioncapasity"] = $fetch["production_capacity"];
			$_SESSION["user_data"]["address"] = $fetch["address"];
			$_SESSION["user_data"]["mobiles"] = $fetch["mobile"];
			$_SESSION["user_data"]["numemploy"] = $fetch["number_of_employes"];
			$_SESSION["user_data"]["certificates"] = $fetch["certificates"];
			$_SESSION["user_data"]["contactpersones"] = $fetch["contact_person"];
			$_SESSION["user_data"]["officephone"] = $fetch["office_phone"];
			$_SESSION["user_data"]["companysize"] = $fetch["company_size"];
			$_SESSION["user_data"]["webaddress"] = $fetch["web_address"];
			$_SESSION["user_data"]["contactemail"] = $fetch["email"];
			$_SESSION["user_data"]["about"] = $fetch["about"];
			$_SESSION["user_data"]["products"] = $fetch["products"];
			$_SESSION["user_data"]["exportmarkets"] = $fetch["export_markets_id"];
		}

		// select products
		$products_sql = 'SELECT 
		`studio404_module_item`.`id`,
		`studio404_module_item`.`idx`,
		`studio404_module_item`.`date`,
		`studio404_module_item`.`title`,
		`studio404_module_item`.`sector_id`,
		`studio404_module_item`.`type`, 
		`studio404_module_item`.`long_description`,
		`studio404_module_item`.`admin_com`,
		`studio404_module_item`.`visibility`
		FROM 
		`studio404_module_item`
		WHERE 
		`studio404_module_item`.`insert_admin`=:insert_admin AND 
		`studio404_module_item`.`module_idx`=:module_idx AND 
		`studio404_module_item`.`status`!=:one 
		ORDER BY `studio404_module_item`.`date` DESC LIMIT 5';
		$prepare_product = $conn->prepare($products_sql);
		$prepare_product->execute(array(
			":insert_admin"=>$_SESSION["tradewithgeorgia_user_id"], 
			":module_idx"=>5, 
			":one"=>1
		));
		$data["myenquire"] = $prepare_product->fetchAll(PDO::FETCH_ASSOC); 

		$db_count = new db_count();
		$session_user_id = (int)$_SESSION["tradewithgeorgia_user_id"];
		$data["count"] = $db_count->retrieve($c,'studio404_module_item',' `status`!=1 AND `module_idx`=5 AND `insert_admin`='.$session_user_id);

		@include($c["website.directory"]."/profileenquires.php"); 
	}
}
?>