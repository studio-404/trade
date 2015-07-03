<?php if(!defined("DIR")){ exit(); }
class model_template_pagination{
	public function pager($list,$item_per_page,$path){
		// count items 
		$all_items = count($list); 
		// pagination numbers
		$pagings = ceil($all_items / $item_per_page);

		// current page
		$pn = (isset($_GET['pn'])) ? preg_replace('#[^0-9]#i','',$_GET['pn']) : 1;
		
		if($all_items > $item_per_page){
			$show_list = array_slice($list, ($pn*$item_per_page)-2, $item_per_page);
		}else{
			$show_list = $list;
		}
		$out[0] = $show_list;

		$out[1] = '';
		if($pagings>$item_per_page){
			for($x=1;$x<=$pagings;$x++){
				$active = (isset($pn) && $pn==$x) ? ' class="active"' : '';
				$out[1] .= '<li'.$active.'><a href="'.$path.'?pn='.$x.'">'.$x.'</a></li>';
			}
		}
		return $out;
	}
}
?>