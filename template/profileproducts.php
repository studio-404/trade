<?php 
	@include("parts/header.php"); 
	if(isset($_SESSION["tradewithgeorgia_username"])) {
?>
<div class="container" id="container">
	<div class="page_title_1">
		Company Profile (Business Enquires)
	</div>
	<div class="row">
		<div class="col-sm-3">
			<div class="form-group">
				<label>Company Name</label>
				<input type="text" class="form-control" value="Business Enquires LTD">
			</div>
			<div class="form-group">
				<label>Sector</label>
				<select class="form-control">
					<option>Food &amp; Drinks</option>
				</select>
			</div>
			<div class="form-group">
				<label>Established in</label>
				<input type="text" class="form-control">
			</div>
			<div class="form-group">
				<label>production Capasity</label>
				<input type="text" class="form-control">
			</div>
			<div class="form-group">
				<label>Address</label>
				<input type="text" class="form-control">
			</div>
			<div class="form-group">
				<label>Mobile Number</label>
				<input type="text" class="form-control">
			</div>
		</div>
		<div class="col-sm-3">
			<div class="form-group">
				<label>Email Address</label>
				<input type="text" class="form-control" value="export@bagration.ge">
			</div>	
			<div class="form-group">
				<label>Sub-Sector</label>
				<select class="form-control">
					<option>Alcoholic Drinks</option>
				</select>
			</div>
			<div class="form-group">
				<label>Number of employees</label>
				<input type="text" class="form-control">
			</div>
			<div class="form-group">
				<label>Certificates</label>
				<select class="form-control">
					<option>ISO</option>
				</select>
			</div>
			<div class="form-group">
				<label>Contact Person</label>
				<input type="text" class="form-control">
			</div>
			<div class="form-group">
				<label>Office Phone</label>
				<input type="text" class="form-control">
			</div>
		</div>
		<div class="col-sm-3">
			<div class="form-group">
				<label>Password</label>
				<input type="password" class="form-control" value="password">
			</div>
			<div class="form-group">
				<label>Products</label>
				<!-- <input type="text" class="form-control" value="Wine, , Energy Drink"> -->
				<select multiple class="form-control" style="min-height:109px; max-height:109px">
				  <option value="Wine" selected="selected">Wine</option>
				  <option value="Beer" selected="selected">Beer</option>
				  <option value="Energy Drink">Energy Drink</option>
				</select>
			</div>
			<div class="form-group">
				<label>Company size</label>
				<select class="form-control">
					<option></option>
				</select>
			</div>
			<div class="form-group">
				<label>Export Markets</label>
				<select class="form-control">
					<option>Europe</option>
				</select>
			</div>
			<div class="form-group">
				<label>E-mail</label>
				<input type="text" class="form-control">
			</div>
		</div>
		<div class="col-sm-3">
			<div class="form-group">
				<label>Company Logo</label> 
				<div class="upload_img_tmp">
					<img src="<?=TEMPLATE?>img/img_upload.png" class="img-responsive" width="100%" alt="" />
				</div>
				<div class="btn btn-upload btn-block"> 
					UPLOAD LOGO <input type="file" class="input_type_file">
				</div> 
			</div>
		</div>
		<div class="admin_inputs">
			<div class="col-sm-9">
				<div class="form-group">
					<label>Web Address</label>
					<input type="text" class="form-control">
				</div>
				<div class="form-group">
					<label>About</label>
					<textarea class="form-control"></textarea>
				</div>
			</div>
			<div class="col-sm-3">
				<button class="btn btn-yellow">SAVE CHANGES</button>
			</div>
		</div>
	</div>
	<hr>
	
	<div class="page_title_1">
		Add New Products
	</div>
	
		<div class="row">
			<div class="col-sm-3">
				<div class="form-group">
					<label>Choose Product</label>
					<select class="form-control">
						<option>Wine</option>
					</select>
				</div>
				<div class="form-group">
					<label>Shelf Life</label>
					<input type="text" class="form-control">
				</div>
			</div>	
			<div class="col-sm-3">
				<div class="form-group">
					<label>product Name</label>
					<select class="form-control">
						<option>Mukuzani - White Dry</option>
					</select>
				</div>
				<div class="form-group">
					<label>Packaging</label>
					<input type="text" class="form-control">
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>HS Code</label>
					<select class="form-control">
						<option>0293948493</option>
					</select>
				</div>
				<div class="form-group">
					<label>AWards</label>
					<input type="text" class="form-control">
				</div>
			</div>	
			<div class="col-sm-3">
				<div class="form-group">
					<label>Product Photo</label> 
					<div class="upload_img_tmp">
						<img src="<?=TEMPLATE?>img/img_upload.png" class="img-responsive" width="100%" alt="" />
					</div>
					<div class="btn btn-upload btn-block"> 
						UPLOAD LOGO <input type="file" class="input_type_file">
					</div> 
				</div>
			</div>
			<div class="admin_inputs">
				<div class="col-sm-9">
					<div class="form-group">
						<label>Describe what are you offering or looking for</label>
						<textarea class="form-control"></textarea>
					</div>				
				</div>	
				<div class="col-sm-3">
					<div class="text-right">
						<button class="btn btn-yellow">POST ENQUARY</button>
					</div>
				</div>
			</div>	
		</div>
		
		<hr>
		
		<div class="page_title_1">
			Products
		</div>
		
		<div class="col-sm-12 padding_0">
			<div class="products">
				<div class="col-sm-12 col-md-12 col-xs-12 col-gl-12 product_item">
					<div class="col-sm-2 col-md-2 col-xs-2 col-lg-2 padding_0">
						<div class="image"><img src="<?=TEMPLATE?>img/product_1.jpg" class="img-responsive" width="100%" alt="" /></div>
					</div>	
					<div class="col-sm-7 col-md-7 col-xs-7 col-gl-7 product_info padding_0">
						<ul>
							<li><span>Sparkling Wine Rose Semi Dry - </span>HS Code 04431001</li>
							<li><span>Packaging </span>0.75 Crystal dark, 6 bottles pre box</li>
							<li><span>Awards </span>Golden Globe, Bronze Medal UK Wines, Silver Medal European Wines</li>
						</ul>
					</div>
					<div class="col-sm-8 col-md-8 col-xs-8 col-gl-8 product_info padding_0">
						<ul>
							<li><span>About - </span>
								Finest sparkling wine produced by methode traditionnelle from carefully selected grapes of Georgian variety "Chinuri", grown in the best wine-producing zone of Kartli region
							</li>
						</ul>
					</div>
					<div class="col-sm-2 " style="margin-top:30px;">
						<button class="btn btn-yellow btn-sm btn-block">MAKE CHANGES</button>
						<button class="btn btn-aproved btn-sm btn-block">APPROVED</button>
					</div>
				</div>
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