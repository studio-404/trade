<?php if(!defined("DIR")){ exit(); } 
class model_admin_sqlcommand extends connection{

	public function load($c){
		$out = array();
		$conn = $this->conn($c); 
		if(isset($_GET["load"]) && !empty($_GET["load"])){
			try{
				$sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'geoweb_trade' AND TABLE_NAME = '".$_GET['load']."'";
				$prepare = $conn->prepare($sql);
				$prepare->execute();
				if($prepare->rowCount() > 0){
					$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC);

					$sqlcommand = 'SELECT ';
					foreach($fetch as $f){
						$sqlcommand .= '`'.$f["COLUMN_NAME"].'`,';
					}
					$sqlcommand = rtrim($sqlcommand,","); 
					$sqlcommand .= ' FROM `'.$_GET["load"].'` WHERE 1';

					$out[0] = $fetch;
					$out[1] = $sqlcommand;
				}
			}catch(Exception $e){

			}
		}
		return $out;
	}


	public function trademap($c){
		$out = array();
		$conn = $this->conn($c); 
		if(isset($_GET["load"]) && !empty($_GET["load"])){
			try{
				$sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'geoweb_trade' AND TABLE_NAME = 'studio404_vectormap'";
				$prepare = $conn->prepare($sql);
				$prepare->execute();
				if($prepare->rowCount() > 0){
					$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC);

					$sqlcommand = 'SELECT ';
					foreach($fetch as $f){
						$sqlcommand .= '`'.$f["COLUMN_NAME"].'`,';
					}
					$sqlcommand = rtrim($sqlcommand,","); 
					$sqlcommand .= ' FROM `'.$_GET["load"].'` WHERE 1';

					$out[0] = $fetch;
					$out[1] = $sqlcommand;
				}
			}catch(Exception $e){

			}
		}
		return $out;
	}


	public function template($c,$type,$userstype){
		$out = array();
		switch($type){
			case "users":
			try{
				if($userstype=="manufacturer"){
					$fetch[0]["COLUMN_NAME"] = "id";
					$fetch[1]["COLUMN_NAME"] = "namelname";
					$fetch[2]["COLUMN_NAME"] = "sector_id";
					$fetch[3]["COLUMN_NAME"] = "sub_sector_id";
					$fetch[4]["COLUMN_NAME"] = "established_in";
					$fetch[5]["COLUMN_NAME"] = "production_capacity";
					$fetch[6]["COLUMN_NAME"] = "address";
					$fetch[7]["COLUMN_NAME"] = "mobile";
					$fetch[8]["COLUMN_NAME"] = "number_of_employes";
					$fetch[9]["COLUMN_NAME"] = "certificates";
					$fetch[10]["COLUMN_NAME"] = "contact_person";
					$fetch[11]["COLUMN_NAME"] = "office_phone";
					$fetch[12]["COLUMN_NAME"] = "company_size";
					$fetch[13]["COLUMN_NAME"] = "web_address";
					$fetch[14]["COLUMN_NAME"] = "email";
					$fetch[15]["COLUMN_NAME"] = "about";
					$fetch[16]["COLUMN_NAME"] = "products";
					$fetch[17]["COLUMN_NAME"] = "export_markets_id";
				}else if($userstype=="serviceprovider"){
					$fetch[0]["COLUMN_NAME"] = "id";
					$fetch[1]["COLUMN_NAME"] = "namelname";
					$fetch[2]["COLUMN_NAME"] = "sector_id";
					$fetch[3]["COLUMN_NAME"] = "sub_sector_id";
					$fetch[4]["COLUMN_NAME"] = "established_in";
					$fetch[5]["COLUMN_NAME"] = "production_capacity";
					$fetch[6]["COLUMN_NAME"] = "address";
					$fetch[7]["COLUMN_NAME"] = "mobile";
					$fetch[8]["COLUMN_NAME"] = "number_of_employes";
					$fetch[9]["COLUMN_NAME"] = "certificates";
					$fetch[10]["COLUMN_NAME"] = "contact_person";
					$fetch[11]["COLUMN_NAME"] = "office_phone";
					$fetch[12]["COLUMN_NAME"] = "company_size";
					$fetch[13]["COLUMN_NAME"] = "web_address";
					$fetch[14]["COLUMN_NAME"] = "email";
					$fetch[15]["COLUMN_NAME"] = "about";
					$fetch[16]["COLUMN_NAME"] = "products";
					$fetch[17]["COLUMN_NAME"] = "export_markets_id";
				}else if($userstype=="company"){
					$fetch[0]["COLUMN_NAME"] = "id";
					$fetch[1]["COLUMN_NAME"] = "namelname";
					$fetch[2]["COLUMN_NAME"] = "sector_id";
					$fetch[4]["COLUMN_NAME"] = "established_in";
					$fetch[6]["COLUMN_NAME"] = "address";
					$fetch[7]["COLUMN_NAME"] = "mobile";
					$fetch[8]["COLUMN_NAME"] = "number_of_employes";
					$fetch[10]["COLUMN_NAME"] = "contact_person";
					$fetch[11]["COLUMN_NAME"] = "office_phone";
					$fetch[12]["COLUMN_NAME"] = "company_size";
					$fetch[13]["COLUMN_NAME"] = "web_address";
					$fetch[14]["COLUMN_NAME"] = "email";
					$fetch[15]["COLUMN_NAME"] = "about";
				}else if($userstype=="individual"){
					$fetch[0]["COLUMN_NAME"] = "id";
					$fetch[1]["COLUMN_NAME"] = "namelname";
					$fetch[2]["COLUMN_NAME"] = "sector_id";
					$fetch[6]["COLUMN_NAME"] = "address";
					$fetch[7]["COLUMN_NAME"] = "mobile";
					$fetch[13]["COLUMN_NAME"] = "web_address";
					$fetch[14]["COLUMN_NAME"] = "email";
				}


				$sqlcommand = 'SELECT ';
				foreach($fetch as $f){
					$sqlcommand .= '`'.$f["COLUMN_NAME"].'`,';
				}
				$sqlcommand = rtrim($sqlcommand,","); 
				$sqlcommand .= ' FROM `studio404_users` WHERE 1';

				$out[0] = $fetch;
				$out[1] = $sqlcommand;
				
			}catch(Exception $e){

			}
			break;
		}
		return $out;
	}




}

?>