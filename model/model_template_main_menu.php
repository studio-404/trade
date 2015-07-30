<?php if(!defined("DIR")){ exit(); }
class model_template_main_menu{
	public function nav($menu_array,$type){	

		$get_slug_from_url = new get_slug_from_url();
		$slug = $get_slug_from_url->slug(); 

		if($type=="header"){
			$obj  = new url_controll(); 
			$second_segment = $obj->url("segment",2);
			//echo $second_segment; 
			$o = '<ul class="nav navbar-nav">';
				for($x=0;$x<count($menu_array->date);$x++){
					$active = ($menu_array->slug[$x]==$second_segment) ? 'active' : '';
					if($menu_array->sub[$x]){ 
						$o .= '<li class="dropdown '.$active.'">';
						$o .= '<a href="'.MAIN_DIR.$menu_array->slug[$x].'?token='.$_SESSION["token_generator"].'">'.strtoupper($menu_array->title[$x]).'</a>';
						$o .= $this->sub($menu_array->sub[$x],$slug,"header"); 
						$o .= '</li>'; 
					}else{
						$o .= '<li class="'.$active.'"><a href="'.MAIN_DIR.$menu_array->slug[$x].'?token='.$_SESSION["token_generator"].'">'.strtoupper($menu_array->title[$x]).'</a></li>'; 
					}
				}			
			$o .= '</ul>';
		}else if($type=="footer"){
			$o = '';
				for($x=0;$x<count($menu_array->date);$x++){
					
					if($menu_array->sub[$x] && $menu_array->title[$x]!="Trade map"){ 						
						$o .= '<ul>';
						$o .= '<span>'.$menu_array->title[$x].': &nbsp;</span>';
						$o .= $this->sub($menu_array->sub[$x],$slug,"footer"); 					
						$o .= '</ul>'; 				
					}
					
				}			
			
		}
		return $o;
	}

	public function left($menu_array){	
		$get_slug_from_url = new get_slug_from_url();
		$slug = $get_slug_from_url->slug();		
		$o = '';

		$obj  = new url_controll(); 
		$third_segment = $obj->url("segment",2)."/".$obj->url("segment",3);

		if(is_array($menu_array)){
			foreach($menu_array as $val){
				$active = ($val->slug==$third_segment) ? 'active' : '';
				$o .= '<li class="'.$active.'"><a href="'.MAIN_DIR.$val->slug.'?token='.$_SESSION["token_generator"].'">'.$val->title.'</a></li>';
			} 
		}
		return $o;
	}

	public function sub($sub,$slug,$type){
		$o = '';
		if($type=="header"){
			$o = '<ul class="dropdown-menu dropdown-menu-2">'; 
			for($x=0;$x<count($sub->date);$x++){
				$active = ($sub->slug[$x]==$slug) ? 'active' : '';
					$o .= '<li class="'.$active.'"><a href="'.MAIN_DIR.$sub->slug[$x].'?token='.$_SESSION["token_generator"].'">'.$sub->title[$x].'</a></li>'; 
			}
			$o .= '</ul>';
		}else if($type=="footer"){
			$o = ''; 
			for($x=0;$x<count($sub->date);$x++){
				$active = ($sub->slug[$x]==$slug) ? 'active' : '';
				$slash = (count($sub->date)!=($x+1)) ? ' / ' : '';
				$o .= '<li><a href="'.MAIN_DIR.$sub->slug[$x].'?token='.$_SESSION["token_generator"].'">'.$sub->title[$x].'</a></li>'.$slash; 
			}
		}
		return $o;
	}


}
?>