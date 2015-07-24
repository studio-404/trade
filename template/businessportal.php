<?php 
	@include("parts/header.php"); 
?>


<?php
//$last_line = system('ls', $retval);
?>

<div class="container" id="container">
	 
	<div class="export_search_div">
		<div class="col-sm-10 padding_0">
			<input type="text" class="form-control" id="svalue" placeholder="Search By Name Or Phrase" value="<?=(Input::method("GET","search")) ? htmlentities(Input::method("GET","search")) : ''?>" />
		</div>
		<div class="col-sm-2 padding_0" style="padding-left:5px;" id="serachMe">
			<button class="btn btn-block btn-sm btn-yellow">SEARCH</button>
		</div>
		<script type="text/javascript"> 
		$(document).on("click","#serachMe",function(){
			var s = $("#svalue").val();
			var u = "http://"+document.domain+"/<?=LANG?>/business-portal?view=<?=$data['get_view']?>&sector=<?=$data['get_sector']?>&search="+s+"&pn=<?=$data['get_pn']?>&token=<?=$_SESSION['token_generator']?>";
			location.href = u;
		});
		</script>
	</div>
	
	
	<div class="export_companies">
		<div class="filters_div">
			<div class="col-sm-8">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					Buy And Sell<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li><a href="?view=buy&amp;type=<?=$data["get_type"]?>&amp;sector=<?=$data["get_sector"]?>&amp;token=<?=$_SESSION["token_generator"]?>">Buy</a></li>
					<li><a href="?view=sell&amp;type=<?=$data["get_type"]?>&amp;sector=<?=$data["get_sector"]?>&amp;token=<?=$_SESSION["token_generator"]?>">Sell</a></li>
				</ul>
			</div>
			<div class="col-sm-2">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					Type <span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li><a href="?view=<?=$data["get_view"]?>&amp;type=company&amp;sector=<?=$data["get_sector"]?>&amp;token=<?=$_SESSION["token_generator"]?>">Companies</a></li>
					<li><a href="?view=<?=$data["get_view"]?>&amp;type=individual&amp;sector=<?=$data["get_sector"]?>&amp;token=<?=$_SESSION["token_generator"]?>">Individuals</a></li>
				</ul>
			</div>
			<div class="col-sm-2">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					Sector <span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<?php foreach($data["sector"] as $val) : ?>
						<li><a href="?view=<?=$data["get_view"]?>&amp;type=<?=$data["get_type"]?>&amp;sector=<?=$val->idx?>&amp;token=<?=$_SESSION["token_generator"]?>"><?=$val->title?></a></li>
					<?php endforeach; ?>
				</ul>				
			</div>
		</div>
		
	
		<div class="filter_content for_enquires">
			<?php foreach($data["fetch"] as $val) : ?>
			<div class="content_divs" style="margin-bottom:38px;">
				<a href="<?=WEBSITE.LANG?>/user?t=<?=$val["su_companytype"]?>&amp;i=<?=$val["users_id"]?>&amp;p=<?=$val["id"]?>&amp;token=<?=$_SESSION["token_generator"]?>">
					<div class="col-sm-8 no-float itemssss" style="text-align:left;">
						<div class="enquire enquire_small no_border">
							<div class="date"><?=date("d.m.Y", $val['date'])?></div>
							<div class="col-sm-12">
								<div class="title">
									<?=strip_tags($val['title'])?>
								</div>
								<div class="text">
									<?=nl2br(strip_tags($val['long_description']))?>
									<small><?=$val['type']?></small>
								</div>
							</div>	 
						</div>
					</div>
				</a>
				<div class="col-sm-2 no-float itemssss">
					<a href="Page_enquires.html"></a><a href="#"><?=$val['users_name']?></a>
				</div>
				<div class="col-sm-2 no-float itemssss"><?=$val['sector_name']?></div>
			</div><div style="clear:both"></div>
		<?php endforeach; ?>
		</div>
	

			
	</div>
	
	
</div>
<?php @include("parts/footer.php"); ?>