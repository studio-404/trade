<?php 
	@include("parts/header.php"); 
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
		<div class="row">
			 <div class="useful_div">
				<?php 
				$ctext = new ctext();
				foreach($data["components"] as $val)
				{
					if($val->com_name != "usefull links"){ continue; }
				?>
					<a href="<?=$val->url?>" target="_blank" title="<?=htmlentities($val->title)?>">
						<div class="col-sm-4 useful_item">
							<div class="image"><img src="<?=WEBSITE?>image?f=<?=WEBSITE_.$val->image?>&w=215&h=80" /></div>
							<div class="title" style="max-height:60px"><?=$ctext->cut(strip_tags($val->title),110)?> »</div>
						</div>
					</a>
				<?php
				}
				?>
			 </div>
		</div>
	</div>


	


</div>
<?php @include("parts/footer.php"); ?>