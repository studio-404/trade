<?php if(!defined("DIR")){ exit(); }
class model_admin_newsmodule extends connection{
	public $outMessage;
	function __construct(){

	}

	public function removeTickets($c){
		if(isset($_GET['removetickets']) && is_numeric($_GET['removetickets'])){
			$conn = $this->conn($c);
			$sql = 'UPDATE `studio404_event_tickets` SET `status`=1 WHERE `id`='.$_GET['removetickets'];
			$prepare = $conn->prepare($sql); 
			$prepare->execute();
		}
	}

	public function countTickets($c,$event_id){
		$conn = $this->conn($c);
		$sql = 'SELECT COUNT(`id`) AS c FROM `studio404_event_tickets` WHERE `event_id`=:event_id AND `status`!=:one';
		$prepare = $conn->prepare($sql); 
		$prepare->execute(array(
			":event_id"=>$event_id, 
			":one"=>1 
		));
		if($prepare->rowCount()>0){
			$fetch = $prepare->fetch(PDO::FETCH_ASSOC); 
			return $fetch["c"];
		}else{
			return "0";
		}
	}

	public function select_list($c){
		if(isset($_GET['removetickets']) && is_numeric($_GET['removetickets'])){
			$this->removeTickets($c);
		}
		$out = array();		
		if(isset($_GET['search']) && !empty($_GET['search']) ){
			$search='%'.$_GET['search'].'%';
			$search_in = ' AND `studio404_module_item`.`title` LIKE :search ';
			if(isset($_GET['loadtickets']) && is_numeric($_GET['loadtickets'])){
				$search_ticket = ' AND `uid`='.$_GET['search'];
			}
		}else{ $search='a'; $search_in = ' AND `studio404_module_item`.`id`!=:search '; $search_ticket = '';  }
			
		if(isset($_GET['loadtickets']) && is_numeric($_GET['loadtickets'])){			
			$sql = 'SELECT * FROM `studio404_event_tickets`	WHERE `event_id`=:event_id AND `status`!=:one '.$search_ticket;
			$exe_array = array(
				":event_id"=>$_GET['loadtickets'], 
				":one"=>1
			);
			if(isset($_GET["csv"])){
				$conn = $this->conn($c); 
				$csv_sql = 'SELECT 
				DATE_FORMAT(FROM_UNIXTIME(`studio404_event_tickets`.`date`), "%e %b %Y") AS set_date, 
				`studio404_event_tickets`.`uid` AS set_uid, 
				`studio404_event_tickets`.`namelname` AS set_namelname, 
				`studio404_event_tickets`.`email` AS set_email, 
				`studio404_event_tickets`.`mobile` AS set_mobile, 
				`studio404_module_item`.`title` AS smi_title, 
				DATE_FORMAT(FROM_UNIXTIME(`studio404_module_item`.`date`), "%e %b %Y") AS smi_date, 
				DATE_FORMAT(FROM_UNIXTIME(`studio404_module_item`.`expiredate`), "%e %b %Y") AS smi_expiredate, 
				`studio404_module_item`.`event_fee` AS smi_place, 
				`studio404_module_item`.`event_booth` AS smi_booth, 
				`studio404_module_item`.`event_desc` AS smi_venue, 
				`studio404_module_item`.`event_website` AS smi_website 
				FROM 
				 `studio404_event_tickets`, `studio404_module_item` 
				 WHERE 
				 `studio404_event_tickets`.`event_id`=:event_id AND 
				 `studio404_event_tickets`.`status`!=:one AND 
				 `studio404_event_tickets`.`event_id`=`studio404_module_item`.`idx` AND 
				 `studio404_module_item`.`status`!=:one  
				';
				
				$csv_prepare = $conn->prepare($csv_sql); 
				$csv_prepare->execute(array(
					":event_id"=>(int)$_GET['loadtickets'], 
					":one"=>1 
				)); 

				// Create array
				$filename = "ticket_list_".time().".csv";
	            $list = array();
	            array_push($list, array("Insert Date","Ticket ID","Company / Person Name","Email","Mobile","Event Title","Event Start", "Event End", "Event Place","Booth N","Venue","Web page"));
	            // Append results to array
	            while ($row = $csv_prepare->fetch(PDO::FETCH_ASSOC)) {
	                array_push($list, array_values($row));
	            }

	            // Output array into CSV file
	            $fp = fopen('php://output', 'w');
	            header('Content-Type: text/csv');
	            header('Content-Disposition: attachment; filename="'.$filename.'"');
	            foreach ($list as $ferow) {
	                fputcsv($fp, $ferow);
	            }
	            exit();
			}
			$path = '?action=newsModule&type='.$_GET['type'].'&id='.$_GET['id'].'&super='.$_GET['super'].'&loadtickets='.$_GET['loadtickets'].'&token='.$_GET['token'].'&pn=';
		}else{
			$sql = 'SELECT 
			`studio404_module_item`.`idx` AS smi_idx, 
			`studio404_module_item`.`date` AS smi_date, 
			`studio404_module_item`.`expiredate` AS smi_expiredate, 
			`studio404_module_item`.`title` AS smi_title, 
			`studio404_module_item`.`tags` AS smi_tags,  
			`studio404_module_item`.`event_registration` AS smi_event_registration,  
			`studio404_module_item`.`slug` AS smi_slug,  
			`studio404_module_item`.`visibility` AS smi_visibility, 
			(SELECT COUNT(`studio404_event_tickets`.`id`) AS c FROM `studio404_event_tickets` WHERE `studio404_event_tickets`.`event_id`=`studio404_module_item`.`idx` AND `studio404_event_tickets`.`status`!=:status) AS registered_members 
			FROM 
			`studio404_module_attachment`, `studio404_module`, `studio404_module_item`
			WHERE 
			`studio404_module_attachment`.`connect_idx`=:sma_connect_id AND 
			(`studio404_module_attachment`.`page_type`=:sma_page_type || `studio404_module_attachment`.`page_type`=:sma_page_type2) AND 
			`studio404_module_attachment`.`lang`=:lang AND 
			`studio404_module_attachment`.`status`!=:status AND 
			`studio404_module_attachment`.`idx`=`studio404_module`.`idx` AND 
			`studio404_module`.`lang`=:lang AND 
			`studio404_module`.`status`!=:status AND 
			`studio404_module`.`idx`=`studio404_module_item`.`module_idx` AND 
			`studio404_module_item`.`lang`=:lang AND 
			`studio404_module_item`.`status`!=:status '.$search_in.'
			ORDER BY 
			`studio404_module_item`.`date` DESC
			';
			$exe_array = array(
				":sma_connect_id"=>$_GET['id'], 
				":sma_page_type"=>"newspage", 
				":sma_page_type2"=>"eventpage", 
				":status"=>1, 
				":search"=>$search, 
				":lang"=>LANG_ID
			);
			$path = '?action=newsModule&type='.$_GET['type'].'&super='.$_GET['super'].'&id='.$_GET['id'].'&pn=';
		}
		
		$itemsPerPage = 10;
		$pager = new pager();
		$pager = $pager->action($c,$sql,$exe_array,$path,$itemsPerPage); 
		if(count($pager)>1){
			$out['table'] = $this->table($c,$pager[0],$exe_array);
			$out['pager'] = $pager[1];
		}else{
			$out['table'] = "";
			$out['pager'] = "";
		}
		return $out;
	}

