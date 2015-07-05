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
		SOPHIO BENDIASHVILI
	</div>
	
</div>

<div class="container" id="container">
	<div class="col-sm-3" id="sidebar">
		<ul class="text_formats_ul contact_text single_contact">
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
		
		<div class="enquire enquire_small no_border">
			<div class="date">03.03.2015</div>
			<div class="col-sm-12" style="float:none;">
				<div class="title">
					Looking for New Business Partners in Europe
				</div>
				<div class="text">
					We are a trade service company based in Hong Kong and focused on premium food and beverages. Currently, we are looking for agents, distributors or contacts who can help us to enter the European market, we have been producing our services since 1998 and we are keen to make real good partners all over the world. For mor einformation please  contact us and we will get back to you. 
					<small>Proposal</small>
				</div>
			</div>	 
		</div>
			
		<div class="yellow_title_19">Previous adds</div>
		
		<div class="enquire enquire_small">
			<div class="date">03.03.2015</div>
			<div class="col-sm-12" style="float:none;">
				<div class="title">
					Titanium sheets, Titanium bars, Titanium tubes
				</div>
				<div class="text">
					We can produce varieties of nonferrous mill products and its alloy in shape of bars, billets, sheets, plates, forged rings, discs, anode, etc. For technical specifications, please see website.
				</div>
			</div>	 
		</div> 
	</div>
</div>

<?php
@include("parts/footer.php");
?>