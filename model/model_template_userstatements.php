<?php if(!defined("DIR")){ exit(); }
class model_template_userstatements extends connection{

	public function stats($c,$t,$i,$limit = ' LIMIT 5'){
		$conn = $this->conn($c); 
		$fetch = '';
		if(isset($t) && isset($i) && is_numeric($i)){
			if($t=="manufacturer"){
				$sql = 'SELECT 
				`studio404_module_item`.`id`, 
				`studio404_module_item`.`idx`, 
				`studio404_module_item`.`title`, 
				`studio404_module_item`.`picture`, 
				`studio404_module_item`.`sub_sector_id`,
				(SELECT `studio404_pages`.`title` FROM `studio404_pages` WHERE `studio404_pages`.`idx`=`studio404_module_item`.`hscode`) AS hscode, 
				`studio404_module_item`.`products`, 
				`studio404_module_item`.`shelf_life`, 
				`studio404_module_item`.`packaging`, 
				`studio404_module_item`.`awards`, 
				`studio404_module_item`.`long_description`
				FROM 
				`studio404_module_item`
				WHERE 
				`studio404_module_item`.`module_idx`=3 AND 
				`studio404_module_item`.`visibility`=:two AND 
				`studio404_module_item`.`status`!=:one AND 
				`studio404_module_item`.`insert_admin`=:insert_admin 
				ORDER BY `studio404_module_item`.`date` DESC '.$limit;
				$prepare = $conn->prepare($sql); 
				$prepare->execute(array(
					":insert_admin"=>(int)$i, 
					":two"=>2, 
					":one"=>1
				));
				if($prepare->rowCount() > 0){
					$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC);
				}else{
					$fetch = '';
				}
			}

			if($t=="serviceprovider"){
				$sql = 'SELECT 
				`studio404_module_item`.`id`, 
				`studio404_module_item`.`idx`, 
				`studio404_module_item`.`title`, 
				`studio404_module_item`.`products`, 
				`studio404_module_item`.`long_description`
				FROM 
				`studio404_module_item`
				WHERE 
				`studio404_module_item`.`module_idx`=4 AND 
				`studio404_module_item`.`visibility`=:two AND 
				`studio404_module_item`.`status`!=:one AND 
				`studio404_module_item`.`insert_admin`=:insert_admin 
				ORDER BY `studio404_module_item`.`date` DESC '.$limit;
				$prepare = $conn->prepare($sql); 
				$prepare->execute(array(
					":insert_admin"=>(int)$i, 
					":two"=>2, 
					":one"=>1
				));
				if($prepare->rowCount() > 0){
					$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC);
				}else{
					$fetch = '';
				}
			}

			if($t=="company" || $t=="individual"){
				$sql = 'SELECT 
				`studio404_module_item`.`id`, 
				`studio404_module_item`.`idx`, 
				`studio404_module_item`.`date`, 
				`studio404_module_item`.`type`, 
				`studio404_module_item`.`title`, 
				`studio404_module_item`.`long_description`
				FROM 
				`studio404_module_item`
				WHERE 
				`studio404_module_item`.`module_idx`=5 AND 
				`studio404_module_item`.`visibility`=:two AND 
				`studio404_module_item`.`status`!=:one AND 
				`studio404_module_item`.`insert_admin`=:insert_admin 
				ORDER BY `studio404_module_item`.`date` DESC '.$limit;
				$prepare = $conn->prepare($sql); 
				$prepare->execute(array(
					":insert_admin"=>(int)$i, 
					":two"=>2, 
					":one"=>1
				));
				if($prepare->rowCount() > 0){
					$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC);
				}else{
					$fetch = '';
				}
			}

		}
		return $fetch;
	}

}
?>