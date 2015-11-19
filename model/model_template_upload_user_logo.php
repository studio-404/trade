<?php if(!defined("DIR")){ exit(); }
class model_template_upload_user_logo extends connection{
	function __construct(){

	}

	public function upload($c){
		/* update manufacturer upload catalog */
		if(isset($_FILES["ad_upload_catalog"]["name"]) && !empty($_FILES["ad_upload_catalog"]["name"])){
			$ext = explode(".",$_FILES["ad_upload_catalog"]["name"]);
			$ext = strtolower(end($ext));

			if($ext!="pdf" && $ext!="doc" && $ext!="docx" && $ext!="xls" && $ext!="xlsx" && $ext!="jpg"){
				//return 2;
			}else if($_FILES["ad_upload_catalog"]["size"]>5000000){
				//return 2;
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
        			//return 1;
    			}else{
    				//return 2; 
    			}
			}
		}


		if(isset($_FILES["inputUserLogo"]["name"]) && !empty($_FILES["inputUserLogo"]["name"]) && isset($_SESSION["tradewithgeorgia_username"])){
			$ext = explode(".",$_FILES["inputUserLogo"]["name"]);
			$ext = strtolower(end($ext));

			if($ext!="jpg"){
				//return 2;
			}else if($_FILES["inputUserLogo"]["size"]>5000000){
				//return 2;
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
        			//return 1;
    			}else{
    				//return 2; 
    			}
			}
		}



		if(Input::method("POST","pix") && isset($_FILES["productfile"]["name"]) && !empty($_FILES["productfile"]["name"])){
			$ext = explode(".",$_FILES["productfile"]["name"]);
			$ext = strtolower(end($ext));

			if($ext!="jpg"){
				//return 2;
			}else if($_FILES["productfile"]["size"]>1000000){
				//return 2;
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
				 		":idx"=>(int)Input::method("POST","pix"), 
				 		":insert_admin"=>$_SESSION["tradewithgeorgia_user_id"], 
				 		":picture"=>$fileName
				 	));
    			}else{
    				//return 2; 
    			}
			}

		}

		if(isset($_FILES["productAnalysis"]["name"]) && !empty($_FILES["productAnalysis"]["name"]) && Input::method("POST","pix")){
			$ext = explode(".",$_FILES["productAnalysis"]["name"]);
			$ext = strtolower(end($ext));

			if($ext!="pdf" && $ext!="doc" && $ext!="docx" && $ext!="xls" && $ext!="xlsx" && $ext!="jpg"){
				//return 2;
			}else if($_FILES["productAnalysis"]["size"]>5000000){
				//return 2;
			}else{
				$fileName = md5(time()).'.'.$ext; 
				
				$target_file = DIR . 'files/document/'.$fileName;
				 if (move_uploaded_file($_FILES["productAnalysis"]["tmp_name"],$target_file)) { 
				 	$conn = $this->conn($c); 

				 	$check = 'SELECT `productanalisis` FROM `studio404_module_item` WHERE `idx`=:pid AND `status`!=:one'; 
				 	$pre_check = $conn->prepare($check);
				 	$pre_check->execute(array(
				 		":pid"=>(int)Input::method("POST","pix"), 
				 		":one"=>1
				 	));
				 	$ch_fetch = $pre_check->fetch(PDO::FETCH_ASSOC); 
				 	if(!empty($ch_fetch["productanalisis"])){
				 		$old_pic = DIR . 'files/document/'.$ch_fetch["productanalisis"]; 
				 		@unlink($old_pic);
				 	}

				 	$sql = 'UPDATE `studio404_module_item` SET `productanalisis`=:productanalisis WHERE `idx`=:pid AND `status`!=:one'; 
				 	$prepare = $conn->prepare($sql); 
				 	$prepare->execute(array(
				 		":pid"=>(int)Input::method("POST","pix"), 
				 		":one"=>1, 
				 		":productanalisis"=>$fileName
				 	));
    			}
			}
		}

		if(Input::method("POST","p_id") && isset($_FILES["p_image"]["name"])){
			$ex = explode(".",$_FILES["p_image"]["name"]); 
			$ex = strtolower(end($ex));
			$uex = explode("@",$_SESSION["tradewithgeorgia_username"]); 
			if($ex == "jpg" || $ex == "jpeg" && $_FILES["p_image"]["size"]<=1000000){
				$f = $uex[0].md5(time()).".jpg";
				$fn =  DIR . 'files/usersproducts/'.$f;
				$conn = $this->conn($c); 
				/*remove old pic*/
				$sql_select = 'SELECT `idx`,`picture` FROM `studio404_module_item` WHERE `id`=:id AND `insert_admin`=:insert_admin';
				$prepare_select = $conn->prepare($sql_select);
				$prepare_select->execute(array(
					":id"=>(int)Input::method("POST","p_id"), 
					":insert_admin"=>$_SESSION["tradewithgeorgia_user_id"]
				));
				$fet = $prepare_select->fetch(PDO::FETCH_ASSOC); 
				if($fet["picture"]){
					$old_pic = DIR . 'files/usersproducts/'.$fet["picture"]; 
			 		@unlink($old_pic);
				}

				/* insert new */
				if(move_uploaded_file($_FILES["p_image"]["tmp_name"], $fn)){
					$sqlup = 'UPDATE `studio404_module_item` SET `picture`=:picture WHERE `idx`=:idx AND `insert_admin`=:insert_admin';
					$prup = $conn->prepare($sqlup);
					$prup->execute(array(
						":picture"=>$f, 
						":idx"=>$fet["idx"], 
						":insert_admin"=>$_SESSION["tradewithgeorgia_user_id"]
					));
				}

			}
		}

		//echo Input::method("POST","p_id").$_FILES["pa_product_analysis"]["name"];
		if(Input::method("POST","p_id") && isset($_FILES["pa_product_analysis"]["name"])){
			$ex = explode(".",$_FILES["pa_product_analysis"]["name"]); 
			$ex = strtolower(end($ex));

			if($ext!="pdf" && $ext!="doc" && $ext!="docx" && $ext!="xls" && $ext!="xlsx" && $ext!="jpg" && $_FILES["pa_product_analysis"]["size"]<=5000000){
				$f = md5(time()).'.'.$ex;
				$fn =  DIR . 'files/document/'.$f;
				$conn = $this->conn($c); 
				/*remove old pic*/
				$sql_select = 'SELECT `productanalisis` FROM `studio404_module_item` WHERE `id`=:id AND `insert_admin`=:insert_admin';
				$prepare_select = $conn->prepare($sql_select);
				$prepare_select->execute(array(
					":id"=>(int)Input::method("POST","p_id"), 
					":insert_admin"=>$_SESSION["tradewithgeorgia_user_id"]
				));
				$fet = $prepare_select->fetch(PDO::FETCH_ASSOC); 
				if($fet["productanalisis"]){
					$old_pic = DIR . 'files/document/'.$fet["productanalisis"]; 
			 		@unlink($old_pic);
				}

				/* insert new */
				if(move_uploaded_file($_FILES["pa_product_analysis"]["tmp_name"], $fn)){
					$sqlup = 'UPDATE `studio404_module_item` SET `productanalisis`=:productanalisis WHERE `id`=:id AND `insert_admin`=:insert_admin';
					$prup = $conn->prepare($sqlup);
					$prup->execute(array(
						":productanalisis"=>$f, 
						":id"=>(int)Input::method("POST","p_id"), 
						":insert_admin"=>$_SESSION["tradewithgeorgia_user_id"]
					));
				}

			}
		}



	} 
}
?>