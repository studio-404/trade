<?php 
	@include("parts/header.php"); 
?>
<!-- START PAGE COMPANY POPUP -->
<div id="page_enquires_popup" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
		<div class="modal-body">
			<h3 class="modal-title">Contact</h3>
			
				<div class="col-sm-6 padding_0">
					<div class="form-group">
						<label>Company Name</label>
						<input type="text" class="form-control"/>
					</div>
					<div class="form-group">
						<label>Country</label>
						<select class="form-control">
							<option>Georgia</option>
						</select>
					</div>
					<div class="form-group">
						<label>Contact Person</label>
						<input type="text" class="form-control"/>
					</div>
					<div class="form-group">
						<label>E-mail address</label>
						<input type="text" class="form-control"/>
					</div>
					<div class="form-group">
						<label>Mobile Number</label>
						<input type="text" class="form-control"/>
					</div>
					<div class="form-group">
						<label>Phone Number</label>
						<input type="text" class="form-control"/>
					</div>
				</div>
					
				<div class="col-sm-6" style="padding-left:40px;">
					<div class="form-group">
						<label>Your Message</label>
						<textarea class="form-control" style="height:408px"></textarea>
					</div>	

					<div class="btn  btn-yellow" style="font-size:19px; float:right; padding:6px 50px">SUBMIT</div>
				</div>	
			
		</div> 
    </div>
  </div>
</div>
<!-- END PAGE COMPANY POPUP -->


<div class="container">
	<div class="breadcrumbs">
		<div class="your_are_here">Your are here: </div>
			<li><a href="#">Export Catalog</a></li><li>  &gt;  
			</li><li><a href="#">Companies</a></li><li>  &gt;  
			</li><li><a href="#">Spirits and bavareges</a></li><li>  &gt;  
			</li><li><a href="#">Bagrationi 1880</a></li><li> 
	</li></div>
	
	<div class="back_to"><a href="#">Back to catalog</a></div>
	
	<div class="page_title_5">
		BAGRATIONI 1882
		<div class="image">
			<img src="<?=TEMPLATE?>img/bagrationi.png" alt="" />
		</div>
	</div>
	
</div>



<div class="container" id="container">
	<div class="col-sm-3" id="sidebar">
		<ul class="text_formats_ul">
			<li class="text_formats"><span>Sector</span></li>
			<li class="text_formats">Food &amp; Drink</li>
		</ul>
		<ul class="text_formats_ul">
			<li class="text_formats"><span>Sub sector</span></li>
			<li class="text_formats">Alcoholic drinks</li>
		</ul>
		<ul class="text_formats_ul">
			<li class="text_formats"><span>Products</span></li>
			<li class="text_formats">Wine, Beer, Shampagne</li>
		</ul>
		<ul class="text_formats_ul">
			<li class="text_formats"><span>Export Markets</span></li>
			<li class="text_formats">Ukrain, Russia, USA,  Germany, Latvia, Estonia Azerbaijan, UK, Netherlands, China, Japan</li>
		</ul>
		<ul class="text_formats_ul">
			<li class="text_formats"><span>Certificates</span></li>
			<li class="text_formats">ISO 220000</li>
		</ul>
		<ul class="text_formats_ul">
			<li class="text_formats"><span>Production Capasity</span></li>
			<li class="text_formats">2 Milion Bottles</li>
		</ul>
		<ul class="text_formats_ul">
			<li class="text_formats"><span>Established In</span></li>
			<li class="text_formats">1995</li>
		</ul>
		<ul class="text_formats_ul">
			<li class="text_formats"><span>Number Of Employes</span></li>
			<li class="text_formats">250</li>
		</ul>
		<ul class="text_formats_ul contact_text">
			<li class="text_formats"><span>Contact Details</span></li>
			<li class="text_formats">Reg. no.11544988</li>
			<li class="text_formats">Address: Chavcahavdze av.7, Tbilisi Georgia.</li>
			<li class="text_formats">Phone: +995 32 2 232323</li>
			<li class="text_formats">E-mail: export@bgrationi.ge</li>
			<li class="text_formats">Web: www.bagrationi.ge</li>
		</ul>
		<div class="btn btn-yellow btn-block contact_btn" data-toggle="modal" data-target="#page_enquires_popup">CONTACT</div>
	</div>
	<div class="col-sm-9" id="content">
		<ul class="text_formats_ul">
			<li class="text_formats"><span>About</span></li>
			<li class="text_formats">
				<p>
				Bagrationi 1882, a historic sparklink wine producer from the country of georgia in the Black sea region of estern
				Europe, Has announces its entrance into the U.S Wihe Market, for the first time in the new world, wine enthusiasts
				can now experience these unique sparkling wines from the very place where winemaking was born. with the intro-duction 
				of bagrationi 1882, wine consumers in america can now enjoy the favorite sparkling wine from the forlds's oldest wine growing region
				</p>
			</li>
		</ul>	
		<div class="yellow_title_19">Products</div>
		
		<div class="product_more_item">
			<div class="products white_bg">
				<div class="col-sm-12 col-md-12 col-xs-12 col-gl-12 product_item">
					<div class="col-sm-3 col-md-3 col-xs-3 col-lg-3 padding_0">
						<div class="image"><img src="<?=TEMPLATE?>img/bagration_2.jpg" class="img-responsive" alt="" /></div>
					</div>	
					<div class="col-sm-7 col-md-7 col-xs-7 col-gl-7 product_info padding_0">
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