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
			echo $data["text_general"][0]["title"]; 
			?>
		</div>


		<?php
		$news_first = array_slice($data["news_list"],0,1);
		// echo "<pre>";
		// print_r($news_first);
		// echo "</pre>";
		?>
		<div class="page_title_3">
			<div class="row">
				<div class="col-sm-10 padding_0"><?=$news_first[0]->title?></div>
				<div class="col-sm-2 padding_0">
					<div class="icons">
						<div class="share"></div>
						<div class="print"></div>
					</div>
				</div>
			</div>			
		</div>
	
		<div class="news_date"><?=date("d",$news_first[0]->date)." ".$data["language_data"][date("M",$news_first[0]->date)]." ".date("Y",$news_first[0]->date)?></div>
		
		<hr class="line_effect"/>
		
		<div class="text_formats">
			<?php
			$first = array_slice($data["last_news_files"], 0, 1);
			//$others = array_slice($data["text_files"], 1);
			if($first[0]->file){
			?>
			<img src="<?=IMG?>ajax-loader.gif" class="img-responsive" id="mainimage" data-mainimage="<?=WEBSITE?>image?f=<?=WEBSITE.$first[0]->file?>&w=377&h=235" />		
			<?php } ?>
			<?=$news_first[0]->long_description?>
		</div>

		<hr class="line_effect"/>
		<div class="text_formats">
			<label><?=$data["language_data"]["othernews"]?></label>
		</div>
		<div class="news_lists">
			<ul>
			<?php
			$itemperpage = 10;
			$path = WEBSITE.LANG."/".$data["text_general"][0]["slug"]; 
			$model_template_pagination = new model_template_pagination();
			$news_list = array_slice($data["news_list"],1);
			$newslist = $model_template_pagination->pager($news_list,$itemperpage,$path);
			$ctext = new ctext();
			if(LANG=="ge"){
				$news_title_number = 65;
			}else{
				$news_title_number = 65;
			}
			foreach ($newslist[0] as $val) {
			?>
				<li style="content:''; padding:0; "><a href="<?=WEBSITE.LANG.'/'.$val->slug?>"><div class="news_date"><?=date("d",$val->date)." ".$data["language_data"][date("M",$val->date)]." ".date("Y",$val->date)?></div><?=$ctext->cut(strip_tags($val->title),$news_title_number)?></a></li>
			<?php
			}
			?>
			</ul>
		</div>

		
		<div class="text-right">		
			<ul class="navigation">
				<?=$newslist[1]?>
			</ul>
		</div>	
		
	</div>
</div>
<?php @include("parts/footer.php"); ?>