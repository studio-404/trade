<?php if(!defined("DIR")){ exit(); }
class model_admin_comments extends connection{
	function __construct(){
	}

	public function get_comments($c){
		$out = array();		
		if(isset($_GET['search']) && !empty($_GET['search']) ){
			$search='%'.$_GET['search'].'%';
			$search_in = ' AND `namelname` LIKE :search ';
		}else{ $search='a'; $search_in = ' AND `id`!=:search ';  }
		$sql = 'SELECT * FROM `studio404_comments` WHERE `connect_idx`=:connect_idx AND `page_type`=:page_type AND `status`!=:status AND `lang`=:lang '.$search_in.' ORDER BY `date` DESC';
		$exe_array = array(
			":connect_idx"=>$_GET['cidx'], 
			":page_type"=>$_GET['type'], 
			":status"=>1, 
			":lang"=>LANG_ID, 
			":search"=>$search 
		);
		$path = '?action=comments&type='.$_GET['type'].'&id='.$_GET['id'].'&cidx='.$_GET['cidx'].'&super='.$_GET['super'].'&pn=';
		$itemsPerPage = 10;
		$pager = new pager();
		$pager = $pager->action($c,$sql,$exe_array,$path,$itemsPerPage);	
		$out['table'] = $this->table($c,$pager[0],$exe_array);
		$out['pager'] = $pager[1];
		return $out;
	}

	public function select_one($c){
		$conn = $this->conn($c); 
		$sql = 'SELECT * FROM `studio404_comments` WHERE `idx`=:idx AND `status`!=:status AND `lang`=:lang';
		$prepare = $conn->prepare($sql); 
		$prepare->execute(array(
			":idx"=>$_GET['comment_idx'], 
			":status"=>1, 
			":lang"=>LANG_ID 
		));
		$fetch = $prepare->fetch(PDO::FETCH_ASSOC); 
		return $fetch; 
	}

	public function table($c,$sql,$exe_array){
		$out = '';
		$conn = $this->conn($c);
		$query = $conn->prepare($sql);
		try{ 
			
			$token = md5(sha1(time()));
			$_SESSION['token'] = $token;
			// $_SESSION['token'] = md5(sha1(time()));
			$query->execute($exe_array);
			while($rows = $query->fetch()){
				$out .= '<div class="row">';				
				$out .= '<span class="cell">'.date("d-m-Y H:i:s",$rows['date']).'</span>';
				$out .= '<span class="cell">'.$rows['namelname'].'</span>';			
				$out .= '<span class="cell" style="width:120px;">
						<a href="?action=editComments&type=catalogpage&id='.$_GET['id'].'&cidx='.$_GET['cidx'].'&comment_idx='.$rows['idx'].'&super='.$_GET['super'].'&token='.$_SESSION['token'].'" title="Edit comment"><i class="fa fa-pencil-square-o"></i></a>
						<a href="javascript:;" onclick="deleteComfirm(\'?action=editComments&type=catalogpage&id='.$_GET['id'].'&cidx='.$_GET['cidx'].'&comment_idx='.$rows['idx'].'&super='.$_GET['super'].'&removeComment='.$rows['idx'].'&token='.$_SESSION['token'].'\')" title="Remove comment"><i class="fa fa-times"></i></a>
						</span>';

				$out .= '</div>';
			}
		}catch(Exception $e){
			
		}
		return $out;
	}

