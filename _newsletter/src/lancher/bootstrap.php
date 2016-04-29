<?php if(!defined("DIR")){ echo "Sorry, You dont have a permittion !"; exit(); }
class src_lancher_bootstrap {
	public function lanch(){
		$out["message"] = "Sorry, you dont have a permition !";
		// $page = src_validation_request::method("GET","page");
		$page = "sentMails";
		switch ($page) {
		 	// case 'refreshEmailList':
		 	// 	$object = new src_database_newsletters();
				// $fetch = $object->newsletters(" ");
				// if($fetch){
				// 	$json = json_encode($fetch);	
				// 	$path = DOCUMENT_ROOT."cache/email_lists.json";
				// 	$makefile = new src_json_makefile();
				// 	$makefile->mk($path,$json);
				// 	$out["message"] = "Email List Refreshed !";
				// }else{
				// 	$out["message"] = "Emails does not exists !";
				// }
				// echo json_encode($out);
		 	// 	break;
		 	// case 'createCampain':
		 	// 	$object = new src_database_createcampain();
		 	// 	$campain = $object->campain();
		 	// 	if($campain){
		 	// 		$out["message"] = "Campain Created !";
		 	// 	}else{
		 	// 		$out["message"] = "Active Campain Exists !";
		 	// 	}
		 	// 	echo json_encode($out);
		 	// 	break;
		 	case 'sentMails':
		 		$path = DOCUMENT_ROOT."cache/products_email.json";
		 		if(!file_exists($path)){
		 			$products = new src_database_products();
		 			$fetch = $products->getter();
		 			if($fetch){
		 				$json = json_encode($fetch);
		 				$makefile = new src_json_makefile();
						$makefile->mk($path,$json);
						$out["message"] = "Products email created !";
					}else{
						$out["message"] = "There is no more products !";
					}
					
		 		}else{
		 			
		 			$newsletters = new src_database_newsletters();
		 			$fetch = $newsletters->newsletters($limit = "LIMIT 1");
		 			if($fetch){
			 			$sendmail = new src_share_sendmail(); 
			 			$insert_emailed = new src_database_emailed();
			 			foreach ($fetch as $v) {
			 				$file_get = file_get_contents("http://tradewithgeorgia.com/_plugins/newsletter/index.php?r=".$v["unsubscribe"]);
			 				$sent = $sendmail->sendMail("Trade With Georgia","info@tradewithgeorgia.com","New Products",base64_encode($file_get),$v["email"]);
			 				$newsletters->sended($v["id"]);
			 				$insert_emailed->insert(base64_encode($v["email"]),$file_get);
			 			}
			 			$out["message"] = "Email has been sent !"; 
		 			}else{
		 				$out["message"] = "There is no more emails !";
		 				$newsletters->reset();
		 				@unlink($path);
		 			}
		 		}
		 		echo json_encode($out);
		 		break;
		 	default:
		 		$out["message"] = "Sorry, you dont have a permition !";
		 		echo json_encode($out);
		 		break;
		 } 
		 
		
	}
}
?>