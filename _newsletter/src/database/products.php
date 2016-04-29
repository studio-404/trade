<?php if(!defined("DIR")){ echo "Sorry, You dont have a permittion !"; exit(); }
class src_database_products extends src_database_connection{
	
	public $db_handler;

	public function getter(){
		$this->db_handler = $this->conn();
		$sql = 'SELECT 
		`studio404_module_item`.`id`, 
		`studio404_module_item`.`date`, 
		`studio404_module_item`.`title`, 
		`studio404_module_item`.`picture`, 
		(SELECT `title` FROM  `studio404_pages` WHERE `studio404_pages`.`idx`=`studio404_module_item`.`sub_sector_id`) AS su_sector,
		(SELECT `title` FROM  `studio404_pages` WHERE `studio404_pages`.`idx`=`studio404_module_item`.`hscode`) AS su_hscode,
		(SELECT `title` FROM  `studio404_pages` WHERE `studio404_pages`.`idx`=`studio404_module_item`.`products`) AS su_products,
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
		`studio404_module_item`.`visibility`=:two AND 
		`studio404_module_item`.`status`!=:one AND 
		`studio404_module_item`.`emailed`=:no AND 
		`studio404_module_item`.`insert_admin`=`studio404_users`.`id` AND 
		`studio404_users`.`status`!=:one AND   
		`studio404_users`.`allow`!=:one ORDER BY `date` ASC LIMIT 10
		';
		$prepare = $this->db_handler->prepare($sql);
		$prepare->execute(array(
			":two"=>2, 
			":one"=>1, 
			":no"=>"no" 
		));
		if($prepare->rowCount() > 0){
			$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC);
			foreach ($fetch as $v) {
				$sql = 'UPDATE `studio404_module_item` SET `emailed`="yes" WHERE `id`=:id';
				$pr = $this->db_handler->prepare($sql);
				$pr->execute(array(	
					":id"=>$v['id']
				));
			}
			return $fetch;
		}else{
			return false;
		}
	}
}
?>