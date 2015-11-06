<?php if(!defined("DIR")){ exit(); }
class module_template_recoverpassword extends connection{

	function __construct(){

	}

	public function change($c){
		$conn = $this->conn($c); 
		$sql = 'SELECT `id` FROM `studio404_users` WHERE `recover`=:recover AND `id`=:id';
		$prepare = $conn->prepare($sql); 
		$prepare->execute(array(
			":recover"=>Input::method("GET","rl"), 
			":id"=>(int)Input::method("GET","ui")
		));

		if($prepare->rowCount()>0){
			if(Input::method("POST","npassword") && Input::method("POST","npassword")===Input::method("POST","cpassword")){
				$update = 'UPDATE `studio404_users` SET `password`=:password, `recover`=:newrecover WHERE `recover`=:recover AND `id`=:id';
				$prepare2 = $conn->prepare($update); 
				$prepare2->execute(array(
					":password"=>md5(Input::method("POST","npassword")), 
					":recover"=>Input::method("GET","rl"), 
					":id"=>Input::method("GET","ui"),  
					":newrecover"=>''   
				));
				return "Password recovered !"; 
			}else{
				return "Error";
			}
		}else{
			redirect::url(WEBSITE);
			return false;
		}
	}

}
?>