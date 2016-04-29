<?php if(!defined("DIR")){ exit(); }
			class FullScreen{
				function __construct($c){
					$this->template($c,"FullScreen");
				}
				
				public function template($c,$page){
					$include = WEB_DIR."/FullScreen.php";
					if(file_exists($include)){
					/* 
					** Here goes any code developer wants to 
					*/
					@include($include);
					}else{
						$controller = new error_page(); 
					}
				}
			}
			?>