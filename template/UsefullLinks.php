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
				$x = 1;
				foreach($data["components"] as $val)
				{
					if($val->com_name != "usefull links"){ continue; }
				?>
					<a href="<?=$val->url?>" target="_blank" title="<?=htmlentities($val->title)?>">
						<div class="col-sm-4 useful_item">
							<div class="image"><img src="<?=WEBSITE?>image?f=<?=WEBSITE_.$val->image?>&amp;w=215&amp;h=80" alt="" /></div>
							<div class="title" style="max-height:60px"><?=$ctext->cut(strip_tags($val->title),110)?> »</div>
						</div>
					</a>
				<?php
					if($x==12){ break; }
					$x++;
				}
				?>
			<div style="clear:both"></div>
			<div class="appends"></div>
			<div style="clear:both"></div>
			<div class="loader" style="padding:0 10px;">Please wait...</div>
			<a href="javascript:;" class="gray_link loadmore" data-type="usefulllinks" data-from="12" data-load="10">Load more »</a>



			 </div>
		</div>
	</div>


	


</div>
<?php @include("parts/footer.php"); ?>