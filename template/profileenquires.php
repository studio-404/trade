<?php 
	@include("parts/header.php"); 
	if(isset($_SESSION["tradewithgeorgia_username"])) {
?>
<div class="container" id="container">
	<div class="page_title_1">
		Company Profile (Business Enquires)
	</div>
	<div class="row">
		
		<div class="admin_inputs">
			<div class="col-sm-3">
				<div class="form-group">
					<label>Company Name</label>
					<input type="text" class="form-control" value="Business Enquires LTD">
				</div>
				<div class="form-group">
					<label>Address</label>
					<input type="text" class="form-control">
				</div>
				<div class="form-group">
					<label>Phone Number</label>
					<input type="text" class="form-control">
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Email Address</label>
					<input type="text" class="form-control" value="export@bagration.ge">
				</div>	
				<div class="form-group">
					<label>Contact Person</label>
					<input type="text" class="form-control">
				</div>
				<div class="form-group">
					<label>Mobile Number</label>
					<input type="text" class="form-control">
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Password</label>
					<input type="password" class="form-control" value="password">
				</div>
				<div class="form-group">
					<label>E-Mail</label>
					<input type="text" class="form-control">
				</div>
				<div class="form-group">
					<label>Website</label>
					<input type="text" class="form-control">
				</div>
			</div>
			<div class="col-sm-3">
				<button class="btn btn-yellow">SAVE CHANGES</button>
			</div>
		</div>	
	</div>
	<hr>
	
	<div class="page_title_1">
		Post In Inquary/Proposal
	</div>
	
	<div class="row">
		<div class="col-sm-2">
			<div class="form-group">
				<label>Type</label>
				<select class="form-control">
					<option>Proposal</option>
				</select>
			</div>
		</div>	
		<div class="col-sm-3">
			<div class="form-group">
				<label>Sector</label>
				<select class="form-control">
					<option>Food &amp; Bevarages</option>
				</select>
			</div>
		</div>		
		<div class="col-sm-12 padding_0">
			<div class="col-sm-5">
				<div class="form-group">
					<label>Title</label>
					<input type="text" class="form-control">
				</div>
			</div>	
		</div>
		<div class="col-sm-12">
			<div class="form-group">
				<label>Describe what are you offering or looking for</label>
				<textarea class="form-control"></textarea>
			</div>
			<div class="text-right">
				<button class="btn btn-yellow">POST ENQUARY</button></div>
			</div>	
		</div>
		
		<hr>
		
		<div class="page_title_1">
			Previous Enquiries/Proposals
		</div>
		
		<div class="col-sm-12 padding_0">
			<div class="enquire">
				<div class="date">03.03.2015</div>
				<div class="col-sm-9" style="float:none;">
					<div class="title">
						Titanium sheets, Titanium bars, Titanium tubes
					</div>
					<div class="text">
						We can produce varieties of nonferrous mill products and its alloy in shape of bars, billets, sheets, plates, forged rings, discs, anode, etc. For technical specifications, please see website.
					</div>
				</div>	
				<div class="text-right">
					<button class="btn btn-aproved">APPROVED</button></div>
				</div>
			</div>
		</div>
<?php 
	}else{
		?>
	<div class="container" id="container" style="min-height:450px;">
		<div class="page_title_1">
			You dont have permition to access this page.
		</div>
		<div class="row">
			<div class="col-md-12">
				<a href="<?=WEBSITE?>">Start page</a> | 
				<a href="#" data-toggle="modal" data-target="#login_popup">Please log in</a>
			</div>
		</div>
	</div>
		<?php
	}
	@include("parts/footer.php"); 
?>