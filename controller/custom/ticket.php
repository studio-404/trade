<?php if(!defined("DIR")){ exit(); }
class ticket extends connection{
	function __construct($c){
		$this->template($c,"tickit");
	}
	
	public function template($c,$page){
		$conn = $this->conn($c); 
		$sql = 'SELECT 
		`studio404_event_tickets`.`date` AS set_date, 
		`studio404_event_tickets`.`uid` AS set_uid, 
		`studio404_event_tickets`.`namelname` AS set_namelname, 
		`studio404_event_tickets`.`email` AS set_email, 
		`studio404_event_tickets`.`mobile` AS set_mobile, 
		`studio404_module_item`.`title` AS smi_title, 
		`studio404_module_item`.`date` AS smi_date, 
		`studio404_module_item`.`expiredate` AS smi_expiredate, 
		`studio404_module_item`.`event_fee` AS smi_place, 
		`studio404_module_item`.`event_booth` AS smi_booth, 
		`studio404_module_item`.`event_desc` AS smi_venue, 
		`studio404_module_item`.`event_website` AS smi_website 
		FROM 
		 `studio404_event_tickets`, `studio404_module_item` 
		 WHERE 
		 `studio404_event_tickets`.`uid`=:uid AND 
		 `studio404_event_tickets`.`token`=:token AND 
		 `studio404_event_tickets`.`status`!=:one AND 
		 `studio404_event_tickets`.`event_id`=`studio404_module_item`.`idx` AND 
		 `studio404_module_item`.`status`!=:one  
		';
		$prepare = $conn->prepare($sql); 
		$prepare->execute(array(
			":uid"=>Input::method("GET","id"), 
			":token"=>Input::method("GET","token"), 
			":one"=>1 
		));
		if($prepare->rowCount() > 0){
			$data["output"] = $prepare->fetch(PDO::FETCH_ASSOC); 
			$include = WEB_DIR."/tickit.php";
			if(file_exists($include)){
				@include($include);
			}else{
				$controller = new error_page(); 
			}
		}else{
			echo "<b>Sorry, Could not select ticket !</b>";
		}
	}
}
?>