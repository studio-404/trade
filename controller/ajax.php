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
					$sql2 = 'INSERT INTO `studio404_users` SET `registered_date`=:registered_date, `registered_ip`=:registered_ip, `username`=:email, `password`=:password, `company_type`=:company_type, `user_type`=:user_type';
					$prepare2 = $conn->prepare($sql2);
					$prepare2->execute(array(
						":registered_date"=>time(), 
						":registered_ip"=>$ip, 
						":email"=>$e, 
						":password"=>md5($p), 
						":company_type"=>$t, 
						":user_type"=>'website'
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
					$sql2 = 'INSERT INTO `studio404_users` SET `registered_date`=:registered_date, `registered_ip`=:registered_ip, `username`=:email, `password`=:password, `company_type`=:company_type, `user_type`=:user_type';
					$prepare2 = $conn->prepare($sql2);
					$prepare2->execute(array(
						":registered_date"=>time(), 
						":registered_ip"=>$ip, 
						":email"=>$e, 
						":password"=>md5($p), 
						":company_type"=>$t, 
						":user_type"=>'website'
					));
					echo "Done";
				}
			}
		endif;
			
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