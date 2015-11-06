<?php if(!defined("DIR")){ exit(); }
class model_admin_charts extends connection{
	public $outMessage = 2;
	function __construct(){

	}

	public function add($c){
		echo "<pre>";
		print_r($_POST); 
		echo "</pre>";
	}

	public function select($c){
		$out = array();		
		if(isset($_GET["search"]) && !empty($_GET["search"])){
			$where = ' AND (`uid`=:search OR `id`=:search) '; 
			$exe_array = array(
			":search"=>urldecode($_GET["search"]), 
			":lang"=>LANG_ID,
			":status"=>1
			);
		}else{
			$where = ''; 
			$exe_array = array(
			":lang"=>LANG_ID,
			":status"=>1
			);
		}
	
		$sql = 'SELECT `uid`,`type`,`title` FROM `studio404_charts` WHERE `lang`=:lang AND `status`!=:status '.$where.' ORDER BY `uid` DESC';
		$path = '?action=charts&pn='; 
		$itemsPerPage = 20;
		$pager = new pager();
		$pager = $pager->action($c,$sql,$exe_array,$path,$itemsPerPage);	
		$out['table'] = $this->table($c,$pager[0],$exe_array);
		$out['pager'] = $pager[1];
		return $out;
	}


	public function table($c,$sql,$exe_array){
		$out = '';
		$conn = $this->conn($c);
		$query = $conn->prepare($sql);	
		try{ 
			$query->execute($exe_array);
			$_SESSION['token'] = md5(sha1(time()));
			$x=0;
			while($rows = $query->fetch()){
				//$out .= '<div class="" style="position:absolute; text-indent:-9999px">['.$rows['uid'].']</div>';										
				$out .= '<div class="row">';										
				$out .= '<span class="cell" onclick="copyMe(\'hiddenIframe'.$x.'\')" id="hiddenIframe'.$x.'">['.$rows['uid'].']</span>';
				$out .= '<span class="cell">'.$rows['type'].'</span>';		
				$out .= '<span class="cell"><a href="#" title="View invoice" target="_blank">'.$rows['title'].'</a></span>';		
				$out .= '<span class="cell" style="width:130px;">'; 
				$out .= '<a href="#" title="Edit invoice"><i class="fa fa-pencil-square-o"></i></a>';
				$out .= '<a href="javascript:;" onclick="#" title="Remove invoice"><i class="fa fa-times"></i></a>';
			
				$out .= '</span>';

				$out .= '</div>';
				$x++;
			}
		}catch(Exception $e){
			
		}
		return $out;
	}





	function __destruct(){

	}
}
?>