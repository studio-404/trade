<?php @include("parts/header.php"); ?>
<?php @include("parts/eventregister.php"); ?>

<?php 
// echo "<pre>";
// print_r($data["event_list"]);  
// echo "</pre>"; 
$first = array_slice($data["event_list"], 0, 1); 
// echo "<pre>";
// print_r($first);  
// echo "</pre>"; 
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
		<div class="page_title_3">
			<?=$first[0]["title"]?>
			<div class="icons">
				<div class="share"></div>
				<div class="print"></div>
			</div>
		</div>	
		
		<div class="row" id="event_div">
			<div class="col-sm-4">
				<img src="<?=WEBSITE?>image?f=<?=WEBSITE.$first[0]["pic"]?>&amp;w=270&amp;h=130" class="img-responsive">
			</div>
			<div class="col-sm-4 event_line_bg">
				<div class="yellow_title">When:</div>
				<div class="text_formats_blue">
					<?=$first[0]["event_when"]?>	
				</div>
				<div class="yellow_title">Fee:</div>
				<div class="text_formats_blue">
					<?=$first[0]["event_fee"]?>
				</div>
			</div>
			<div class="col-sm-4 event_line_bg">
				<div class="yellow_title">Venue:</div>
				<div class="text_formats_blue">
					<?=$first[0]["event_desc"]?>	
				</div>
				<div class="yellow_title">Website:</div>
				<div class="text_formats_blue">
					<?=$first[0]["event_website"]?>	
				</div>
			</div>			
		</div>
		
		<div class="text_formats">
			<?=$first[0]["short_description"]?>
		</div>
		
		<div class="event_prog">
			<div class="title">Programme</div>
			<?=$first[0]["long_description"]?>
		</div>
		
		<div class="btn btn-yellow eventRegister" data-eventid="<?=$first[0]["idx"]?>" style="margin-top:30px;">REGISTER FOR  THIS EVENT</div>
		
		<hr class="line_effect">
		
		<div class="page_title_4">Events Schedule</div>
		<?php 
		$other = array_slice($data["event_list"], 1); 
		?>
		<div class="row" id="events_items">

			<?php 
			$ctext = new ctext();
			foreach($other as $val) : ?>
			<div class="col-sm-4 col-md-3 col-xs-4 event_item">
				<a href="<?=WEBSITE.LANG?>/<?=$val["slug"]?>">
					<div class="date"><?=date("d M",$val["date"])?></div>
					<div class="image"><img src="<?=WEBSITE?>image?f=<?=WEBSITE.$val["pic"]?>&amp;w=270&amp;h=130" class="img-responsive" alt="" /></div>
					<div class="text"><?=$ctext->cut($val["title"],30)?></div>
				</a>	
			</div>
			<?php endforeach; ?>
			<div class="appends"></div>
			<div style="clear:both"></div>
			<div class="loader">Please wait...</div>
			<a href="javascript:;" class="gray_link loadmore" data-type="eventslist"  data-from="10" data-load="10">Load more »</a>
			
		</div>
		
		<!-- <a href="#" class="gray_link">Load Older Events »</a> -->
		
	</div>
</div>
<?php @include("parts/footer.php"); ?>