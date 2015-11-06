<?php if(!defined("DIR")){ exit(); }
class download{

	function __construct(){
		try{
			if(isset($_GET['path'],$_GET['contenttype']) && !empty($_GET['path'])){
				switch($_GET['contenttype']){
					case "text/csv":
					$file = $_GET['path']; 					
					header("Content-Description: File Transfer"); 
					header("Content-Type: text/csv"); 
					header("Content-Disposition: attachment; filename=\"exelfile.csv\""); 

					readfile($file); 
					break;
				}
			}
		}catch(Exception $e){
			echo $e;
		}
	}

}
?>