	public function edit($c){ 
		$conn = $this->conn($c); 
		if(
			isset($_POST['date'],$_POST['namelname'],$_POST['comment']) && 
			$this->noEmpty($_POST['date']) && 
			$this->noEmpty($_POST['namelname']) && 
			$this->noEmpty($_POST['comment']) 
		){ 
			// update main columns
			$sql = 'UPDATE `studio404_comments` SET 
			`namelname`=:namelname, 
			`comment`=:comment
			WHERE 
			`connect_idx`=:connect_idx AND 
			`lang`=:lang AND 
			`status`!=:status 
			';
			$prepare = $conn->prepare($sql);
			$prepare->execute(array(
				":namelname"=>$_POST['namelname'], 
				":comment"=>$_POST['comment'], 
				":lang"=>LANG_ID,
				":status"=>1,
				":connect_idx"=>$_GET['comment_idx']
			));

			//update every language columne
			$date = strtotime($_POST['date']);
			
			$sql2 = 'UPDATE `studio404_comments` SET 
			`date`=:datex
			WHERE 
			`connect_idx`=:connect_idx AND 
			`status`!=:status ';
			$prepare2 = $conn->prepare($sql2);
			$prepare2->execute(array(
				":datex"=>$date, 
				":status"=>1,
				":connect_idx"=>$_GET['comment_idx']
			));

			$background = 'false';
			if(isset($_POST['background']) && !empty($_POST['background'])){ 
				$expl = explode("/",$_POST['background']);				
				$from = DIR.$expl[1]."/".end($expl);
				$To = DIR.'files/'.end($expl);
				if(file_exists($from)){	
					if(@copy($from,$To)){
						@unlink($from);
						$background = explode(DIR,$To);
						$background = $background[1];
					}
				}	
				$sql3 = 'UPDATE `studio404_comments` SET 
				`file`=:file
				WHERE 
				`connect_idx`=:connect_idx AND 
				`status`!=:status ';
				$prepare3 = $conn->prepare($sql3);
				$prepare3->execute(array(
					":file"=>$background, 
					":status"=>1,
					":connect_idx"=>$_GET['comment_idx']
				));

			}		


			return 1;
		}
	}


	public function add($c){
		$conn = $this->conn($c); 
		if(
			isset($_POST['date'],$_POST['namelname'],$_POST['comment']) && 
			$this->noEmpty($_POST['date']) && 
			$this->noEmpty($_POST['namelname']) && 
			$this->noEmpty($_POST['comment']) 
		){ 
			$date = strtotime($_POST['date']);
			
			$background = 'false';
			if(isset($_POST['background']) && !empty($_POST['background'])){ 
				$expl = explode("/",$_POST['background']);				
				$from = DIR.$expl[1]."/".end($expl);
				$To = DIR.'files/'.end($expl);
				if(file_exists($from)){	
					if(@copy($from,$To)){
						@unlink($from);
						$background = explode(DIR,$To);
						$background = $background[1];
					}
				}	
			}

			// select languages
			$model_admin_selectLanguage = new model_admin_selectLanguage();
			$lang_query = $model_admin_selectLanguage->select_languages($c);

			$sqlm = 'SELECT MAX(`idx`)+1 AS maxid FROM `studio404_comments`';
			$querym = $conn->query($sqlm);
			$rowm = $querym->fetch(PDO::FETCH_ASSOC);
			$maxidx = ($rowm['maxid']) ? $rowm['maxid'] : 1;

			
			foreach($lang_query as $lang_row){
				$lang_id = $lang_row['id']; 
				$sql = 'INSERT INTO `studio404_comments` SET 
				`idx`=:maxidx, 
				`connect_idx`=:connect_idx, 
				`date`=:datex, 
				`namelname`=:namelname, 
				`comment`=:comment, 
				`file`=:file, 
				`page_type`=:page_type, 
				`lang`=:lang
				';
				$prepare = $conn->prepare($sql);
				$prepare->execute(array(
				":maxidx"=>$maxidx, 
				":datex"=>$date, 
				":namelname"=>$_POST['namelname'], 
				":comment"=>$_POST['comment'], 
				":lang"=>$lang_id,
				":connect_idx"=>$_GET['cidx'], 
				":page_type"=>$_GET['type'], 
				":file"=>$background 
				));
			}
			return 1;
		}
	}


	public function removeMe($c){
		$conn = $this->conn($c);
		$sql = 'UPDATE `studio404_comments` SET `status`=:status WHERE `idx`=:idx';
		$prepare = $conn->prepare($sql);
		$prepare->execute(array(
			":status"=>1,
			":idx"=>$_GET['removeComment'] 
		));
		return 1; 
	}


	private function noEmpty($foo){
		if(!empty($foo)){
			return true;
		}
		return false;
	}
}
?>