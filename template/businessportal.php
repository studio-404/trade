<?php 
	@include("parts/header.php"); 
?>
<div class="container" id="container">
	 
	<div class="export_search_div">
		<div class="col-sm-10 padding_0">
			<input type="text" class="form-control" placeholder="Search By Name Or Phrase">
		</div>
		<div class="col-sm-2 padding_0" style="padding-left:5px;">
			<button class="btn btn-block btn-sm btn-yellow">SEARCH</button>
		</div>
	</div>
	
	
	<div class="export_companies">
		<div class="filters_div">
			<div class="col-sm-8 active">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					Buy And Sell<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li><a href="#">Buy</a></li>
					<li><a href="#">Sell</a></li>
				</ul>
			</div>
			<div class="col-sm-2 selected">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					Individual <span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li><a href="#">Individuals</a></li>
					<li><a href="#">Individuals</a></li>
					<li><a href="#">Individuals</a></li>
				</ul>
			</div>
			<div class="col-sm-2">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					Sector <span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li><a href="#">Sector</a></li>
					<li><a href="#">Sector</a></li>
					<li><a href="#">Sector</a></li>
				</ul>				
			</div>
		</div>
		
	
		<div class="filter_content for_enquires">
			<div class="content_divs">
				<a href="#">
					<div class="col-sm-8 no-float itemssss" style="text-align:left;">
						<div class="enquire enquire_small no_border">
							<div class="date">03.03.2015</div>
							<div class="col-sm-12">
								<div class="title">
									Aromatic plants and herbs
								</div>
								<div class="text">
									I am looking for buyers of Moringa seeds and Moringa leaf powder. 
									<small>Proposal</small>
								</div>
							</div>	 
						</div>
					</div>
				</a>
				<div class="col-sm-2 no-float itemssss">
					<a href="Page_enquires.html"></a><a href="#">Niki Getsadze</a>
				</div>
				<div class="col-sm-2 no-float itemssss">Agriculture</div>
			</div>	
		</div>
	

			
	</div>
	
	
</div>
<?php @include("parts/footer.php"); ?>