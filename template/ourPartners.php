<?php 
	@include("parts/header.php"); 
	$donour_list = array();
	foreach($data["components"] as $val){
		if($val->com_name != "Donour organizations"){ continue; }
		$donour_list[] = $val;
	}
	$top_donours = array_slice($donour_list,0,2);
	$other_donours = array_slice($donour_list,2); 
?>
<div class="container" id="container">
	<div class="page_title_2">
		<?=$data["text_general"][0]["title"]?>
	</div>
	
	<div class="col-sm-12" id="content_full">	
		 
		<div class="text_formats">
			<label><?=$data["language_data"]["donourorganozations"]?></label>
		</div>	 
		  
		<?php
		foreach($top_donours as $val):
		?> 
		<div class="partner_top">
			<div class="col-sm-4">
				<div class="image"><a href="<?=$val->url?>" target="_blank"><img src="<?=WEBSITE?>image?f=<?=WEBSITE_.$val->image?>&w=327&h=124" class="img-responsive"/></a></div>
			</div>
			<div class="col-sm-8">
				<div class="text_formats">
					<li><span><?=$val->title?></span></li>
					<br/>
					<?=$val->desc?>
				</div>
			</div>
		</div>		
		<?php
		endforeach;
		?>
		
		<hr style="margin-bottom:20px;"/> 
		 
		<div class="text_formats">
			<label><?=$data["language_data"]["donourorganozations"]?></label>
		</div>	 
		
		<div class="partners_div">
			<?php
			foreach($other_donours as $val):
			?> 
			<div class="col-sm-4">
				<div class="image"><a href="<?=$val->url?>" target="_blank"><img src="<?=WEBSITE?>image?f=<?=WEBSITE_.$val->image?>&w=327&h=124" class="img-responsive"/></a></div>
			</div>
			<?php
			endforeach; 
			?>
		</div>
		 
				
	</div>
</div>
<?php @include("parts/footer.php"); ?>