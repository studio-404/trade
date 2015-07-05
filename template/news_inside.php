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
				<div class="share"></div>
				<div class="print"></div>
			</div>
		</div>
		
		<div class="text_formats margin_top_20">
			<img src="<?=WEBSITE?>image?f=<?=WEBSITE.$data["news_general"][0]["pic"]?>&w=270&h=130" class="img-responsive" alt="" />
			<p>
				The Business Excellence (BE) Briefing is suitable for companies &amp; organizations that are new to business excellence, and are interested in finding out how the Revised BE Framework can help strengthen management systems to deliver superior results. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen 
				book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
			</p>
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
		
		<a href="#" class="gray_link">View More News »</a>
		
	</div>
</div>
<?php @include("parts/footer.php"); ?>