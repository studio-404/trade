<?php 
	@include("parts/header.php"); 
?>
<div class="container" id="container">
	<div class="export_menu">
		<ul>
			<li<?=(Input::method("GET","view")=="companies" || !Input::method("GET","view")) ? ' class="active"' : ''?>><a href="?view=companies&amp;token=<?=$_SESSION["token_generator"]?>">COMPANIES</a></li>
			<li<?=(Input::method("GET","view")=="products") ? ' class="active"' : ''?>><a href="?view=products&amp;token=<?=$_SESSION["token_generator"]?>">PRODUCTS</a></li>
			<li<?=(Input::method("GET","view")=="services") ? ' class="active"' : ''?>><a href="?view=services&amp;token=<?=$_SESSION["token_generator"]?>">SERVICES</a></li>
		</ul>
	</div>
	
	<div class="export_search_div">
		<div class="col-sm-10 padding_0">
			<input type="text" class="form-control" id="svalue" placeholder="Search By Name Or Phrase" value="<?=$data["get_search"]?>" />
		</div>
		<div class="col-sm-2 padding_0" style="padding-left:5px;" id="serachMe">
			<button class="btn btn-block btn-sm btn-yellow">SEARCH</button>
		</div>
		<script type="text/javascript"> 
		$(document).on("click","#serachMe",function(){
			var s = $("#svalue").val();
			var u = "http://"+document.domain+"/<?=LANG?>/export-catalog?view=<?=$data['get_view']?>&sort=<?=$data['get_sort']?>&sector=<?=$data['get_sector']?>&certificate=<?=$data['get_certificate']?>&search="+s+"&pn=<?=$data['get_pn']?>&token=<?=$_SESSION['token_generator']?>";
			location.href = u;
		});
		</script>
	</div>
	
	
	<?php if(Input::method("GET","view")=="companies" || !Input::method("GET","view")) : ?>
	<div class="export_companies">
		<div class="filters_div">
			<div class="col-sm-2">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					Sort by name <span class="caret"></span> 
				</a>					
				<ul class="dropdown-menu">
					<li><a href="?view=<?=$data["get_view"]?>&amp;sort=asc&amp;sector=<?=$data["get_sector"]?>&amp;certificate=<?=$data["get_certificate"]?>&amp;search=<?=$data["get_search"]?>&amp;pn=<?=$data["get_pn"]?>&amp;token=<?=$_SESSION["token_generator"]?>">ASC</a></li>
					<li><a href="?view=<?=$data["get_view"]?>&amp;sort=desc&amp;sector=<?=$data["get_sector"]?>&amp;certificate=<?=$data["get_certificate"]?>&amp;search=<?=$data["get_search"]?>&amp;pn=<?=$data["get_pn"]?>&amp;token=<?=$_SESSION["token_generator"]?>">DESC</a></li>
				</ul>
			</div>
			<div class="col-sm-2">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					Choose sector <span class="caret"></span> 
				</a>
				<ul class="dropdown-menu">
					<?php foreach($data["sector"] as $sector) : ?>
					<li>
						<a href="?view=<?=$data["get_view"]?>&amp;sort=<?=$data["get_sort"]?>&amp;sector=<?=$sector->idx?>&amp;certificate=<?=$data["get_certificate"]?>&amp;search=<?=$data["get_search"]?>&amp;pn=<?=$data["get_pn"]?>&amp;token=<?=$_SESSION["token_generator"]?>"><?=$sector->title?></a> 
					</li>
					<?php endforeach; ?>					
				</ul>
			</div>
			<div class="col-sm-2">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					Products
				</a>
			</div>
			<div class="col-sm-4">
				<a href="#">
					Export Markets
				</a>
			</div>
			<div class="col-sm-2">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					Choose certificate<span class="caret"></span> 
				</a>
				<ul class="dropdown-menu">
					<?php foreach($data["certificates"] as $certificates) : ?>
					<li><a href="?view=<?=$data["get_view"]?>&amp;sort=<?=$data["get_asc"]?>&amp;sector=<?=$data["get_sector"]?>&amp;certificate=<?=$certificates->idx?>&amp;search=<?=$data["get_search"]?>&amp;pn=<?=$data["get_pn"]?>&amp;token=<?=$_SESSION["token_generator"]?>"><?=$certificates->title?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	
	<?php 
	$retrieve_users_info = new retrieve_users_info();
	foreach($data["fetch"] as $val){
	?>
	<a href="<?=WEBSITE.LANG?>/export-catalog/company?view=<?=$val["su_id"]?>&token=<?=$_SESSION["token_generator"]?>">	
		<div class="filter_content">
			<div class="names"><?=$val["su_namelname"]?></div>
			<div class="content_divs">
				<?php
				$logo = (!empty($val["su_picture"])) ? WEBSITE.'image?f='.WEBSITE.'files/usersimage/'.$val["su_picture"].'&w=150&h=75' : TEMPLATE.'img/noimage.png';
				?>
				<div class="col-sm-2 no-float itemssss"><img src="<?=$logo?>" class="img-responsive"></div>
				<div class="col-sm-2 no-float itemssss"><?=$retrieve_users_info->retrieveDb($val["su_sector_id"])?></div>
				<div class="col-sm-2 no-float itemssss"><?=$retrieve_users_info->retrieveDb($val["su_products"])?></div>
				<div class="col-sm-4 no-float itemssss"><?=$retrieve_users_info->retrieveDb($val["su_export_markets_id"])?></div>
				<div class="col-sm-2 no-float itemssss"><?=$retrieve_users_info->retrieveDb($val["su_certificates"])?></div>
			</div>	
		</div>
	</a>
	<?php } ?>
