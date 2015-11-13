<?php 
	@include("parts/header.php"); 
	@include("parts/contactuser.php"); 
	@include("parts/readmore.php"); 
?>


<div class="container">
	<div class="breadcrumbs">
		<div class="your_are_here">Your are here: </div>
			<li>
				<a href="<?=WEBSITE.LANG?>/<?=(isset($_GET["t"]) && ($_GET["t"]=="individual" || $_GET["t"]=="company")) ? 'business-portal' : 'export-catalog'?>">
					<?=(isset($_GET["t"]) && ($_GET["t"]=="individual" || $_GET["t"]=="company")) ? 'Bussiness portal' : 'Export Catalog'?>
				</a>
			</li>
			<li>  &gt;  </li>
			<li>
				<a href="javascript:;">
					<?=$data["fetch"]["namelname"]?>
				</a>
			</li>
		</div>
	
	<div class="back_to"><a href="<?=WEBSITE.LANG?>/<?=(isset($_GET["t"]) && ($_GET["t"]=="individual" || $_GET["t"]=="company")) ? 'business-portal' : 'export-catalog'?>"><?=(isset($_GET["t"]) && ($_GET["t"]=="individual" || $_GET["t"]=="company")) ? 'Back to bussiness portal' : 'Back to catalog'?></a></div>
	
	<div class="page_title_5">
		<?=$data["fetch"]["namelname"]?>
		<?php
		if($data["get_type"]=="manufacturer" || $data["get_type"]=="serviceprovider") :
			$logo = (!empty($data["fetch"]["picture"])) ? WEBSITE.'image?f='.WEBSITE.'files/usersimage/'.$data["fetch"]["picture"].'&w=80&h=40' : TEMPLATE.'img/noimage.png';
		?>
		<div class="image">
			<img src="<?=$logo?>" alt="" />
		</div>
		<?php endif; ?>
	</div>
	
</div>



