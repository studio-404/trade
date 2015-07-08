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
				<input type="text" class="form-control" value="MobileJobile">
			</div>
			<div class="form-group">
				<label>Sector</label>
				<select class="form-control">
					<option>IT &amp; Telecomunications</option>
				</select>
			</div>
			<div class="form-group">
				<label>Established in</label>
				<input type="text" class="form-control">
			</div>
			<div class="form-group">
				<label>SME Classification</label>
				<select class="form-control">
					<option></option>
				</select>
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
				<input type="text" class="form-control" value="Design@dg.ge">
			</div>	
			<div class="form-group">
				<label>Sub-Sector</label>
				<select class="form-control">
					<option>Mobile Communication</option>
				</select>
			</div>
			<div class="form-group">
				<label>Number of employees</label>
				<input type="text" class="form-control">
			</div>
			<div class="form-group">
				<label>Certificate</label>
				<input type="text" class="form-control">
			</div>
			<div class="form-group">
				<label>Contact Person</label>
				<input type="text" class="form-control">
			</div>
			<div class="form-group">
				<label>Phone Phone</label>
				<input type="text" class="form-control">
			</div>
		</div>
		<div class="col-sm-3">
			<div class="form-group">
				<label>Password</label>
				<input type="password" class="form-control" value="password">
			</div>
			<div class="form-group">
				<label>Services</label>
				<input type="text" class="form-control" value="Mobile Fixing, Communication Fixing">
			</div>
			<div class="form-group">
				<label>Export Markets</label>
				<select class="form-control">
					<option>Europe</option>
				</select>
			</div>
			<br><br><br><br>
			<div class="form-group">
				<label>E-mail</label>
				<input type="text" class="form-control">
			</div>
			<div class="form-group">
				<label>Web Address</label>
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
		Add New Service
	</div>
	
		<div class="row">
			<div class="col-sm-5">
				<div class="form-group">
					<label>Title</label>
					<select class="form-control">
						<option>Communication Fixing</option>
					</select>
				</div>
			</div>	
			<div class="col-sm-12">
				<div class="form-group">
					<label>Describe Service</label>
					<textarea class="form-control"></textarea>
				</div>				
			</div>	
			<div class="col-sm-12">
				<div class="text-right">
					<button class="btn btn-yellow">POST ENQUARY</button>
				</div>
			</div>
		</div>
		
		<hr>
		
		<div class="page_title_1">
			Services
		</div>
		
		<div class="col-sm-12 padding_0">
			<div class="services">
				<div class="col-sm-12 col-md-12 col-xs-12 col-gl-12 service_item">
					<div class="col-sm-9 col-md-9 col-xs-12 col-gl-9 product_info padding_0">
						<div class="title">Mobile Phone Transfers</div>
						<div class="text">
							Finest sparkling wine produced by methode traditionnelle from carefully selected grapes of Georgian variety "Chinuri", grown in the best wine-producing zone of Kartli region Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered 
						</div>
					</div>
					<div class="col-sm-3 padding_0" style="margin-top:30px;">
						<div class="text-right">
							<button class="btn btn-yellow btn-sm btn-service_item">MAKE CHANGES</button>
							<button class="btn btn-aproved btn-sm btn-service_item">APPROVED</button>
						</div>	
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