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
					if($menu_array->redirectlink[$x]!="false" && !empty($menu_array->redirectlink[$x])){
							$gotoUrl = $menu_array->redirectlink[$x];
					}else{
						$gotoUrl = MAIN_DIR.$menu_array->slug[$x];
					}
					$ttTitle = strtoupper($menu_array->title[$x]);
					if(isset($_GET["t"])){
						$tt = (($_GET["t"]=="individual" || $_GET["t"]=="company")) ? 'BUSINESS PORTAL' : 'EXPORT CATALOG'; 
						if($ttTitle==$tt){ $active = 'active'; }
					}
					if($menu_array->sub[$x]){ 
						$o .= '<li class="dropdown '.$active.'">';
						$o .= '<a href="'.$gotoUrl.'">'.$ttTitle.'</a>';
						$o .= $this->sub($menu_array->sub[$x],$slug,"header"); 
						$o .= '</li>'; 
					}else{
						$o .= '<li class="'.$active.'"><a href="'.$gotoUrl.'">'.strtoupper($menu_array->title[$x]).'</a></li>'; 
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

				if($val->redirectlink!="false" && !empty($val->redirectlink)){
					$gotoUrl = $val->redirectlink;
				}else{
					$gotoUrl = MAIN_DIR.$val->slug;
				}

				$o .= '<li class="'.$active.'"><a href="'.$gotoUrl.'">'.$val->title.'</a></li>';
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

				if($sub->redirectlink[$x]!="false" && !empty($sub->redirectlink[$x])){
					$gotoUrl = $sub->redirectlink[$x];
				}else{
					$gotoUrl = MAIN_DIR.$sub->slug[$x];
				}
				$o .= '<li class="'.$active.'"><a href="'.$gotoUrl.'">'.$sub->title[$x].'</a></li>'; 
			}
			$o .= '</ul>';
		}else if($type=="footer"){
			$o = ''; 
			for($x=0;$x<count($sub->date);$x++){
				$active = ($sub->slug[$x]==$slug) ? 'active' : '';
				$slash = (count($sub->date)!=($x+1)) ? ' / ' : '';

				if($sub->redirectlink[$x]!="false" && !empty($sub->redirectlink[$x])){
					$gotoUrl = $sub->redirectlink[$x];
				}else{
					$gotoUrl = MAIN_DIR.$sub->slug[$x];
				}

				$o .= '<li><a href="'.$gotoUrl.'">'.$sub->title[$x].'</a></li>'.$slash; 
			}
		}
		return $o;
	}


}
?>