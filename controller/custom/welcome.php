<?php if(!defined("DIR")){ exit(); }
class welcome extends connection{
	function __construct($c){
		$this->template($c,"welcome");
	}
	
	public function template($c,$page){
		$conn = $this->conn($c); // connection
		$include = WEB_DIR."/welcome.php";
		if(file_exists($include)){		
			$cache = new cache();
			/* components */
			$components = $cache->index($c,"components");
			$data["components"] = json_decode($components); 

			/* language variables */
			$language_data = $cache->index($c,"language_data");
			$language_data = json_decode($language_data);
			$model_template_makevars = new  model_template_makevars();
			$data["language_data"] = $model_template_makevars->vars($language_data); 

			@include($include);
		}else{
			$controller = new error_page(); 
		}
	}
}
?>