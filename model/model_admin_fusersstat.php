<?php if(!defined("DIR")){ exit(); }
class model_admin_fusersstat extends connection{

	public $outMessage;
	function __construct(){

	}

	public function edit($c){
		$conn = $this->conn($c); 

		$out = false;
		if($_GET['type']=="products" && is_numeric($_GET['idx'])){
			$sql = 'UPDATE 
			`studio404_module_item` SET 
			`title`=:title, 
			`packaging`=:packaging, 
			`hscode`=:hscode, 
			`awards`=:awards, 
			`shelf_life`=:shelf_life, 
			`long_description`=:long_description, 
			`admin_com`=:admin_com, 
			`visibility`=:visibility
			WHERE 
			`studio404_module_item`.`module_idx`=3 AND 
			`studio404_module_item`.`idx`=:idx AND  
			`studio404_module_item`.`lang`=:lang  ';
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":title"=>strip_tags($_POST['pname']), 
				":packaging"=>strip_tags($_POST['pck']), 
				":hscode"=>strip_tags($_POST['hscode-idx']), 
				":awards"=>strip_tags($_POST['awards']), 
				":shelf_life"=>strip_tags($_POST['shlf_life']), 
				":long_description"=>strip_tags(nl2br($_POST['desc'])), 
				":admin_com"=>strip_tags($_POST['admin_com']), 
				":visibility"=>(int)$_POST['show'], 
				":idx"=>(int)$_GET['idx'], 
				":lang"=>LANG_ID
			));
			$out = 1;

