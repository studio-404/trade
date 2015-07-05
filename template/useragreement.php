<?php 
	@include("parts/header.php"); 
?>
<div class="container" id="container" style="min-height:350px;">
		<div class="page_title_2">
			<?=$data["text_general"][0]["title"]?>
		</div>
		<div class="text_formats">
		<?php
		$first = array_slice($data["text_files"], 0, 1);
		//$others = array_slice($data["text_files"], 1);
		if($first[0]->file){
		?>
		<img src="<?=IMG?>ajax-loader.gif" class="img-responsive" alt="" id="mainimage" data-mainimage="<?=WEBSITE?>image?f=<?=WEBSITE.$first[0]->file?>&w=377&h=235" />		
		<?php } ?>
		<?=$data["text_general"][0]["text"]?>
		</div>
		<div style="clear:both"></div>
		<?php if(count($data["text_documents"]) > 0) : ?>
		<hr class="line_effect" />

		<div class="page_title_2">
			<?=$data["language_data"]["attachedfiles"]?>
		</div>
		<div class="text_formats">
			<p>If you want to find out more about trading statistics with Georgia, Please download the following brochure documents.</p>
		</div>
		<?php
		foreach($data["text_documents"] as $val){ 
			$ext = explode(".",$val->file);
			$ext = end($ext);
			$ext = strtoupper($ext);
		?>
			<a href="<?=WEBSITE.$val->file?>" target="_blank" style="text-decoration:none">
				<div class="attachment_div">
					<div class="attach_img">
						<img src="<?=TEMPLATE?>img/pdf.png" alt="" />
					</div>
					<div class="attach_info">
						<ul>
							<li><?=$data["language_data"]["documenttype"]?>: <?=$ext?></li>
							<li><?=$data["language_data"]["documentname"]?>: <?=$val->title?></li>
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
<?php @include("parts/footer.php"); ?>