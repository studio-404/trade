<?php if(!defined("DIR")){ exit(); }
class user extends connection{
	function __construct($c){
		$this->template($c);
	}
	
	public function template($c){
		$conn = $this->conn($c); // connection

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

		/* breadcrups */
		$breadcrups = $cache->index($c,"breadcrups");
		$data["breadcrups"] = json_decode($breadcrups);

		/* components */
		$components = $cache->index($c,"components");
		$data["components"] = json_decode($components); 

		/* countries */
		$countries = $cache->index($c,"countries");
		$data["countries"] = json_decode($countries); 

		/* users statements */
		$model_template_userstatements = new model_template_userstatements();
		$data["userstatements"] = $model_template_userstatements->stats($c,Input::method("GET","t"),Input::method("GET","i"));
		
		$doerror = false;
		/*company*/
		if(Input::method("GET","t")=="manufacturer" || Input::method("GET","t")=="serviceprovider" || Input::method("GET","t")=="company" || Input::method("GET","t")=="individual"){
			if(Input::method("GET","t")=="manufacturer"){
				$columns = '
				`studio404_users`.`namelname`, 
				`studio404_users`.`picture`, 
				`studio404_users`.`sector_id`, 
				`studio404_users`.`sub_sector_id`, 
				`studio404_users`.`products`, 
				`studio404_users`.`export_markets_id`, 
				`studio404_users`.`certificates`, 
				`studio404_users`.`production_capacity`, 
				`studio404_users`.`established_in`, 
				`studio404_users`.`number_of_employes`, 
				`studio404_users`.`address`, 
				`studio404_users`.`mobile`, 
				`studio404_users`.`office_phone`, 
				`studio404_users`.`email`, 
				`studio404_users`.`web_address`, 
				`studio404_users`.`about` 
				';	
			}else if(Input::method("GET","t")=="serviceprovider"){
				$columns = '
				`studio404_users`.`namelname`, 
				`studio404_users`.`picture`, 
				`studio404_users`.`sector_id`, 
				`studio404_users`.`sub_sector_id`, 
				`studio404_users`.`products`, 
				`studio404_users`.`export_markets_id`, 
				`studio404_users`.`certificates`, 
				`studio404_users`.`production_capacity`, 
				`studio404_users`.`established_in`, 
				`studio404_users`.`number_of_employes`, 
				`studio404_users`.`address`, 
				`studio404_users`.`mobile`, 
				`studio404_users`.`office_phone`, 
				`studio404_users`.`email`, 
				`studio404_users`.`web_address`, 
				`studio404_users`.`about` 
				';	
			}else if(Input::method("GET","t")=="company"){
				$columns = '
				`studio404_users`.`namelname`, 
				`studio404_users`.`address`, 
				`studio404_users`.`mobile`, 
				`studio404_users`.`office_phone`, 
				`studio404_users`.`email`, 
				`studio404_users`.`web_address` 
				';	
			}else if(Input::method("GET","t")=="individual"){
				$columns = '
				`studio404_users`.`namelname`, 
				`studio404_users`.`address`, 
				`studio404_users`.`mobile`, 
				`studio404_users`.`office_phone`, 
				`studio404_users`.`email`, 
				`studio404_users`.`web_address` 
				';	
			}

			$data["get_type"] = Input::method("GET","t");
		}else{ 
			$doerror = true; 
			$redirect = new redirect();
			$redirect->go(WEBSITE);
			die(); 
		}
		$data["get_view"] = (int)Input::method("GET","i");
		$data["get_product"] = (int)Input::method("GET","p");
		$data["get_token"] = (Input::method("GET","token")) ? Input::method("GET","token") : '';

	
		$sql = 'SELECT 
		'.$columns.'
		FROM 
		`studio404_users` 
		WHERE 
		`studio404_users`.`user_type`=:user_type AND 
		`studio404_users`.`company_type`=:company_type AND 
		`studio404_users`.`id`=:idx AND 
		`studio404_users`.`allow`!=:one AND 
		`studio404_users`.`status`!=:one 
		';
		$prepare = $conn->prepare($sql); 
		$prepare->execute(array(
			":user_type"=>'website', 
			":company_type"=>$data["get_type"], 
			":idx"=>$data["get_view"], 
			":one"=>1
		));

		if($prepare->rowCount() > 0){
			$data["fetch"] = $prepare->fetch(PDO::FETCH_ASSOC);		
			$retrieve_users_info = new retrieve_users_info();
			@include($c["website.directory"]."/user.php");
		}else{
			$doerror = true; 
			$redirect = new redirect();
			$redirect->go(WEBSITE);
			die(); 
		}
	}
}
?>