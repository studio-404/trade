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
			<?=$data["text_general"][0]["title"]?>
		</div>
		 
		<div class="text_formats">
			<label><?=$data["text_general"][0]["shorttitle"]?></label>
		</div>
	 
		 
		
		<div class="text_formats">
		<?php
		$first = array_slice($data["text_files"], 0, 1);
		//$others = array_slice($data["text_files"], 1);
		if($first[0]->file){
		?>
		<img src="<?=WEBSITE.$first[0]->file?>" class="img-responsive" />		
		<?php } ?>
		<?=$data["text_general"][0]["text"]?>
		</div>
		 
		<!-- <div class="about_map_div">
			<small>Map under developer</small>
			<iframe src="<?=WEBSITE?>_plugins/canvas/georgianmap.php" style="margin:0; padding:0; border:0; width:100%; height:460px;"></iframe>
		</div>  -->
		
		 
	
		
	</div>
</div>
<?php @include("parts/footer.php"); ?>