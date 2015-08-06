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
		<div class="page_title_2"><?=$data["language_data"]["latestnews"]?></div>
		<br>
		<div class="page_title_3">
			<div class="date"><span><?=date("d",$data["news_general"][0]["date"])?></span> <?=date("M",$data["news_general"][0]["date"])?></div>
			<?=$data["news_general"][0]["title"]?>
			<div class="icons">
				<div id="u" data-lang="<?=LANG?>" style="position:absolute; top:-1000px; text-indent:-9999px"><?=url_controll::current_link()?></div>
				<div class="share"></div>
				<div class="print"></div>
			</div>
		</div>
		
		<div class="text_formats margin_top_20">
			<?php if(!empty($data["news_general"][0]["pic"])) : ?>
				<img src="<?=WEBSITE?>image?f=<?=WEBSITE.$data["news_general"][0]["pic"]?>&amp;w=270&amp;h=130" class="img-responsive" alt="" />
			<?php endif;?>

			<?=$data["news_general"][0]["long_description"]?>
		</div>
		
		<hr class="line_effect hr_margin">
		
		<div class="page_title_4">Other News</div>
		
		<div class="row news_div">
			<?php
			// echo "<pre>";
			// print_r($data["news_list"]);  
			// echo "</pre>"; 
			$itemperpage = 10;
			$path = WEBSITE.LANG."/".$data["text_general"][0]["slug"]; 
			$model_template_pagination = new model_template_pagination();
			$news_list = array_slice($data["news_list"],0,8);
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
			<?php if($data["count"]>9) : ?>
			<div style="clear:both"></div>
			<div class="appends"></div>
			<div style="clear:both"></div>
			<div class="loader">Please wait...</div>
			<a href="javascript:;" class="gray_link loadmore" data-type="newslist"  data-from="9" data-load="10">Load more »</a>
			<?php endif; ?>
		</div>
		
		<!-- <a href="#" class="gray_link"><?=$data["language_data"]["viewmorenews"]?> »</a> -->
		
	</div>
</div>
<?php @include("parts/footer.php"); ?>