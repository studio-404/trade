<?php if(!defined("DIR")){ exit(); }
class structure_array{

	public function mk($array){
			$o = '';
			foreach ($array as $val) {
				$o .= " [{ v:'".$val->idx."', f:'".$val->title." <div style=\"color:#ccc\">".$val->shorttitle."</div>' }, '".$val->cid."', '' ], "; 
				$o .= $this->sb($val->sub); 				
			}
			return $o;
		}

	public function sb($array){			
		$o = ''; 
		if(count($array)){
			if(count($array->idx) == 1){
				$o .= " [{ v:'".$array->idx[0]."', f:'".$array->title[0]." <div style=\"color:#ccc\">".$array->shorttitle[0]."</div>' }, '".$array->cid[0]."', '' ], "; 
				$o .= $this->sb($array->sub[0]);
			}else{
				for($x=0;$x<=count($array->idx);$x++){
					if(!empty($array->idx[$x])){
						$o .= " [{ v:'".$array->idx[$x]."', f:'".$array->title[$x]." <div style=\"color:#ccc\">".$array->shorttitle[$x]."</div>' }, '".$array->cid[$x]."', '' ], "; 
						$o .= $this->sb($array->sub[$x]);
					}
				}
			}
							 
		}
		return $o;
	}

	public function mob_sub_str($array){
		$c = count($array); 
		$o = '';
		$y=1;
		if($c>0){
			$o = '<ul>';
			$x = 0;
			foreach($array->title as $val){
				$o .= '<li>';
				$o .= '<span>&nbsp;'.$y.') '.$val.'&nbsp;</span>'; 
				$o .= $this->mob_sub_str($array->sub[$x]); 
				$o .= '</li>';
				$x++;
				$y++;
			}
			$o .= '</ul>';

		}
		return $o;
	}

}
?>