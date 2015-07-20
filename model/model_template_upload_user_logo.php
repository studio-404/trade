<?php if(!defined("DIR")){ exit(); }
class model_template_upload_user_logo extends connection{
	function __construct(){

	}

	public function upload($c){
		if(isset($_FILES["inputUserLogo"]["name"]) && !empty($_FILES["inputUserLogo"]["name"]) && isset($_SESSION["tradewithgeorgia_username"])){
			$ext = explode(".",$_FILES["inputUserLogo"]["name"]);
			$ext = strtolower(end($ext));

			if($ext!="jpeg" && $ext!="jpg" && $ext!="png" && $ext!="gif"){
				return 2;
			}else if($_FILES["inputUserLogo"]["size"]>1000000){
				return 2;
			}else{
				$prefix = explode("@",$_SESSION["tradewithgeorgia_username"]);
				if(is_array($prefix) && !empty($prefix[0])){ $prefix = $prefix[0];  }else{ $prefix = '_'; }
				$fileName = $prefix.md5(time()).'.'.$ext; 
				
				$target_file = DIR . 'files/usersimage/'.$fileName;
				 if (move_uploaded_file($_FILES["inputUserLogo"]["tmp_name"],$target_file)) { 
				 	$conn = $this->conn($c); 

				 	$check = 'SELECT `picture` FROM `studio404_users` WHERE `username`=:username AND `allow`!=:one AND `status`!=:one'; 
				 	$pre_check = $conn->prepare($check);
				 	$pre_check->execute(array(
				 		":username"=>$_SESSION["tradewithgeorgia_username"], 
				 		":one"=>1
				 	));
				 	$ch_fetch = $pre_check->fetch(PDO::FETCH_ASSOC); 
				 	if(!empty($ch_fetch["picture"])){
				 		$old_pic = DIR . 'files/usersimage/'.$ch_fetch["picture"]; 
				 		@unlink($old_pic);
				 	}

				 	$sql = 'UPDATE `studio404_users` SET `picture`=:picture WHERE `username`=:username AND `allow`!=:one AND `status`!=:one'; 
				 	$prepare = $conn->prepare($sql); 
				 	$prepare->execute(array(
				 		":username"=>$_SESSION["tradewithgeorgia_username"], 
				 		":one"=>1, 
				 		":picture"=>$fileName
				 	));
				 	$_SESSION["user_data"]["picture"] = $fileName;
        			return 1;
    			}else{
    				return 2; 
    			}
			}
		}


		if(Input::method("POST","pi") && isset($_FILES["productfile"]["name"]) && !empty($_FILES["productfile"]["name"])){
			$ext = explode(".",$_FILES["productfile"]["name"]);
			$ext = strtolower(end($ext));

			if($ext!="jpeg" && $ext!="jpg" && $ext!="png" && $ext!="gif"){
				return 2;
			}else if($_FILES["productfile"]["size"]>1000000){
				return 2;
			}else{
				$prefix = explode("@",$_SESSION["tradewithgeorgia_username"]);
				if(is_array($prefix) && !empty($prefix[0])){ $prefix = $prefix[0];  }else{ $prefix = '_'; }
				$fileName = $prefix.md5(time()).'.'.$ext; 
				
				$target_file = DIR . 'files/usersproducts/'.$fileName;
				 if (move_uploaded_file($_FILES["productfile"]["tmp_name"],$target_file)) { 
				 	$conn = $this->conn($c); 

				 	$sql = 'UPDATE `studio404_module_item` SET `picture`=:picture WHERE `idx`=:idx AND `module_idx`=3 AND `insert_admin`=:insert_admin'; 
				 	$prepare = $conn->prepare($sql); 
				 	$prepare->execute(array(
				 		":idx"=>(int)Input::method("POST","pi"), 
				 		":insert_admin"=>$_SESSION["tradewithgeorgia_user_id"], 
				 		":picture"=>$fileName
				 	));
        			return 1;
    			}else{
    				return 2; 
    			}
			}

		}


	} 
}
?>