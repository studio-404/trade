<?php if(!defined("DIR")){ exit(); } 
class module_admin_create_csv extends connection{

	public function create($c){
		$conn = $this->conn($c); 

		if(isset($_POST["chk"]) && count($_POST["chk"]) > 0){
			
			$filename = DIR.'files/csv/file.csv';
			$ck_array = array();
			foreach($_POST['chk'] as $v){
				if(isset($_POST["input"][$v])){
					$ck_array[] = $_POST["input"][$v];
				}
			}

			$fp = fopen($filename, 'w');


			fputcsv($fp, $ck_array);
			$table = ($_POST['table']=="template_trademap") ? 'studio404_vectormap' : $_POST['table'];
			$sql = 'SELECT '.implode(",",$_POST["chk"]).' FROM `'.$table.'` WHERE 1';
			$prepare = $conn->prepare($sql);
			$prepare->execute();
			if($prepare->rowCount() > 0){
				$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC); 
				foreach($fetch as $f){
					fputcsv($fp, $f);
				}
			}
			
			fclose($fp);

			echo '<script type=\'text/javascript\'>
				window.open(\''.WEBSITE.'download?path='.$filename.'&contenttype=text/csv\', \'_blank\');
				</script>';
		}

	}


	public function create_user_template($c){
		$conn = $this->conn($c); 
		if(isset($_POST["chk"]) && count($_POST["chk"]) > 0){
			
			$filename = DIR.'files/csv/file.csv';
			$ck_array = array();
			foreach($_POST['chk'] as $v){
				if(isset($_POST["input"][$v])){
					$ck_array[] = $_POST["input"][$v];
				}
			}

			$fp = fopen($filename, 'w');


			fputcsv($fp, $ck_array);
			$sql = 'SELECT '.implode(",",$_POST["chk"]).' FROM `studio404_users` WHERE `status`!=1 AND `user_type`="website" AND `company_type`="'.$_GET['usertype'].'"';
			$prepare = $conn->prepare($sql);
			$prepare->execute();
			$csv_array = array();
			if($prepare->rowCount() > 0){
				$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC); 
				$retrieve_users_info = new retrieve_users_info();
				foreach($fetch as $v){

					foreach($_POST["chk"] as $chk){
						if($chk=="sector_id"){
							$csv_array[] = $retrieve_users_info->retrieveDb($v[$chk]);
						}else if($chk=="company_size"){
							$csv_array[] = $retrieve_users_info->retrieveDb($v[$chk]);
						}else if($chk=="sub_sector_id"){
							$csv_array[] = $retrieve_users_info->retrieveDb($v[$chk]);
						}else if($chk=="certificates"){
							$csv_array[] = $retrieve_users_info->retrieveDb($v[$chk]);
						}else if($chk=="products"){
							$csv_array[] = $retrieve_users_info->retrieveDb($v[$chk]);
						}else if($chk=="export_markets_id"){
							$csv_array[] = $retrieve_users_info->retrieveDb($v[$chk]);
						}else{
							$csv_array[] = $v[$chk];
						}

					}

				}
				fputcsv($fp, $csv_array);
			}
			
			fclose($fp);

			echo '<script type=\'text/javascript\'>
				window.open(\''.WEBSITE.'download?path='.$filename.'&contenttype=text/csv\', \'_blank\');
				</script>';

		}


	}

}
?>