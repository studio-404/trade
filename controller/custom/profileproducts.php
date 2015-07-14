<?php if(!defined("DIR")){ exit(); }
class profileproducts extends connection{
	function __construct($c){
		if(isset($_SESSION["tradewithgeorgia_company_type"]) && $_SESSION["tradewithgeorgia_company_type"]!="manufacturer"){
			$controller = new error_page(); 
		}else{
			$this->template($c);
		}
	}
	
	public function template($c){
		$conn = $this->conn($c); // connection

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

		if(!isset($_SESSION["user_data"]) && isset($_SESSION["tradewithgeorgia_username"])){
			$sql = 'SELECT * FROM `studio404_users` WHERE `username`=:username AND `allow`!=:one AND `status`!=:one';
			$prepare = $conn->prepare($sql);
			$prepare->execute(array(
				":username"=>$_SESSION["tradewithgeorgia_username"], 
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

		// upload function 
		$model_template_upload_user_logo = new model_template_upload_user_logo();
		$upload = $model_template_upload_user_logo->upload($c);

		@include($c["website.directory"]."/profileproducts.php"); 
	}
}
?>