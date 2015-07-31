<?php 
	@include("parts/header.php"); 
	@include("parts/contactuser.php"); 
?>


<div class="container">
	<div class="breadcrumbs">
		<div class="your_are_here">Your are here: </div>
			<li><a href="<?=WEBSITE.LANG?>/export-catalog">Export Catalog</a></li><li>  &gt;  
			</li><li><a href="javascript:;"><?=$data["fetch"]["namelname"]?></a></li><li>  
	</li></div>
	
	<div class="back_to"><a href="<?=WEBSITE.LANG?>/export-catalog">Back to catalog</a></div>
	
	<div class="page_title_5">
		<?=$data["fetch"]["namelname"]?>
		<div class="image">
			<?php
				$logo = (!empty($data["fetch"]["picture"])) ? WEBSITE.'image?f='.WEBSITE.'files/usersimage/'.$data["fetch"]["picture"].'&w=80&h=40' : TEMPLATE.'img/noimage.png';
			?>
			<img src="<?=$logo?>" alt="" />
		</div>
	</div>
	
</div>



<div class="container" id="container">
	<div class="col-sm-3" id="sidebar">
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
			<li class="text_formats"><span>Products</span></li>
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
		<ul class="text_formats_ul">
			<li class="text_formats"><span>Production Capasity</span></li>
			<li class="text_formats"><?=htmlentities(strip_tags($data["fetch"]["production_capacity"]))?></li>
		</ul>
		<ul class="text_formats_ul">
			<li class="text_formats"><span>Established In</span></li>
			<li class="text_formats"><?=htmlentities(strip_tags($data["fetch"]["established_in"]))?></li>
		</ul>
		<ul class="text_formats_ul">
			<li class="text_formats"><span>Number Of Employes</span></li>
			<li class="text_formats"><?=htmlentities(strip_tags($data["fetch"]["number_of_employes"]))?></li>
		</ul>
		<ul class="text_formats_ul contact_text">
			<li class="text_formats"><span>Contact Details</span></li>
			<!-- <li class="text_formats">Reg. no.11544988</li> -->
			<li class="text_formats">Address: <?=htmlentities(strip_tags($data["fetch"]["address"]))?></li>
			<li class="text_formats">Mobile number: <?=htmlentities(strip_tags($data["fetch"]["mobile"]))?></li>
			<li class="text_formats">Office phone: <?=htmlentities(strip_tags($data["fetch"]["office_phone"]))?></li>
			<li class="text_formats">E-mail: <?=strip_tags($data["fetch"]["email"])?></li>
			<li class="text_formats">Web: <?=strip_tags($data["fetch"]["web_address"])?></li>
		</ul>
		<div class="btn btn-yellow btn-block contact_btn" data-toggle="modal" data-target="#page_enquires_popup">CONTACT</div>
	</div>
	<div class="col-sm-9" id="content">
		<ul class="text_formats_ul">
			<li class="text_formats"><span>About</span></li>
			<li class="text_formats">
				<?=nl2br(strip_tags($data["fetch"]["about"]))?>
			</li>
		</ul>	
		<div class="yellow_title_19">Products</div>
		
		<div class="product_more_item">
			<div class="products white_bg">
				<div class="col-sm-12 col-md-12 col-xs-12 col-gl-12 product_item">
					<div class="col-sm-12 col-md-3 col-xs-12 col-lg-3 padding_0">
						<div class="image"><img src="<?=TEMPLATE?>img/bagration_2.jpg" class="img-responsive" alt="" /></div>
					</div>	
					<div class="col-sm-12 col-md-7 col-xs-12 col-gl-7 product_info padding_0">
						<ul>
							<li><span>Bagratini - sparckling wine</span> - HS 023393920 </li>
							<li><span>Packiging: </span>075, crystal dark bottles (6 in box)</li>
							<li><span>Shelf life: </span>12 years </li>
							<li><span>Awards: </span>Golden medal of European wina accossiation</li>
							<li>Silver medal of UK</li>
							<li>Bronze  medal of European wina accossiation</li>
							<li style="margin-top:15px;"><a href="#">View describtion</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php @include("parts/footer.php"); ?>