<?php 
	@include("parts/header.php"); 
	if(isset($_SESSION["tradewithgeorgia_username"])) {
		@include('parts/changepassword.php'); 
?>
<div class="container" id="container">
	<div class="page_title_1">
		Profile (<?=ucfirst($_SESSION["tradewithgeorgia_company_type"])?>)
	</div>
	<div class="row">
		<div class="col-sm-4">
			<div class="form-group">
				<label>Username <font color="red">*</font></label>
				<input type="text" class="form-control" value="<?=$_SESSION["tradewithgeorgia_username"]?>" readonly="readonly" />
			</div>	
			<div class="form-group ">
				<label>Sector <font color="red">*</font></label>
				<div class="multiselectBox">
					<div class="selectBoxWithCheckbox" data-toggle="drop_sector">
						Choose
					</div>
					<div class="selectBoxWithCheckbox_dropdown" id="drop_sector">
						<?php 
						$x = 1;
						foreach($data["sector"] as $sector) : ?>
						<div class="selectItem" data-checkbox="selectItem<?=$x?>">
							<input type="checkbox" name="selectItem[]" class="sector_ids selectItem<?=$x?>" value="<?=$sector->idx?>" />
							<span><?=htmlentities($sector->title)?></span>
						</div>
						<?php 
						$x++;
						endforeach; 
						?>
					</div>
				</div>
				<font class="error-msg" id="requiredx_sector">Please select minimum one sector !</font>
			</div>

			<div class="form-group">
				<label>Address</label>
				<input type="text" id="address" name="address" class="form-control" value="<?=($_SESSION["user_data"]["address"]) ? htmlentities($_SESSION["user_data"]["address"]) : ''?>" />
			</div>
			<div class="form-group">
				<label>Mobile Number</label>
				<input type="text" id="mobile" name="mobile" class="form-control" value="<?=($_SESSION["user_data"]["mobiles"]) ? htmlentities($_SESSION["user_data"]["mobiles"]) : ''?>" />
			</div>
		</div>
		<div class="col-sm-4">
			<div class="form-group">
				<label>Company Name <font color="red">*</font></label>
				<input type="text" id="companyname" name="companyname" class="form-control" value="<?=($_SESSION["user_data"]["companyname"]) ? htmlentities($_SESSION["user_data"]["companyname"]) : ''?>" />
				<font class="error-msg" id="requiredx_companyname">Please fill company name field !</font>
			</div>

			<div class="form-group">
				<label>Number of employees</label>
				<input type="text" id="numemploy" name="numemploy" class="form-control" value="<?=($_SESSION["user_data"]["numemploy"]) ? htmlentities($_SESSION["user_data"]["numemploy"]) : ''?>" />
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
		<div class="col-sm-4">
			<div class="form-group">
				<label>Established in</label>
				<input type="text" id="establishedin" name="establishedin" class="form-control" value="<?=($_SESSION["user_data"]["establishedin"]) ? htmlentities($_SESSION["user_data"]["establishedin"]) : ''?>" />
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
				<label>Web Address</label>
				<input type="text" id="webaddress" name="webaddress" class="form-control" value="<?=($_SESSION["user_data"]["webaddress"]) ? htmlentities($_SESSION["user_data"]["webaddress"]) : ''?>" />
			</div>
			<div class="form-group">
					<label>Contact email <font color="red">*</font></label>
					<input type="text" id="contactemail" name="contactemail" class="form-control" value="<?=($_SESSION["user_data"]["contactemail"]) ? htmlentities($_SESSION["user_data"]["contactemail"]) : ''?>" />
					<font class="error-msg" id="requiredx_contactemail">Please check contact email field !</font>
				</div>
		</div>
	
		<div class="admin_inputs">
			<div class="col-sm-12">
				<div class="form-group">
					<label>About</label>
					<textarea id="about" name="about" class="form-control"><?=($_SESSION["user_data"]["about"]) ? htmlentities($_SESSION["user_data"]["about"]) : ''?></textarea>
				</div>
			</div>
			<div class="col-sm-12">
				<div class="form-group">
					<label><a href="#" data-toggle="modal" data-target="#changepass_popup">Change password</a></label>
				</div>
			</div>
			<div class="col-sm-12">
				<button class="btn btn-yellow" id="save_company_changes">SAVE CHANGES</button>
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
				<label>Type <font color="red">*</font></label>
				<select class="form-control" id="etype" name="etype">
					<option value="sell">I want to SELL</option>
					<option value="buy">I want to BUY</option>
				</select>
				<font class="error-msg" id="enquire_type_required">Type is required !</font>
			</div>
		</div>	
		<div class="col-sm-3">
			<div class="form-group">
				<label>Sector <font color="red">*</font></label>
				<select class="form-control" id="esector" name="esector">
					<?php foreach($data["sector"] as $val) : ?>
						<option value="<?=$val->idx?>" title="<?=htmlentities($val->title)?>"><?=$val->title?></option>
					<?php endforeach; ?>
				</select>
				<font class="error-msg" id="enquire_sector_required">Sector is required !</font>
			</div>
		</div>		
		<div class="col-sm-12 padding_0">
			<div class="col-sm-5">
				<div class="form-group">
					<label>Title <font color="red">*</font></label>
					<input type="text" class="form-control" id="etitle" name="etitle" value="" />
					<font class="error-msg" id="enquire_title_required">Tilte is required !</font>
				</div>
			</div>	
		</div>
		<div class="col-sm-12">
			<div class="form-group">
				<label>Describe what are you offering or looking for <font color="red">*</font></label>
				<textarea class="form-control" id="edescription" name="edescription"></textarea>
				<font class="error-msg" id="enquire_description_required">Description is required !</font>
			</div>
			<div class="text-right">
				<button class="btn btn-yellow postEnquires">POST ENQUARY</button></div>
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
$make = phparray_to_jsarray::sectorSelects();
?>
<script type="text/javascript" charset="utf-8">
$(document).ready(function(){
selectOnlySectors(<?=$make[0]?>);
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