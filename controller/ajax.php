<?php if(!defined("DIR")){ exit(); }
class ajax extends connection{
	public $subject,$name,$email,$message,$lang,$ip;

	function __construct($c){
		$this->requests($c);
	}

	public function requests($c){
		$conn = $this->conn($c); 
		if(Input::method("POST","sendemail1")) : 
			$sendemail1 = Input::method("POST","sendemail1");
			$type = Input::method("POST","type");
			$email1 = Input::method("POST","email1");
			$_SESSION["register_code_tradewithgeorgia"] = ustring::random(6);
			$msg = 'Hello dear user, you have registered to our website: <b>'.WEBSITE.'</b>; Your registration code is: '.$_SESSION["register_code_tradewithgeorgia"];
			
			$sql = 'SELECT `id` FROM `studio404_users` WHERE `username`=:email AND `status`!=:status';
			$prepare = $conn->prepare($sql);
			$prepare->execute(array(
				":email"=>$email1, 
				":status"=>1
			));
			if($prepare->rowCount() > 0){
				echo "Error";
			}else{
				$this->send("::Registration::","Dear user",$email1,$msg);
			}
		endif;

		if(Input::method("POST","sendemail2")) : 
			$sendemail2 = Input::method("POST","sendemail3");
			$type2 = Input::method("POST","type2");
			$email2 = Input::method("POST","email2");
			$_SESSION["register_code_tradewithgeorgia"] = ustring::random(6);
			$msg = 'Hello dear user, you have registered to our website: <b>'.WEBSITE.'</b>; Your registration code is: '.$_SESSION["register_code_tradewithgeorgia"];
			$sql = 'SELECT `id` FROM `studio404_users` WHERE `username`=:email AND `status`!=:status';
			$prepare = $conn->prepare($sql);
			$prepare->execute(array(
				":email"=>$email2, 
				":status"=>1
			));
			if($prepare->rowCount() > 0){
				echo "Error";
			}else{
				$this->send("::Registration::","Drear user",$email2,$msg);
			}
		endif;

		if(Input::method("POST","finalregister")) : 
			if(empty(Input::method("POST","code")) || Input::method("POST","code")!=$_SESSION["register_code_tradewithgeorgia"]){
				echo "Error"; 
			}else if(!Input::method("POST","t") || !Input::method("POST","e") || !Input::method("POST","p") || !Input::method("POST","p2")){
				echo "Error"; 
			}else if(!$this->isValidEmail(Input::method("POST","e"))){
				echo "Error"; 
			}else{
				$e = Input::method("POST","e");
				$p = Input::method("POST","p");
				$t = Input::method("POST","t");
				$ip = get_ip::ip();

				$sql = 'SELECT `id` FROM `studio404_users` WHERE `username`=:email AND `status`!=:status';
				$prepare = $conn->prepare($sql);
				$prepare->execute(array(
					":email"=>$e, 
					":status"=>1
				));
				if($prepare->rowCount() > 0){
					echo "Error";
				}else{
					$sql2 = 'INSERT INTO `studio404_users` SET `registered_date`=:registered_date, `registered_ip`=:registered_ip, `username`=:email, `password`=:password, `company_type`=:company_type, `user_type`=:user_type, `allow`=:allow';
					$prepare2 = $conn->prepare($sql2);
					$prepare2->execute(array(
						":registered_date"=>time(), 
						":registered_ip"=>$ip, 
						":email"=>$e, 
						":password"=>md5($p), 
						":company_type"=>$t, 
						":user_type"=>'website', 
						":allow"=>2
					));
					echo "Done";
				}
			}			
		endif;

		if(Input::method("POST","finalregister2")) : 
			if(empty(Input::method("POST","code")) || Input::method("POST","code")!=$_SESSION["register_code_tradewithgeorgia"]){
				echo "Error"; 
			}else if(!Input::method("POST","t") || !Input::method("POST","e") || !Input::method("POST","p") || !Input::method("POST","p2")){
				echo "Error"; 
			}else if(!$this->isValidEmail(Input::method("POST","e"))){
				echo "Error"; 
			}else{
				$e = Input::method("POST","e");
				$p = Input::method("POST","p");
				$t = Input::method("POST","t");
				$ip = get_ip::ip();

				$sql = 'SELECT `id` FROM `studio404_users` WHERE `username`=:email AND `status`!=:status';
				$prepare = $conn->prepare($sql);
				$prepare->execute(array(
					":email"=>$e, 
					":status"=>1
				));
				if($prepare->rowCount() > 0){
					echo "Error";
				}else{
					$sql2 = 'INSERT INTO `studio404_users` SET `registered_date`=:registered_date, `registered_ip`=:registered_ip, `username`=:email, `password`=:password, `company_type`=:company_type, `user_type`=:user_type, `allow`=:allow';
					$prepare2 = $conn->prepare($sql2);
					$prepare2->execute(array(
						":registered_date"=>time(), 
						":registered_ip"=>$ip, 
						":email"=>$e, 
						":password"=>md5($p), 
						":company_type"=>$t, 
						":user_type"=>'website', 
						":allow"=>2
					));
					echo "Done";
				}
			}
		endif;

		if(Input::method("POST","logintry")) :
			if(!Input::method("POST","e") || !Input::method("POST","p") || !Input::method("POST","c")){
				echo "Error empty";
			}else if(Input::method("POST","c")!=$_SESSION['protect_']){
				echo "Error code";
			}else{
				$e = Input::method("POST","e");
				$p = Input::method("POST","p");
				$sql = 'SELECT * FROM `studio404_users` WHERE `username`=:username AND `password`=:password AND `user_type`=:user_type AND `allow`=:two AND `status`!=:one'; 
				$prepare = $conn->prepare($sql); 
				$prepare->execute(array(
					":username"=>$e, 
					":password"=>md5($p), 
					":user_type"=>'website', 
					":two"=>2, 
					":one"=>1 
				));
				if($prepare->rowCount() > 0){
					$fetch = $prepare->fetch(PDO::FETCH_ASSOC);
					$_SESSION["tradewithgeorgia_username"] = $e; 
					$_SESSION["tradewithgeorgia_company_type"] = $fetch["company_type"]; 
					$_SESSION["tradewithgeorgia_user_id"] = $fetch["id"]; 
					if(!empty($fetch["namelname"])){
						$_SESSION["tradewithgeorgia_user_namelname"] = $fetch["namelname"]; 
					}
					// update 
					$usql = 'UPDATE `studio404_users` SET `logtime`=:logtime, `log`=`log`+1 WHERE `id`=:id';
					$prepare2 = $conn->prepare($usql); 
					$prepare2->execute(array(
						":logtime"=>time(), 
						":id"=>$fetch["id"], 
					));
					echo "Done"; 
				}else{
					echo "Error numrows"; 
				}
			}
		endif;

		if(Input::method("POST","logout")) :
			session_destroy();
			echo "Done"; 
		endif;

		if(Input::method("POST","loadsubsector") && $_SESSION["tradewithgeorgia_username"]){
			$sval = json_decode(Input::method("POST","sval")); 
			$l = count($sval);
			// echo "ass ".$l;
			$x = 1;
			$in = '';
			foreach($sval as $i){
				$i = (int)$i;
				if($x>=$l){
					$in .= $i;
				}else{
					$in .= $i.",";
				}
				$x++;
			}
			//echo $in;
			if(!Input::method("POST","products")){
				//echo '<option value="">Choose</option>';
			}
			try{
				$sql = 'SELECT `idx`,`title` FROM `studio404_pages` WHERE `cid` IN ('.$in.') AND `visibility`!=:visibility AND `status`!=:status';
				$prepare = $conn->prepare($sql); 
				$prepare->execute(array(
					":visibility"=>1, 
					":status"=>1
				));
				
				$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC);
				$i = 0;
				foreach ($fetch as $val) {
					//echo '<option value="'.$val['idx'].'" title="'.htmlentities($val['title']).'">'.$val['title'].'</option>';
					echo '<div class="selectItem2" data-checkbox="selectItemx'.$i.'">
							<input type="checkbox" name="selectItem2[]" class="sector_ids2" id="selectItemx'.$i.'" value="'.$val['idx'].'" />
							<span>'.$val['title'].'</span>
						</div>';
						$i++;
				}
			}catch(Exception $e){

			}
		}

