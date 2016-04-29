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
				<a href="?t=<?=@$_GET['t']?>&amp;i=<?=@$_GET['i']?>">
					<?=$data["fetch"]["namelname"]?>
				</a>
			</li>
			<?php if(isset($_GET['p'])) : ?>
			<li>  &gt;  </li>
			<li>
				<a href="?t=<?=@$_GET['t']?>&amp;i=<?=@$_GET['i']?>&amp;p=<?=@$_GET['p']?>">
					<?=$data["productinside"]->title?>
				</a>
			</li>
			<?php endif; ?>
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
		<?php
		$outsector = $retrieve_users_info->retrieveDb($data["fetch"]["sector_id"]);
		$outsubsector = $retrieve_users_info->retrieveDb($data["fetch"]["sub_sector_id"]);
		$outproducts = $retrieve_users_info->retrieveDb($data["fetch"]["products"]); 
		$outexporting = $retrieve_users_info->retrieveDb($data["fetch"]["export_markets_id"]);
		$outcertificates = $retrieve_users_info->retrieveDb($data["fetch"]["certificates"]); 
		if($outsector!='') {
		?>
			<ul class="text_formats_ul">
				<li class="text_formats"><span>Sector</span></li>
				<li class="text_formats">
					<?=$outsector?>
				</li>
			</ul>
		<?php 
		}

		if($outsubsector!=''){
		?>
			<ul class="text_formats_ul">
				<li class="text_formats"><span>Sub sector</span></li>
				<li class="text_formats">
					<?=$outsubsector?>
				</li>
			</ul>
		<?php
		}

		if($outproducts!=''){
		?>
			<ul class="text_formats_ul">
				<li class="text_formats"><span>Activity</span></li>
				<li class="text_formats">
					<?=$outproducts?>
				</li>
			</ul>
		<?php
		}

		if($outexporting){
		?>
			<ul class="text_formats_ul">
				<li class="text_formats"><span>Exporting To</span></li>
				<li class="text_formats">
					<?=$outexporting?>
				</li>
			</ul>
		<?php
		}

		if($outcertificates!='') {
		?>
			<ul class="text_formats_ul">
				<li class="text_formats"><span>Certificates</span></li>
				<li class="text_formats">
					<?=$outcertificates?>
				</li>
			</ul>
		<?php
		}

		if($data["fetch"]["established_in"]!=''){
		?>		
			<ul class="text_formats_ul">
				<li class="text_formats"><span>Founded</span></li>
				<li class="text_formats"><?=htmlentities(strip_tags($data["fetch"]["established_in"]))?></li>
			</ul>
		<?php
		}

		if($data["fetch"]["number_of_employes"]!=''){
		?>
			<ul class="text_formats_ul">
				<li class="text_formats"><span>Number Of Employes</span></li>
				<li class="text_formats"><?=htmlentities(strip_tags($data["fetch"]["number_of_employes"]))?></li>
			</ul>
		<?php 
		}
		if($data["fetch"]["ad_upload_catalog"]) : ?>
		<ul class="text_formats_ul">
			<li class="text_formats"><span>Attachment</span></li>
			<li class="text_formats"><a href="<?=WEBSITE?>files/document/<?=$data["fetch"]["ad_upload_catalog"]?>" target="_blank">View Attachment</a></li>
		</ul>
		<?php endif; ?>
		
		<?php endif; ?>

		<ul class="text_formats_ul contact_text <?=($data["get_type"]!="manufacturer" && $data["get_type"]!="serviceprovider") ? 'single_contact' : ''?>">
			<li class="text_formats"><span>Contact Details</span></li>
			<!-- <li class="text_formats">Reg. no.11544988</li> -->
			<?php if($data["fetch"]["address"]!='') : ?>
			<li class="text_formats"><b>Address:</b> <?=htmlentities(strip_tags($data["fetch"]["address"]))?></li>
			<?php endif; ?>

			<?php if($_GET['t']!="individual" && $data["fetch"]["office_phone"]) : ?>
			<li class="text_formats"><b>Office phone:</b> <?=htmlentities(strip_tags($data["fetch"]["office_phone"]))?></li>
			<?php endif; ?>
			
			<?php if($_GET['t']=="individual") : ?>
			<li class="text_formats"><b>Mobile Number:</b> <?=strip_tags($data["fetch"]["mobile"])?></li>
			<?php endif; ?>

			<?php if($data["fetch"]["email"]!='') : ?>
			<li class="text_formats"><b>E-mail:</b> <a href="mailto:<?=strip_tags($data["fetch"]["email"])?>"><script>document.write('<?=strip_tags($data["fetch"]["email"])?>')</script></a></li>
			<?php endif; ?>
			
			<?php
			if($data["fetch"]["web_address"]):
			$without = str_replace(array("http://","www."),array('',''),$data["fetch"]["web_address"]);
			?>
			<li class="text_formats"><b>Web:</b> <a href="http://<?=$without?>" target="_blank">www.<?=$without?></a></li>
		    <?php endif; ?>
			<li class="text_formats">&nbsp;</li>
			<?php if($_GET['t']!="individual" && $data["fetch"]["contact_person"]!="") : ?>
			<li class="text_formats"><b>Contact person 1</b></li>
			<li class="text_formats"><b>Person:</b> <?=strip_tags($data["fetch"]["contact_person"])?></li>
			<li class="text_formats"><b>Position:</b> <?=strip_tags($data["fetch"]["ad_position1"])?></li>
			<li class="text_formats"><b>Mobile Number:</b> <?=strip_tags($data["fetch"]["mobile"])?></li>
			<li class="text_formats"><b>Email:</b> <a href="mailto:<?=strip_tags($data["fetch"]["ad_email1"])?>"><?=strip_tags($data["fetch"]["ad_email1"])?></a></li>
			<?php endif; ?>
			<?php if($_GET['t']!="individual" && $data["fetch"]["ad_person2"]!="") : ?>
			<li class="text_formats">&nbsp;</li>
			<li class="text_formats"><b>Contact person 2</b></li>
			<li class="text_formats"><b>Person:</b> <?=strip_tags($data["fetch"]["ad_person2"])?></li>
			<li class="text_formats"><b>Position:</b> <?=strip_tags($data["fetch"]["ad_position2"])?></li>
			<li class="text_formats"><b>Mobile Number:</b> <?=strip_tags($data["fetch"]["ad_mobile2"])?></li>
			<li class="text_formats"><b>Email:</b> <a href="mailto:<?=strip_tags($data["fetch"]["ad_email2"])?>"><?=strip_tags($data["fetch"]["ad_email2"])?></a></li>
			<?php endif; ?>
		</ul>



	<div class="btn btn-yellow btn-block contact_btn" data-toggle="modal" data-target="#page_enquires_popup">CONTACT</div>
	</div>
	<div class="col-sm-9" id="content">
		<?php
		if(!isset($_GET['p'])){
			@include('parts/user_content.php');
		}else{
			include('parts/productinside.php');
		}
		?>
	</div>
</div>
<?php @include("parts/footer.php"); ?>