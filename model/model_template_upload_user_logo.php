<?php if(!defined("DIR")){ exit(); }
class model_template_upload_user_logo extends connection{
	function __construct(){

	}

	public function upload($c){
		/* update manufacturer upload catalog */
		if(isset($_FILES["ad_upload_catalog"]["name"]) && !empty($_FILES["ad_upload_catalog"]["name"])){
			$ext = explode(".",$_FILES["ad_upload_catalog"]["name"]);
			$ext = strtolower(end($ext));

			if($ext!="pdf"){
				return 2;
			}else if($_FILES["ad_upload_catalog"]["size"]>3000000){
				return 2;
			}else{
				$fileName = md5(time()).'.'.$ext; 
				
				$target_file = DIR . 'files/document/'.$fileName;
				 if (move_uploaded_file($_FILES["ad_upload_catalog"]["tmp_name"],$target_file)) { 
				 	$conn = $this->conn($c); 

				 	$check = 'SELECT `ad_upload_catalog` FROM `studio404_users` WHERE `id`=:companyId AND `username`=:username AND `status`!=:one'; 
				 	$pre_check = $conn->prepare($check);
				 	$pre_check->execute(array(
				 		":username"=>$_SESSION["tradewithgeorgia_username"], 
				 		":companyId"=>$_SESSION["tradewithgeorgia_user_id"], 
				 		":one"=>1
				 	));
				 	$ch_fetch = $pre_check->fetch(PDO::FETCH_ASSOC); 
				 	if(!empty($ch_fetch["ad_upload_catalog"])){
				 		$old_pic = DIR . 'files/document/'.$ch_fetch["ad_upload_catalog"]; 
				 		@unlink($old_pic);
				 	}

				 	$sql = 'UPDATE `studio404_users` SET `ad_upload_catalog`=:ad_upload_catalog WHERE `id`=:companyId AND `username`=:username AND `status`!=:one'; 
				 	$prepare = $conn->prepare($sql); 
				 	$prepare->execute(array(
				 		":username"=>$_SESSION["tradewithgeorgia_username"], 
				 		":companyId"=>$_SESSION["tradewithgeorgia_user_id"], 
				 		":one"=>1, 
				 		":ad_upload_catalog"=>$fileName
				 	));
				 	$_SESSION["user_data"]["ad_upload_catalog"] = $fileName;
        			return 1;
    			}else{
    				return 2; 
    			}
			}
		}

		if(isset($_FILES["inputUserLogo"]["name"]) && !empty($_FILES["inputUserLogo"]["name"]) && isset($_SESSION["tradewithgeorgia_username"])){
			$ext = explode(".",$_FILES["inputUserLogo"]["name"]);
			$ext = strtolower(end($ext));

			if($ext!="jpeg" && $ext!="jpg" && $ext!="png" && $ext!="gif"){
				return 2;
			}else if($_FILES["inputUserLogo"]["size"]>1000000){
				return 2;
			}else{
				$prefix = explode("@",$_SESSION["tradewithgeorgia_username"].$_SESSION["tradewithgeorgia_user_id"]);
				if(is_array($prefix) && !empty($prefix[0])){ $prefix = $prefix[0];  }else{ $prefix = '_'; }
				$fileName = $prefix.md5(time()).'.'.$ext; 
				
				$target_file = DIR . 'files/usersimage/'.$fileName;
				 if (move_uploaded_file($_FILES["inputUserLogo"]["tmp_name"],$target_file)) { 
				 	$conn = $this->conn($c); 

				 	$check = 'SELECT `picture` FROM `studio404_users` WHERE `id`=:companyId AND `username`=:username AND `allow`!=:one AND `status`!=:one'; 
				 	$pre_check = $conn->prepare($check);
				 	$pre_check->execute(array(
				 		":username"=>$_SESSION["tradewithgeorgia_username"], 
				 		":companyId"=>$_SESSION["tradewithgeorgia_user_id"], 
				 		":one"=>1
				 	));
				 	$ch_fetch = $pre_check->fetch(PDO::FETCH_ASSOC); 
				 	if(!empty($ch_fetch["picture"])){
				 		$old_pic = DIR . 'files/usersimage/'.$ch_fetch["picture"]; 
				 		@unlink($old_pic);
				 	}

				 	$sql = 'UPDATE `studio404_users` SET `picture`=:picture WHERE `id`=:companyId AND `username`=:username AND `allow`!=:one AND `status`!=:one'; 
				 	$prepare = $conn->prepare($sql); 
				 	$prepare->execute(array(
				 		":username"=>$_SESSION["tradewithgeorgia_username"], 
				 		":companyId"=>$_SESSION["tradewithgeorgia_user_id"], 
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