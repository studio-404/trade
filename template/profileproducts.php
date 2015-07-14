<?php 
	@include("parts/header.php"); 
	if(isset($_SESSION["tradewithgeorgia_username"])) { 
		@include('parts/changepassword.php'); 
?>
<div class="container" id="container">
	<div class="page_title_1">
		Company Profile (Business Enquires)
	</div>
	<div class="row">
		<div class="col-sm-3">
			<div class="form-group">
				<label>Username <font color="red">*</font></label>
				<input type="text" class="form-control" value="<?=$_SESSION["tradewithgeorgia_username"]?>" readonly="readonly" />
			</div>	
			<div class="form-group">
				<label>Sector <font color="red">*</font></label>
				<select name="sector" id="sector" name="sector" class="form-control" multiple style="min-height:109px; max-height:109px">
					<?php foreach($data["sector"] as $sector) : ?>
					<option value="<?=$sector->idx?>"><?=$sector->title?></option>
					<?php endforeach; ?>
				</select>
				<font class="error-msg" id="requiredx_sector">Please choose minimum one sector !</font>
			</div>
			<div class="form-group">
				<label>production Capasity</label>
				<input type="text" id="productioncapasity" name="productioncapasity" class="form-control" value="<?=($_SESSION["user_data"]["productioncapasity"]) ? htmlentities($_SESSION["user_data"]["productioncapasity"]) : ''?>" />
			</div>
			<div class="form-group">
				<label>Address</label>
				<input type="text" id="address" name="address" class="form-control" value="<?=($_SESSION["user_data"]["address"]) ? htmlentities($_SESSION["user_data"]["address"]) : ''?>" />
			</div>
			<div class="form-group">
				<label>Mobile Number</label>
				<input type="text" id="mobile" name="mobile" class="form-control" value="<?=($_SESSION["user_data"]["mobiles"]) ? htmlentities($_SESSION["user_data"]["mobiles"]) : ''?>" />
			</div>
			<div class="form-group">
					<label>Contact email <font color="red">*</font></label>
					<input type="text" id="contactemail" name="contactemail" class="form-control" value="<?=($_SESSION["user_data"]["contactemail"]) ? htmlentities($_SESSION["user_data"]["contactemail"]) : ''?>" />
					<font class="error-msg" id="requiredx_contactemail">Please check contact email field !</font>
				</div>
		</div>
		<div class="col-sm-3">
			<div class="form-group">
				<label>Company Name <font color="red">*</font></label>
				<input type="text" id="companyname" name="companyname" class="form-control" value="<?=($_SESSION["user_data"]["companyname"]) ? htmlentities($_SESSION["user_data"]["companyname"]) : ''?>" />
				<font class="error-msg" id="requiredx_companyname">Please fill company name field !</font>
			</div>
			<div class="form-group">
				<label>Sub-Sector <font color="red">*</font></label>
				<select id="subsector" name="subsector" class="form-control" multiple style="min-height:109px; max-height:109px">
					<option value="">Choose</option>
				</select>
				<font class="error-msg" id="requiredx_subsector">Please choose minimum one sub-sector !</font>
			</div>
			<div class="form-group">
				<label>Number of employees</label>
				<input type="text" id="numemploy" name="numemploy" class="form-control" value="<?=($_SESSION["user_data"]["numemploy"]) ? htmlentities($_SESSION["user_data"]["numemploy"]) : ''?>" />
			</div>
			<div class="form-group">
				<label>Certificates</label>
				<select id="certificates" name="certificates" class="form-control">
					<option value="">Choose</option>
					<?php foreach($data["certificates"] as $certificates) : ?>
					<option value="<?=$certificates->idx?>" <?=($_SESSION["user_data"]["certificates"]==$certificates->idx) ? 'selected="selected"' : ''?>><?=$certificates->title?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="form-group">
				<label>Contact Person</label>
				<input type="text" id="contactperson" name="contactperson" class="form-control" value="<?=($_SESSION["user_data"]["contactpersones"]) ? htmlentities($_SESSION["user_data"]["contactpersones"]) : ''?>" />
			</div>
			<div class="form-group">
				<label>Office Phone</label>
				<input type="text" id="officephone" name="officephone" class="form-control" value="<?=($_SESSION["user_data"]["officephone"]) ? htmlentities($_SESSION["user_data"]["officephone"]) : ''?>" />
			</div>
		</div>
		<div class="col-sm-3">
			<div class="form-group">
				<label>Established in</label>
				<input type="text" id="establishedin" name="establishedin" class="form-control" value="<?=($_SESSION["user_data"]["establishedin"]) ? htmlentities($_SESSION["user_data"]["establishedin"]) : ''?>" />
			</div>
			<div class="form-group">
				<label>Products <font color="red">*</font></label>
				<select multiple id="products" name="products" class="form-control" style="min-height:109px; max-height:109px">
				  <option value="">Choose</option>
				</select>
				<font class="error-msg" id="requiredx_products">Please choose minimum one product !</font>
			</div>
			<div class="form-group">
				<label>Company size</label>
				<select id="companysize" name="companysize" class="form-control">
					<option value="">Choose</option>
					<?php foreach($data["companysize"] as $companysize) : ?>
					<option value="<?=$companysize->idx?>" <?=($_SESSION["user_data"]["companysize"]==$companysize->idx) ? 'selected="selected"' : ''?>><?=$companysize->title?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="form-group">
				<label>Export Markets <font color="red">*</font></label>
				<select name="exportmarkets" id="exportmarkets" class="form-control" style="min-height:109px; max-height:109px" multiple>
					<?php 
					$markets = explode(",",$_SESSION["user_data"]["exportmarkets"]);
					foreach($data["countries"] as $countries) : 
					?>
					<option value="<?=$countries->idx?>" <?=(in_array($countries->idx,$markets)) ? 'selected="selected"' : ''?>><?=$countries->title?></option>
					<?php endforeach; ?>
				</select>
				<font class="error-msg" id="requiredx_exportmarkets">Please choose minimum one export market !</font>
			</div>
			<div class="form-group">
				<label>Web Address</label>
				<input type="text" id="webaddress" name="webaddress" class="form-control" value="<?=($_SESSION["user_data"]["webaddress"]) ? htmlentities($_SESSION["user_data"]["webaddress"]) : ''?>" />
			</div>
		</div>
		<div class="col-sm-3">
			<div class="form-group">
				<label>Company Logo</label> 
				<div class="upload_img_tmp">
					<?php
					$logo = (!empty($_SESSION["user_data"]["picture"])) ? WEBSITE.'image?f='.WEBSITE.'files/usersimage/'.$_SESSION["user_data"]["picture"].'&w=300&h=170' : TEMPLATE.'img/img_upload.png';
					?>
					<img src="<?=$logo?>" class="img-responsive" id="userLogo" width="100%" alt="" />
				</div>
				<form action="" method="post" enctype="multipart/form-data" id="uploadImageForm">
				<div class="btn btn-upload btn-block"> 
					<span id="txtFupload">UPLOAD LOGO</span> <input type="file" name="inputUserLogo" class="input_type_file" accept="image/*" id="inputUserLogo" />
				</div>
				</form> 
				<font class="error-msg" style="padding:5px 15px 0 0;" id="imageWarning">Please choose 300x170 px photo or system resizes it itself !</font>
			</div>
		</div>
		<div class="admin_inputs">
			<div class="col-sm-9">
				<div class="form-group">
					<label>About</label>
					<textarea id="about" name="about" class="form-control"><?=($_SESSION["user_data"]["about"]) ? htmlentities($_SESSION["user_data"]["about"]) : ''?></textarea>
				</div>
			</div>
			<div class="col-sm-9">
				<div class="form-group">
					<label><a href="#" data-toggle="modal" data-target="#changepass_popup">Change password</a></label>
				</div>
			</div>
			<div class="col-sm-3">
				<button class="btn btn-yellow" id="save_changes">SAVE CHANGES</button>
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
					<select id="products2" name="products2" class="form-control">
						<option>Choose</option>
					</select>
				</div>
				<div class="form-group">
					<label>Shelf Life</label>
					<input type="text" class="form-control">
				</div>
			</div>	
			<div class="col-sm-3">
				<div class="form-group">
					<label>Product Name</label>
					<input type="text" class="form-control">
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
$make = phparray_to_jsarray::sectorSelects();
?>
<script type="text/javascript" charset="utf-8">
$(document).ready(function(){
selectSectors(<?=$make[0]?>,<?=$make[1]?>,<?=$make[2]?>);
});				
</script>
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