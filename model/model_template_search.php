<?php if(!defined("DIR")){ exit(); }
class model_template_search extends connection{

	public function studio404_search($c,$post)
	{
		$conn = $this->conn($c); 
		$post = strip_tags($post);
		$sql = "
		(SELECT 
		`title` AS page_title,  
		`text` AS page_text, 
		`page_type` as page_type, 
		`slug` as page_slug 
		FROM 
		`studio404_pages` 
		WHERE 
		(
			MATCH (`title`) AGAINST (:post) OR 
			MATCH (`text`) AGAINST (:post)
		) AND 
		`lang`=:lang AND 
		`visibility`!=:visibility AND 
		`status`!=:status)
		UNION 
		(
			SELECT 
			`studio404_module_item`.`title` AS page_title, 
			`studio404_module_item`.`long_description` AS page_text, 
			`studio404_module_attachment`.`page_type` AS page_type, 
			`studio404_module_item`.`slug` AS page_slug 
			FROM 
			`studio404_module_item`, `studio404_module_attachment` 
			WHERE 
			(
				MATCH (`studio404_module_item`.`title`) AGAINST (:post) OR 
				MATCH (`studio404_module_item`.`long_description`) AGAINST (:post)
			) AND 
			`studio404_module_item`.`lang`=:lang AND 
			`studio404_module_item`.`visibility`!=:visibility AND 
			`studio404_module_item`.`status`!=:status AND 
			`studio404_module_item`.`module_idx`=`studio404_module_attachment`.`idx` AND 
			`studio404_module_attachment`.`lang`=:lang AND 
			`studio404_module_attachment`.`status`!=:status  
		)
		";
		$prepare = $conn->prepare($sql); 
		$prepare->execute(array(
			":post"=>$post, 
			":lang"=>LANG_ID, 
			":visibility"=>1, 
			":status"=>1 
		));
		$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC);
		return $fetch;
	}

}
?>