<div class="container" id="container">
	<div class="col-sm-3" id="sidebar">
		<?php if($data["get_type"]=="manufacturer" || $data["get_type"]=="serviceprovider") : ?>
		<ul class="text_formats_ul">
			<li class="text_formats"><span>Sector</span></li>
			<li class="text_formats">
				<?=$retrieve_users_info->retrieveDb($data["fetch"]["sector_id"])?>
			</li>
		</ul>
		<ul class="text_formats_ul">
			<li class="text_formats"><span>Sub sector</span></li>
			<li class="text_formats">
				<?=$retrieve_users_info->retrieveDb($data["fetch"]["sub_sector_id"])?>
			</li>
		</ul>
		<ul class="text_formats_ul">
			<li class="text_formats"><span>Activity</span></li>
			<li class="text_formats">
				<?=$retrieve_users_info->retrieveDb($data["fetch"]["products"])?>
			</li>
		</ul>
		<ul class="text_formats_ul">
			<li class="text_formats"><span>Export Markets</span></li>
			<li class="text_formats">
				<?=$retrieve_users_info->retrieveDb($data["fetch"]["export_markets_id"])?>
			</li>
		</ul>
		<ul class="text_formats_ul">
			<li class="text_formats"><span>Certificates</span></li>
			<li class="text_formats">
				<?=$retrieve_users_info->retrieveDb($data["fetch"]["certificates"])?>
			</li>
		</ul>
		<!-- <ul class="text_formats_ul">
			<li class="text_formats"><span>Production Capasity</span></li>
			<li class="text_formats"><?=htmlentities(strip_tags($data["fetch"]["production_capacity"]))?></li>
		</ul> -->
		<ul class="text_formats_ul">
			<li class="text_formats"><span>Founded</span></li>
			<li class="text_formats"><?=htmlentities(strip_tags($data["fetch"]["established_in"]))?></li>
		</ul>
		<ul class="text_formats_ul">
			<li class="text_formats"><span>Number Of Employes</span></li>
			<li class="text_formats"><?=htmlentities(strip_tags($data["fetch"]["number_of_employes"]))?></li>
		</ul>
		<?php if($data["get_type"]=="manufacturer" && $data["fetch"]["ad_upload_catalog"]) : ?>
		<ul class="text_formats_ul">
			<li class="text_formats"><span>Uploaded Catalogue</span></li>
			<li class="text_formats"><a href="<?=WEBSITE?>files/document/<?=$data["fetch"]["ad_upload_catalog"]?>" target="_blank">View Catalogue</a></li>
		</ul>
		<?php endif; ?>
		
		<?php endif; ?>

		<ul class="text_formats_ul contact_text <?=($data["get_type"]!="manufacturer" && $data["get_type"]!="serviceprovider") ? 'single_contact' : ''?>">
			<li class="text_formats"><span>Contact Details</span></li>
			<!-- <li class="text_formats">Reg. no.11544988</li> -->
			<li class="text_formats"><b>Address:</b> <?=htmlentities(strip_tags($data["fetch"]["address"]))?></li>
			<?php if($_GET['t']!="individual") : ?>
			<li class="text_formats"><b>Office phone:</b> <?=htmlentities(strip_tags($data["fetch"]["office_phone"]))?></li>
			<?php endif; ?>
			
			<?php if($_GET['t']=="individual") : ?>
			<li class="text_formats"><b>Mobile Number:</b> <?=strip_tags($data["fetch"]["mobile"])?></li>
			<?php endif; ?>
			<li class="text_formats"><b>E-mail:</b> <a href="mailto:<?=strip_tags($data["fetch"]["email"])?>"><script>document.write('<?=strip_tags($data["fetch"]["email"])?>')</script></a></li>
			<?php
			if($data["fetch"]["web_address"]):
			$without = str_replace(array("http://","www."),array('',''),$data["fetch"]["web_address"]);
			?>
			<li class="text_formats"><b>Web:</b> <a href="http://<?=$without?>" target="_blank">www.<?=$without?></a></li>
		    <?php endif; ?>
			<li class="text_formats">&nbsp;</li>
			<?php if($_GET['t']!="individual") : ?>
			<li class="text_formats"><b>Contact person 1</b></li>
			<li class="text_formats"><b>Person:</b> <?=strip_tags($data["fetch"]["contact_person"])?></li>
			<li class="text_formats"><b>Position:</b> <?=strip_tags($data["fetch"]["ad_position1"])?></li>
			<li class="text_formats"><b>Mobile Number:</b> <?=strip_tags($data["fetch"]["mobile"])?></li>
			<li class="text_formats"><b>Email:</b> <?=strip_tags($data["fetch"]["ad_email1"])?></li>
			<li class="text_formats">&nbsp;</li>
			<li class="text_formats"><b>Contact person 2</b></li>
			<li class="text_formats"><b>Person:</b> <?=strip_tags($data["fetch"]["ad_person2"])?></li>
			<li class="text_formats"><b>Position:</b> <?=strip_tags($data["fetch"]["ad_position2"])?></li>
			<li class="text_formats"><b>Mobile Number:</b> <?=strip_tags($data["fetch"]["ad_mobile2"])?></li>
			<li class="text_formats"><b>Email:</b> <?=strip_tags($data["fetch"]["ad_email2"])?></li>
			<?php endif; ?>
		</ul>



		<div class="btn btn-yellow btn-block contact_btn" data-toggle="modal" data-target="#page_enquires_popup">CONTACT</div>
	</div>
	<div class="col-sm-9" id="content">
		<?php if($data["get_type"]=="manufacturer") : ?>
			<ul class="text_formats_ul">
				<li class="text_formats"><span>Company description</span></li>
				<li class="text_formats">
					<?=nl2br(strip_tags($data["fetch"]["about"]))?>
				</li>
			</ul>	
			<?php if(is_array($data["userstatements"])) { ?>
			<div class="yellow_title_19">Product</div>
			<div class="product_more_item">
				<div class="products white_bg">
					
					<?php 
					foreach($data["userstatements"] as $val) : 
					?>
						<div class="col-sm-12 col-md-12 col-xs-12 col-gl-12 product_item" style="margin-bottom:10px;">
							<div class="col-sm-12 col-md-3 col-xs-12 col-lg-3 padding_0">
								<?php
								$picture = ($val["picture"]) ? WEBSITE.'image?f='.WEBSITE.'files/usersproducts/'.$val["picture"].'&w=175&h=175' : '';
								?>
								<div class="image"><img src="<?=$picture?>" class="img-responsive" alt="" /></div>
							</div>	
							<div class="col-sm-12 col-md-7 col-xs-12 col-gl-7 product_info padding_0">
								<ul>
									<li><span><?=$val["title"]?></span> - HS <?=$val["hscode"]?> </li>
									<li><span>Packiging: </span><?=$val["packaging"]?></li>
									<li><span>Shelf life: </span><?=$val["shelf_life"]?> </li>
									<li><span>Awards: </span><?=$val["awards"]?></li>
									<li style="margin-top:15px;"><a href="javascript:;" class="readmore" data-pid="<?=$val["id"]?>">View describtion</a></li>
								</ul>
							</div>
						</div>
					<?php 
					endforeach; 
					?>
					<div style="clear:both"></div>
					<div class="appends"></div>
					<div style="clear:both"></div>
					<div class="loader">Please wait...</div>
					<a href="javascript:;" class="gray_link loadmore" data-type="userspagemanufacturer"  data-from="5" data-load="10">Load more »</a>


				</div>
			</div>
		<?php } endif; ?>


		<?php if($data["get_type"]=="serviceprovider") : ?>
			<ul class="text_formats_ul">
				<li class="text_formats"><span>About</span></li>
				<li class="text_formats">
					<?=nl2br(strip_tags($data["fetch"]["about"]))?>
				</li>
			</ul>
			<?php if($data["userstatements"]) { ?>	
			<div class="yellow_title_19">Services</div>
			<?php 
			$retrieve_users_info = new retrieve_users_info();
			foreach($data["userstatements"] as $val) : 
				$p = $retrieve_users_info->retrieveDb($val["products"]); 
			?>
			<div class="service_box readmore" data-pid="<?=$val["id"]?>" style="cursor:pointer">
				<ul class="text_formats_ul">
					<li class="text_formats"><span>Activity: <?=$p?></span></li>
					<li class="text_formats"><span><?=$val["title"]?></span></li>
					<li class="text_formats">
						<p><?=strip_tags($val["long_description"])?></p>
					</li>
				</ul>
			</div>
		<?php 
			endforeach; 
			?>
			<div style="clear:both"></div>
			<div class="appends"></div>
			<div style="clear:both"></div>
			<div class="loader">Please wait...</div>
			<a href="javascript:;" class="gray_link loadmore" data-type="userspageserviceprovider"  data-from="5" data-load="10">Load more »</a>
			<?php
			} 
		endif; 
		?>

		<?php if($data["get_type"]=="company" || $data["get_type"]=="individual") : ?>

			<?php 
			if(is_array($data["userstatements"])){
				$first = array_slice($data["userstatements"],0,1);
				$others = array_slice($data["userstatements"],1,4);
			}
			?>

			<div class="enquire enquire_small no_border readmore" data-pid="<?=$first[0]["id"]?>" style="cursor:pointer">
				<div class="date"><?=date("d.m.Y",$first[0]["date"])?></div>
				<div class="col-sm-12" style="float:none;">
					<div class="title">
						<?=$first[0]["title"]?>
					</div>
					<div class="text">
						<?=$first[0]["long_description"]?>
						<small><?=$first[0]["type"]?></small>
					</div>
				</div>	 
			</div>
				
			<div class="yellow_title_19">Previous adds</div>
			<?php
			foreach ($others as $val) :
			?>
			<div class="enquire enquire_small readmore" data-pid="<?=$val["id"]?>" style="cursor:pointer">
				<div class="date"><?=date("d.m.Y",$val["date"])?></div>
				<div class="col-sm-12" style="float:none;">
					<div class="title">
						<?=$val["title"]?>
					</div>
					<div class="text">
						<?=$val["long_description"]?>
						<small><?=$val["type"]?></small>
					</div>
				</div>	 
			</div> 
			<?php endforeach; ?>
			<div style="clear:both"></div>
			<div class="appends"></div>
			<div style="clear:both"></div>
			<div class="loader">Please wait...</div>
			<a href="javascript:;" class="gray_link loadmore" data-type="userspageenquires"  data-from="5" data-load="10">Load more »</a>
		<?php endif; ?>



	</div>
</div>
<script type="text/javascript" charset="utf-8">
$(document).ready(function(){
	var par = urlParamiters();
	if(par["i"] && par["p"]){
		getReadmoreInfo(par["i"],par["p"]);
	}
});
</script>
<?php @include("parts/footer.php"); ?>