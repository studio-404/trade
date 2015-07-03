<?php @include("parts/header.php"); ?>
<div class="container" id="container">
	<div class="col-sm-3" id="sidebar">
		<div class="breadcrumbs">
			<div class="your_are_here"><?=$data["language_data"]["path"]?>: </div>
			<li><a href="<?=MAIN_PAGE?>"><?=$data["language_data"]["mainpage"]?></a><li>  >
			<?php 
			$count = count($data["breadcrups"]); 
			$x=1;
			foreach($data["breadcrups"] as $val)
			{
				if($x<$count){ $seperarator = ">"; }else{ $seperarator=""; }
			?>
				<li><a href="<?=WEBSITE.LANG."/".$val->slug?>"><?=$val->title?></a><li>  <?=$seperarator?>
			<?php
				$x++;
			}
			?>  
		</div>
		<div class="sidebar_menu">
			<ul>
				<?=$data["left_menu"]?>
			</ul>
		</div>
	</div>
	<div class="col-sm-9" id="content">
		<div class="page_title_2">
			<?=$data["team_general"][0]["title"]?>
		</div>
				<?php  
				$list = array();
				$db_team = new db_team();
				$x=0;
				//$team_list = array_reverse($data["team_list"]);
				foreach($data["team_list"] AS $v){
					$idx = $v->smi_idx; 
					$list[$x]["namelname"] = $v->namelname; 
					$list[$x]["moreinfo"][] = $db_team->get($idx);
					$x++;
				}

				$x = 0;
				$w = array();
				$w2 = array();
				$w3 = array();
				$list = array_reverse($list,true);
				foreach ($list as $v) {	
					if(!in_array($v["moreinfo"][0][0], $w)){
						echo '<div class="text_formats" style="width:100%; float:left">
							<label>'.$v["moreinfo"][0][0].'</label>
						</div>';
					}

					foreach($list as $v2){
						if(!in_array($v2["namelname"], $w2)){
							if($v2["moreinfo"][0][0]!=$v["moreinfo"][0][0]){ continue; }
							$w3[] = '<div class="col-sm-4 col-md-3 col-xs-6" style="margin-bottom:20px; padding:0px 5px 0 0">
								<div class="name"><i style="color:#244396;" class="geofontCaps">'.$v2["namelname"].'</i></div>
								<div class="work_position">'.$v2["moreinfo"][0][1].'</div>
							</div>';
						}
						$w2[] = $v2["namelname"]; 
					}
					$w3 = array_reverse($w3); 
					foreach ($w3 as $value) {
						echo $value;
					}
					unset($w3); 
					$w3 = array();
					$w[] = $v["moreinfo"][0][0]; 
					$x++;
				}
				?>
		
		 
				
	</div>
</div>
<?php @include("parts/footer.php"); ?>