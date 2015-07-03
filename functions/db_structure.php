<?php if(!defined("DIR")){ exit(); }
class db_structure extends connection{
	public $idx, $title, $shorttitle, $sub = array();

	public function __construct(){
		global $c;
		$this->sub = $this->callAgain($c,$this->idx); 
		//$this->makeArray($call);
	}

	public function callAgain($c,$cid){
		$out = array();
		$conn = $this->conn($c); 
		$sql = 'SELECT 
		`idx`,`cid`,`title`, `shorttitle`
		FROM 
		`studio404_pages` 
		WHERE 
		`status`!=:status AND 
		`menu_type`!=:super AND 
		`lang`=:lang AND 
		`visibility`!=:visibility AND 
		`cid`=:cid 
		ORDER BY `position` ASC
        ';
        $prepare = $conn->prepare($sql); 
        $prepare->execute(array(
				":status"=>1, 
				":super"=>'super', 
				":lang"=>LANG_ID, 
				":visibility"=>1, 
				":cid"=>$cid
		));

		if($prepare->rowCount()){
			$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC); 
			foreach($fetch as $val){
				$out['idx'][] = $val['idx']; 
				$out['cid'][] = $val['cid']; 
				$out['title'][] = $val['title']; 
				$out['shorttitle'][] = $val['shorttitle']; 
				$out['sub'][] = $this->callAgain($c,$val['idx']);  
			}
			return $out;
		}
		
	}
}
?>