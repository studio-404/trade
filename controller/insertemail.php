<?php if(!defined("DIR")){ exit(); }
class insertemail extends connection{
	function __construct(){
		$email = filter_input(INPUT_POST, "email");
		$this->insert($email);
	}

	public function insert($email){ 
		global $c;
		if($this->check($email)){
			$conn = $this->conn($c);
			$get_ip = new get_ip();
			$time = time();
			$type = "email"; 
			$unsubscribe = md5(sha1($time));
			$u_ip = $get_ip->ip;
			$group_id = 4; 
			$name = "User ".$u_ip;
			$check = 'SELECT `id` FROM `studio404_newsletter_emails` WHERE `email`=:emailx AND `status`!=:status'; 
			$prepare = $conn->prepare($check); 
			$prepare->execute(array(
				":emailx"=>$email, 
				":status"=>1
			));
			$nums = $prepare->rowCount();


			$check_ip = 'SELECT COUNT(`id`) AS c FROM `studio404_newsletter_emails` WHERE `u_ip`=:u_ip AND `status`!=:status'; 
			$prepare_ip = $conn->prepare($check_ip); 
			$prepare_ip->execute(array(
				":u_ip"=>$u_ip, 
				":status"=>1
			));
			$fetch = $prepare_ip->fetch();

			if(!$nums && $fetch["c"]<=15){
				$sql = 'INSERT INTO 
				`studio404_newsletter_emails` 
				SET 
				`date`=:datex, 
				`type`=:type, 
				`unsubscribe`=:unsubscribe, 
				`u_ip`=:u_ip, 
				`group_id`=:group_id, 
				`email`=:emailx
				';
				$prepare2 = $conn->prepare($sql); 
				$prepare2->execute(array(
					":datex"=>$time, 
					":type"=>$type, 
					":unsubscribe"=>$unsubscribe, 
					":u_ip"=>$u_ip, 
					":group_id"=>$group_id,
					":emailx"=>$email 
				));
				echo 1;
			}else{
				echo 2;
			}
		}
	}

	public function check($email){
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		 return false;
		}
		return true;
	}
}
?>