<?php if(!defined("DIR")){ exit(); }
class loadpublicfiles{
	function __construct($c){
		$this->template($c,"loadpublicfiles");
	}
	
	public function template($c,$page){
		$ext = Input::method("GET","ext");
		$sizetype = Input::method("GET","sizetype");
		$datafrom = Input::method("GET","datafrom");
		$dataid = Input::method("GET","dataid");

		if($datafrom=="file"){
			@include("filearray.php");
			switch($ext){
				case "css":
				header("Content-type: text/css; charset=utf-8");
				$ex = explode(",",$dataid); 
				$fx = '';
				if(count($ex)>1){
					foreach ($ex as $v) {
						if(file_exists($FILE["get_".$v])){
							$fx .= @file_get_contents($FILE["get_".$v]);
						}else{
							continue;
						}
					}
				}else{
					$fx = @file_get_contents($FILE["get_".$dataid]);
				}
				echo $fx;
				break;
				case "jpg":  
				header("Content-Type: image/jpeg");
				header("Content-Length: " .(string)(filesize($FILE["get_".$dataid])) );
				if($sizetype=="false"){
					echo file_get_contents($FILE["get_".$dataid]);
				}
				break;
				case "png":  
				header("Content-Type: image/png");
				header("Content-Length: " .(string)(filesize($FILE["get_".$dataid])) );
				if($sizetype=="false"){
					echo file_get_contents($FILE["get_".$dataid]);
				}
				break;
				case "svg":  
				header('Content-type: image/svg+xml');
				if($sizetype=="false"){
					echo file_get_contents($FILE["get_".$dataid]);
				}
				break;
				case "txt":  
				header('Content-type: text/plain');
				echo file_get_contents($FILE["get_".$dataid]);
				break;
				case "ico":  
				header('Content-Type: image/vnd.microsoft.icon');
				echo file_get_contents($FILE["get_".$dataid]);
				break;
				case "woff":  
				header('Content-Type: application/x-font-woff');
				echo file_get_contents($FILE["get_".$dataid]);
				break;
				case "js":  
				header('Content-Type: application/javascript');
				$ex = explode(",",$dataid); 
				$fx = '';
				if(count($ex)>1){
					foreach ($ex as $v) {
						if(file_exists($FILE["get_".$v])){
							$fx .= @file_get_contents($FILE["get_".$v]);
						}else{
							continue;
						}
					}
				}else{
					$fx = @file_get_contents($FILE["get_".$dataid]);
				}
				echo $fx;
				break;
				
			}
		}else if($datafrom=="database"){

		}
	}
}
?>