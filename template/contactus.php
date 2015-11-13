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
		<?php
		// echo "<pre>";
		// print_r($data["text_general"]); 
		// echo "</pre>";
		?>
		<div class="contact_details">
			<ul>
				<li class="text_formats"><span>Tbilisi Office</span></li>
				<li class="text_formats p100">
					<?=$data["text_general"][0]["text"]?>
				</li>
				<!-- <li class="text_formats">Tel: +995 32 2 99 10 44; +995 32 2 99 11 28; Fax +995 32 2 99 11 29</li>
				<li class="text_formats">Hotline; +995 32 99 99 99 ; E-mail; info@eda.ge</li> -->
			</ul>
		</div>
		
		<div class="page_title_2">
			Find Us On A Map
		</div>
		
		<div class="row col-sm-12">
			<!-- <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d7098.94326104394!2d78.0430654485247!3d27.172909818538997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2s!4v1385710909804" width="100%" height="150" frameborder="0" style="border:0"></iframe> -->
			<iframe src="https://www.google.com/maps/d/u/1/embed?mid=zdKuQPLdBUUE.keTrYL0PFOaM&amp;z=18" width="100%" height="250" style="border:0; margin:0;"></iframe>
		</div>
		
	</div>

</div>
<?php @include("parts/footer.php"); ?>