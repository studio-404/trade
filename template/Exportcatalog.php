<?php 
	@include("parts/header.php"); 
?>
<div class="container" id="container">
	<div class="export_menu">
		<ul>
			<li<?=(Input::method("GET","view")=="companies" || !Input::method("GET","view")) ? ' class="active"' : ''?>><a href="?view=companies">COMPANIES</a></li>
			<li<?=(Input::method("GET","view")=="products") ? ' class="active"' : ''?>><a href="?view=products">PRODUCTS</a></li>
			<li<?=(Input::method("GET","view")=="services") ? ' class="active"' : ''?>><a href="?view=services">SERVICES</a></li>
		</ul>
	</div>
	
	<div class="export_search_div">
		<div class="col-sm-10 padding_0">
			<input type="text" class="form-control" placeholder="Search By Name Or Phrase">
		</div>
		<div class="col-sm-2 padding_0" style="padding-left:5px;">
			<button class="btn btn-block btn-sm btn-yellow">SEARCH</button>
		</div>
	</div>
	
	
	<?php if(Input::method("GET","view")=="companies" || !Input::method("GET","view")) : ?>
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
					Certificates<span class="caret"></span> 
				</a>
				<ul class="dropdown-menu">
					<li><a href="#">Certificates</a></li>
					<li><a href="#">Certificates</a></li>
					<li><a href="#">Certificates</a></li>
				</ul>
			</div>
		</div>
		
	<a href="Page_company.html">	
		<div class="filter_content">
			<div class="names">BAGRATIONI 1882</div>
			<div class="content_divs">
				<div class="col-sm-2 no-float itemssss"><img src="<?=TEMPLATE?>img/export_img.jpg" class="img-responsive"></div>
				<div class="col-sm-2 no-float itemssss">Alcoholic Drinks</div>
				<div class="col-sm-2 no-float itemssss">Wine, Beer, Energy drink</div>
				<div class="col-sm-4 no-float itemssss">Ukrain, Russia, USA,  Germany, Latvia, Estonia Azerbaijan, UK, Netherlands, China, Japan</div>
				<div class="col-sm-2 no-float itemssss">ISO 220000</div>
			</div>	
		</div>
	</a>
<?php endif; ?>

<?php if(Input::method("GET","view")=="products") : ?>
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
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					Certificates<span class="caret"></span> 
				</a>
				<ul class="dropdown-menu">
					<li><a href="#">Certificates</a></li>
					<li><a href="#">Certificates</a></li>
					<li><a href="#">Certificates</a></li>
				</ul>
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