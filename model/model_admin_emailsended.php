<?php if(!defined("DIR")){ exit(); }
class model_admin_emailsended extends connection{
	public $outMessage = 2;
	function __construct(){

	} 

	public function select_list($c){
		$out = array();		
		if(isset($_GET['search']) && is_numeric($_GET['search'])){
			$idsearch = ' AND `id`='.$_GET['search'];
		}else{ $idsearch = ''; }
		$sql = 'SELECT `id`,`data`,`emailto` FROM `studio404_newsletter_sended` WHERE `status`!=:status '.$idsearch.' ORDER BY `data` DESC';
		$exe_array = array(":status"=>1);
		$path = '?action=loadnewsletter&pn=';
		$itemsPerPage = 10;
		$pager = new pager();
		$pager = $pager->action($c,$sql,$exe_array,$path,$itemsPerPage);	
		$out['table'] = $this->table($c,$pager[0],$exe_array);
		$out['pager'] = $pager[1];
		return $out;
	}

	public function table($c,$sql,$exe_array){
		$out = '';
		if(!empty($sql) && $sql!=""){
			$conn = $this->conn($c);

			$prepare = $conn->prepare($sql);		
		
			$prepare->execute($exe_array);
			if($prepare->rowCount() > 0){
				while($rows = $prepare->fetch()){
					$out .= '<div class="row">';
					$out .= '<span class="cell">'.$rows['id'].'</span>';
					$out .= '<span class="cell">'.date("d/m/Y g:i:s",$rows['data']).'</span>';
					$out .= '<span class="cell">'.base64_decode($rows['emailto']).'</span>';

					
					$out .= '<span class="cell" style="width:120px;">
							<a href="'.WEBSITE.LANG.'/newsletter-email?id='.$rows['id'].'" title="Load email" target="_blank"><i class="fa fa-eye"></i></a>
							</span>';
					$out .= '</div>';
				}
			}
		}
		return $out;
	}

	function __destruct(){

	}
}
?>