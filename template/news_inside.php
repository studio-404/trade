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
			<?php 
			echo $data["language_data"]["newsheader"]; 
			?>
		</div>
		 
		<div class="page_title_3">
			<div class="row">
				<div class="col-sm-10 padding_0"><?=$data["news_general"][0]["title"]?></div>
				<div class="col-sm-2 padding_0">
					<div class="icons">
						<div class="share"></div>
						<div class="print"></div>
					</div>
				</div>
			</div>			
		</div>
	
		<div class="news_date">
			<?=date("d",$data["news_general"][0]["date"])." ".$data["language_data"][date("M",$data["news_general"][0]["date"])]." ".date("Y",$data["news_general"][0]["date"])?>
		</div>
		
		<hr class="line_effect"/>
		
		<div class="text_formats">
			
		<?php
		$first = array_slice($data["news_files"], 0, 1);
		//$others = array_slice($data["text_files"], 1);
		if($first[0]->file){
		?>
		<img src="<?=IMG?>ajax-loader.gif" class="img-responsive" id="mainimage" data-mainimage="<?=WEBSITE?>image?f=<?=WEBSITE.$first[0]->file?>&w=377&h=235" />		
		<?php } ?>
		<?=$data["news_general"][0]["long_description"]?> 
		</div>
		<div style="clear:both"></div>
		<?php if(count($data["news_documents"]) > 0) : ?>
		<hr class="line_effect" />
		<div class="page_title_4">
			<?=$data["language_data"]["attachedfiles"]?>
		</div>
		<?php
		foreach($data["news_documents"] as $val){ 
			$ext = explode(".",$val->file);
			$ext = end($ext);
			$ext = strtoupper($ext);
		?>
			<a href="<?=WEBSITE.$val->file?>" target="_blank" style="text-decoration:none">
			<div class="attachment_div">
				<div class="attach_img"><img src="<?=TEMPLATE?>img/document.png"></div>
				<div class="attach_info">
					<ul>
						<!-- <li><?=$data["language_data"]["documenttype"]?>: <?=$ext?></li>
						<li><?=$data["language_data"]["documentname"]?>: <?=$val->title?></li>
						<li><?=$data["language_data"]["date"]?>: <?=date("d.m.Y",$val->date)?></li> -->
						<li><?=$val->title?></li>
						<li><?=$data["language_data"]["date"]?>: <?=date("d.m.Y",$val->date)?></li>
					</ul>
				</div>
			</div>
			</a><br />
		<?php 
		} 
		endif;
		?>
		
	</div>
</div>
<?php @include("parts/footer.php"); ?>