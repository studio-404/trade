<?php @include("parts/header.php"); ?>
<div class="container" id="container">
	<div class="col-sm-3" id="sidebar">
		<div class="sidebar_menu">
			<ul>
				<?=$data["left_menu"]?>
			</ul>
		</div>
	</div>
	<div class="col-sm-9" id="content">
		<?php
		$news_first = array_slice($data["news_list"],0,1);
		?>
		<div class="page_title_2"><?=$data["language_data"]["latestnews"]?></div>
		<br>
		<div class="page_title_3">
			<div class="date"><span><?=date("d",$news_first[0]->date)?></span> <?=date("M",$news_first[0]->date)?></div>
			<?=$news_first[0]->title?>
			<div class="icons">
				<div class="share"></div>
				<div class="print"></div>
			</div>
		</div>
		
		<div class="text_formats margin_top_20">
			<img src="<?=WEBSITE?>image?f=<?=WEBSITE.$news_first[0]->pic?>&w=270&h=130" class="img-responsive" alt="" />
			<?=$news_first[0]->long_description?>
		</div>
		
		<hr class="line_effect hr_margin">
		
		<div class="page_title_4"><?=$data["language_data"]["othernews"]?></div>
		
		<div class="row news_div">
			<?php
			$itemperpage = 10;
			$path = WEBSITE.LANG."/".$data["text_general"][0]["slug"]; 
			$model_template_pagination = new model_template_pagination();
			$news_list = array_slice($data["news_list"],1);
			$newslist = $model_template_pagination->pager($news_list,$itemperpage,$path);
			$ctext = new ctext();
			foreach ($newslist[0] as $val) {
			?>

				<div class="col-sm-4 col-md-3 col-xs-4 news_item">
					<a href="<?=WEBSITE.LANG.'/'.$val->slug?>">
						<div class="date"><span><?=date("d",$val->date)?></span> <?=date("M",$val->date)?></div>
						<div class="text">
							<?=$ctext->cut(strip_tags($val->title),55)?>
						</div>
					</a>	
				</div>

			<?php
			}
			?>
		</div>
		
		<a href="#" class="gray_link"><?=$data["language_data"]["viewmorenews"]?> »</a>
		
	</div>
</div>
<?php @include("parts/footer.php"); ?>