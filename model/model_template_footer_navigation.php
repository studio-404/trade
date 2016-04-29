<?php if(!defined("DIR")){ exit(); }
class model_template_footer_navigation extends connection{
	public function select_all($c){
		$cache = new cache();
		$footernavigation = $cache->index($c,"footernavigation");
		$out["footernavigation"] = json_decode($footernavigation,true);
		$o = '';
		foreach ($out["footernavigation"] as $value) {
			$o .= '<ul>';
			$o .= '<span>'.$value['title'].': </span> ';
			$o .= $this->select_sub($c,$value['idx']);
			$o .= '</ul>';
		}
		return $o;
	}

	public function select_sub($c,$idx){
		$conn = $this->conn($c);
		$sql = 'SELECT `idx`,`cid`,`title`,`slug`,`redirectlink` FROM `studio404_pages` WHERE `cid`=:cid AND `footermenu`=1 AND `lang`=:lang AND `visibility`!=:visibility AND `status`!=:status ORDER BY `position` ASC';	
		$prepare = $conn->prepare($sql); 
		$prepare->execute(array(
			":cid"=>$idx, 
			":status"=>1, 
			":visibility"=>1, 
			":lang"=>LANG_ID 
		)); 
		$out = '';
		if($prepare->rowCount() > 0){
			$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC);
			$x = 1;
			$count = $prepare->rowCount();
			foreach ($fetch as $value) {
				if($value['redirectlink']!="false"){
					$link = $value['redirectlink'];
				}else{
					$link = WEBSITE.LANG.'/'.$value['slug'];
				}
				if($x==$count){
					$out .= '<li><a href="'.$link.'">'.$value['title'].'</a></li>'; 
				}else{
					$out .= '<li><a href="'.$link.'">'.$value['title'].'</a></li> / '; 
				}
				$x++;
			}
		}
		return $out;
	}
}
?>