		if(Input::method("POST","loadproducts") && $_SESSION["tradewithgeorgia_username"]){
			$sval = json_decode(Input::method("POST","sval")); 
			$l = count($sval);
			// echo "ass ".$l;
			$x = 1;
			$in = '';
			foreach($sval as $i){
				$i = (int)$i;
				if($x>=$l){
					$in .= $i;
				}else{
					$in .= $i.",";
				}
				$x++;
			}
			try{
				$sql = 'SELECT `idx`,`title` FROM `studio404_pages` WHERE `cid` IN ('.$in.') AND `visibility`!=:visibility AND `status`!=:status';
				$prepare = $conn->prepare($sql); 
				$prepare->execute(array(
					":visibility"=>1, 
					":status"=>1
				));
				
				$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC);

				$checkusersproducts = 'SELECT `products` FROM `studio404_users` WHERE `username`=:username AND `status`!=:one';
				$prepare2 = $conn->prepare($checkusersproducts);
				$prepare2->execute(array(
					":username"=>$_SESSION["tradewithgeorgia_username"], 
					":one"=>1 
				));
				$f = $prepare2->fetch(PDO::FETCH_ASSOC);
				if($prepare2->rowCount()){
					$e = explode(",",$f["products"]);
				}else{
					$e = array();
				}
				$i = 0;
				foreach ($fetch as $val) {
					if(Input::method("POST","option")){
						if(!in_array($val['idx'], $e)){ continue; }
						echo '<option value="'.$val['idx'].'" title="'.htmlentities($val['title']).'">'.$val['title'].'</option>';
					}else{
						echo '<div class="selectItem3" data-checkbox="selectItemxx'.$i.'">
							<input type="checkbox" name="selectItem3[]" class="sector_ids3" id="selectItemxx'.$i.'" value="'.$val['idx'].'" />
							<span>'.$val['title'].'</span>
						</div>';
					}	
					$i++;
				}
			}catch(Exception $e){

			}
		}

		if(Input::method("POST","changeprofile")=="true" && $_SESSION["tradewithgeorgia_username"]){
			$p_companyname = strip_tags(Input::method("POST","p_companyname")); 
			$p_establishedin = strip_tags(Input::method("POST","p_establishedin"));
			$p_productioncapasity = strip_tags(Input::method("POST","p_productioncapasity"));
			$p_address = strip_tags(Input::method("POST","p_address"));
			$p_mobiles = strip_tags(Input::method("POST","p_mobiles"));
			$p_numemploy = strip_tags(Input::method("POST","p_numemploy"));
			$p_certificates = strip_tags(Input::method("POST","p_certificates"));
			$p_contactpersones = strip_tags(Input::method("POST","p_contactpersones"));
			$p_officephone = strip_tags(Input::method("POST","p_officephone"));
			$p_companysize = strip_tags(Input::method("POST","p_companysize"));
			$p_webaddress = strip_tags(Input::method("POST","p_webaddress"));
			$p_contactemail = strip_tags(Input::method("POST","p_contactemail"));
			$p_about = strip_tags(nl2br(Input::method("POST","p_about")));
			
			$p_products = json_decode(Input::method("POST","p_products"));
			$p_products = implode(",", $p_products); 

			$p_exportmarkets = json_decode(Input::method("POST","p_exportmarkets"));
			$p_exportmarkets = implode(",", $p_exportmarkets); 

			$p_sector = json_decode(Input::method("POST","p_sector"));
			$p_sector = implode(",", $p_sector); 

			$p_subsector = json_decode(Input::method("POST","p_subsector"));
			$p_subsector = implode(",", $p_subsector); 
			$p_file = Input::method("POST","p_file"); 

			// $str = file_get_contents("php://input");
			// if($str){
			// 	$filename = md5(time()).".jpg";
			// 	$path = 'testu/'.$filename;
			// 	file_put_contents($path, $str);
			// }
			$sql = 'UPDATE `studio404_users` SET 
			`namelname`=:namelname, 
			`sector_id`=:sector_id, 
			`sub_sector_id`=:sub_sector_id, 
			`established_in`=:established_in, 
			`production_capacity`=:production_capacity, 
			`address`=:address, 
			`mobile`=:mobile, 
			`number_of_employes`=:number_of_employes, 
			`certificates`=:certificates, 
			`contact_person`=:contact_person, 
			`office_phone`=:office_phone, 
			`company_size`=:company_size, 
			`web_address`=:web_address, 
			`email`=:email, 
			`about`=:about, 
			`products`=:products, 
			`export_markets_id`=:export_markets_id 
			WHERE 
			`username`=:username AND 
			`allow`!=:one AND 
			`status`!=:one 
			';
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":namelname"=>$p_companyname, 
				":sector_id"=>$p_sector, 
				":sub_sector_id"=>$p_subsector, 
				":established_in"=>$p_establishedin, 
				":production_capacity"=>$p_productioncapasity, 
				":address"=>$p_address, 
				":mobile"=>$p_mobiles, 
				":number_of_employes"=>$p_numemploy, 
				":certificates"=>$p_certificates, 
				":contact_person"=>$p_contactpersones, 
				":office_phone"=>$p_officephone, 
				":company_size"=>$p_companysize, 
				":web_address"=>$p_webaddress, 
				":email"=>$p_contactemail, 
				":about"=>$p_about, 
				":products"=>$p_products, 
				":export_markets_id"=>$p_exportmarkets, 
				":username"=>$_SESSION["tradewithgeorgia_username"], 
				":one"=>1
			));

			$_SESSION["user_data"]["companyname"] = $p_companyname;
			$_SESSION["user_data"]["sector"] = $p_sector;
			$_SESSION["user_data"]["subsector"] = $p_subsector;
			$_SESSION["user_data"]["establishedin"] = $p_establishedin;
			$_SESSION["user_data"]["productioncapasity"] = $p_productioncapasity;
			$_SESSION["user_data"]["address"] = $p_address;
			$_SESSION["user_data"]["mobiles"] = $p_mobiles;
			$_SESSION["user_data"]["numemploy"] = $p_numemploy;
			$_SESSION["user_data"]["certificates"] = $p_certificates;
			$_SESSION["user_data"]["contactpersones"] = $p_contactpersones;
			$_SESSION["user_data"]["officephone"] = $p_officephone;
			$_SESSION["user_data"]["companysize"] = $p_companysize;
			$_SESSION["user_data"]["webaddress"] = $p_webaddress;
			$_SESSION["user_data"]["contactemail"] = $p_contactemail;
			$_SESSION["user_data"]["about"] = $p_about;
			$_SESSION["user_data"]["products"] = $p_products;
			$_SESSION["user_data"]["exportmarkets"] = $p_exportmarkets;

			echo "Done";
		}

		//
		if(Input::method("POST","changecompanyprofile")=="true" && $_SESSION["tradewithgeorgia_username"]){
			$p_companyname = strip_tags(Input::method("POST","p_companyname")); 
			$p_establishedin = strip_tags(Input::method("POST","p_establishedin"));
			$p_address = strip_tags(Input::method("POST","p_address"));
			$p_mobiles = strip_tags(Input::method("POST","p_mobiles"));
			$p_numemploy = strip_tags(Input::method("POST","p_numemploy"));
			$p_contactpersones = strip_tags(Input::method("POST","p_contactpersones"));
			$p_officephone = strip_tags(Input::method("POST","p_officephone"));
			$p_companysize = strip_tags(Input::method("POST","p_companysize"));
			$p_webaddress = strip_tags(Input::method("POST","p_webaddress"));
			$p_contactemail = strip_tags(Input::method("POST","p_contactemail"));
			$p_about = strip_tags(nl2br(Input::method("POST","p_about")));
			
			$p_sector = json_decode(Input::method("POST","p_sector"));
			$p_sector = implode(",", $p_sector); 

		
			$p_file = Input::method("POST","p_file"); 

			// $str = file_get_contents("php://input");
			// if($str){
			// 	$filename = md5(time()).".jpg";
			// 	$path = 'testu/'.$filename;
			// 	file_put_contents($path, $str);
			// }
			$sql = 'UPDATE `studio404_users` SET 
			`namelname`=:namelname, 
			`sector_id`=:sector_id, 
			`sub_sector_id`=:sub_sector_id, 
			`established_in`=:established_in, 
			`production_capacity`=:production_capacity, 
			`address`=:address, 
			`mobile`=:mobile, 
			`number_of_employes`=:number_of_employes, 
			`certificates`=:certificates, 
			`contact_person`=:contact_person, 
			`office_phone`=:office_phone, 
			`company_size`=:company_size, 
			`web_address`=:web_address, 
			`email`=:email, 
			`about`=:about, 
			`products`=:products, 
			`export_markets_id`=:export_markets_id 
			WHERE 
			`username`=:username AND 
			`allow`!=:one AND 
			`status`!=:one 
			';
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":namelname"=>$p_companyname, 
				":sector_id"=>$p_sector, 
				":sub_sector_id"=>$p_subsector, 
				":established_in"=>$p_establishedin, 
				":production_capacity"=>$p_productioncapasity, 
				":address"=>$p_address, 
				":mobile"=>$p_mobiles, 
				":number_of_employes"=>$p_numemploy, 
				":certificates"=>$p_certificates, 
				":contact_person"=>$p_contactpersones, 
				":office_phone"=>$p_officephone, 
				":company_size"=>$p_companysize, 
				":web_address"=>$p_webaddress, 
				":email"=>$p_contactemail, 
				":about"=>$p_about, 
				":products"=>$p_products, 
				":export_markets_id"=>$p_exportmarkets, 
				":username"=>$_SESSION["tradewithgeorgia_username"], 
				":one"=>1
			));

			$_SESSION["user_data"]["companyname"] = $p_companyname;
			$_SESSION["user_data"]["sector"] = $p_sector;
			$_SESSION["user_data"]["establishedin"] = $p_establishedin;
			$_SESSION["user_data"]["address"] = $p_address;
			$_SESSION["user_data"]["mobiles"] = $p_mobiles;
			$_SESSION["user_data"]["numemploy"] = $p_numemploy;
			$_SESSION["user_data"]["contactpersones"] = $p_contactpersones;
			$_SESSION["user_data"]["officephone"] = $p_officephone;
			$_SESSION["user_data"]["companysize"] = $p_companysize;
			$_SESSION["user_data"]["webaddress"] = $p_webaddress;
			$_SESSION["user_data"]["contactemail"] = $p_contactemail;
			$_SESSION["user_data"]["about"] = $p_about;
		
			echo "Done";
		}





		if(Input::method("POST","changepassword")){
			if( !empty(Input::method("POST","o")) && !empty(Input::method("POST","n")) && !empty(Input::method("POST","r")) && (!empty(Input::method("POST","n"))==!empty(Input::method("POST","r"))) ){
				$oldpass = Input::method("POST","o");
				$sql = 'SELECT `id` FROM `studio404_users` WHERE `username`=:username AND `password`=:password AND `allow`!=:one AND `status`!=:one';
				$prepare = $conn->prepare($sql); 
				$prepare->execute(array(
					":username"=>$_SESSION["tradewithgeorgia_username"], 
					":password"=>md5($oldpass), 
					":one"=>1
				));
				if($prepare->rowCount()){ 
					$n = md5(Input::method("POST","n"));
					$update = 'UPDATE `studio404_users` SET `password`=:password WHERE `username`=:username AND `allow`!=:one AND `status`!=:one'; 
					$prepare2 = $conn->prepare($update); 
					$prepare2->execute(array(
						":username"=>$_SESSION["tradewithgeorgia_username"], 
						":password"=>$n,
						":one"=>1
					));
					echo "Done";
				}else{
					echo "Error";
				}
			}else{
				echo "Error";
			}
		}

		if(Input::method("POST","hscode") && Input::method("POST","hscode")=="true" && Input::method("POST","s") && strlen(Input::method("POST","s"))>=3){
			$sql = 'SELECT `idx`,`title` FROM `studio404_pages` WHERE `cid`=:cid AND `title` LIKE "%'.Input::method("POST","s").'%" AND `status`!=:one ORDER BY `title` ASC LIMIT 10';
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":cid"=>769, 
				":one"=>1
			));
			$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC); 
			if($prepare->rowCount()){
				foreach($fetch as $val){
					echo '<li><a href="javascript:;" class="resultx" data-idx="'.$val["idx"].'">'.$val["title"].'</a></li>';
				}
			}else{
				echo '';
			}
		}

		if(Input::method("POST","delproduct") && Input::method("POST","delproduct")=="true" && Input::method("POST","pid") && is_numeric(Input::method("POST","pid")) && !empty($_SESSION["tradewithgeorgia_user_id"])){
			
			$check = 'SELECT `position`,`picture` FROM `studio404_module_item` WHERE `idx`=:idx AND `module_idx`=3 AND `insert_admin`=:insert_admin'; 
		 	$pre_check = $conn->prepare($check);
		 	$pre_check->execute(array(
		 		":idx"=>(int)Input::method("POST","pid"), 
		 		":insert_admin"=>$_SESSION["tradewithgeorgia_user_id"]
		 	));
		 	$ch_fetch = $pre_check->fetch(PDO::FETCH_ASSOC); 
		 	if(!empty($ch_fetch["picture"])){
		 		$old_pic = DIR . 'files/usersproducts/'.$ch_fetch["picture"]; 
		 		@unlink($old_pic);
		 	}

		 	$update_pos = 'UPDATE `studio404_module_item` SET `position`=`position`-1 WHERE `status`!=1 AND `position`>'.$ch_fetch['position'].' AND `module_idx`=3 ';
		 	$query = $conn->query($update_pos); 

			$sql = 'UPDATE `studio404_module_item` SET `status`=:one WHERE `insert_admin`=:insert_admin AND `module_idx`=:module_idx AND `idx`=:idx';
			$prepare = $conn->prepare($sql);
			$prepare->execute(array(
				":idx"=>(int)Input::method("POST","pid"), 
		 		":insert_admin"=>$_SESSION["tradewithgeorgia_user_id"], 
		 		":module_idx"=>3, 
		 		":one"=>1
			));
			echo "Done"; 
		}


		if(Input::method("POST","delservice") && Input::method("POST","delservice")=="true" && Input::method("POST","sid") && is_numeric(Input::method("POST","sid")) && !empty($_SESSION["tradewithgeorgia_user_id"])){
			
			$check = 'SELECT `position` FROM `studio404_module_item` WHERE `idx`=:idx AND `module_idx`=4 AND `insert_admin`=:insert_admin'; 
		 	$pre_check = $conn->prepare($check);
		 	$pre_check->execute(array(
		 		":idx"=>(int)Input::method("POST","sid"), 
		 		":insert_admin"=>$_SESSION["tradewithgeorgia_user_id"]
		 	));
		 	$ch_fetch = $pre_check->fetch(PDO::FETCH_ASSOC); 
		 	// if(!empty($ch_fetch["picture"])){
		 	// 	$old_pic = DIR . 'files/usersproducts/'.$ch_fetch["picture"]; 
		 	// 	@unlink($old_pic);
		 	// }

		 	$update_pos = 'UPDATE `studio404_module_item` SET `position`=`position`-1 WHERE `status`!=1 AND `position`>'.$ch_fetch['position'].' AND `module_idx`=4 ';
		 	$query = $conn->query($update_pos); 

			$sql = 'UPDATE `studio404_module_item` SET `status`=:one WHERE `insert_admin`=:insert_admin AND `module_idx`=:module_idx AND `idx`=:idx';
			$prepare = $conn->prepare($sql);
			$prepare->execute(array(
				":idx"=>(int)Input::method("POST","sid"), 
		 		":insert_admin"=>$_SESSION["tradewithgeorgia_user_id"], 
		 		":module_idx"=>4, 
		 		":one"=>1
			));
			echo "Done"; 
		}

		if(Input::method("POST","addproduct") && Input::method("POST","addproduct")=="true" && Input::method("POST","p") && Input::method("POST","pn") && Input::method("POST","c") && Input::method("POST","d"))
		{
			$products = (int)Input::method("POST","p");
			$shelf_life = strip_tags(Input::method("POST","s"));
			$packaging = strip_tags(Input::method("POST","pkg"));
			$awards = strip_tags(Input::method("POST","a"));
			// $check_product = 'SELECT `cid` FROM `studio404_pages` WHERE `idx`=:idx AND `status`!=:one'; 
			// $prepare = $conn->prepare($check_product); 
			// $prepare->execute(array(
			// 	":idx"=>$products, 
			// 	":one"=>1
			// ));
			// $fetch = $prepare->fetch(PDO::FETCH_ASSOC);
			$retrieve_users_info = new retrieve_users_info();
			$subsector = (int)$retrieve_users_info->retrieve_subsector_from_product($products,"idx"); 

			$check_hscode = 'SELECT `id` FROM `studio404_pages` WHERE `cid`=:cid AND `idx`=:idx AND `status`!=:one';
			$prepare2 = $conn->prepare($check_hscode); 
			$prepare2->execute(array(
				":cid"=>769, 
				":idx"=>(int)Input::method("POST","c"), 
				":one"=>1
			));

			if(!$prepare->rowCount() || !$prepare2->rowCount()){
				echo "Error"; 
			}else{

				//select max idx
				$sqlm = 'SELECT MAX(`idx`)+1 AS maxid FROM `studio404_module_item`';
				$querym = $conn->query($sqlm);
				$rowm = $querym->fetch(PDO::FETCH_ASSOC);
				$maxidm = ($rowm['maxid']) ? $rowm['maxid'] : 1;

				// pos
				$sqlm2 = 'SELECT MAX(`position`)+1 AS pos FROM `studio404_module_item` WHERE `module_idx`=3 AND `status`!=1';
				$querym2 = $conn->query($sqlm2);
				$rowm2 = $querym2->fetch(PDO::FETCH_ASSOC);
				$pos = ($rowm2['pos']) ? $rowm2['pos'] : 1;

				$slug_generation = new slug_generation();
				$uid = new uid();
				$u = $uid->generate();
				$slug = PRE_VIEW."/".$u."/".$slug_generation->generate(Input::method("POST","pn"));

				$sql = 'INSERT INTO `studio404_module_item` SET 
				`idx`=:idx, 
				`uid`=:uid, 
				`date`=:datex, 
				`module_idx`=:module_idx, 
				`title`=:title, 
				`hscode`=:hscode, 
				`sub_sector_id`=:sub_sector_id, 
				`products`=:products, 
				`shelf_life`=:shelf_life, 
				`packaging`=:packaging, 
				`awards`=:awards, 
				`long_description`=:long_description, 
				`slug`=:slug, 
				`insert_admin`=:insert_admin, 
				`position`=:position, 
				`lang`=:lang, 
				`visibility`=:visibility, 
				`status`=:status';
				$prepare = $conn->prepare($sql);
				$prepare->execute(array(
					":idx"=>$maxidm, 
					":uid"=>$u, 
					":datex"=>time(), 
					":module_idx"=>3, 
					":title"=>strip_tags(Input::method("POST","pn")), 
					":hscode"=>strip_tags(Input::method("POST","c")), 
					":sub_sector_id"=>$subsector, 
					":products"=>$products, 
					":shelf_life"=>$shelf_life, 
					":packaging"=>$packaging, 
					":awards"=>$awards, 
					":long_description"=>strip_tags(nl2br(Input::method("POST","d"))), 
					":slug"=>$slug, 
					":insert_admin"=>$_SESSION["tradewithgeorgia_user_id"], 
					":position"=>$pos, 
					":lang"=>LANG_ID, 
					":visibility"=>1, 
					":status"=>0 
				));
				echo $maxidm;
			}
		}


		if(Input::method("POST","loadproduct")=="true" && Input::method("POST","prid") && is_numeric(Input::method("POST","prid"))){
			// load project info for update form
			$products_sql = 'SELECT 
			`studio404_module_item`.`id`,
			`studio404_module_item`.`idx`,
			`studio404_module_item`.`title`,
			`studio404_module_item`.`picture`,
			`studio404_module_item`.`shelf_life`,
			`studio404_module_item`.`packaging`,
			`studio404_module_item`.`awards`,
			`studio404_module_item`.`long_description`,
			`studio404_module_item`.`visibility`, 
			`studio404_pages`.`idx` AS hs_id,
			`studio404_pages`.`title` AS hs_title
			FROM 
			`studio404_module_item`, `studio404_pages`
			WHERE 
			`studio404_module_item`.`idx`=:idx AND 
			`studio404_module_item`.`insert_admin`=:insert_admin AND 
			`studio404_module_item`.`status`!=:one AND 
			`studio404_module_item`.`hscode`=`studio404_pages`.`idx` AND 
			`studio404_pages`.`status`!=:one  
			ORDER BY `studio404_module_item`.`date` DESC LIMIT 10';
			$prepare_product = $conn->prepare($products_sql);
			$prepare_product->execute(array(
				":idx"=>Input::method("POST","prid"), 
				":insert_admin"=>$_SESSION["tradewithgeorgia_user_id"], 
				":one"=>1
			));
			$fetch = $prepare_product->fetchAll(PDO::FETCH_ASSOC); 
			echo json_encode($fetch);
		}




		if(Input::method("POST","loadservices")=="true" && Input::method("POST","srid") && is_numeric(Input::method("POST","srid")) && $_SESSION["tradewithgeorgia_user_id"]){
			// load project info for update form
			$products_sql = 'SELECT `id`,`idx`,`products`,`long_description`
			FROM `studio404_module_item` WHERE `id`=:id AND `insert_admin`=:insert_admin AND `status`!=:one ORDER BY `date` DESC LIMIT 10';
			$prepare_product = $conn->prepare($products_sql);
			$prepare_product->execute(array(
				":id"=>Input::method("POST","srid"), 
				":insert_admin"=>$_SESSION["tradewithgeorgia_user_id"], 
				":one"=>1
			));
			$fetch = $prepare_product->fetchAll(PDO::FETCH_ASSOC); 
			echo json_encode($fetch);
		}

		if(Input::method("POST","loadenquires")=="true" && Input::method("POST","eid") && is_numeric(Input::method("POST","eid")) && $_SESSION["tradewithgeorgia_user_id"]){
			// load project info for update form
			$products_sql = 'SELECT `id`,`idx`,`title`,`type`,`sector_id`,`long_description`
			FROM `studio404_module_item` WHERE `id`=:id AND `insert_admin`=:insert_admin AND `status`!=:one ORDER BY `date` DESC LIMIT 10';
			$prepare_product = $conn->prepare($products_sql);
			$prepare_product->execute(array(
				":id"=>Input::method("POST","eid"), 
				":insert_admin"=>$_SESSION["tradewithgeorgia_user_id"], 
				":one"=>1
			));
			$fetch = $prepare_product->fetchAll(PDO::FETCH_ASSOC); 
			echo json_encode($fetch);
		}

		if(Input::method("POST","changeservice")=="true" && is_numeric(Input::method("POST","i")) && Input::method("POST","s") && Input::method("POST","d")){
			$i = Input::method("POST","i"); 
			$s = Input::method("POST","s"); 
			$d = Input::method("POST","d"); 
			$retrieve_users_info = new retrieve_users_info();
			$p = $retrieve_users_info->retrieveDb($s); 

			$subsector = (int)$retrieve_users_info->retrieve_subsector_from_product($s,"idx"); 

			$sql = 'UPDATE `studio404_module_item` SET 
			`title`=:title, 
			`sub_sector_id`=:sub_sector_id, 
			`products`=:products, 
			`long_description`=:long_description, 
			`visibility`=:one  
			WHERE 
			`id`=:id AND  
			`insert_admin`=:insert_admin   
			';
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":title"=>$p, 
				":sub_sector_id"=>$subsector, 
				":products"=>$s, 
				":long_description"=>$d, 
				":id"=>$i, 
				":insert_admin"=>$_SESSION["tradewithgeorgia_user_id"], 
				":one"=>1
			));
			echo "Done"; 
		}


		if(Input::method("POST","makeitchange")=="true"){
			$pi = Input::method("POST","pi"); 
			$pn = Input::method("POST","pn"); 
			$phs = Input::method("POST","phs"); 
			$psl = Input::method("POST","psl"); 
			$pp = Input::method("POST","pp"); 
			$pa = Input::method("POST","pa"); 
			$pd = Input::method("POST","pd"); 
			$sql = 'UPDATE `studio404_module_item` SET 
			`title`=:title, 
			`hscode`=:hscode, 
			`shelf_life`=:shelf_life, 
			`packaging`=:packaging, 
			`awards`=:awards, 
			`long_description`=:long_description, 
			`visibility`=:one  
			WHERE 
			`id`=:id AND  
			`insert_admin`=:insert_admin   
			';
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":title"=>$pn, 
				":hscode"=>$phs, 
				":shelf_life"=>$psl, 
				":packaging"=>$pp, 
				":awards"=>$pa, 
				":long_description"=>$pd, 
				":id"=>$pi, 
				":insert_admin"=>$_SESSION["tradewithgeorgia_user_id"], 
				":one"=>1
			));
			echo "Done"; 
		}

		if(Input::method("POST","addservice")=="true" && Input::method("POST","t") && Input::method("POST","d")){
			$t = Input::method("POST","t");
			$d = Input::method("POST","d"); 

			//select max idx
			$sqlm = 'SELECT MAX(`idx`)+1 AS maxid FROM `studio404_module_item`';
			$querym = $conn->query($sqlm);
			$rowm = $querym->fetch(PDO::FETCH_ASSOC);
			$maxidm = ($rowm['maxid']) ? $rowm['maxid'] : 1;

			// pos
			$sqlm2 = 'SELECT MAX(`position`)+1 AS pos FROM `studio404_module_item` WHERE `module_idx`=5197 AND `status`!=1';
			$querym2 = $conn->query($sqlm2);
			$rowm2 = $querym2->fetch(PDO::FETCH_ASSOC);
			$pos = ($rowm2['pos']) ? $rowm2['pos'] : 1;

			$slug_generation = new slug_generation();
			$uid = new uid();
			$u = $uid->generate();
			$slug = PRE_VIEW."/".$u."/".$slug_generation->generate(Input::method("POST","t"));

			$retrieve_users_info = new retrieve_users_info();
			$p = $retrieve_users_info->retrieveDb($t); 

			$subsector = (int)$retrieve_users_info->retrieve_subsector_from_product($t,"idx"); 

			$sql = 'INSERT INTO `studio404_module_item` SET 
			`idx`=:idx, 
			`uid`=:uid, 
			`date`=:datex, 
			`module_idx`=:module_idx, 
			`title`=:title,
			`sub_sector_id`=:sub_sector_id,
			`products`=:products,
			`long_description`=:long_description, 
			`slug`=:slug, 
			`insert_admin`=:insert_admin, 
			`position`=:position, 
			`lang`=:lang, 
			`visibility`=:visibility, 
			`status`=:status';
			$prepare = $conn->prepare($sql);
			$prepare->execute(array(
				":idx"=>$maxidm, 
				":uid"=>$u, 
				":datex"=>time(), 
				":module_idx"=>4, 
				":title"=>$p, 
				":sub_sector_id"=>$subsector, 
				":products"=>(int)$t, 
				":long_description"=>strip_tags(nl2br($d)), 
				":slug"=>$slug, 
				":insert_admin"=>$_SESSION["tradewithgeorgia_user_id"], 
				":position"=>$pos, 
				":lang"=>LANG_ID, 
				":visibility"=>1, 
				":status"=>0 
			));
			echo "Done";
		}

		if(Input::method("POST","addenquire")=="true" && Input::method("POST","t") && Input::method("POST","s") && Input::method("POST","ti") && Input::method("POST","d")){
			$t = Input::method("POST","t");
			$s = Input::method("POST","s");
			$ti = Input::method("POST","ti");
			$d = Input::method("POST","d");

			//select max idx
			$sqlm = 'SELECT MAX(`idx`)+1 AS maxid FROM `studio404_module_item`';
			$querym = $conn->query($sqlm);
			$rowm = $querym->fetch(PDO::FETCH_ASSOC);
			$maxidm = ($rowm['maxid']) ? $rowm['maxid'] : 1;

			// pos
			$sqlm2 = 'SELECT MAX(`position`)+1 AS pos FROM `studio404_module_item` WHERE `module_idx`=5198 AND `status`!=1';
			$querym2 = $conn->query($sqlm2);
			$rowm2 = $querym2->fetch(PDO::FETCH_ASSOC);
			$pos = ($rowm2['pos']) ? $rowm2['pos'] : 1;

			$slug_generation = new slug_generation();
			$uid = new uid();
			$u = $uid->generate();
			$slug = PRE_VIEW."/".$u."/".$slug_generation->generate($ti);


			$sql = 'INSERT INTO `studio404_module_item` SET 
			`idx`=:idx, 
			`uid`=:uid, 
			`date`=:datex, 
			`module_idx`=:module_idx, 
			`type`=:type, 
			`title`=:title,
			`sector_id`=:sector_id,
			`long_description`=:long_description, 
			`slug`=:slug, 
			`insert_admin`=:insert_admin, 
			`position`=:position, 
			`lang`=:lang, 
			`visibility`=:visibility, 
			`status`=:status';
			$prepare = $conn->prepare($sql);
			$prepare->execute(array(
				":idx"=>$maxidm, 
				":uid"=>$u, 
				":datex"=>time(), 
				":module_idx"=>5, 
				":type"=>$t, 
				":title"=>$ti, 
				":sector_id"=>(int)$s, 
				":long_description"=>strip_tags(nl2br($d)), 
				":slug"=>$slug, 
				":insert_admin"=>$_SESSION["tradewithgeorgia_user_id"], 
				":position"=>$pos, 
				":lang"=>LANG_ID, 
				":visibility"=>1, 
				":status"=>0 
			));
			echo "Done";

		}

	}


	public function selectEmailGeneralInfo(){
		global $c;
		$conn = $this->conn($c); 
		$out = array();
		$sql = 'SELECT `host`,`user`,`pass`,`from`,`fromname` FROM `studio404_newsletter` WHERE `id`=:id';
		$prepare = $conn->prepare($sql); 
		$prepare->execute(array(
			":id"=>1
		));
		$fetch = $prepare->fetch(PDO::FETCH_ASSOC); 
		$out["host"] = $fetch["host"];
		$out["user"] = $fetch["user"];
		$out["pass"] = $fetch["pass"];
		$out["from"] = $fetch["from"];
		return $out;
	}

	public function send($s,$n,$e,$m){
		$_SESSION["send_view"] = (isset($_SESSION["send_view"])) ? $_SESSION["send_view"]+1 : 1;
		if($_SESSION["send_view"]>150){ 
			echo "Error page."; 
			exit(); 
		}
		
		if(!$this->isValidEmail($e)){
			echo "Error page.";
			exit(); 
		}else{
			$i = $this->selectEmailGeneralInfo(); 
			$message = wordwrap(strip_tags($m), 70, "\r\n");
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
			$headers .= 'To: '.$n.' <'.$e.'>' . "\r\n";
			$headers .= 'From: '.$i["fromname"].' <'.$i["from"].'>' . "\r\n";
			$send_email = mail($e, $s, $m, $headers);

			if($send_email){
				echo "done !";
			}else{
				echo "Error page."; 
				exit(); 
			}
		}
	}

	public function isValidEmail($email){ 
    	return filter_var($email, FILTER_VALIDATE_EMAIL);
	}

}
?>