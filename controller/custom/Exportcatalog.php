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

		/* contact_page_data */
		$contact_page_data = $cache->index($c,"contact_page_data");
		$data["contact_data"] = json_decode($contact_page_data,true); 

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
			
			if(!empty($data["get_search"])){	
				$searchPages = 'SELECT `idx` FROM `studio404_pages` WHERE `title` LIKE "%?%" AND `slug` LIKE "selectoption%" AND `status`!=1';
				$prepareSearch = $conn->prepare($searchPages); 
				// $searchQuery = urldecode($data["get_search"]);
				$searchQuery = str_replace(array('"','.'),array('',''),$data["get_search"]);
				$prepareSearch->execute(array($searchQuery));
				$s = '';
				if($prepareSearch->rowCount() > 0){
					$fetchPages = $prepareSearch->fetchAll(PDO::FETCH_ASSOC);
					foreach ($fetchPages as $value) {
						$s .= ' OR ( FIND_IN_SET("'.$value['idx'].'",`sector_id`) OR FIND_IN_SET("'.$value['idx'].'",`sub_sector_id`) OR FIND_IN_SET("'.$value['idx'].'",`products`) OR FIND_IN_SET("'.$value['idx'].'",`export_markets_id`) OR FIND_IN_SET("'.$value['idx'].'",`certificates`) ) '; 
					}
				}
				if($s!=''){
					$search ='(`studio404_users`.`id`="'.$searchQuery.'" OR `studio404_users`.`namelname` LIKE "'.$searchQuery.'%" '.$s.' OR `studio404_users`.`namelname` LIKE "%'.$searchQuery.'" OR MATCH(`studio404_users`.`namelname`) AGAINST ("'.$searchQuery.'") '.$s.') AND ';
				}else{
					$search ='`studio404_users`.`id`="'.$searchQuery.'" OR `studio404_users`.`namelname` LIKE "'.$searchQuery.'%" OR `studio404_users`.`namelname` LIKE "%'.$searchQuery.'" OR MATCH(`studio404_users`.`namelname`) AGAINST ("'.$searchQuery.'") AND ';	
				}
				
			}else{
				$search = "";
			}

			if(Input::method("GET","csv")){ 
				$sql = 'SELECT 
				`studio404_users`.`id` AS su_id,
				`studio404_users`.`username` AS su_username,
				(SELECT `title` FROM  `studio404_pages` WHERE `studio404_pages`.`idx`=`studio404_users`.`sub_sector_id`) AS su_sub_sector_title,
				`studio404_users`.`namelname` AS su_namelname,
				(SELECT `title` FROM  `studio404_pages` WHERE `studio404_pages`.`idx`=`studio404_users`.`products`) AS su_products,
				(SELECT `title` FROM  `studio404_pages` WHERE `studio404_pages`.`idx`=`studio404_users`.`export_markets_id`) AS su_exportmarkets,
				(SELECT `title` FROM  `studio404_pages` WHERE `studio404_pages`.`idx`=`studio404_users`.`certificates`) AS su_certificates 
				FROM 
				`studio404_users`
				WHERE 
				`studio404_users`.`user_type`=:user_type AND 
				`studio404_users`.`allow`!=:one AND 
				`studio404_users`.`namelname`<>"" AND 
				`studio404_users`.`picture`<>"" AND 
				`studio404_users`.`sector_id`<>"" AND 
				`studio404_users`.`sub_sector_id`<>"" AND 
				`studio404_users`.`products`<>"" AND 
				'.$subsectors.' 
				'.$products.' 
				'.$exportmarkets.' 
				'.$certificates.' 
				'.$search.' 
				(`studio404_users`.`company_type`=:manufacturer OR `studio404_users`.`company_type`=:serviceprovider) AND 
				`studio404_users`.`status`!=:one '.$orderBy.'';
			}else{
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
				`studio404_users`.`namelname`<>"" AND 
				`studio404_users`.`picture`<>"" AND 
				`studio404_users`.`sector_id`<>"" AND 
				`studio404_users`.`sub_sector_id`<>"" AND 
				`studio404_users`.`products`<>"" AND 
				'.$subsectors.' 
				'.$products.' 
				'.$exportmarkets.' 
				'.$certificates.' 
				'.$search.' 
				(`studio404_users`.`company_type`=:manufacturer OR `studio404_users`.`company_type`=:serviceprovider) AND 
				`studio404_users`.`status`!=:one '.$orderBy.' '.$limit.'
				';
			}

			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":manufacturer"=>'manufacturer', 
				":serviceprovider"=>'serviceprovider', 
				":user_type"=>'website', 
				":one"=>1
			));
			if($prepare->rowCount() > 0){
				if(Input::method("GET","csv")){
					// Create array
					$filename = "userstable.csv";
		            $list = array ();

		            // Append results to array
		            array_push($list, array("ID","EMAIL","Subsector","Company Name","Product","Export market","certificate"));
		            while ($row = $prepare->fetch(PDO::FETCH_ASSOC)) {
		                array_push($list, array_values($row));
		            }

		            // Output array into CSV file
		            $fp = fopen('php://output', 'w');
		            header('Content-Type: text/csv');
		            header('Content-Disposition: attachment; filename="'.$filename.'"');
		            foreach ($list as $ferow) {
		                fputcsv($fp, $ferow);
		            }
		            exit();
				}
				$data["fetch"] = $prepare->fetchAll(PDO::FETCH_ASSOC);
			}else{
				$data["fetch"] = array();
			}
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
			
			
			if(!empty($data["get_search"])){	
				$searchQuery = str_replace(array('"','.'),array('',''),$data["get_search"]);
				$searchPages = 'SELECT `idx` FROM `studio404_pages` WHERE `title` LIKE "%?%" AND `slug` LIKE "selectoption%" AND `status`!=1';
				$prepareSearch = $conn->prepare($searchPages); 
				$prepareSearch->execute(array($searchQuery));
				$s = '';
				if($prepareSearch->rowCount() > 0){
					$fetchPages = $prepareSearch->fetchAll(PDO::FETCH_ASSOC);
					foreach ($fetchPages as $value) {
						$s .= ' OR ( FIND_IN_SET("'.$value['idx'].'",`studio404_module_item`.`sector_id`) OR FIND_IN_SET("'.$value['idx'].'",`studio404_module_item`.`sub_sector_id`) OR FIND_IN_SET("'.$value['idx'].'",`studio404_module_item`.`products`) ) '; 
					}
				}
				if($s!=''){
					$search ='(
						`studio404_module_item`.`id`="'.$searchQuery.'" OR 
						`studio404_module_item`.`title` LIKE "'.$searchQuery.'%" OR 
						`studio404_module_item`.`title` LIKE "%'.$searchQuery.'" OR 
						MATCH(`studio404_module_item`.`title`) AGAINST ("'.$searchQuery.'") OR 
						`studio404_module_item`.`long_description` LIKE "'.$searchQuery.'%" OR 
						`studio404_module_item`.`long_description` LIKE "%'.$searchQuery.'" OR 
						MATCH(`studio404_module_item`.`long_description`) AGAINST ("'.$searchQuery.'") OR 
						`studio404_users`.`namelname` LIKE "'.$searchQuery.'%" OR
						`studio404_users`.`namelname` LIKE "%'.$searchQuery.'" OR 
						MATCH(`studio404_users`.`namelname`) AGAINST ("'.$searchQuery.'") '.$s.'
					) AND ';
					//OR MATCH(`studio404_users`.`namelname`) AGAINST ("'.$data["get_search"].'")
				}else{
					$search ='(
						`studio404_module_item`.`id`="'.$searchQuery.'" OR 
						`studio404_module_item`.`title` LIKE "'.$searchQuery.'%" OR 
						`studio404_module_item`.`title` LIKE "%'.$searchQuery.'" OR 
						MATCH(`studio404_module_item`.`title`) AGAINST ("'.$searchQuery.'") OR 
						`studio404_module_item`.`long_description` LIKE "'.$searchQuery.'%" OR 
						`studio404_module_item`.`long_description` LIKE "%'.$searchQuery.'" OR 
						MATCH(`studio404_module_item`.`long_description`) AGAINST ("'.$searchQuery.'") OR 
						`studio404_users`.`namelname` LIKE "'.$searchQuery.'%" OR 
						`studio404_users`.`namelname` LIKE "%'.$searchQuery.'" OR 
						MATCH(`studio404_users`.`namelname`) AGAINST ("'.$searchQuery.'") 
					) AND ';	
				}
				
			}else{
				$search = "";
			}
			//echo $search;
			if(Input::method("GET","csv")){ 
				$sql = 'SELECT 
				`studio404_module_item`.`title`, 
				(SELECT `title` FROM  `studio404_pages` WHERE `studio404_pages`.`idx`=`studio404_module_item`.`sub_sector_id`) AS su_sector,
				(SELECT `title` FROM  `studio404_pages` WHERE `studio404_pages`.`idx`=`studio404_module_item`.`hscode`) AS su_hscode,
				(SELECT `title` FROM  `studio404_pages` WHERE `studio404_pages`.`idx`=`studio404_module_item`.`products`) AS su_products,
				`studio404_module_item`.`shelf_life`, 
				`studio404_module_item`.`packaging`, 
				`studio404_module_item`.`awards`, 
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
				`studio404_users`.`status`!=:one AND   
				`studio404_users`.`allow`!=:one 
				';
			}else{
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
				`studio404_users`.`status`!=:one AND   
				`studio404_users`.`allow`!=:one 
				'.$orderBy.' '.$limit.'
				';
			}

			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":two"=>2, 
				":one"=>1
			));
			if($prepare->rowCount() > 0){
				if(Input::method("GET","csv")){
					// Create array
					$filename = "producttable.csv";
		            $list = array ();

		            // Append results to array
		            array_push($list, array("Title","SubSector","HScode","Product","Shelf life","Packaging","Awards","Username","Users Company Type"));
		            while ($row = $prepare->fetch(PDO::FETCH_ASSOC)) {
		                array_push($list, array_values($row));
		            }

		            // Output array into CSV file
		            $fp = fopen('php://output', 'w');
		            header('Content-Type: text/csv');
		            header('Content-Disposition: attachment; filename="'.$filename.'"');
		            foreach ($list as $ferow) {
		                fputcsv($fp, $ferow);
		            }
		            exit();
				}
				$data["fetch"] = $prepare->fetchAll(PDO::FETCH_ASSOC);
			}else{
				$data["fetch"] = array();
			}
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
			
			if(!empty($data["get_search"])){
				$searchQuery = str_replace(array('"','.'),array('',''),$data["get_search"]);
				$searchPages = 'SELECT `idx` FROM `studio404_pages` WHERE `title` LIKE "%?%" AND `slug` LIKE "selectoption%" AND `status`!=1';
				$prepareSearch = $conn->prepare($searchPages); 
				$prepareSearch->execute(array($searchQuery));
				$s = '';
				if($prepareSearch->rowCount() > 0){
					$fetchPages = $prepareSearch->fetchAll(PDO::FETCH_ASSOC);
					foreach ($fetchPages as $value) {
						$s .= ' OR ( FIND_IN_SET("'.$value['idx'].'",`studio404_module_item`.`sector_id`) OR FIND_IN_SET("'.$value['idx'].'",`studio404_module_item`.`sub_sector_id`) OR FIND_IN_SET("'.$value['idx'].'",`studio404_module_item`.`products`) ) '; 
					}
				}
				if($s!=''){
					$search ='(
						`studio404_module_item`.`id`="'.$searchQuery.'" OR 
						`studio404_module_item`.`title` LIKE "'.$searchQuery.'%" OR 
						`studio404_module_item`.`title` LIKE "%'.$searchQuery.'" OR 
						MATCH(`studio404_module_item`.`title`) AGAINST ("'.$searchQuery.'") OR 
						`studio404_module_item`.`long_description` LIKE "'.$searchQuery.'%" OR 
						`studio404_module_item`.`long_description` LIKE "%'.$searchQuery.'" OR 
						MATCH(`studio404_module_item`.`long_description`) AGAINST ("'.$searchQuery.'") OR 
						`studio404_users`.`namelname` LIKE "%'.$searchQuery.'" OR 
						`studio404_users`.`namelname` LIKE "'.$searchQuery.'%" OR 
						MATCH(`studio404_users`.`namelname`) AGAINST ("'.$searchQuery.'") 
						'.$s.'
					) AND ';
					//$search = (!empty($data["get_search"])) ? '`studio404_module_item`.`title` LIKE "%'.$data["get_search"].'%" AND ' : '';
				}else{
					$search ='(
						`studio404_module_item`.`id`="'.$searchQuery.'" OR 
						`studio404_module_item`.`title` LIKE "'.$searchQuery.'%" OR 
						`studio404_module_item`.`title` LIKE "%'.$searchQuery.'" OR 
						MATCH(`studio404_module_item`.`title`) AGAINST ("'.$searchQuery.'") OR 
						`studio404_module_item`.`long_description` LIKE "'.$searchQuery.'%" OR 
						`studio404_module_item`.`long_description` LIKE "%'.$searchQuery.'" OR 
						MATCH(`studio404_module_item`.`long_description`) AGAINST ("'.$searchQuery.'") OR 
						`studio404_users`.`namelname` LIKE "'.$searchQuery.'%" OR 
						`studio404_users`.`namelname` LIKE "%'.$searchQuery.'" OR 
						MATCH(`studio404_users`.`namelname`) AGAINST ("'.$searchQuery.'")
					) AND';	
				}
				
			}else{
				$search = "";
			}
			//echo $search;
			//$search = (!empty($data["get_search"])) ? '`studio404_module_item`.`long_description` LIKE "%'.$data["get_search"].'%" AND ' : '';
			if(Input::method("GET","csv")){ 
				$sql = 'SELECT 
				`studio404_module_item`.`title`,  
				(SELECT `title` FROM  `studio404_pages` WHERE `studio404_pages`.`idx`=`studio404_module_item`.`sub_sector_id`) AS su_sector,
				(SELECT `title` FROM  `studio404_pages` WHERE `studio404_pages`.`idx`=`studio404_module_item`.`hscode`) AS su_hscode,
				(SELECT `title` FROM  `studio404_pages` WHERE `studio404_pages`.`idx`=`studio404_module_item`.`products`) AS su_products,
				`studio404_module_item`.`shelf_life`, 
				`studio404_module_item`.`packaging`, 
				`studio404_module_item`.`awards`, 
				`studio404_users`.`namelname` AS users_name, 
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
				`studio404_users`.`status`!=:one AND 
				`studio404_users`.`allow`!=:one 
				';
			}else{
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
				`studio404_users`.`status`!=:one AND 
				`studio404_users`.`allow`!=:one 
				'.$orderBy.' '.$limit.'
				';
			}
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":two"=>2, 
				":one"=>1
			));
			if($prepare->rowCount() > 0){
				if(Input::method("GET","csv")){
					// Create array
					$filename = "servicetable.csv";
		            $list = array ();

		            // Append results to array
		            array_push($list, array("Title","SubSector","HScode","Product","Shelf life","Packaging","Awards","Username","Users Company Type"));
		            while ($row = $prepare->fetch(PDO::FETCH_ASSOC)) {
		                array_push($list, array_values($row));
		            }

		            // Output array into CSV file
		            $fp = fopen('php://output', 'w');
		            header('Content-Type: text/csv');
		            header('Content-Disposition: attachment; filename="'.$filename.'"');
		            foreach ($list as $ferow) {
		                fputcsv($fp, $ferow);
		            }
		            exit();
				}

				$data["fetch"] = $prepare->fetchAll(PDO::FETCH_ASSOC);
			}else{
				$data["fetch"] = array();
			}
		endif;

		@include($c["website.directory"]."/exportcatalog.php"); 
	}
}
?>