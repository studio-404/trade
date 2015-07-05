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
			</li><li><a href="#">Services</a></li><li>  &gt;  
			</li><li><a href="#">Microsoft</a></li><li>
	</li></div>
	
	<div class="back_to"><a href="#">Back to catalog</a></div>
	
	<div class="page_title_5">
		MICROSOFT
		<div class="image">
			<img src="<?=TEMPLATE?>img/microsoft.png" alt="" />
		</div>
	</div>
	
</div>

<div class="container" id="container">
	<div class="col-sm-3" id="sidebar">
		<ul class="text_formats_ul">
			<li class="text_formats"><span>Sector</span></li>
			<li class="text_formats">IT &amp; Communications</li>
		</ul>
		<ul class="text_formats_ul">
			<li class="text_formats"><span>Sub sector</span></li>
			<li class="text_formats">Computer Services</li>
		</ul>
		<ul class="text_formats_ul">
			<li class="text_formats"><span>Products</span></li>
			<li class="text_formats">Os fixing, Mobile fixing</li>
		</ul>
		<ul class="text_formats_ul">
			<li class="text_formats"><span>Export Markets</span></li>
			<li class="text_formats">Ukrain, Russia, USA,  Germany, Latvia, Estonia, UK, Netherlands, China, Japan</li>
		</ul>
		<ul class="text_formats_ul">
			<li class="text_formats"><span>Certificates</span></li>
			<li class="text_formats">ISO 220000</li>
		</ul>
		<ul class="text_formats_ul">
			<li class="text_formats"><span>Membership</span></li>
			<li class="text_formats">World Computer Association</li>
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
		<div class="yellow_title_19">Services</div>
		
		<div class="service_box">
			<ul class="text_formats_ul">
				<li class="text_formats"><span>Mobile phone transefrs</span></li>
				<li class="text_formats">
					<p>
						Finest sparkling wine produced by methode traditionnelle from carefully selected grapes of Georgian variety "Chinuri", grown in the best wine-producing zone of Kartli region Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered 
					</p>
				</li>
			</ul>
		</div>
	</div>
</div>
<?php
@include("parts/footer.php");
?>