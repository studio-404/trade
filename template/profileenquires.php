<?php 
	@include("parts/header.php"); 
	if(isset($_SESSION["tradewithgeorgia_username"])) {
		@include('parts/changepassword.php'); 
		@include('parts/makeenquireschange.php'); 
		$sector_array = array_filter(explode(",",$_SESSION["user_data"]["sector"]));
?>
<div class="container" id="container">
	<div class="page_title_1">
		Profile (<?=ucfirst($_SESSION["tradewithgeorgia_company_type"])?>)
	</div>
	<?php if($_SESSION["tradewithgeorgia_company_type"]=="company") : ?>
	<div class="row">
		<!--FRIST COLUMN START-->
		<div class="col-lg-4">
			<div class="form-group">
				<label>Username <font color="red">*</font></label>
				<input type="text" class="form-control" value="<?=$_SESSION["tradewithgeorgia_username"]?>" readonly="readonly" />
			</div>
			<div class="form-group">
				<label>Address</label>
				<input type="text" id="address" name="address" class="form-control" value="<?=($_SESSION["user_data"]["address"]) ? htmlentities($_SESSION["user_data"]["address"]) : ''?>" />
			</div>
			<div class="form-group ">
				<label>Sector <font color="red">*</font></label>
				<div class="multiselectBox">
					<div class="selectBoxWithCheckbox" data-toggle="drop_sector">
						<?=(count($sector_array)>0) ? 'Selected '.count($sector_array).' sectors' : 'Selected'?>
					</div>
					<div class="selectBoxWithCheckbox_dropdown" id="drop_sector">
						<?php 
						$x = 1;
						foreach($data["sector"] as $sector) : ?>
						<div class="selectItem" data-checkbox="selectItem<?=$x?>" data-selectedname="sectors">
							<input type="checkbox" name="selectItem[]" class="sector_ids selectItem<?=$x?>" value="<?=$sector->idx?>" <?=(in_array($sector->idx, $sector_array)) ? 'checked="checked"' : ''?> />
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
				<label>Web Address</label>
				<input type="text" id="webaddress" name="webaddress" class="form-control" value="<?=($_SESSION["user_data"]["webaddress"]) ? htmlentities($_SESSION["user_data"]["webaddress"]) : ''?>" placeholder="www.yourwebsite.com" />
				<font class="error-msg" id="requiredx_webformat">Website mast start with www (www.yourwebsite.com) !</font>
			</div>
		</div>
		<!--FRIST COLUMN END-->
		
		<!--SECOND COLUMN START-->
		<div class="col-lg-4">
			<div class="form-group">
				<label>Company Name <font color="red">*</font></label>
				<input type="text" id="companyname" name="companyname" class="form-control" value="<?=($_SESSION["user_data"]["companyname"]) ? htmlentities($_SESSION["user_data"]["companyname"]) : ''?>" />
				<font class="error-msg" id="requiredx_companyname">Please fill company name field !</font>
			</div>
			<div class="form-group">
				<label>Office number</label>
				<input type="text" id="officephone" name="officephone" class="form-control" value="<?=($_SESSION["user_data"]["officephone"]) ? htmlentities($_SESSION["user_data"]["officephone"]) : ''?>" />
			</div>
			<div class="form-group">
				<label>Company Size</label>
				<select id="companysize" name="companysize" class="form-control">
					<option value="">Select</option>
					<?php foreach($data["companysize"] as $companysize) : ?>
					<option value="<?=$companysize->idx?>" <?=($_SESSION["user_data"]["companysize"]==$companysize->idx) ? 'selected="selected"' : ''?>><?=$companysize->title?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
		<!--SECOND COLUMN END-->
		
		<!--THIRD COLUMN START-->
		<div class="col-lg-4">
			<div class="form-group">
				<label>Established In</label>
				<input type="text" id="establishedin" name="establishedin" class="form-control" value="<?=($_SESSION["user_data"]["establishedin"]) ? htmlentities($_SESSION["user_data"]["establishedin"]) : ''?>" />
			</div>
			<div class="form-group">
				<label>Email <font color="red">*</font></label>
				<input type="text" id="contactemail" name="contactemail" class="form-control" value="<?=($_SESSION["user_data"]["contactemail"]) ? htmlentities($_SESSION["user_data"]["contactemail"]) : ''?>" />
				<font class="error-msg" id="requiredx_contactemail">Please check contact email field !</font>
			</div>
			<div class="form-group">
				<label>Number of Employees</label>
				<input type="text" id="numemploy" name="numemploy" class="form-control" value="<?=($_SESSION["user_data"]["numemploy"]) ? htmlentities($_SESSION["user_data"]["numemploy"]) : ''?>" />
			</div>
		</div>
		<!--THIRD COLUMN END-->
		
		<!--Contact persons START-->
		<div class="admin_inputs" style="margin-top:20px;">
			
			<div class="col-sm-9" style="margin:0 -10px 0 0; padding:0">
				<div class="col-lg-3 col-md-6 col-sm-12">
					<div class="form-group">
						<label>Person 1</label>
						<input type="text" id="contactperson" name="contactperson" class="form-control" value="<?=($_SESSION["user_data"]["contactpersones"]) ? htmlentities($_SESSION["user_data"]["contactpersones"]) : ''?>" />
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-12">
					<div class="form-group">
						<label>Position</label>
						<input type="text" id="ad_position1" name="ad_position1" class="form-control" value="<?=($_SESSION["user_data"]["ad_position1"]) ? htmlentities($_SESSION["user_data"]["ad_position1"]) : ''?>" />
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-12">
					<div class="form-group">
						<label>Mobile Number</label>
						<input type="text" id="mobile" name="mobile" class="form-control" value="<?=($_SESSION["user_data"]["mobiles"]) ? htmlentities($_SESSION["user_data"]["mobiles"]) : ''?>" />
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-12">
					<div class="form-group">
						<label>Email</label>
						<input type="text" id="ad_email1" name="ad_email1" class="form-control" value="<?=($_SESSION["user_data"]["ad_email1"]) ? htmlentities($_SESSION["user_data"]["ad_email1"]) : ''?>" />
					</div>
				</div> 
				<div class="col-lg-3 col-md-6 col-sm-12">
					<div class="form-group">
						<label>Person 2</label>
						<input type="text" id="ad_person2" name="ad_person2" class="form-control" value="<?=($_SESSION["user_data"]["ad_person2"]) ? htmlentities($_SESSION["user_data"]["ad_person2"]) : ''?>" />
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-12">
					<div class="form-group">
						<label>Position</label>
						<input type="text" id="ad_position2" name="ad_position2" class="form-control" value="<?=($_SESSION["user_data"]["ad_position2"]) ? htmlentities($_SESSION["user_data"]["ad_position2"]) : ''?>" />
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-12">
					<div class="form-group">
						<label>Mobile Number</label>
						<input type="text" id="ad_mobile2" name="ad_mobile2" class="form-control" value="<?=($_SESSION["user_data"]["ad_mobile2"]) ? htmlentities($_SESSION["user_data"]["ad_mobile2"]) : ''?>" />
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-12">
					<div class="form-group">
						<label>Email</label>
						<input type="text" id="ad_email2" name="ad_email2" class="form-control" value="<?=($_SESSION["user_data"]["ad_email2"]) ? htmlentities($_SESSION["user_data"]["ad_email2"]) : ''?>" />
					</div>
				</div>
			</div>
			<div class="col-sm-3">
				
			</div>
		</div>
		<!--Contact persons END-->
	
		<div class="admin_inputs">
			<div class="col-sm-12">
				<div class="form-group">
					<label>Company Description</label>
					<textarea id="about" name="about" class="form-control"><?=($_SESSION["user_data"]["about"]) ? htmlentities($_SESSION["user_data"]["about"]) : ''?></textarea>
					<div id="maxlength" style="width:100%; text-align:left; color:#555555"><?=strlen($_SESSION["user_data"]["about"])?> / 250</div>
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
<?php endif; ?>


<?php if($_SESSION["tradewithgeorgia_company_type"]=="individual") : ?>
	<div class="row">
		<!--FRIST COLUMN START-->
		<div class="col-sm-4">
			<div class="form-group">
				<label>Username <font color="red">*</font></label>
				<input type="text" class="form-control" value="<?=$_SESSION["tradewithgeorgia_username"]?>" readonly="readonly" />
			</div>
			<div class="form-group">
				<label>Mobile Number</label>
				<input type="text" id="mobile" name="mobile" class="form-control" value="<?=($_SESSION["user_data"]["mobiles"]) ? htmlentities($_SESSION["user_data"]["mobiles"]) : ''?>" />
				<font class="error-msg" id="requiredx_mobile">Mobile number mast start with +995 (13 character) !</font>
			</div>
			<div class="form-group">
				<label>Web Page</label>
				<input type="text" id="webaddress" name="webaddress" class="form-control" value="<?=($_SESSION["user_data"]["webaddress"]) ? htmlentities($_SESSION["user_data"]["webaddress"]) : ''?>" placeholder="www.yourwebsite.com" />
				<font class="error-msg" id="requiredx_webformat">Web page mast start with www (www.yourwebsite.com) !</font>
			</div>
		</div>
		<!--FRIST COLUMN END-->
		
		<!--SECOND COLUMN START-->
		<div class="col-sm-4">
			<div class="form-group">
				<label>Firstname Lastname <font color="red">*</font></label>
				<input type="text" id="companyname" name="companyname" class="form-control" value="<?=($_SESSION["user_data"]["companyname"]) ? htmlentities($_SESSION["user_data"]["companyname"]) : ''?>" />
				<font class="error-msg" id="requiredx_companyname">Please fill name field !</font>
			</div>
			<div class="form-group">
				<label>Email <font color="red">*</font></label>
				<input type="text" id="contactemail" name="contactemail" class="form-control" value="<?=($_SESSION["user_data"]["contactemail"]) ? htmlentities($_SESSION["user_data"]["contactemail"]) : ''?>" />
				<font class="error-msg" id="requiredx_contactemail">Please check contact email field !</font>
			</div>
		</div>
		<!--SECOND COLUMN END-->
		
		<!--THIRD COLUMN START-->
		<div class="col-sm-4">
			<div class="form-group">
				<label>Address</label>
				<input type="text" id="address" name="address" class="form-control" value="<?=($_SESSION["user_data"]["address"]) ? htmlentities($_SESSION["user_data"]["address"]) : ''?>" />
			</div>
			<div class="form-group ">
				<label>Sector <font color="red">*</font></label>
				<div class="multiselectBox">
					<div class="selectBoxWithCheckbox" data-toggle="drop_sector">
						<?=(count($sector_array)>0) ? 'Selected '.count($sector_array).' sectors' : 'Selected'?>
					</div>
					<div class="selectBoxWithCheckbox_dropdown" id="drop_sector">
						<?php 
						$x = 1;
						foreach($data["sector"] as $sector) : ?>
						<div class="selectItem" data-checkbox="selectItem<?=$x?>" data-selectedname="sectors">
							<input type="checkbox" name="selectItem[]" class="sector_ids selectItem<?=$x?>" value="<?=$sector->idx?>" <?=(in_array($sector->idx, $sector_array)) ? 'checked="checked"' : ''?> />
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
		</div>
		<!--THIRD COLUMN END-->
		
		<div class="admin_inputs">
			<div class="col-sm-12">
				<div class="form-group">
					<label><a href="#" data-toggle="modal" data-target="#changepass_popup">Change password</a></label>
				</div>
			</div>
			<div class="col-sm-12">
				<button class="btn btn-yellow" id="save_individual_changes">SAVE CHANGES</button>
			</div>
		</div>
	</div>
<?php endif; ?>
	

	<hr>
	
	<div class="page_title_1">
		Post In Inquary/Proposal
	</div>
	
	<div class="row">
		<div class="col-sm-2">
			<div class="form-group">
				<label>Type <font color="red">*</font></label>
				<select class="form-control" id="etype" name="etype">
					<option value="sell">SELL</option>
					<option value="buy">BUY</option>
				</select>
				<font class="error-msg" id="enquire_type_required">Type is required !</font>
			</div>
		</div>	
		<div class="col-sm-3">
			<div class="form-group">
				<label>Sector <font color="red">*</font></label>
				<select class="form-control" id="esector" name="esector">
					<?php
						foreach($data["sector"] as $val) : 
						if(!in_array($val->idx, $sector_array)){ continue; }
					?>
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
				<label>Describe Enquire/Proposal <font color="red">*</font></label>
				<textarea class="form-control" id="edescription" name="edescription"></textarea>
				<div id="maxlengthedescription" style="width:100%; text-align:left; color:#555555">0 / 250</div>
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
		<?php
		// echo "<pre>";
		// print_r($data["myenquire"]);  
		// echo "</pre>"; 
		?>
			<div class="col-sm-12 padding_0">
				<?php foreach($data["myenquire"] as $val) : ?>
				<div class="enquire">
					<div class="date"><?=date("d.m.Y",$val["date"])?></div>
					<div class="col-sm-10">
						<div class="title">
							<?=$val["title"]?>
						</div>
						<div class="text">
							<?=strip_tags(nl2br($val["long_description"]))?>
							<?php if(!empty($val["admin_com"])) : ?>
							<p style="color:red"><b>Admin comment:</b> <?=$val["admin_com"]?></p>
							<?php endif; ?>
						</div>
					</div>	
					<div class="col-sm-2">
						<div class="text-right">
							<button class="btn btn-yellow" style="width:100%; padding: 7px 0; float:left;" id="change_enquires" data-eid="<?=$val["id"]?>">MAKE CHANGES</button>
							<button class="btn btn-aproved" style="width:100%; padding: 7px 0; margin-top:8px; float:left; background:red" id="delete_enquires" data-enquid="<?=$val["idx"]?>">DELETE</button>							
							<button class="btn btn-aproved" style="width:100%; padding: 7px 0; margin-top:8px; float:left;"><?=($val['visibility']==2) ? 'APPROVED' : 'PENDING'?></button>
						</div>
					</div>
					<div style="clear:both"></div>
				</div>
			<?php endforeach; ?>
			<?php if($data["count"]>5) : ?>
				<div style="clear:both"></div>
				<div class="appends"></div>
				<div style="clear:both"></div>
				<div class="loader">Please wait...</div>
				<a href="javascript:;" class="gray_link loadmore" data-type="profileenquirelist"  data-from="5" data-load="10" style="padding:0">Load more »</a>
			<?php endif; ?>
			</div>
		</div>

<?php 
$make = phparray_to_jsarray::sectorSelects();
?>
<script type="text/javascript" charset="utf-8">
$(document).ready(function(){
 //selectOnlySectors(<?=$make[0]?>);
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