			if(isset($_FILES["pimage"]["name"])){
				$imageFileType = explode(".",$_FILES["pimage"]["name"]);
				$imageFileType = end($imageFileType); 
				// http://trade.404.ge/image?f= 
				$newfilename = md5(sha1(time())).".jpg";
				$target_file = DIR."/files/usersproducts/".$newfilename; 
				if($imageFileType=="jpg"){
 
					if (move_uploaded_file($_FILES["pimage"]["tmp_name"], $target_file)) {
						// remove old file 
						$selfilename = 'SELECT `picture` FROM `studio404_module_item` WHERE `idx`=:idx AND `lang`=:lang AND `module_idx`=:module_idx';
						$preparefilename = $conn->prepare($selfilename); 
						$preparefilename->execute(array(
							":idx"=>(int)$_GET['idx'], 
							":lang"=>LANG_ID, 
							":module_idx"=>3
						));
						if($preparefilename->rowCount()>0){
							$fetchfilename = $preparefilename->fetch(PDO::FETCH_ASSOC);
							if($fetchfilename['picture']){
								@unlink(WEBSITE."/files/usersproducts/".$fetchfilename['picture']); 
							}
						}
						//update db newfilename
						$nfilename = 'UPDATE `studio404_module_item` SET `picture`=:picture WHERE `idx`=:idx AND `lang`=:lang AND `module_idx`=:module_idx';
						$preparenew = $conn->prepare($nfilename);
						$preparenew->execute(array(
							":picture"=>$newfilename,
							":idx"=>(int)$_GET['idx'], 
							":lang"=>LANG_ID, 
							":module_idx"=>3
						));
				       	$out = 1;
				    } else {
				       $out = 2;
				    }
				}
			}

		}else if($_GET['type']=="services" && is_numeric($_GET['idx'])){
			$sql = 'UPDATE 
			`studio404_module_item` SET  
			`title`=:title, 
			`long_description`=:long_description, 
			`admin_com`=:admin_com, 
			`visibility`=:visibility
			WHERE 
			`studio404_module_item`.`module_idx`=4 AND 
			`studio404_module_item`.`idx`=:idx AND  
			`studio404_module_item`.`lang`=:lang  ';
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":title"=>strip_tags($_POST['servicex']), 
				":long_description"=>strip_tags(nl2br($_POST['desc'])), 
				":admin_com"=>strip_tags($_POST['admin_com']), 
				":visibility"=>(int)$_POST['show'], 
				":idx"=>(int)$_GET['idx'], 
				":lang"=>LANG_ID
			));
			$out = 1;
		}else if($_GET['type']=="enquires" && is_numeric($_GET['idx'])){
			$sql = 'UPDATE 
			`studio404_module_item` SET  
			`title`=:title, 
			`long_description`=:long_description, 
			`admin_com`=:admin_com, 
			`visibility`=:visibility
			WHERE 
			`studio404_module_item`.`module_idx`=5 AND 
			`studio404_module_item`.`idx`=:idx AND  
			`studio404_module_item`.`lang`=:lang  ';
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":title"=>strip_tags($_POST['title']), 
				":long_description"=>strip_tags(nl2br($_POST['desc'])), 
				":admin_com"=>strip_tags($_POST['admin_com']), 
				":visibility"=>(int)$_POST['show'], 
				":idx"=>(int)$_GET['idx'], 
				":lang"=>LANG_ID
			));
			$out = 1;
		}
		return $out;
	}

	public function select_one($c){
		$conn = $this->conn($c); 
		$out = false;
		if($_GET['type']=="products" && is_numeric($_GET['idx'])){
			$sql = 'SELECT 
			`studio404_module_item`.`id`, 
			`studio404_module_item`.`idx`, 
			`studio404_module_item`.`title`, 
			`studio404_module_item`.`picture`, 
			`studio404_module_item`.`sub_sector_id`, 
			`studio404_module_item`.`hscode` AS hscode_id,
			(SELECT `studio404_pages`.`title` FROM `studio404_pages` WHERE `studio404_pages`.`idx`=`studio404_module_item`.`hscode`) AS hscode, 
			(SELECT `studio404_users`.`username` FROM `studio404_users` WHERE `studio404_users`.`id`=`studio404_module_item`.`insert_admin`) AS username, 
			`studio404_module_item`.`products`, 
			`studio404_module_item`.`shelf_life`, 
			`studio404_module_item`.`packaging`, 
			`studio404_module_item`.`awards`, 
			`studio404_module_item`.`long_description`, 
			`studio404_module_item`.`admin_com`, 
			`studio404_module_item`.`visibility` 
			FROM 
			`studio404_module_item`
			WHERE 
			`studio404_module_item`.`module_idx`=3 AND 
			`studio404_module_item`.`idx`=:idx AND  
			`studio404_module_item`.`lang`=:lang  ';
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":idx"=>(int)$_GET['idx'], 
				":lang"=>LANG_ID
			));
			if($prepare->rowCount() > 0){
				$out = $prepare->fetchAll(PDO::FETCH_ASSOC);
			}
		}else if($_GET['type']=="services" && is_numeric($_GET['idx'])){
			$sql = 'SELECT 
			`studio404_module_item`.`id`, 
			`studio404_module_item`.`idx`, 
			`studio404_module_item`.`title`, 
			`studio404_module_item`.`sub_sector_id`,
			(SELECT `studio404_users`.`username` FROM `studio404_users` WHERE `studio404_users`.`id`=`studio404_module_item`.`insert_admin`) AS username, 
			(SELECT `studio404_users`.`products` FROM `studio404_users` WHERE `studio404_users`.`id`=`studio404_module_item`.`insert_admin`) AS uproducts, 
			`studio404_module_item`.`products`, 
			`studio404_module_item`.`long_description`, 
			`studio404_module_item`.`admin_com`, 
			`studio404_module_item`.`visibility` 
			FROM 
			`studio404_module_item`
			WHERE 
			`studio404_module_item`.`module_idx`=4 AND 
			`studio404_module_item`.`idx`=:idx AND  
			`studio404_module_item`.`lang`=:lang  ';
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":idx"=>(int)$_GET['idx'], 
				":lang"=>LANG_ID
			));
			if($prepare->rowCount() > 0){
				$out = $prepare->fetchAll(PDO::FETCH_ASSOC);
			}
		}else if($_GET['type']=="enquires" && is_numeric($_GET['idx'])){
			$sql = 'SELECT 
			`studio404_module_item`.`id`, 
			`studio404_module_item`.`idx`, 
			`studio404_module_item`.`title`, 
			`studio404_module_item`.`type`,
			(SELECT `studio404_users`.`username` FROM `studio404_users` WHERE `studio404_users`.`id`=`studio404_module_item`.`insert_admin`) AS username, 
			(SELECT `studio404_pages`.`title` FROM `studio404_pages` WHERE `studio404_pages`.`idx`=`studio404_module_item`.`sector_id` AND `studio404_pages`.`lang`='.LANG_ID.') AS sector_name, 
			`studio404_module_item`.`long_description`, 
			`studio404_module_item`.`admin_com`, 
			`studio404_module_item`.`visibility` 
			FROM 
			`studio404_module_item`
			WHERE 
			`studio404_module_item`.`module_idx`=5 AND 
			`studio404_module_item`.`idx`=:idx AND  
			`studio404_module_item`.`lang`=:lang  ';
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":idx"=>(int)$_GET['idx'], 
				":lang"=>LANG_ID
			));
			if($prepare->rowCount() > 0){
				$out = $prepare->fetchAll(PDO::FETCH_ASSOC);
			}
		}
		return $out;
	}

	public function get_users($c){

		if(isset($_GET['visibilitychnage'],$_GET['load'],$_GET["allow"],$_GET['username'])){
			$conn = $this->conn($c);
			if($_GET['username']!=""){

				$replaceUserAt = str_replace("xXx","@",$_GET['username']);
				$sql = 'UPDATE `studio404_users` SET `allow`=:allow WHERE `username`=:username';
				$prepare = $conn->prepare($sql);
				$prepare->execute(array(
					":allow"=>(int)$_GET["allow"], 
					":username"=>$replaceUserAt
				));
				$pn = (isset($_GET['pn'])) ? $_GET['pn'] : 1;
				redirect::url(WEBSITE.LANG."/tadmin?action=fusersstat&load=users&pn=".$pn);

			}
		}

		$out = array();		
		if(isset($_GET['search']) && !empty($_GET['search']) ){
			$search='%'.$_GET['search'].'%';
			$search2= $_GET['search'];
			$search_in = ' AND (`studio404_users`.`id`=:search2 OR `studio404_users`.`username` LIKE :search ) ';
		}else{ $search='a'; $search_in = ' AND `studio404_users`.`id`!=:search AND `studio404_users`.`id`!=:search2';  }
			$sql = 'SELECT 
			`studio404_users`.*
			FROM 
			`studio404_users`
			WHERE 
			`studio404_users`.`user_type`=:website AND 
			`studio404_users`.`status`!=:status '.$search_in.'
			ORDER BY 
			`studio404_users`.`id` DESC
			';
			$exe_array = array(
				":website"=>"website", 
				":status"=>1, 
				":search"=>$search, 
				":search2"=>(int)$search2 
			);
		$path = '?action=fusersstat&load=users&pn=';
		$itemsPerPage = 15;
		$pager = new pager();
		$pager = $pager->action($c,$sql,$exe_array,$path,$itemsPerPage);	
		$out['table'] = $this->table($c,$pager[0],$exe_array);
		$out['pager'] = $pager[1];
		return $out;
	}

	public function get_products($c){
		$out = array();		
		if(isset($_GET['search']) && !empty($_GET['search']) ){
			$search='%'.$_GET['search'].'%';
			$search_in = ' AND (`studio404_module_item`.`id`=:search OR `studio404_module_item`.`title` LIKE :search ) ';
		}else{ $search='a'; $search_in = ' AND `studio404_module_item`.`id`!=:search ';  }
			$sql = 'SELECT 
			`studio404_module_item`.*, 
			(SELECT `studio404_users`.`username` FROM `studio404_users` WHERE `studio404_users`.`id`=`studio404_module_item`.`insert_admin` AND `studio404_users`.`status`!=1) AS users_name 
			FROM 
			`studio404_module_item`
			WHERE 
			`studio404_module_item`.`module_idx`=:module_idx AND 
			`studio404_module_item`.`status`!=:status '.$search_in.'
			ORDER BY 
			`studio404_module_item`.`date` DESC
			';
			$exe_array = array(
				":module_idx"=>3, 
				":status"=>1, 
				":search"=>$search 
			);
			//echo $sql;
		$path = '?action=fusersstat&load=products&pn=';
		$itemsPerPage = 15;
		$pager = new pager();
		$pager = $pager->action($c,$sql,$exe_array,$path,$itemsPerPage);	
		$out['table'] = $this->table($c,$pager[0],$exe_array,"products");
		$out['pager'] = $pager[1];
		return $out;
	}

	public function get_services($c){
		$out = array();		
		if(isset($_GET['search']) && !empty($_GET['search']) ){
			$search='%'.$_GET['search'].'%';
			$search_in = ' AND (`studio404_module_item`.`id`=:search OR `studio404_module_item`.`title` LIKE :search ) ';
		}else{ $search='a'; $search_in = ' AND `studio404_module_item`.`id`!=:search ';  }
			$sql = 'SELECT 
			`studio404_module_item`.*, 
			(SELECT `studio404_users`.`username` FROM `studio404_users` WHERE `studio404_users`.`id`=`studio404_module_item`.`insert_admin` AND `studio404_users`.`status`!=1) AS users_name 
			FROM 
			`studio404_module_item`
			WHERE 
			`studio404_module_item`.`module_idx`=:module_idx AND 
			`studio404_module_item`.`status`!=:status '.$search_in.'
			ORDER BY 
			`studio404_module_item`.`date` DESC
			';
			$exe_array = array(
				":module_idx"=>4, 
				":status"=>1, 
				":search"=>$search 
			);
			//echo $sql;
		$path = '?action=fusersstat&load=services&pn=';
		$itemsPerPage = 15;
		$pager = new pager();
		$pager = $pager->action($c,$sql,$exe_array,$path,$itemsPerPage);	
		$out['table'] = $this->table($c,$pager[0],$exe_array,"services");
		$out['pager'] = $pager[1];
		return $out;
	}

	public function get_enquires($c){
		$out = array();		
		if(isset($_GET['search']) && !empty($_GET['search']) ){
			$search='%'.$_GET['search'].'%';
			$search_in = ' AND (`studio404_module_item`.`id`=:search OR `studio404_module_item`.`title` LIKE :search ) ';
		}else{ $search='a'; $search_in = ' AND `studio404_module_item`.`id`!=:search ';  }
			$sql = 'SELECT 
			`studio404_module_item`.*, 
			(SELECT `studio404_users`.`username` FROM `studio404_users` WHERE `studio404_users`.`id`=`studio404_module_item`.`insert_admin` AND `studio404_users`.`status`!=1) AS users_name, 
			(SELECT `studio404_users`.`company_type` FROM `studio404_users` WHERE `studio404_users`.`id`=`studio404_module_item`.`insert_admin` AND `studio404_users`.`status`!=1) AS users_type
			FROM 
			`studio404_module_item`
			WHERE 
			`studio404_module_item`.`module_idx`=:module_idx AND 
			`studio404_module_item`.`status`!=:status '.$search_in.'
			ORDER BY 
			`studio404_module_item`.`date` DESC
			';
			$exe_array = array(
				":module_idx"=>5, 
				":status"=>1, 
				":search"=>$search 
			);
			//echo $sql;
		$path = '?action=fusersstat&load=enquires&pn=';
		$itemsPerPage = 10;
		$pager = new pager();
		$pager = $pager->action($c,$sql,$exe_array,$path,$itemsPerPage);	
		$out['table'] = $this->table($c,$pager[0],$exe_array,"enquires");
		$out['pager'] = $pager[1];
		return $out;
	}

	public function table($c,$sql,$exe_array,$loadtype="users"){
		$out = '';
		$conn = $this->conn($c);
		$query = $conn->prepare($sql);
		
		try{ 
			$query->execute($exe_array);
			$token = md5(sha1(time()));
			$_SESSION['token'] = $token;
			$calculate = new calculate();
			$calculate_pre = new calculate_pre();
			while($rows = $query->fetch()){
				$out .= '<div class="row">';
				if($loadtype=="users"){
					//print_r();
					$session = $calculate_pre->calc($c,$rows['id']); 
					if($rows['company_type']=="manufacturer"){
						$tocomplete = $calculate::filled($session,"product"); 
						$typename = "Product";
					}else if($rows['company_type']=="serviceprovider"){
						$tocomplete = $calculate::filled($session,"service"); 
						$typename = "Service";
					}else{
						$tocomplete["tocomplete"] = "Nope ";
						$typename = $rows['company_type'];
					}
					
					$out .= '<span class="cell">'.$rows['id'].'</span>';
					$out .= '<span class="cell" style="width:100px">'.date("d-m-Y",$rows['registered_date']).'</span>';
				
					$out .= '<span class="cell">'.$rows['username'].'</span>';
					$out .= '<span class="cell">'.$typename.'</span>';
					$out .= '<span class="cell">'.$tocomplete["tocomplete"].'%</span>';
					$out .= '<span class="cell">';
					if($rows['company_type']=="manufacturer" || $rows['company_type']=="serviceprovider"){
						$out .= '<a href="javascript:void(0)" title="Log as User" class="logasuser-administrator" data-userid="'.$rows['id'].'" data-usertype="'.$rows['company_type'].'"><i class="fa fa-unlock-alt"></i></a>';//p08H6UcO4
					}else{
						$out .= '<a href="javascript:void(0)" title="Log as User" style="opacity:0.4"><i class="fa fa-unlock-alt"></i></a>';//p08H6UcO4
					}
					if($rows['allow']==2){
						$out .= '<a href="?action=fusersstat&amp;load='.$_GET['load'].'&amp;visibilitychnage=true&amp;allow=1&amp;username='.str_replace("@","xXx",$rows['username']).'" style="color:green; margin:0 5px;" title="Change visibility"><i class="fa fa-dot-circle-o"></i></a>';
					}else{
						$out .= '<a href="?action=fusersstat&amp;load='.$_GET['load'].'&amp;visibilitychnage=true&amp;allow=2&amp;username='.str_replace("@","xXx",$rows['username']).'" style="color:red; margin:0 5px;" title="Change visibility"><i class="fa fa-dot-circle-o"></i></a>';
					}
					$out .=	'<a href="'.WEBSITE.LANG.'/user?t='.$rows['company_type'].'&i='.$rows['id'].'" target="_blank" title="Check users"><i class="fa fa-eye"></i></a>
						<a href="javascript:;" onclick="deleteComfirm(\'?action=fusersstat&load=users&rmid='.$rows['id'].'&remove=true&token='.$_SESSION['token'].'\')" title="Remove users"><i class="fa fa-times"></i></a>
					</span>';
				}else if($loadtype=="products"){
					$color = ($rows["visibility"]==2) ? 'green' : 'red';
					$out .= '<span class="cell" style="color:'.$color.';">'.$rows['idx'].'</span>';
					$out .= '<span class="cell" style="color:'.$color.'; width:150px">'.date("d M Y H:m:s",$rows['date']).'</span>';
				
					$out .= '<span class="cell" style="color:'.$color.';">'.$rows['title'].'</span>';
					$out .= '<span class="cell" style="color:'.$color.';">'.$rows['users_name'].'</span>';
					$out .= '<span class="cell">
						<a href="'.WEBSITE.LANG.'/user?t=manufacturer&i='.$rows['insert_admin'].'&p='.$rows['id'].'" target="_blank" title="Check products"><i class="fa fa-eye"></i></a>
						<a href="?action=edituserstats&idx='.$rows['idx'].'&type=products&token='.$_SESSION['token'].'" title="Edit products"><i class="fa fa-pencil-square-o"></i></a>
						<a href="javascript:;" onclick="deleteComfirm(\'?action=fusersstat&load=products&rmid='.$rows['idx'].'&remove=true&token='.$_SESSION['token'].'\')" title="Remove news"><i class="fa fa-times"></i></a>
					</span>';
				}else if($loadtype=="services"){
					$color = ($rows["visibility"]==2) ? 'green' : 'red';
					$out .= '<span class="cell" style="color:'.$color.';">'.$rows['idx'].'</span>';
					$out .= '<span class="cell" style="color:'.$color.'; width:150px">'.date("d M Y H:m:s",$rows['date']).'</span>';
				
					$out .= '<span class="cell" style="color:'.$color.';">'.$rows['title'].'</span>';
					$out .= '<span class="cell" style="color:'.$color.';">'.$rows['users_name'].'</span>';
					$out .= '<span class="cell">
						<a href="'.WEBSITE.LANG.'/user?t=serviceprovider&i='.$rows['insert_admin'].'&p='.$rows['id'].'" target="_blank" title="Check news"><i class="fa fa-eye"></i></a>
						<a href="?action=edituserstats&idx='.$rows['idx'].'&type=services&token='.$_SESSION['token'].'" title="Edit services"><i class="fa fa-pencil-square-o"></i></a>
						<a href="javascript:;" onclick="deleteComfirm(\'?action=fusersstat&load=services&rmid='.$rows['idx'].'&remove=true&token='.$_SESSION['token'].'\')" title="Remove service"><i class="fa fa-times"></i></a>
					</span>';
				}else if($loadtype=="enquires"){
					$color = ($rows["visibility"]==2) ? 'green' : 'red';
					$out .= '<span class="cell" style="color:'.$color.';">'.$rows['idx'].'</span>';
					$out .= '<span class="cell" style="color:'.$color.'; width:150px">'.date("d M Y H:m:s",$rows['date']).'</span>';
				
					$out .= '<span class="cell" style="color:'.$color.';">'.$rows['title'].'</span>';
					$out .= '<span class="cell" style="color:'.$color.';">'.$rows['users_name'].'</span>';
					$out .= '<span class="cell">
						<a href="'.WEBSITE.LANG.'/user?t='.$rows['users_type'].'&i='.$rows['insert_admin'].'&p='.$rows['id'].'" target="_blank" title="Check news"><i class="fa fa-eye"></i></a>
						<a href="?action=edituserstats&idx='.$rows['idx'].'&type=enquires&token='.$_SESSION['token'].'" title="Edit enquires"><i class="fa fa-pencil-square-o"></i></a>
						<a href="javascript:;" onclick="deleteComfirm(\'?action=fusersstat&load=enquires&rmid='.$rows['idx'].'&remove=true&token='.$_SESSION['token'].'\')" title="Remove news"><i class="fa fa-times"></i></a>
					</span>';
				}
				
				$out .= '</div>';
			}
		}catch(Exception $e){
			
		}
		return $out;
	}

	public function removeMe($c,$t){
		$out = fasle;
		$conn = $this->conn($c);
		switch($t){
			case "users":
			$sql = 'UPDATE `studio404_users` SET `status`=1 WHERE `id`=:id';
			$prepare = $conn->prepare($sql);
			$prepare->execute(array(
				":id"=>(int)$_GET['rmid']
			));
			$out = true;
			break;
			case "products":
			$sql = 'UPDATE `studio404_module_item` SET `status`=1 WHERE `idx`=:idx';
			$prepare = $conn->prepare($sql);
			$prepare->execute(array(
				":idx"=>(int)$_GET['rmid']
			));
			$out = true;
			break;
			case "services": 
			$sql = 'UPDATE `studio404_module_item` SET `status`=1 WHERE `idx`=:idx';
			$prepare = $conn->prepare($sql);
			$prepare->execute(array(
				":idx"=>(int)$_GET['rmid']
			));
			$out = true;
			break;
			case "enquires": 
			$sql = 'UPDATE `studio404_module_item` SET `status`=1 WHERE `idx`=:idx';
			$prepare = $conn->prepare($sql);
			$prepare->execute(array(
				":idx"=>(int)$_GET['rmid']
			));
			$out = true;
			break;
		}
		return $out;
	}

	function __destruct(){

	}

}
?>