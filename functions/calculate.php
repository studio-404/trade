<?php if(!defined("DIR")){ exit(); }
class calculate {
	public static function filled($session,$type = "product"){

		if($type=="product"){
			if($session){
				$tocomplete = @(count(array_filter($session)) * 4) + 4;

				$topublish = 10; 
				if($session["picture"]!=""){
					$topublish += 10; 
				}

				if($session["companyname"]!=""){
					$topublish += 10; 
				}

				if($session["sector"]!=""){
					$topublish += 10; 
				}

				if($session["subsector"]!=""){
					$topublish += 10; 
				}

				if($session["products"]!=""){
					$topublish += 10; 
				}

				if($session["mobiles"]!=""){
					$topublish += 10; 
				}

				if($session["ad_position1"]!=""){
					$topublish += 10; 
				}

				if($session["ad_email1"]!=""){
					$topublish += 10; 
				}

				if($session["contactpersones"]!=""){
					$topublish += 10; 
				}

				
				$out["topublish"] = $topublish;
				$out["tocomplete"] = $tocomplete;
			}else{
				$out["topublish"] = 10;
				$out["tocomplete"] = 4;
			}
		}else if($type=="service"){

			$tocomplete = @(count(array_filter($session)) * 4) + 8;

			$topublish = 0; 

			
			if($session["picture"]!=""){
				$topublish += 10; 
			}

			if($session["companyname"]!=""){
				$topublish += 10; 
			}

			if($session["contactemail"]!=""){
				$topublish += 10; 
			}

			if($session["sector"]!=""){
				$topublish += 10; 
			}

			if($session["subsector"]!=""){
				$topublish += 10; 
			}

			if($session["products"]!=""){
				$topublish += 10; 
			}

			if($session["contactpersones"]!=""){
				$topublish += 10; 
			}

			if($session["ad_position1"]!=""){
				$topublish += 10; 
			}

			if($session["mobiles"]!=""){
				$topublish += 10; 
			}

			if($session["ad_email1"]!=""){
				$topublish += 10; 
			}
			$out["topublish"] = $topublish;
			$out["tocomplete"] = $tocomplete;
		}
		return $out;
	} 
}
?>