	public function table($c,$sql,$exe_array){
		$out = '';
		$conn = $this->conn($c);
		$query = $conn->prepare($sql);
		
		try{ 
			$query->execute($exe_array);
			$token = md5(sha1(time()));
			$_SESSION['token'] = $token;
			if(isset($_GET['loadtickets']) && is_numeric($_GET['loadtickets'])){
				while($rows = $query->fetch()){
					$out .= '<div class="row">';

					$out .= '<span class="cell">'.$rows['uid'].'</span>';
					$out .= '<span class="cell" style="width:100px">'.date("d-m-Y",$rows['date']).'</span>';
					
					$out .= '<span class="cell">'.$rows['namelname'].'</span>';
					$out .= '<span class="cell">'.$rows['email'].'</span>';
					$out .= '<span class="cell">'.$rows['mobile'].'</span>';

					$out .= '<span class="cell" style="min-width:140px">';
					$out .= '<a href="'.WEBSITE.'en/about-us/events/ticket?id='.$rows['uid'].'&token='.$rows['token'].'" title="Show Event Ticket" target="_blank"><i class="fa fa-eye"></i></a>';
					$out .= '<a href="javascript:;" onclick="deleteComfirm(\'?action=newsModule&type='.$_GET['type'].'&id='.$_GET['id'].'&super='.$_GET['super'].'&loadtickets='.$_GET['loadtickets'].'&token='.$_GET['token'].'&removetickets='.$rows['id'].'\')" title="Remove Event Ticket"><i class="fa fa-times"></i></a>';
					$out .= '</span>';

					$out .= '</div>';
				}
			}else{
				while($rows = $query->fetch()){
					$out .= '<div class="row">';

					$visibilityx = ($rows['smi_visibility']==1) ? "red" : "green";
					$link_visibility = "?action=newsModule&type=".$_GET['type']."&id=".$_GET['id']."&newsidx=".$rows['smi_idx']."&super=".$_GET['super']."&visibilitychnage=true&token=".$_SESSION['token'];
					$out .= '<span class="cell primary"><a href="'.htmlentities($link_visibility).'" style="color:'.$visibilityx.'" title="Change visibility"><i class="fa fa-dot-circle-o"></i></a></span>';
					$out .= '<span class="cell">'.$rows['smi_idx'].'</span>';
					$out .= '<span class="cell" style="width:100px">'.date("d-m-Y",$rows['smi_date']).'</span>';
					
					if(isset($_GET['type']) && $_GET['type']=="eventpage"){
						$out .= '<span class="cell" style="width:100px">'.date("d-m-Y",$rows['smi_expiredate']).'</span>';
					}

					$out .= '<span class="cell"><a href="?action=editNewsItem&type='.$_GET['type'].'&id='.$_GET['id'].'&newsidx='.$rows['smi_idx'].'&super='.$_GET['super'].'&token='.$_SESSION['token'].'">'.$rows['smi_title'].'</a> <br /> <a href="'.WEBSITE.LANG."/".htmlentities($rows['smi_slug']).'" class="slugs" target="_blank">'.WEBSITE.LANG."/".$rows['smi_slug'].'</a></span>';
					if(isset($_GET['type']) && $_GET['type']=="eventpage"){
						$color = ($rows['smi_event_registration']=="on") ? 'green' : 'red';
						$out .= '<span class="cell"><font color="'.$color.'">'.$rows['smi_event_registration'].'</font></span>';
						$out .= '<span class="cell">'.(int)$rows['registered_members'].'</span>';
					}
					$out .= '<span class="cell">'.$rows['smi_tags'].'</span>';

					$insert_image_link = '<a href="?action=editNewsItem&type='.$_GET['type'].'&id='.$_GET['id'].'&newsidx='.$rows['smi_idx'].'&super='.$_GET['super'].'&token='.$_SESSION['token'].'#tabs-3" title="Attach pictures"> <i class="fa fa-picture-o"></i></a>';
					$insert_image_link .= '<a href="?action=editNewsItem&type='.$_GET['type'].'&id='.$_GET['id'].'&newsidx='.$rows['smi_idx'].'&super='.$_GET['super'].'&token='.$_SESSION['token'].'#tabs-4" title="Attach files"> <i class="fa fa-file"></i></a>';
					//<i class="fa fa-ticket" aria-hidden="true"></i>
					$out .= '<span class="cell" style="min-width:140px">';
					$out .= '<a href="'.WEBSITE.LANG."/".htmlentities($rows['smi_slug']).'" target="_blank" title="Check news"><i class="fa fa-eye"></i></a>';
					$out .= '<a href="?action=editNewsItem&type='.$_GET['type'].'&id='.$_GET['id'].'&newsidx='.$rows['smi_idx'].'&type='.$_GET['type'].'&super='.$_GET['super'].'&token='.$_SESSION['token'].'" title="Edit news"><i class="fa fa-pencil-square-o"></i></a>';
					if(isset($_GET['type']) && $_GET['type']=="eventpage"){
						$out .= '<a href="?action=newsModule&type=eventpage&id='.$_GET['id'].'&super='.$_GET['super'].'&loadtickets='.$rows['smi_idx'].'&token='.$_GET['token'].'" title="Tickets"><i class="fa fa-ticket" aria-hidden="true"></i></a>';
					}
					$out .= $insert_image_link;
					$out .= '<a href="javascript:;" onclick="deleteComfirm(\'?action=newsModule&type='.$_GET['type'].'&id='.$_GET['id'].'&nidx='.$rows['smi_idx'].'&super='.$_GET['super'].'&remove=true&token='.$_SESSION['token'].'\')" title="Remove news"><i class="fa fa-times"></i></a>';
					$out .= '</span>';
					$out .= '</div>';
				}
			}
		}catch(Exception $e){
			
		}
		return $out;
	}

	function __destruct(){

	}

}
?>