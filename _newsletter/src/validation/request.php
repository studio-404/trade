<?php if(!defined("DIR")){ echo "Sorry, You dont have a permittion !"; exit(); }
class src_validation_request{

	public static function method($type,$item){
		if($type=="POST" && isset($_POST[$item])){
			return filter_input(INPUT_POST, $item);
		}else if($type=="GET" && isset($_GET[$item])){
			return filter_input(INPUT_GET, $item);
		}else{
			return '';
		}
	}

}
?>