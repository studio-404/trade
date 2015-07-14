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
			echo "ass ".$l;
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
				echo '<option value="">Choose</option>';
			}
			try{
				$sql = 'SELECT `idx`,`title` FROM `studio404_pages` WHERE `cid` IN ('.$in.') AND `visibility`!=:visibility AND `status`!=:status';
				$prepare = $conn->prepare($sql); 
				$prepare->execute(array(
					":visibility"=>1, 
					":status"=>1
				));
				
				$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC);
				foreach ($fetch as $val) {
					echo '<option value="'.$val['idx'].'">'.$val['title'].'</option>';
				}
			}catch(Exception $e){

			}
		}

		if(Input::method("POST","uploadfile")){
			echo "Its been uploaded !"; 
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