<?php endif; ?>

<?php if(Input::method("GET","view")=="products") : ?>
	<div class="export_companies">
		<div class="filters_div">
			<div class="col-sm-2">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					Product Name <span class="caret"></span> 
				</a>
			</div>
			<div class="col-sm-2">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					Sub Sector <span class="caret"></span> 
				</a>
				<ul class="dropdown-menu">
					<li><a href="#">Sub Sector</a></li>
					<li><a href="#">Sub Sector</a></li>
					<li><a href="#">Sub Sector</a></li>
				</ul>
			</div>
			<div class="col-sm-2">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					Products
				</a>
			</div>
			<div class="col-sm-2">
				<a href="#">
					Export Markets
				</a>
			</div>
			<div class="col-sm-4">
				<a href="#" > <!-- class="dropdown-toggle" data-toggle="dropdown" -->
					About<!-- <span class="caret"></span>  -->
				</a>
				<!-- <ul class="dropdown-menu">
					<li><a href="#">Certificates</a></li>
					<li><a href="#">Certificates</a></li>
					<li><a href="#">Certificates</a></li>
				</ul> -->
			</div>
		</div>
		
		<a href="Page_company.html">	
			<div class="filter_content">
				<div class="names">MUKUZANI - RED WINE</div>
				<div class="content_divs">
					<div class="col-sm-2 no-float itemssss"><img src="<?=TEMPLATE?>img/mukuzani.jpg" class="img-responsive"></div>
					<div class="col-sm-2 no-float itemssss">Alcoholic Drinks</div>
					<div class="col-sm-2 no-float itemssss">Wine</div>
					<div class="col-sm-2 no-float itemssss">Eniseli Wines</div>
					<div class="col-sm-4 no-float itemssss">
						<ul class="text_formats">
							<li><span>Packiging:</span> 075, Crystal Dark Bottles (6 in box)</li>
							<li><span>Shelf Life:</span> 12 years</li>
							<li><span>Awards:</span> Golden Medal of  European Wina accossiation</li>
						</ul>
						<ul class="text_formats" style="margin-top:20px;">
							<li><span>About:</span> Finest sparkling wine produced by methode traditionnelle from carefully selected grapes of Georgian variety "Chinuri", grown in the best wine-producing zone of ....</li>
						</ul>
					</div>
				</div>	
			</div>
		</a>	
	</div>
<?php endif; ?>

<?php if(Input::method("GET","view")=="services") : ?>
	<div class="export_companies">
		<div class="filters_div">
			<div class="col-sm-2">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					Company Name <span class="caret"></span> 
				</a>					
				<ul class="dropdown-menu">
					<li><a href="#">Company Name</a></li>
					<li><a href="#">Company Name</a></li>
					<li><a href="#">Company Name</a></li>
				</ul>
			</div>
			<div class="col-sm-2">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					Sub Sector <span class="caret"></span> 
				</a>
				<ul class="dropdown-menu">
					<li><a href="#">Sub Sector</a></li>
					<li><a href="#">Sub Sector</a></li>
					<li><a href="#">Sub Sector</a></li>
				</ul>
			</div>
			<div class="col-sm-2">
				<a href="#">
					Services
				</a>
			</div>
			<div class="col-sm-6">
				<a href="#">
					About
				</a>
			</div> 
		</div>
		
	<a href="Page_Service_company.html">	
		<div class="filter_content">
			<div class="names">MUKUZANI - RED WINE</div>
			<div class="content_divs">
				<div class="col-sm-2 no-float itemssss"><img src="<?=TEMPLATE?>img/microsoft.jpg" class="img-responsive"></div>
				<div class="col-sm-2 no-float itemssss">IT &amp; Communications</div>
				<div class="col-sm-2 no-float itemssss">Operating system fixings Online bussines conultations, Skype conferences</div>
				<div class="col-sm-6 no-float itemssss">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampdenney College in Virginia, looked up one of the more ....</div>
			</div>	
		</div>
	</a>	

	</div>
<?php endif; ?>
	
</div>
	
	
</div>
<?php @include("parts/footer.php"); ?>