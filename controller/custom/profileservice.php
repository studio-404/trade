<?php if(!defined("DIR")){ exit(); }
class profileservice extends connection{
	function __construct($c){
		if(isset($_SESSION["tradewithgeorgia_company_type"]) && $_SESSION["tradewithgeorgia_company_type"]!="serviceprovider"){
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
		$model_template_upload_user_logo = new model_template_upload_user_logo();
		$upload = $model_template_upload_user_logo->upload($c);

		$cache = new cache();
		$text_general = $cache->index($c,"text_general");
		$data["text_general"] = json_decode($text_general,true);

		$text_documents = $cache->index($c,"text_documents");
		$data["text_documents"] = json_decode($text_documents);

		/* languages */
		$languages = $cache->index($c,"languages");
		$data["languages"] = json_decode($languages); 

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

		
		$service_sql = 'SELECT `id`,`idx`,`title`,`products`,`long_description`, `visibility`, `admin_com` FROM `studio404_module_item` WHERE `module_idx`=:module_idx AND `insert_admin`=:insert_admin AND `status`!=:one ORDER BY `date` DESC LIMIT 5';
		$service_product = $conn->prepare($service_sql);
		$service_product->execute(array(
			":module_idx"=>4, 
			":insert_admin"=>$_SESSION["tradewithgeorgia_user_id"], 
			":one"=>1
		));
		$data["myservices"] = $service_product->fetchAll(PDO::FETCH_ASSOC); 

		$db_count = new db_count();
		$session_user_id = (int)$_SESSION["tradewithgeorgia_user_id"];
		$data["count"] = $db_count->retrieve($c,'studio404_module_item',' `status`!=1 AND `module_idx`=4 AND `insert_admin`='.$session_user_id);

		@include($c["website.directory"]."/profileservice.php"); 
	}
}
?>