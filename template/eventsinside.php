<?php @include("parts/header.php"); ?>
<?php @include("parts/eventregister.php"); ?>

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
			$first = $data["eventsinside_general"];
			if(!empty($first[0]->title)) :
		?>
		<div class="page_title_3">
			<?=$first[0]->title?>
			<div class="icons">
				<div id="u" data-lang="<?=LANG?>" style="position:absolute; top:-1000px; text-indent:-9999px"><?=url_controll::current_link()?></div>
				<div class="share"></div>
				<div class="print"></div>
			</div>
		</div>


		
		<div class="row" id="event_div">
			<div class="col-sm-4" id="event_image">
				<img src="<?=WEBSITE?>image?f=<?=WEBSITE.$first[0]->pic?>&amp;w=270&amp;h=130" class="img-responsive" alt="" style="width:100%" />
			</div>
			<div class="col-sm-4 event_line_bg">
				<div class="yellow_title">When:</div>
				<div class="text_formats_blue">
					Start <?=date("d M Y G:i",$first[0]->date)?>
					<?php if($first[0]->date!=$first[0]->expiredate) : ?>
					<br />
					End <?=date("d M Y G:i",$first[0]->expiredate)?>
					<?php endif; ?>
				</div><br />
				<div class="yellow_title">Place:</div>
				<div class="text_formats_blue">
					<?=$first[0]->event_fee?>	
				</div>
				<div class="yellow_title">Booth N:</div>
				<div class="text_formats_blue">
					<?=$first[0]->event_booth?>
				</div>
			</div>
			<div class="col-sm-4 event_line_bg">
				<div class="yellow_title">Venue:</div>
				<div class="text_formats_blue">
					<?=$first[0]->event_desc?>
				</div><br />
				<div class="yellow_title">Web page:</div>
				<div class="text_formats_blue">
					<a href="<?=$first[0]->event_website?>" target="_blank"><?=$first[0]->event_website?></a>
				</div>
			</div>			
		</div>

		
		<div class="text_formats">
			<p><?=$first[0]->short_description?></p>
		</div> 

		<div style="clear:both"></div>
		<div class="event_prog" style="margin:0">
			<div class="title" style="padding:10px 0;">Participants</div>
			<?=$first[0]->long_description?>
		</div>
		<?php if($first[0]->date > time()) : ?>
		<div class="btn btn-yellow eventRegister" data-homepage="false" data-eventid="<?=$first[0]->idx?>" style="margin-top:30px;">REGISTER FOR  THIS EVENT</div>
		<?php endif; ?>

		<hr class="line_effect">
		
		<div class="page_title_4">Events Schedule</div>
		<?php 
		$other = array_slice($data["event_list"], 0, 8); 
		?>
		<div class="row" id="events_items">

			<?php 
			$ctext = new ctext();
			foreach($other as $val) : 
				$old = ($val["expiredate"] < time()) ? ' oldeventitem' : '';
				$bw = ($val["expiredate"] < time()) ? '&amp;bw=1' : '';
			?>
			<div class="col-sm-4 col-md-3 col-xs-4 event_item<?=$old?>">
				<a href="<?=WEBSITE.LANG?>/<?=$val["slug"]?>">
					<div class="date"><?=date("d M Y",$val["date"])?></div>
					<div class="image"><img src="<?=WEBSITE?>image?f=<?=WEBSITE.$val["pic"]?>&amp;w=270&amp;h=130<?=$bw?>" class="img-responsive" alt="" /></div>
					<div class="text">
						<b><?=$ctext->cut($val["title"],30)?></b>
						<p class="booth">Booth N: <?=$ctext->cut($val["event_booth"],50)?></p>
					</div>
				</a>	
			</div>
			<?php endforeach; ?>
			<?php if($data["count"]>9) :?>
			<div style="clear:both"></div>
			<div class="appends"></div>
			<div style="clear:both"></div>
			<div class="loader">Please wait...</div>
			<a href="javascript:;" class="gray_link loadmore" data-type="eventslist"  data-from="8" data-load="10">Load more »</a>
			<?php endif; ?>
		</div>


		<?php endif; ?>

	</div>
</div>

<?php @include("parts/footer.php"); ?>