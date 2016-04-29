<?php 
	@include("parts/header.php"); 
?>
<div class="container" id="container">
	<div class="col-sm-3" id="sidebar">
		<div class="sidebar_menu">
			<ul>
				<?=$data["left_menu"]?>
			</ul>
		</div>
	</div>

	<div class="col-sm-9" id="content">
		<!-- <div class="page_title_2">
			Our Team
		</div> 
		<div class="row contact_person">
			<?php
			$db_team = new db_team();
			foreach($data["hidden_team_list"] as $val) : 
				$moreinfo = $db_team->get($val["smi_idx"]);
			?>
			<div class="col-sm-4 col-md-3 col-xs-4">
				<div class="name"><?=$val["namelname"]?></div>
				<div class="work_position"><?=$moreinfo["Position"]?></div>
				<div class="email"><script>document.write("<?=$moreinfo["email"]?>")</script></div>
			</div>
		<?php endforeach; ?>
		</div>-->
		
		<div class="page_title_2">
			Contact Details
		</div>
		<div class="contact_details">
			<ul>
				<li class="text_formats"><span><?=$data["contact_data"][0]["city"]?></span></li>
				<li class="text_formats p100">
					<p>Address: <?=$data["contact_data"][0]["address"]?></p>
					<p>Hotline: <?=$data["contact_data"][0]["phone"]?></p>
					<p>E-mail: <?=$data["contact_data"][0]["email"]?></p>					
				</li>
			</ul>
		</div>
		
		<div class="page_title_2">
			Find Us On A Map
		</div>
		
		<div class="row col-sm-12">
			<iframe src="<?=$data["contact_data"][0]["iframemap"]?>" width="100%" height="250" style="border:0; margin:0;"></iframe>
		</div>
		
	</div>

</div>
<?php @include("parts/footer.php"); ?>