<?php if(!defined("DIR")){ exit(); }
class newslettercode extends connection{
	function __construct($c){
		$this->template($c,"newslettercode");
	}
	
	public function template($c,$page){
		$conn = $this->conn($c);

		$compain = 'SELECT * FROM `studio404_newsletter_campain` WHERE `status`!=1';
		$compain_query = $conn->query($compain);
		if($compain_query->rowCount() > 0){ // Compain Exists
			
		}else{ // no Campain
			/*insert compain*/
			$insert_compain = 'INSERT INTO `studio404_newsletter_campain` SET `type`="user"';
			$insert_query = $conn->query($insert_compain);
			/* select user */
			$sql_select_user = 'SELECT `id`,`namelname`,`company_type`,`picture`,`about` FROM `studio404_users` WHERE `user_type`="website" AND `allow`=2 AND `emailed`="no" AND `status`!=:status ORDER BY `id` ASC LIMIT 1';
			$prepare = $conn->prepare($sql_select_user);
			$prepare->execute(array(
				":status"=>1
			));
			if($prepare->rowCount() > 0){
				$fetch_users = $prepare->fetch(PDO::FETCH_ASSOC);
				/* select emails */
				$select_emails = 'SELECT * FROM `studio404_newsletter_emails` WHERE `group_id`=1 AND `status`=0 AND `pending`=0 ORDER BY `id` ASC LIMIT 5';
				$prepare_email = $conn->prepare($select_emails);
				$prepare_email->execute();
				if($prepare_email->rowCount() > 0){
					$fetch_emails = $prepare_email->fetchAll(PDO::FETCH_ASSOC);
					$mail = new PHPMailer();
					$mail->IsSMTP();
					$mail->CharSet = 'UTF-8';

					$mail->Host       = "mail.tradewithgeorgia.com"; 
					$mail->SMTPDebug  = 0; 
					$mail->SMTPAuth   = true;
					$mail->Port       = 25;
					$mail->Username   = "info@tradewithgeorgia.com";
					$mail->Password   = "p08H6UcO4";
					foreach ($fetch_emails as $value) {
						echo $value["email"]."<br />";
					}
				}
			}
		}
		//http://tradewithgeorgia.com/_plugins/newsletter/index.php
		
	}
}
?>