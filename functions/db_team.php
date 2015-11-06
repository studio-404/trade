<?php if(!defined("DIR")){ exit(); }
class db_team extends connection{
        public function get($idx){
        	global $c;
                $conn = $this->conn($c); 
                //var_dump($conn); 
                $sql = 'SELECT 
                `studio404_catalog_info`.`name` AS sci_name, 
                `studio404_catalog_info_values`.`value` AS scv_value 
                FROM 
                `studio404_catalog_info_values`, `studio404_catalog_info` 
                WHERE 
                `studio404_catalog_info_values`.`cidx`=:cidx AND 
                `studio404_catalog_info_values`.`lang`=:lang AND 
                `studio404_catalog_info_values`.`status`!=:status AND 
                `studio404_catalog_info_values`.`sci_idx`=`studio404_catalog_info`.`idx` AND 
                `studio404_catalog_info`.`lang`=:lang AND 
                `studio404_catalog_info`.`status`!=:status 
                ORDER BY `studio404_catalog_info_values`.`position` ASC 
                ';
                $prepare = $conn->prepare($sql); 
                $prepare->execute(array(
                	":cidx"=>$idx, 
                	":lang"=>LANG_ID, 
                	":status"=>1
                ));
                $fetch = $prepare->fetchAll(PDO::FETCH_ASSOC); 
                $out[$fetch[0]["sci_name"]] = $fetch[0]["scv_value"]; 
                $out[$fetch[1]["sci_name"]] = $fetch[1]["scv_value"]; 
                return $out;        
        }
}
?>