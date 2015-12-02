<?php if(!defined("DIR")){ exit();  }
class cache extends connection{

	public function index($c,$type){
		$get_slug_from_url = new get_slug_from_url();
		$slug = $get_slug_from_url->slug();
		$slug_ = str_replace(array("/","\\"), array("",""), strip_tags(urlencode($slug))); 
		if(Input::method("GET","i") && Input::method("GET","p")){
			$proin = "proinside".Input::method("GET","p");
		}else{ $proin = ""; }
		$cache_file = "_cache/".$type.$proin.$slug_.LANG_ID.".json"; 
		if(file_exists($cache_file)){
			$output = @file_get_contents($cache_file); 
		}else{
			$this->recreate_cache($c,$type,$cache_file);
			$output = @file_get_contents($cache_file);
		}
		return $output;
	}

	public function recreate_cache($c,$type,$cache_file){
		$conn = $this->conn($c);
		switch($type){
			case "homepage_general": 
			$get_slug_from_url = new get_slug_from_url();
			$slug = $get_slug_from_url->slug();
			$sql = 'SELECT * FROM `studio404_pages` WHERE `slug`=:slug AND `lang`=:lang AND `visibility`!=:visibility AND `status`!=:status';	
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":slug"=>$slug, 
				":status"=>1, 
				":visibility"=>1, 
				":lang"=>LANG_ID 
			)); 
			$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC); 
			break;
			case "text_general": 
			$get_slug_from_url = new get_slug_from_url();
			$slug = $get_slug_from_url->slug();
			$sql = 'SELECT * FROM `studio404_pages` WHERE `slug`=:slug AND `lang`=:lang AND `visibility`!=:visibility AND `status`!=:status';	
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":slug"=>$slug, 
				":status"=>1, 
				":visibility"=>1, 
				":lang"=>LANG_ID 
			)); 
			$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC); 
			break;
			case "team_general": 
			$get_slug_from_url = new get_slug_from_url();
			$slug = $get_slug_from_url->slug();
			$sql = 'SELECT * FROM `studio404_pages` WHERE `slug`=:slug AND `lang`=:lang AND `visibility`!=:visibility AND `status`!=:status';	
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":slug"=>$slug, 
				":status"=>1, 
				":visibility"=>1, 
				":lang"=>LANG_ID 
			)); 
			$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC); 
			break;
			case "catalog_general": 
			$get_slug_from_url = new get_slug_from_url();
			$slug = $get_slug_from_url->slug();
			$sql = 'SELECT * FROM `studio404_pages` WHERE `slug`=:slug AND `lang`=:lang AND `visibility`!=:visibility AND `status`!=:status';	
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":slug"=>$slug, 
				":status"=>1, 
				":visibility"=>1, 
				":lang"=>LANG_ID 
			)); 
			$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC); 
			break;
			case "publication_general": 
			$get_slug_from_url = new get_slug_from_url();
			$slug = $get_slug_from_url->slug();
			$sql = 'SELECT * FROM `studio404_pages` WHERE `slug`=:slug AND `lang`=:lang AND `visibility`!=:visibility AND `status`!=:status';	
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":slug"=>$slug, 
				":status"=>1, 
				":visibility"=>1, 
				":lang"=>LANG_ID 
			)); 
			$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC); 
			break;
			case "news_general": 
			$get_slug_from_url = new get_slug_from_url();
			$slug = $get_slug_from_url->slug();
			$sql = 'SELECT 
			`studio404_module_item`.*, 
			( 
				SELECT `studio404_gallery_file`.`file` FROM 
				`studio404_gallery_attachment`,`studio404_gallery`,`studio404_gallery_file` 
				WHERE 
				`studio404_gallery_attachment`.`connect_idx`=`studio404_module_item`.`idx` AND 
				`studio404_gallery_attachment`.`pagetype`=:pagetype AND 
				`studio404_gallery_attachment`.`lang`=:lang AND 
				`studio404_gallery_attachment`.`status`!=:status AND 
				`studio404_gallery_attachment`.`idx`=`studio404_gallery`.`idx` AND 
				`studio404_gallery`.`lang`=:lang AND 
				`studio404_gallery`.`status`!=:status AND 
				`studio404_gallery`.`idx`=`studio404_gallery_file`.`gallery_idx` AND 
				`studio404_gallery_file`.`media_type`=:media_type AND 
				`studio404_gallery_file`.`lang`=:lang AND 
				`studio404_gallery_file`.`status`!=:status 
				ORDER BY `studio404_gallery_file`.`position` ASC LIMIT 1 
			) AS pic 
			FROM `studio404_module_item` WHERE 
			`studio404_module_item`.`slug`=:slug AND 
			`studio404_module_item`.`lang`=:lang AND 
			`studio404_module_item`.`visibility`!=:visibility AND 
			`studio404_module_item`.`status`!=:status ';	
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":pagetype"=>'newspage', 
				":media_type"=>'photo', 
				":slug"=>$slug, 
				":lang"=>LANG_ID, 
				":status"=>1, 
				":visibility"=>1 
			)); 
			$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC); 
			break;
			case "news_list": 
			$sql = 'SELECT 
			`studio404_module_item`.*, 
			( 
				SELECT `studio404_gallery_file`.`file` FROM 
				`studio404_gallery_attachment`,`studio404_gallery`,`studio404_gallery_file` 
				WHERE 
				`studio404_gallery_attachment`.`connect_idx`=`studio404_module_item`.`idx` AND 
				`studio404_gallery_attachment`.`pagetype`=:pagetype AND 
				`studio404_gallery_attachment`.`lang`=:lang AND 
				`studio404_gallery_attachment`.`status`!=:status AND 
				`studio404_gallery_attachment`.`idx`=`studio404_gallery`.`idx` AND 
				`studio404_gallery`.`lang`=:lang AND 
				`studio404_gallery`.`status`!=:status AND 
				`studio404_gallery`.`idx`=`studio404_gallery_file`.`gallery_idx` AND 
				`studio404_gallery_file`.`media_type`=:media_type AND 
				`studio404_gallery_file`.`lang`=:lang AND 
				`studio404_gallery_file`.`status`!=:status 
				ORDER BY `studio404_gallery_file`.`position` ASC LIMIT 1 
			) AS pic 
			FROM 
			`studio404_pages`,`studio404_module_attachment`, `studio404_module`, `studio404_module_item` 
			WHERE 
			`studio404_pages`.`page_type`=:pagetype AND 
			`studio404_pages`.`lang`=:lang AND 
			`studio404_pages`.`status`!=:status AND 
			`studio404_pages`.`idx`=`studio404_module_attachment`.`connect_idx` AND 
			`studio404_module_attachment`.`page_type`=:pagetype AND 
			`studio404_module_attachment`.`lang`=:lang AND 
			`studio404_module_attachment`.`status`!=:status AND 
			`studio404_module_attachment`.`idx`=`studio404_module`.`idx` AND 
			`studio404_module`.`lang`=:lang AND 
			`studio404_module`.`status`!=:status AND 
			`studio404_module`.`idx`=`studio404_module_item`.`module_idx` AND 
			`studio404_module_item`.`lang`=:lang AND 
			`studio404_module_item`.`visibility`!=:visibility AND 
			`studio404_module_item`.`status`!=:status 
			ORDER BY `studio404_module_item`.`date` DESC 
			';	
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":pagetype"=>'newspage', 
				":media_type"=>'photo', 
				":lang"=>LANG_ID, 
				":status"=>1, 
				":visibility"=>1, 
			)); 
			$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC); 
			break;
			case "event_list": 
			$sql = 'SELECT 
			`studio404_module_item`.*, 
			( 
				SELECT `studio404_gallery_file`.`file` FROM 
				`studio404_gallery_attachment`,`studio404_gallery`,`studio404_gallery_file` 
				WHERE 
				`studio404_gallery_attachment`.`connect_idx`=`studio404_module_item`.`idx` AND 
				`studio404_gallery_attachment`.`pagetype`=:pagetype AND 
				`studio404_gallery_attachment`.`lang`=:lang AND 
				`studio404_gallery_attachment`.`status`!=:status AND 
				`studio404_gallery_attachment`.`idx`=`studio404_gallery`.`idx` AND 
				`studio404_gallery`.`lang`=:lang AND 
				`studio404_gallery`.`status`!=:status AND 
				`studio404_gallery`.`idx`=`studio404_gallery_file`.`gallery_idx` AND 
				`studio404_gallery_file`.`media_type`=:media_type AND 
				`studio404_gallery_file`.`lang`=:lang AND 
				`studio404_gallery_file`.`status`!=:status 
				ORDER BY `studio404_gallery_file`.`position` ASC LIMIT 1 
			) AS pic 
			FROM 
			`studio404_pages`,`studio404_module_attachment`, `studio404_module`, `studio404_module_item` 
			WHERE 
			`studio404_pages`.`page_type`=:pagetype AND 
			`studio404_pages`.`lang`=:lang AND 
			`studio404_pages`.`status`!=:status AND 
			`studio404_pages`.`idx`=`studio404_module_attachment`.`connect_idx` AND 
			`studio404_module_attachment`.`page_type`=:pagetype AND 
			`studio404_module_attachment`.`lang`=:lang AND 
			`studio404_module_attachment`.`status`!=:status AND 
			`studio404_module_attachment`.`idx`=`studio404_module`.`idx` AND 
			`studio404_module`.`lang`=:lang AND 
			`studio404_module`.`status`!=:status AND 
			`studio404_module`.`idx`=`studio404_module_item`.`module_idx` AND 
			`studio404_module_item`.`lang`=:lang AND 
			`studio404_module_item`.`visibility`!=:visibility AND 
			`studio404_module_item`.`status`!=:status 
			ORDER BY `studio404_module_item`.`date` DESC 
			';	
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":pagetype"=>'eventpage', 
				":media_type"=>'photo', 
				":lang"=>LANG_ID, 
				":status"=>1, 
				":visibility"=>1, 
			)); 
			$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC); 
			break;
			case "team_list": 
			$get_slug_from_url = new get_slug_from_url();
			$slug = $get_slug_from_url->slug();
			$sql = 'SELECT 
			`studio404_module_item`.`idx` AS smi_idx, 
			`studio404_module_item`.`title` AS namelname 
			FROM 
			`studio404_pages`, `studio404_module_attachment`, `studio404_module`, `studio404_module_item`  
			WHERE 
			`studio404_pages`.`slug`=:slug AND 
			`studio404_pages`.`lang`=:lang AND 
			`studio404_pages`.`visibility`!=:visibility AND 
			`studio404_pages`.`status`!=:status AND 
			`studio404_pages`.`idx`=`studio404_module_attachment`.`connect_idx` AND 
			`studio404_module_attachment`.`page_type`=:pagetype AND 
			`studio404_module_attachment`.`lang`=:lang AND 
			`studio404_module_attachment`.`status`!=:status AND 
			`studio404_module_attachment`.`idx`=`studio404_module`.`idx` AND 
			`studio404_module`.`lang`=:lang AND 
			`studio404_module`.`status`!=:status AND 
			`studio404_module`.`idx`=`studio404_module_item`.`module_idx` AND 
			`studio404_module_item`.`lang`=:lang AND 
			`studio404_module_item`.`visibility`!=:visibility AND 
			`studio404_module_item`.`status`!=:status 
			ORDER BY `studio404_module_item`.`position` ASC 
			';	
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":media_type"=>'photo', 
				":media_type_doc"=>'document', 
				":pagetype"=>'teampage', 
				":slug"=>$slug, 
				":status"=>1, 
				":visibility"=>1, 
				":lang"=>LANG_ID 
			)); 
			// $fetch = $prepare->fetchAll(PDO::FETCH_CLASS,'db_team'); 			
			$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC); 
			break;
			case "catalog_list": 
			$get_slug_from_url = new get_slug_from_url();
			$slug = $get_slug_from_url->slug();
			$sql = 'SELECT 
			`studio404_module_item`.*, 
			(
				SELECT 
				`studio404_gallery_file`.`file` 
				FROM 
				`studio404_gallery_attachment`,`studio404_gallery`,`studio404_gallery_file` 
				WHERE 
				`studio404_gallery_attachment`.`connect_idx`=`studio404_module_item`.`idx` AND 
				`studio404_gallery_attachment`.`pagetype`=:pagetype AND 
				`studio404_gallery_attachment`.`lang`=:lang AND 
				`studio404_gallery_attachment`.`status`!=:status AND 
				`studio404_gallery_attachment`.`idx`=`studio404_gallery`.`idx` AND 
				`studio404_gallery`.`lang`=:lang AND 
				`studio404_gallery`.`status`!=:status AND 
				`studio404_gallery`.`idx`=`studio404_gallery_file`.`gallery_idx` AND 
				`studio404_gallery_file`.`lang`=:lang AND 
				`studio404_gallery_file`.`media_type`=:media_type AND 
				`studio404_gallery_file`.`status`!=:status 
				ORDER BY `studio404_gallery_file`.`position` ASC LIMIT 1
			) AS pic, 
			(
				SELECT 
				`studio404_gallery_file`.`file` 
				FROM 
				`studio404_gallery_attachment`,`studio404_gallery`,`studio404_gallery_file` 
				WHERE 
				`studio404_gallery_attachment`.`connect_idx`=`studio404_module_item`.`idx` AND 
				`studio404_gallery_attachment`.`pagetype`=:pagetype AND 
				`studio404_gallery_attachment`.`lang`=:lang AND 
				`studio404_gallery_attachment`.`status`!=:status AND 
				`studio404_gallery_attachment`.`idx`=`studio404_gallery`.`idx` AND 
				`studio404_gallery`.`lang`=:lang AND 
				`studio404_gallery`.`status`!=:status AND 
				`studio404_gallery`.`idx`=`studio404_gallery_file`.`gallery_idx` AND 
				`studio404_gallery_file`.`media_type`=:media_type_doc AND 
				`studio404_gallery_file`.`lang`=:lang AND 
				`studio404_gallery_file`.`status`!=:status 
				ORDER BY `studio404_gallery_file`.`position` ASC LIMIT 1
			) AS doc  
			FROM 
			`studio404_pages`, `studio404_module_attachment`, `studio404_module`, `studio404_module_item`  
			WHERE 
			`studio404_pages`.`slug`=:slug AND 
			`studio404_pages`.`lang`=:lang AND 
			`studio404_pages`.`visibility`!=:visibility AND 
			`studio404_pages`.`status`!=:status AND 
			`studio404_pages`.`idx`=`studio404_module_attachment`.`connect_idx` AND 
			`studio404_module_attachment`.`page_type`=:pagetype AND 
			`studio404_module_attachment`.`lang`=:lang AND 
			`studio404_module_attachment`.`status`!=:status AND 
			`studio404_module_attachment`.`idx`=`studio404_module`.`idx` AND 
			`studio404_module`.`lang`=:lang AND 
			`studio404_module`.`status`!=:status AND 
			`studio404_module`.`idx`=`studio404_module_item`.`module_idx` AND 
			`studio404_module_item`.`lang`=:lang AND 
			`studio404_module_item`.`visibility`!=:visibility AND 
			`studio404_module_item`.`status`!=:status 
			ORDER BY `studio404_module_item`.`position` ASC 
			';	
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":pagetype"=>'catalogpage', 
				":media_type"=>'photo', 
				":media_type_doc"=>'document', 
				":slug"=>$slug, 
				":status"=>1, 
				":visibility"=>1, 
				":lang"=>LANG_ID 
			)); 
			$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC); 
			break;
			case "catalog_info_comments_list": 
			$get_slug_from_url = new get_slug_from_url();
			$slug = $get_slug_from_url->slug();
			$sql = 'SELECT 
			`studio404_module_item`.`idx` AS smi_idx,  
			`studio404_module_item`.`uid` AS smi_uid,  
			`studio404_module_item`.`date` AS smi_date,  
			`studio404_module_item`.`module_idx` AS smi_module_idx,  
			`studio404_module_item`.`title` AS smi_title,  
			`studio404_module_item`.`short_description` AS smi_short_description,  
			`studio404_module_item`.`long_description` AS smi_long_description,  
			`studio404_module_item`.`tags` AS smi_tags,  
			`studio404_module_item`.`slug` AS smi_slug   
			FROM 
			`studio404_pages`, `studio404_module_attachment`, `studio404_module`, `studio404_module_item`  
			WHERE 
			`studio404_pages`.`slug`=:slug AND 
			`studio404_pages`.`lang`=:lang AND 
			`studio404_pages`.`visibility`!=:visibility AND 
			`studio404_pages`.`status`!=:status AND 
			`studio404_pages`.`idx`=`studio404_module_attachment`.`connect_idx` AND 
			`studio404_module_attachment`.`page_type`=:pagetype AND 
			`studio404_module_attachment`.`lang`=:lang AND 
			`studio404_module_attachment`.`status`!=:status AND 
			`studio404_module_attachment`.`idx`=`studio404_module`.`idx` AND 
			`studio404_module`.`lang`=:lang AND 
			`studio404_module`.`status`!=:status AND 
			`studio404_module`.`idx`=`studio404_module_item`.`module_idx` AND 
			`studio404_module_item`.`lang`=:lang AND 
			`studio404_module_item`.`visibility`!=:visibility AND 
			`studio404_module_item`.`status`!=:status 
			ORDER BY `studio404_module_item`.`position` ASC 
			';	
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":pagetype"=>'catalogpage', 
				":media_type"=>'photo', 
				":media_type_doc"=>'document', 
				":slug"=>$slug, 
				":status"=>1, 
				":visibility"=>1, 
				":lang"=>LANG_ID 
			)); 
			$fetch = $prepare->fetchAll(PDO::FETCH_CLASS,"db_catalog"); 
			break;
			case "publication_list": 
			$get_slug_from_url = new get_slug_from_url();
			$slug = $get_slug_from_url->slug();
			$sql = 'SELECT 
			`studio404_module_item`.*, 
			(
				SELECT 
				`studio404_gallery_file`.`file` 
				FROM 
				`studio404_gallery_attachment`,`studio404_gallery`,`studio404_gallery_file` 
				WHERE 
				`studio404_gallery_attachment`.`connect_idx`=`studio404_module_item`.`idx` AND 
				`studio404_gallery_attachment`.`pagetype`=:pagetype AND 
				`studio404_gallery_attachment`.`lang`=:lang AND 
				`studio404_gallery_attachment`.`status`!=:status AND 
				`studio404_gallery_attachment`.`idx`=`studio404_gallery`.`idx` AND 
				`studio404_gallery`.`lang`=:lang AND 
				`studio404_gallery`.`status`!=:status AND 
				`studio404_gallery`.`idx`=`studio404_gallery_file`.`gallery_idx` AND 
				`studio404_gallery_file`.`media_type`=:media_type AND 
				`studio404_gallery_file`.`lang`=:lang AND 
				`studio404_gallery_file`.`status`!=:status 
				ORDER BY `studio404_gallery_file`.`position` ASC LIMIT 1
			) AS pic, 
			(
				SELECT 
				`studio404_gallery_file`.`file` 
				FROM 
				`studio404_gallery_attachment`,`studio404_gallery`,`studio404_gallery_file` 
				WHERE 
				`studio404_gallery_attachment`.`connect_idx`=`studio404_module_item`.`idx` AND 
				`studio404_gallery_attachment`.`pagetype`=:pagetype AND 
				`studio404_gallery_attachment`.`lang`=:lang AND 
				`studio404_gallery_attachment`.`status`!=:status AND 
				`studio404_gallery_attachment`.`idx`=`studio404_gallery`.`idx` AND 
				`studio404_gallery`.`lang`=:lang AND 
				`studio404_gallery`.`status`!=:status AND 
				`studio404_gallery`.`idx`=`studio404_gallery_file`.`gallery_idx` AND 
				`studio404_gallery_file`.`media_type`=:media_type_doc AND 
				`studio404_gallery_file`.`lang`=:lang AND 
				`studio404_gallery_file`.`status`!=:status 
				ORDER BY `studio404_gallery_file`.`position` ASC LIMIT 1
			) AS doc   
			FROM 
			`studio404_pages`, `studio404_module_attachment`, `studio404_module`, `studio404_module_item`  
			WHERE 
			`studio404_pages`.`slug`=:slug AND 
			`studio404_pages`.`lang`=:lang AND 
			`studio404_pages`.`visibility`!=:visibility AND 
			`studio404_pages`.`status`!=:status AND 
			`studio404_pages`.`idx`=`studio404_module_attachment`.`connect_idx` AND 
			`studio404_module_attachment`.`page_type`=:pagetype AND 
			`studio404_module_attachment`.`lang`=:lang AND 
			`studio404_module_attachment`.`status`!=:status AND 
			`studio404_module_attachment`.`idx`=`studio404_module`.`idx` AND 
			`studio404_module`.`lang`=:lang AND 
			`studio404_module`.`status`!=:status AND 
			`studio404_module`.`idx`=`studio404_module_item`.`module_idx` AND 
			`studio404_module_item`.`lang`=:lang AND 
			`studio404_module_item`.`visibility`!=:visibility AND 
			`studio404_module_item`.`status`!=:status 
			ORDER BY `studio404_module_item`.`position` ASC 
			';	
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":pagetype"=>'publicationpage', 
				":media_type"=>'photo', 
				":media_type_doc"=>'document', 
				":slug"=>$slug, 
				":status"=>1, 
				":visibility"=>1, 
				":lang"=>LANG_ID 
			)); 
			$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC); 
			break;
			case "homepage_files": 
			$get_slug_from_url = new get_slug_from_url();
			$slug = $get_slug_from_url->slug();
			$sql = 'SELECT 
			`studio404_gallery_file`.*
			FROM 
			`studio404_pages`,`studio404_gallery_attachment`,`studio404_gallery`,`studio404_gallery_file` 
			WHERE 
			`studio404_pages`.`slug`=:slug AND 
			`studio404_pages`.`lang`=:lang AND 
			`studio404_pages`.`visibility`!=:visibility AND 
			`studio404_pages`.`status`!=:status AND 
			`studio404_pages`.`idx`=`studio404_gallery_attachment`.`connect_idx` AND 
			`studio404_gallery_attachment`.`lang`=:lang AND 
			`studio404_gallery_attachment`.`status`!=:status AND 
			`studio404_gallery_attachment`.`idx`=`studio404_gallery`.`idx` AND 
			`studio404_gallery`.`lang`=:lang AND 
			`studio404_gallery`.`status`!=:status AND 
			`studio404_gallery`.`idx`=`studio404_gallery_file`.`gallery_idx` AND 
			`studio404_gallery_file`.`media_type`=:media_type AND 
			`studio404_gallery_file`.`lang`=:lang AND 
			`studio404_gallery_file`.`status`!=:status 
			ORDER BY `studio404_gallery_file`.`position` ASC 
			';	
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":media_type"=>'photo', 
				":slug"=>$slug, 
				":status"=>1, 
				":visibility"=>1, 
				":lang"=>LANG_ID 
			)); 
			$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC); 
			break;
			case "text_files":
			$get_slug_from_url = new get_slug_from_url();
			$slug = $get_slug_from_url->slug();
			$sql = 'SELECT 
			`studio404_pages`.`idx` as midx, 
			`studio404_gallery_file`.*
			FROM 
			`studio404_pages`,`studio404_gallery_attachment`,`studio404_gallery`,`studio404_gallery_file` 
			WHERE 
			`studio404_pages`.`slug`=:slug AND 
			`studio404_pages`.`lang`=:lang AND 
			`studio404_pages`.`visibility`!=:visibility AND 
			`studio404_pages`.`status`!=:status AND 
			`studio404_pages`.`idx`=`studio404_gallery_attachment`.`connect_idx` AND 
			`studio404_pages`.`page_type`=`studio404_gallery_attachment`.`pagetype` AND 
			`studio404_gallery_attachment`.`lang`=:lang AND 
			`studio404_gallery_attachment`.`status`!=:status AND 
			`studio404_gallery_attachment`.`idx`=`studio404_gallery`.`idx` AND 
			`studio404_gallery`.`lang`=:lang AND 
			`studio404_gallery`.`status`!=:status AND 
			`studio404_gallery`.`idx`=`studio404_gallery_file`.`gallery_idx` AND 
			`studio404_gallery_file`.`media_type`=:media_type AND 
			`studio404_gallery_file`.`lang`=:lang AND 
			`studio404_gallery_file`.`status`!=:status 
			ORDER BY `studio404_gallery_file`.`position` ASC 
			';	
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":slug"=>$slug, 
				":media_type"=>'photo', 
				":status"=>1, 
				":visibility"=>1, 
				":lang"=>LANG_ID 
			)); 
			$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC); 
			break;
			case "last_news_files":
			$sql = 'SELECT 
			`studio404_module_item`.* 
			FROM 
			`studio404_pages`,`studio404_module_attachment`, `studio404_module`, `studio404_module_item` 
			WHERE 
			`studio404_pages`.`page_type`=:pagetype AND 
			`studio404_pages`.`lang`=:lang AND 
			`studio404_pages`.`status`!=:status AND 
			`studio404_pages`.`idx`=`studio404_module_attachment`.`connect_idx` AND 
			`studio404_module_attachment`.`page_type`=:pagetype AND 
			`studio404_module_attachment`.`lang`=:lang AND 
			`studio404_module_attachment`.`status`!=:status AND 
			`studio404_module_attachment`.`idx`=`studio404_module`.`idx` AND 
			`studio404_module`.`lang`=:lang AND 
			`studio404_module`.`status`!=:status AND 
			`studio404_module`.`idx`=`studio404_module_item`.`module_idx` AND 
			`studio404_module_item`.`lang`=:lang AND 
			`studio404_module_item`.`visibility`!=:visibility AND 
			`studio404_module_item`.`status`!=:status 
			ORDER BY `studio404_module_item`.`date` DESC LIMIT 1
			';	
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":pagetype"=>'newspage', 
				":lang"=>LANG_ID, 
				":status"=>1, 
				":visibility"=>1, 
			)); 
			$f = $prepare->fetchAll(PDO::FETCH_ASSOC);
			$slug = $f[0]["slug"]; 
			$sql = 'SELECT 
			`studio404_gallery_file`.*
			FROM 
			`studio404_module_item`,`studio404_gallery_attachment`,`studio404_gallery`,`studio404_gallery_file` 
			WHERE 
			`studio404_module_item`.`slug`=:slug AND 
			`studio404_module_item`.`lang`=:lang AND 
			`studio404_module_item`.`visibility`!=:visibility AND 
			`studio404_module_item`.`status`!=:status AND 
			`studio404_module_item`.`idx`=`studio404_gallery_attachment`.`connect_idx` AND 
			`studio404_gallery_attachment`.`pagetype`="newspage" AND 
			`studio404_gallery_attachment`.`lang`=:lang AND 
			`studio404_gallery_attachment`.`status`!=:status AND 
			`studio404_gallery_attachment`.`idx`=`studio404_gallery`.`idx` AND 
			`studio404_gallery`.`lang`=:lang AND 
			`studio404_gallery`.`status`!=:status AND 
			`studio404_gallery`.`idx`=`studio404_gallery_file`.`gallery_idx` AND 
			`studio404_gallery_file`.`media_type`=:media_type AND 
			`studio404_gallery_file`.`lang`=:lang AND 
			`studio404_gallery_file`.`status`!=:status 
			ORDER BY `studio404_gallery_file`.`position` ASC 
			';	
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":slug"=>$slug, 
				":media_type"=>'photo', 
				":status"=>1, 
				":visibility"=>1, 
				":lang"=>LANG_ID 
			)); 
			$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC); 
			break;
			case "news_files": 
			$get_slug_from_url = new get_slug_from_url();
			$slug = $get_slug_from_url->slug();
			$sql = 'SELECT 
			`studio404_gallery_file`.*
			FROM 
			`studio404_module_item`,`studio404_gallery_attachment`,`studio404_gallery`,`studio404_gallery_file` 
			WHERE 
			`studio404_module_item`.`slug`=:slug AND 
			`studio404_module_item`.`lang`=:lang AND 
			`studio404_module_item`.`visibility`!=:visibility AND 
			`studio404_module_item`.`status`!=:status AND 
			`studio404_module_item`.`idx`=`studio404_gallery_attachment`.`connect_idx` AND 
			`studio404_gallery_attachment`.`pagetype`="newspage" AND 
			`studio404_gallery_attachment`.`lang`=:lang AND 
			`studio404_gallery_attachment`.`status`!=:status AND 
			`studio404_gallery_attachment`.`idx`=`studio404_gallery`.`idx` AND 
			`studio404_gallery`.`lang`=:lang AND 
			`studio404_gallery`.`status`!=:status AND 
			`studio404_gallery`.`idx`=`studio404_gallery_file`.`gallery_idx` AND 
			`studio404_gallery_file`.`media_type`=:media_type AND 
			`studio404_gallery_file`.`lang`=:lang AND 
			`studio404_gallery_file`.`status`!=:status 
			ORDER BY `studio404_gallery_file`.`position` ASC 
			';	
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":slug"=>$slug, 
				":media_type"=>'photo', 
				":status"=>1, 
				":visibility"=>1, 
				":lang"=>LANG_ID 
			)); 
			$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC); 
			break;
			case "text_documents":
			$get_slug_from_url = new get_slug_from_url();
			$slug = $get_slug_from_url->slug();
			$sql = 'SELECT 
			`studio404_pages`.`idx` as midx, 
			`studio404_gallery_file`.*
			FROM 
			`studio404_pages`,`studio404_gallery_attachment`,`studio404_gallery`,`studio404_gallery_file` 
			WHERE 
			`studio404_pages`.`slug`=:slug AND 
			`studio404_pages`.`lang`=:lang AND 
			`studio404_pages`.`visibility`!=:visibility AND 
			`studio404_pages`.`status`!=:status AND 
			`studio404_pages`.`idx`=`studio404_gallery_attachment`.`connect_idx` AND 
			`studio404_pages`.`page_type`=`studio404_gallery_attachment`.`pagetype` AND 
			`studio404_gallery_attachment`.`lang`=:lang AND 
			`studio404_gallery_attachment`.`status`!=:status AND 
			`studio404_gallery_attachment`.`idx`=`studio404_gallery`.`idx` AND 
			`studio404_gallery`.`lang`=:lang AND 
			`studio404_gallery`.`status`!=:status AND 
			`studio404_gallery`.`idx`=`studio404_gallery_file`.`gallery_idx` AND 
			`studio404_gallery_file`.`media_type`=:media_type AND 
			`studio404_gallery_file`.`lang`=:lang AND 
			`studio404_gallery_file`.`status`!=:status 
			ORDER BY `studio404_gallery_file`.`position` ASC 
			';	
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":slug"=>$slug, 
				":media_type"=>'document', 
				":status"=>1, 
				":visibility"=>1, 
				":lang"=>LANG_ID 
			)); 
			$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC); 
			break;
			case "news_documents": 
			$get_slug_from_url = new get_slug_from_url();
			$slug = $get_slug_from_url->slug();
			$sql = 'SELECT 
			`studio404_gallery_file`.*
			FROM 
			`studio404_module_item`,`studio404_gallery_attachment`,`studio404_gallery`,`studio404_gallery_file` 
			WHERE 
			`studio404_module_item`.`slug`=:slug AND 
			`studio404_module_item`.`lang`=:lang AND 
			`studio404_module_item`.`visibility`!=:visibility AND 
			`studio404_module_item`.`status`!=:status AND 
			`studio404_module_item`.`idx`=`studio404_gallery_attachment`.`connect_idx` AND 
			`studio404_gallery_attachment`.`pagetype`="newspage" AND 
			`studio404_gallery_attachment`.`lang`=:lang AND 
			`studio404_gallery_attachment`.`status`!=:status AND 
			`studio404_gallery_attachment`.`idx`=`studio404_gallery`.`idx` AND 
			`studio404_gallery`.`lang`=:lang AND 
			`studio404_gallery`.`status`!=:status AND 
			`studio404_gallery`.`idx`=`studio404_gallery_file`.`gallery_idx` AND 
			`studio404_gallery_file`.`media_type`=:media_type AND 
			`studio404_gallery_file`.`lang`=:lang AND 
			`studio404_gallery_file`.`status`!=:status 
			ORDER BY `studio404_gallery_file`.`position` ASC 
			';	
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":slug"=>$slug, 
				":media_type"=>'document', 
				":status"=>1, 
				":visibility"=>1, 
				":lang"=>LANG_ID 
			)); 
			$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC); 	
			break;
			case "components":
			$sql = 'SELECT 
			`studio404_components`.`name` AS com_name,  
			`studio404_components_inside`.* 
			FROM 
			`studio404_components`,`studio404_components_inside`
			WHERE 
			`studio404_components`.`status`!=:status AND 
			`studio404_components`.`id`=`studio404_components_inside`.`cid` AND  
			`studio404_components_inside`.`lang`=:lang AND  
			`studio404_components_inside`.`status`!=:status 
			ORDER BY `studio404_components_inside`.`position` ASC 
			';	
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":status"=>1, 
				":lang"=>LANG_ID 
			)); 
			$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC); 
			break;
			case "languages":
			$sql = 'SELECT * FROM `studio404_language` WHERE `status`=:status AND `variable`=:false';	
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":status"=>1, 
				":false"=>'false' 
			)); 
			$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC); 
			break;
			case "language_data":
			$sql = 'SELECT * FROM `studio404_language` WHERE `status`!=:status AND `variable`!=:false AND `langs`=:lang';	
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":status"=>1, 
				":false"=>'false', 
				":lang"=>LANG_ID 
			)); 
			$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC); 
			break;
			case "main_menu": 
			$sql = 'SELECT * FROM `studio404_pages` WHERE `status`!=:status AND `menu_type`!=:super AND `lang`=:lang AND `visibility`!=:visibility AND `cid`=:cid ORDER BY `position` ASC';	
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":status"=>1, 
				":super"=>'super', 
				":lang"=>LANG_ID, 
				":visibility"=>1, 
				":cid"=>1
			)); 
			$f = $prepare->fetchAll(PDO::FETCH_ASSOC); 
			$fetch = $this->sub_menu($c,$f);
			break;
			case "structure": 
			$sql = 'SELECT `idx`,`title`,`shorttitle` FROM `studio404_pages` WHERE `status`!=:status AND `menu_type`!=:super AND `lang`=:lang AND `visibility`!=:visibility AND `cid`=:cid ORDER BY `position` ASC';	
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":status"=>1, 
				":super"=>'super', 
				":lang"=>LANG_ID, 
				":visibility"=>1, 
				":cid"=>46 
			)); 
			$fetch = $prepare->fetchAll(PDO::FETCH_CLASS,"db_structure");
			break;
			case "left_menu": 
			$get_slug_from_url = new get_slug_from_url();
			$slug = $get_slug_from_url->slug();
			$sql = 'SELECT `idx`,`cid` FROM `studio404_pages` WHERE `slug`=:slug AND `status`!=:status AND `menu_type`!=:super AND `lang`=:lang AND `visibility`!=:visibility ORDER BY `position` ASC ';	
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":status"=>1, 
				":super"=>'super', 
				":lang"=>LANG_ID, 
				":visibility"=>1, 
				":slug"=>$slug 
			)); 
			$f = $prepare->fetch(PDO::FETCH_ASSOC); 

			if($prepare->rowCount() <= 0){ 
				$sql3 = 'SELECT 
				`studio404_pages`.`cid` AS cid
				FROM 
				`studio404_module_item`, `studio404_module`, `studio404_module_attachment`, `studio404_pages` 
				WHERE 
				`studio404_module_item`.`slug`=:slug AND 
				`studio404_module_item`.`lang`=:lang AND 
				`studio404_module_item`.`visibility`!=:visibility AND 
				`studio404_module_item`.`status`!=:status AND 
				`studio404_module_item`.`module_idx`=`studio404_module`.`idx` AND 
				`studio404_module`.`lang`=:lang AND 
				`studio404_module`.`status`!=:status AND  
				`studio404_module`.`idx`=`studio404_module_attachment`.`idx` AND  
				`studio404_module_attachment`.`lang`=:lang AND  
				`studio404_module_attachment`.`status`!=:status AND  
				`studio404_module_attachment`.`connect_idx`=`studio404_pages`.`idx` AND  
				`studio404_pages`.`lang`=:lang AND  
				`studio404_pages`.`visibility`!=:visibility AND  
				`studio404_pages`.`status`!=:status 
				';
				$prepare3 = $conn->prepare($sql3); 
				$prepare3->execute(array(
					":slug"=>$slug, 
					":lang"=>LANG_ID, 
					":visibility"=>1, 
					":status"=>1 
				));
				$f = $prepare3->fetchAll(PDO::FETCH_ASSOC);
				$f = $f[0]; 
			}

			$sql2 = 'SELECT * FROM `studio404_pages` WHERE `cid`=:cid AND `status`!=:status AND `menu_type`!=:super AND `lang`=:lang AND `visibility`!=:visibility ORDER BY `position` ASC';	
			$prepare2 = $conn->prepare($sql2); 
			$prepare2->execute(array(
				":status"=>1, 
				":super"=>'super', 
				":lang"=>LANG_ID, 
				":visibility"=>1, 
				":cid"=>$f['idx'] 
			)); 
			$fetch = $prepare2->fetchAll(PDO::FETCH_ASSOC);
			if($prepare2->rowCount() <= 0){
				$sql3 = 'SELECT * FROM `studio404_pages` WHERE `cid`=:cid AND `status`!=:status AND `menu_type`!=:super AND `lang`=:lang AND `visibility`!=:visibility ORDER BY `position` ASC';	
				$prepare3 = $conn->prepare($sql3); 
				$prepare3->execute(array(
					":status"=>1, 
					":super"=>'super', 
					":lang"=>LANG_ID, 
					":visibility"=>1, 
					":cid"=>$f['cid'] 
				)); 
				$fetch = $prepare3->fetchAll(PDO::FETCH_ASSOC);
			}			
			break; 
			case "multimedia": 
			$sql = 'SELECT 
			`studio404_gallery_file`.*, `studio404_gallery_file`.`gallery_idx` as x
			FROM 
			`studio404_pages`,`studio404_media_attachment`,`studio404_media`,`studio404_media_item`,`studio404_gallery_attachment`,`studio404_gallery`,`studio404_gallery_file` 
			WHERE 
			`studio404_pages`.`page_type`=:videogallery AND 
			`studio404_pages`.`lang`=:lang AND 
			`studio404_pages`.`visibility`!=:visibility AND 
			`studio404_pages`.`status`!=:status AND 
			`studio404_pages`.`idx`=`studio404_media_attachment`.`connect_idx` AND 
			`studio404_media_attachment`.`lang`=:lang AND 
			`studio404_media_attachment`.`status`!=:status AND 
			`studio404_media_attachment`.`idx`=`studio404_media`.`idx` AND 
			`studio404_media`.`lang`=:lang AND 
			`studio404_media`.`status`!=:status AND 
			`studio404_media`.`idx`=`studio404_media_item`.`media_idx` AND 
			`studio404_media_item`.`lang`=:lang AND 
			`studio404_media_item`.`visibility`!=:visibility AND 
			`studio404_media_item`.`status`!=:status AND 
			`studio404_media_item`.`idx`=`studio404_gallery_attachment`.`connect_idx` AND 
			`studio404_gallery_attachment`.`pagetype`=:videogallery AND 
			`studio404_gallery_attachment`.`lang`=:lang AND 
			`studio404_gallery_attachment`.`status`!=:status AND 
			`studio404_gallery_attachment`.`idx`=`studio404_gallery`.`idx` AND 
			`studio404_gallery`.`lang`=:lang AND 
			`studio404_gallery`.`status`!=:status AND 
			`studio404_gallery`.`idx`=`studio404_gallery_file`.`gallery_idx` AND 
			`studio404_gallery_file`.`lang`=:lang AND 
			`studio404_gallery_file`.`status`!=:status 
			ORDER BY `studio404_gallery_file`.`position` ASC LIMIT 2
			';	
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":videogallery"=>'videogallerypage', 
				":lang"=>LANG_ID, 
				":visibility"=>1, 
				":status"=>1
			)); 
			$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC); 
			break;
			case "news":
			$sql = 'SELECT 
			`studio404_module_item`.*
			FROM 
			`studio404_pages`,`studio404_module_attachment`, `studio404_module`, `studio404_module_item` 
			WHERE 
			`studio404_pages`.`page_type`=:pagetype AND 
			`studio404_pages`.`lang`=:lang AND 
			`studio404_pages`.`status`!=:status AND 
			`studio404_pages`.`idx`=`studio404_module_attachment`.`connect_idx` AND 
			`studio404_module_attachment`.`page_type`=:pagetype AND 
			`studio404_module_attachment`.`lang`=:lang AND 
			`studio404_module_attachment`.`status`!=:status AND 
			`studio404_module_attachment`.`idx`=`studio404_module`.`idx` AND 
			`studio404_module`.`lang`=:lang AND 
			`studio404_module`.`status`!=:status AND 
			`studio404_module`.`idx`=`studio404_module_item`.`module_idx` AND 
			`studio404_module_item`.`lang`=:lang AND 
			`studio404_module_item`.`visibility`!=:visibility AND 
			`studio404_module_item`.`status`!=:status 
			ORDER BY `studio404_module_item`.`date` DESC LIMIT 15 
			';	
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":pagetype"=>'newspage', 
				":lang"=>LANG_ID, 
				":status"=>1, 
				":visibility"=>1, 
			)); 
			$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC); 
			break;
			case "events":
			$sql = 'SELECT 
			`studio404_module_item`.*, 
			( 
				SELECT `studio404_gallery_file`.`file` FROM 
				`studio404_gallery_attachment`,`studio404_gallery`,`studio404_gallery_file` 
				WHERE 
				`studio404_gallery_attachment`.`connect_idx`=`studio404_module_item`.`idx` AND 
				`studio404_gallery_attachment`.`pagetype`=:pagetype AND 
				`studio404_gallery_attachment`.`lang`=:lang AND 
				`studio404_gallery_attachment`.`status`!=:status AND 
				`studio404_gallery_attachment`.`idx`=`studio404_gallery`.`idx` AND 
				`studio404_gallery`.`lang`=:lang AND 
				`studio404_gallery`.`status`!=:status AND 
				`studio404_gallery`.`idx`=`studio404_gallery_file`.`gallery_idx` AND 
				`studio404_gallery_file`.`media_type`=:media_type AND 
				`studio404_gallery_file`.`lang`=:lang AND 
				`studio404_gallery_file`.`status`!=:status 
				ORDER BY `studio404_gallery_file`.`position` ASC LIMIT 1
			) AS pic 
			FROM 
			`studio404_pages`,`studio404_module_attachment`, `studio404_module`, `studio404_module_item` 
			WHERE 
			`studio404_pages`.`page_type`=:pagetype AND 
			`studio404_pages`.`lang`=:lang AND 
			`studio404_pages`.`status`!=:status AND 
			`studio404_pages`.`idx`=`studio404_module_attachment`.`connect_idx` AND 
			`studio404_module_attachment`.`page_type`=:pagetype AND 
			`studio404_module_attachment`.`lang`=:lang AND 
			`studio404_module_attachment`.`status`!=:status AND 
			`studio404_module_attachment`.`idx`=`studio404_module`.`idx` AND 
			`studio404_module`.`lang`=:lang AND 
			`studio404_module`.`status`!=:status AND 
			`studio404_module`.`idx`=`studio404_module_item`.`module_idx` AND 
			`studio404_module_item`.`lang`=:lang AND 
			`studio404_module_item`.`visibility`!=:visibility AND 
			`studio404_module_item`.`status`!=:status 
			ORDER BY `studio404_module_item`.`date` DESC LIMIT 15 
			';	
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":pagetype"=>'eventpage', 
				":media_type"=>'photo', 
				":lang"=>LANG_ID, 
				":status"=>1, 
				":visibility"=>1, 
			)); 
			$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC); 
			break;
			case "events_general":  
			$get_slug_from_url = new get_slug_from_url();
			$slug = $get_slug_from_url->slug();
			$sql = 'SELECT 
			`studio404_module_item`.* 
			FROM 
			`studio404_pages`, `studio404_module_attachment`, `studio404_module`, `studio404_module_item` 
			WHERE 
			`studio404_pages`.`slug`=:slug AND 
			`studio404_pages`.`lang`=:lang AND 
			`studio404_pages`.`visibility`!=:visibility AND 
			`studio404_pages`.`status`!=:status AND 
			`studio404_pages`.`idx`=`studio404_module_attachment`.`connect_idx` AND 
			`studio404_module_attachment`.`page_type`=:page_type AND 
			`studio404_module_attachment`.`lang`=:lang AND 
			`studio404_module_attachment`.`status`!=:status AND 
			`studio404_module_attachment`.`idx`=`studio404_module`.`idx` AND 
			`studio404_module`.`lang`=:lang AND 
			`studio404_module`.`status`!=:status AND 
			`studio404_module`.`idx`=`studio404_module_item`.`module_idx` AND 
			`studio404_module_item`.`lang`=:lang AND 
			`studio404_module_item`.`visibility`!=:visibility AND 
			`studio404_module_item`.`status`!=:status ORDER BY `studio404_module_item`.`date` DESC 
			';
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":pagetype"=>'eventpage', 
				":media_type"=>'photo', 
				":slug"=>$slug, 
				":lang"=>LANG_ID,
				":visibility"=>1,
				":status"=>1,
				":page_type"=>'eventpage'
			));
			$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC); 
			break;
			case "eventsinside_general": 
			$get_slug_from_url = new get_slug_from_url();
			$slug = $get_slug_from_url->slug();
			$sql = 'SELECT `studio404_module_item`.*,
			( 
				SELECT `studio404_gallery_file`.`file` FROM 
				`studio404_gallery_attachment`,`studio404_gallery`,`studio404_gallery_file` 
				WHERE 
				`studio404_gallery_attachment`.`connect_idx`=`studio404_module_item`.`idx` AND 
				`studio404_gallery_attachment`.`pagetype`=:pagetype AND 
				`studio404_gallery_attachment`.`lang`=:lang AND 
				`studio404_gallery_attachment`.`status`!=:status AND 
				`studio404_gallery_attachment`.`idx`=`studio404_gallery`.`idx` AND 
				`studio404_gallery`.`lang`=:lang AND 
				`studio404_gallery`.`status`!=:status AND 
				`studio404_gallery`.`idx`=`studio404_gallery_file`.`gallery_idx` AND 
				`studio404_gallery_file`.`media_type`=:media_type AND 
				`studio404_gallery_file`.`lang`=:lang AND 
				`studio404_gallery_file`.`status`!=:status 
				ORDER BY `studio404_gallery_file`.`position` ASC LIMIT 1
			) AS pic 
			FROM `studio404_module_item` WHERE 
			`studio404_module_item`.`slug`=:slug AND 
			`studio404_module_item`.`lang`=:lang AND 
			`studio404_module_item`.`visibility`!=:visibility AND 
			`studio404_module_item`.`status`!=:status';
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":pagetype"=>'eventpage', 
				":media_type"=>'photo', 
				":slug"=>$slug, 
				":lang"=>LANG_ID, 
				":visibility"=>1, 
				":status"=>1
			));
			$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC); 
			break;
			case "photo_gallery_list": 
			$get_slug_from_url = new get_slug_from_url();
			$slug = $get_slug_from_url->slug();
			$sql = 'SELECT 
			`studio404_media_item`.`slug` AS smi_slug, 
			`studio404_gallery`.`title` AS sg_title, 
			(
				SELECT 
				`studio404_gallery_file`.`file` 
				FROM 
				`studio404_gallery_attachment`,`studio404_gallery`,`studio404_gallery_file` 
				WHERE 
				`studio404_gallery_attachment`.`connect_idx`=`studio404_media_item`.`idx` AND 
				`studio404_gallery_attachment`.`pagetype`=:page_type AND 
				`studio404_gallery_attachment`.`lang`=:lang AND 
				`studio404_gallery_attachment`.`status`!=:status AND 
				`studio404_gallery_attachment`.`idx`=`studio404_gallery`.`idx` AND 
				`studio404_gallery`.`lang`=:lang AND 
				`studio404_gallery`.`status`!=:status AND 
				`studio404_gallery`.`idx`=`studio404_gallery_file`.`gallery_idx` AND 
				`studio404_gallery_file`.`media_type`=:media_type AND 
				`studio404_gallery_file`.`lang`=:lang AND 
				`studio404_gallery_file`.`status`!=:status 
				ORDER BY `studio404_gallery_file`.`position` ASC LIMIT 1
			) AS pic 
			FROM 
			`studio404_pages`, `studio404_media_attachment`, `studio404_media`, `studio404_media_item`, `studio404_gallery_attachment`, `studio404_gallery` 
			WHERE 
			`studio404_pages`.`slug`=:slug AND 
			`studio404_pages`.`lang`=:lang AND 
			`studio404_pages`.`visibility`!=:visibility AND 
			`studio404_pages`.`status`!=:status AND 
			`studio404_pages`.`idx`=`studio404_media_attachment`.`connect_idx` AND 
			`studio404_media_attachment`.`page_type`=:page_type AND 
			`studio404_media_attachment`.`lang`=:lang AND 
			`studio404_media_attachment`.`status`!=:status AND 
			`studio404_media_attachment`.`idx`=`studio404_media`.`idx` AND 
			`studio404_media`.`lang`=:lang AND 
			`studio404_media`.`status`!=:status AND 
			`studio404_media`.`idx`=`studio404_media_item`.`media_idx` AND 
			`studio404_media_item`.`lang`=:lang AND 
			`studio404_media_item`.`visibility`!=:visibility AND 
			`studio404_media_item`.`status`!=:status AND 
			`studio404_media_item`.`idx`=`studio404_gallery_attachment`.`connect_idx` AND 
			`studio404_gallery_attachment`.`pagetype`=:page_type AND 
			`studio404_gallery_attachment`.`lang`=:lang AND 
			`studio404_gallery_attachment`.`status`!=:status AND 
			`studio404_gallery_attachment`.`idx`=`studio404_gallery`.`idx` AND 
			`studio404_gallery`.`lang`=:lang AND 
			`studio404_gallery`.`status`!=:status ORDER BY `studio404_media_item`.`position` ASC 
			';
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":slug"=>$slug, 
				":lang"=>LANG_ID, 
				":visibility"=>1, 
				":status"=>1, 
				":page_type"=>'photogallerypage', 
				":media_type"=>'photo'
			));
			$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC); 
			break; 
			case "files_":
			$get_slug_from_url = new get_slug_from_url();
			$slug = $get_slug_from_url->slug();
			$sql = 'SELECT 
			`studio404_gallery_file`.* 
			FROM 
			`studio404_media_item`, `studio404_gallery_attachment`, `studio404_gallery`, `studio404_gallery_file` 
			WHERE 
			`studio404_media_item`.`slug`=:slug AND 
			`studio404_media_item`.`lang`=:lang AND 
			`studio404_media_item`.`visibility`!=:visibility AND 
			`studio404_media_item`.`status`!=:status AND 
			`studio404_media_item`.`idx`=`studio404_gallery_attachment`.`connect_idx` AND  
			`studio404_gallery_attachment`.`pagetype`=:pagetype AND  
			`studio404_gallery_attachment`.`lang`=:lang AND  
			`studio404_gallery_attachment`.`status`!=:status AND  
			`studio404_gallery_attachment`.`idx`=`studio404_gallery`.`idx` AND   
			`studio404_gallery`.`lang`=:lang AND   
			`studio404_gallery`.`status`!=:status AND   
			`studio404_gallery`.`idx`=`studio404_gallery_file`.`gallery_idx` AND   
			`studio404_gallery_file`.`media_type`=:media_type AND   
			`studio404_gallery_file`.`lang`=:lang AND   
			`studio404_gallery_file`.`status`!=:status 
			ORDER BY `studio404_gallery_file`.`position` ASC   
			';
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":slug"=>$slug, 
				":lang"=>LANG_ID, 
				":visibility"=>1, 
				":status"=>1, 
				":pagetype"=>'photogallerypage', 
				":media_type"=>'photo' 
			));
			$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC); 
			break;
			case "videogallery_general":
			$get_slug_from_url = new get_slug_from_url();
			$slug = $get_slug_from_url->slug();
			$sql = 'SELECT 
			`studio404_gallery_file`.* 
			FROM 
			`studio404_pages`,`studio404_media_attachment`,`studio404_media`,`studio404_media_item`,`studio404_gallery_attachment`, `studio404_gallery`, `studio404_gallery_file` 
			WHERE 
			`studio404_pages`.`slug`=:slug AND 
			`studio404_pages`.`lang`=:lang AND  
			`studio404_pages`.`visibility`!=:visibility AND  
			`studio404_pages`.`status`!=:status AND  
			`studio404_pages`.`idx`=`studio404_media_attachment`.`connect_idx` AND  
			`studio404_media_attachment`.`lang`=:lang AND  
			`studio404_media_attachment`.`status`!=:status AND  
			`studio404_media_attachment`.`idx`=`studio404_media`.`idx` AND  
			`studio404_media`.`lang`=:lang AND  
			`studio404_media`.`status`!=:status AND   
			`studio404_media`.`idx`=`studio404_media_item`.`media_idx` AND   
			`studio404_media_item`.`lang`=:lang AND 
			`studio404_media_item`.`visibility`!=:visibility AND 
			`studio404_media_item`.`status`!=:status AND 
			`studio404_media_item`.`idx`=`studio404_gallery_attachment`.`connect_idx` AND  
			`studio404_gallery_attachment`.`pagetype`=:pagetype AND  
			`studio404_gallery_attachment`.`lang`=:lang AND  
			`studio404_gallery_attachment`.`status`!=:status AND  
			`studio404_gallery_attachment`.`idx`=`studio404_gallery`.`idx` AND   
			`studio404_gallery`.`lang`=:lang AND   
			`studio404_gallery`.`status`!=:status AND   
			`studio404_gallery`.`idx`=`studio404_gallery_file`.`gallery_idx` AND   
			`studio404_gallery_file`.`media_type`=:media_type AND   
			`studio404_gallery_file`.`lang`=:lang AND   
			`studio404_gallery_file`.`status`!=:status 
			ORDER BY `studio404_gallery_file`.`position` ASC   
			';
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":slug"=>$slug, 
				":lang"=>LANG_ID, 
				":visibility"=>1, 
				":status"=>1, 
				":pagetype"=>'videogallerypage', 
				":media_type"=>'video' 
			));
			$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC); 
			break;
			case "breadcrups": 
			$get_slug_from_url = new get_slug_from_url();
			$slug = $get_slug_from_url->slug();
			$fetch =  $this->breakcrups($c,$slug);
			break;
			case "sector": 
			$sectors_subsectors_products = new sectors_subsectors_products();
			$fetch = $sectors_subsectors_products->sectors($c);
			break;
			case "subsector": 
			$sectors_subsectors_products = new sectors_subsectors_products();
			$fetch = $sectors_subsectors_products->subsector($c);
			break;
			case "products": 
			$sectors_subsectors_products = new sectors_subsectors_products();
			$fetch = $sectors_subsectors_products->products($c);
			break;
			case "countries":
			$sectors_subsectors_products = new sectors_subsectors_products();
			$fetch = $sectors_subsectors_products->countries($c);
			break;
			case "certificates":
			$sectors_subsectors_products = new sectors_subsectors_products();
			$fetch = $sectors_subsectors_products->certificates($c);
			break;
			case "companysize":
			$sectors_subsectors_products = new sectors_subsectors_products();
			$fetch = $sectors_subsectors_products->companysize($c);
			break;
			case "hidden_team_list": 
			$sql = 'SELECT 
			`studio404_module_item`.`idx` AS smi_idx, 
			`studio404_module_item`.`title` AS namelname 
			FROM 
			`studio404_pages`, `studio404_module_attachment`, `studio404_module`, `studio404_module_item`  
			WHERE 
			`studio404_pages`.`slug`=:slug AND 
			`studio404_pages`.`lang`=:lang AND 
			`studio404_pages`.`visibility`!=:visibility AND 
			`studio404_pages`.`status`!=:status AND 
			`studio404_pages`.`idx`=`studio404_module_attachment`.`connect_idx` AND 
			`studio404_module_attachment`.`page_type`=:pagetype AND 
			`studio404_module_attachment`.`lang`=:lang AND 
			`studio404_module_attachment`.`status`!=:status AND 
			`studio404_module_attachment`.`idx`=`studio404_module`.`idx` AND 
			`studio404_module`.`lang`=:lang AND 
			`studio404_module`.`status`!=:status AND 
			`studio404_module`.`idx`=`studio404_module_item`.`module_idx` AND 
			`studio404_module_item`.`lang`=:lang AND 
			`studio404_module_item`.`visibility`!=:visibility AND 
			`studio404_module_item`.`status`!=:status 
			ORDER BY `studio404_module_item`.`position` ASC 
			';	
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":media_type"=>'photo', 
				":media_type_doc"=>'document', 
				":pagetype"=>'catalogpage', 
				":slug"=>'team', 
				":status"=>1, 
				":visibility"=>1, 
				":lang"=>LANG_ID 
			)); 			
			$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC); 
			break;
			case "productinside":
			$sql = 'SELECT 
			`studio404_module_item`.*, 
			(SELECT `studio404_users`.`company_type` FROM `studio404_users` WHERE `studio404_users`.`id`=`studio404_module_item`.`insert_admin`) AS com_type, 
			(SELECT `studio404_users`.`namelname` FROM `studio404_users` WHERE `studio404_users`.`id`=`studio404_module_item`.`insert_admin`) AS com_name, 
			(SELECT `studio404_pages`.`title` FROM `studio404_pages` WHERE `studio404_pages`.`idx`=`studio404_module_item`.`hscode`) AS hscode_title 
			FROM 
			 `studio404_module_item`
			 WHERE 
			 `studio404_module_item`.`insert_admin`='.(int)Input::method("GET","i").' AND 
			 `studio404_module_item`.`id`='.(int)Input::method("GET","p").' AND 
			 `studio404_module_item`.`status`!=:one
			';
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":one"=>1
			));
			if($prepare->rowCount()>0){
				$fetch = $prepare->fetch(PDO::FETCH_ASSOC); 
				//$picture = ($fetch["picture"]) ? WEBSITE.'image?f='.WEBSITE.'files/usersproducts/'.$fetch["picture"].'&w=175&h=175' : '';
			}	
			break;
		}
		if(count($fetch)){
			$fh = @fopen($cache_file, 'w') or die("Error opening output file");
			@fwrite($fh, json_encode($fetch,JSON_UNESCAPED_UNICODE));
			@fclose($fh);
		}
	}

	public function breakcrups($c,$slug){
		$conn = $this->conn($c); 
		$explode = explode("/", $slug);
		$nums = count($explode); 
		$out = array();
		
		for($x=0;$x<$nums;$x++){
			$slice = array_slice($explode,0,($x+1));
			$url = implode("/",$slice);

			$sql = 'SELECT `title`,`slug` FROM `studio404_pages` WHERE `slug`=:slug AND `status`!=:status AND `menu_type`!=:super AND `lang`=:lang AND `visibility`!=:visibility';
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":slug"=>$url, 
				":status"=>1, 
				":super"=>'super', 
				":lang"=>LANG_ID, 
				":visibility"=>1 
			));
			if($prepare->rowCount()){
				$f = $prepare->fetch(PDO::FETCH_ASSOC);	
				$out[$x]["title"] = $f["title"]; 
				$out[$x]["slug"] = $f["slug"]; 
			}else{
				$sql2 = 'SELECT `title`,`slug` FROM `studio404_module_item` WHERE `slug`=:slug AND `status`!=:status AND `lang`=:lang AND `visibility`!=:visibility';
				$prepare2 = $conn->prepare($sql2); 
				$prepare2->execute(array(
					":slug"=>$url, 
					":status"=>1, 
					":lang"=>LANG_ID, 
					":visibility"=>1 
				));
				if($prepare2->rowCount()){
					$f2 = $prepare2->fetch(PDO::FETCH_ASSOC);	
					$out[$x]["title"] = $f2["title"]; 
					$out[$x]["slug"] = $f2["slug"]; 
				}

			}
		}
		return $out;
	}

	public function sub_menu($c,$fetch){ 
		$conn = $this->conn($c);
		$o = array(); 
		foreach($fetch as $f){ 
			$o["date"][] = $f["date"]; 
			$o["expiredate"][] = $f["expiredate"]; 
			$o["title"][] = $f["title"]; 
			$o["redirectlink"][] = $f["redirectlink"]; 
			$o["slug"][] = $f["slug"]; 

			$sql = 'SELECT * FROM `studio404_pages` WHERE `status`!=:status AND `menu_type`!=:super AND `lang`=:lang AND `visibility`!=:visibility AND `cid`=:cid ORDER BY `position` ASC';	
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array( 
				":status"=>1, 
				":super"=>'super', 
				":lang"=>LANG_ID, 
				":visibility"=>1, 
				":cid"=>$f['cid'] 
			)); 
			$fetch2 = $prepare->fetchAll(PDO::FETCH_ASSOC); 
			if(!$prepare->rowCount()){ 
				break; 
			}else{ 
				$o["sub"][] = $this->sub_menu2($c,$f["idx"]);
			}
		}
		return $o;
	}

	public function sub_menu2($c,$idx){
		$conn = $this->conn($c);
		$o = array();
		$sql = 'SELECT * FROM `studio404_pages` WHERE `status`!=:status AND `menu_type`!=:super AND `lang`=:lang AND `visibility`!=:visibility AND `cid`=:cid ORDER BY `position` ASC ';	
		$prepare = $conn->prepare($sql); 
		$prepare->execute(array( 
			":status"=>1, 
			":super"=>'super', 
			":lang"=>LANG_ID, 
			":visibility"=>1, 
			":cid"=>$idx  
		)); 
		$fetch2 = $prepare->fetchAll(PDO::FETCH_ASSOC); 
		if($prepare->rowCount()){
			foreach($fetch2 as $f2){
				$o["date"][] = $f2["date"]; 
				$o["expiredate"][] = $f2["expiredate"]; 
				$o["title"][] = $f2["title"]; 
				$o["redirectlink"][] = $f2["redirectlink"]; 
				$o["slug"][] = $f2["slug"]; 
				$o["sub"][] = $this->sub_menu2($c,$f2['idx']); 	
			}
		}
		return $o;	
	}

}
?>