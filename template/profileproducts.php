<?php 
	@include("parts/header.php"); 
	if(isset($_SESSION["tradewithgeorgia_username"])) { 
		@include('parts/changepassword.php'); 
		@include('parts/makechange.php'); 
		$sector_array = array_filter(explode(",",$_SESSION["user_data"]["sector"]));
		$sector_array2 = array_filter(explode(",",$_SESSION["user_data"]["subsector"]));
		$sector_array3 = array_filter(explode(",",$_SESSION["user_data"]["products"]));
?>
<div class="container" id="container">
	<div class="page_title_1">
		Profile (<?=ucfirst($_SESSION["tradewithgeorgia_company_type"])?>)
	</div>
	<div class="row">
		<div class="col-sm-3">
			<div class="form-group">
				<label>Username <font color="red">*</font></label>
				<input type="text" class="form-control" value="<?=$_SESSION["tradewithgeorgia_username"]?>" readonly="readonly" />
			</div>	
			<div class="form-group ">
				<label>Sector <font color="red">*</font></label>
				<div class="multiselectBox">
					<div class="selectBoxWithCheckbox" data-toggle="drop_sector">
						<?=(count($sector_array)>0) ? 'Selected '.count($sector_array).' items' : 'Choose'?>
					</div>
					<div class="selectBoxWithCheckbox_dropdown" id="drop_sector">
						<?php 
						$x = 1;
						foreach($data["sector"] as $sector) : ?>
						<div class="selectItem" data-checkbox="selectItem<?=$x?>">
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

			<div class="form-group ">
				<label>Sub-Sector <font color="red">*</font></label>
				<div class="multiselectBox2">
					<div class="selectBoxWithCheckbox2" data-toggle="drop_sector2">
						<?=(count($sector_array2)>0) ? 'Selected '.count($sector_array2).' items' : 'Choose'?>
					</div>
					<div class="selectBoxWithCheckbox_dropdown2" id="drop_sector2">
						<?php 
						$sectors_subsectors_products = new sectors_subsectors_products();
						$fetch = $sectors_subsectors_products->subsector($c,$sector_array);
						$x = 1;
						foreach($fetch as $val){
							?>

							<div class="selectItem2" data-checkbox="selectItemx<?=$x?>">
								<input type="checkbox" name="selectItem2[]" class="sector_ids2" id="selectItemx<?=$x?>" value="<?=$val["idx"]?>" <?=(in_array($val["idx"], $sector_array2)) ? 'checked="checked"' : ''?> />
								<span><?=htmlentities($val['title'])?></span>
							</div>

							<?php
							$x++;
						}
						?>
					</div>
				</div>
				<font class="error-msg" id="requiredx_subsector">Please select minimum one Sub-Sector !</font>
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
				<div class="multiselectBox3">
					<div class="selectBoxWithCheckbox3" data-toggle="drop_sector3">
						<?=(count($sector_array3)>0) ? 'Selected '.count($sector_array3).' items' : 'Choose'?>
					</div>
					<div class="selectBoxWithCheckbox_dropdown3" id="drop_sector3">

						<?php 
						$sectors_subsectors_products = new sectors_subsectors_products();
						$fetch2 = $sectors_subsectors_products->products($c,$sector_array2);
						$x = 1;
						foreach($fetch2 as $val){
							?>

							<div class="selectItem3" data-checkbox="selectItemxx<?=$x?>">
								<input type="checkbox" name="selectItem3[]" class="sector_ids3" id="selectItemxx<?=$x?>" value="<?=$val["idx"]?>" <?=(in_array($val["idx"], $sector_array3)) ? 'checked="checked"' : ''?> />
								<span><?=htmlentities($val['title'])?></span>
							</div>

							<?php
							$x++;
						}
						?>

					</div>
				</div>
				<font class="error-msg" id="requiredx_products">Please select minimum one product !</font>
			</div>
			<!-- <div class="form-group">
				<label>Products <font color="red">*</font></label>
				<select multiple id="products" name="products" class="form-control" style="min-height:109px; max-height:109px">
				  <option value="">Choose</option>
				</select>
				<font class="error-msg" id="requiredx_products">Please choose minimum one product !</font>
			</div> -->
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
				<label>Export markets <font color="red">*</font></label>
				<?php $markets = explode(",",$_SESSION["user_data"]["exportmarkets"]); ?>
				<div class="multiselectBox4">
					<div class="selectBoxWithCheckbox4" data-toggle="drop_sector4">
						<?=(count($markets) > 0) ? "Selected ".count($markets)." items" : "Choose"?>
					</div>
					<div class="selectBoxWithCheckbox_dropdown4" id="drop_sector4">
						<?php 
						$x=0;
						foreach($data["countries"] as $countries) : 
						?>
						<div class="selectItem4" data-checkbox="selectItemxxx<?=$x?>">
							<input type="checkbox" name="selectItem4[]" class="sector_ids4" id="selectItemxxx<?=$x?>" value="<?=$countries->idx?>" <?=(in_array($countries->idx,$markets)) ? 'checked="checked"' : ''?> />
							<span><?=htmlentities($countries->title)?></span>
						</div>
						<?php 
						$x++;
						endforeach; ?>

					</div>
				</div>
				<font class="error-msg" id="requiredx_exportmarkets">Please check minimum one export market</font>
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
					<label>Choose Product <font color="red">*</font></label>
					<select id="products2" name="products2" class="form-control">
						<option value="">Choose</option>
						<?php 
						foreach($fetch2 as $val){	
							if(!in_array($val["idx"], $sector_array3)){ continue; }
						?>
							<option value="<?=htmlentities($val['idx'])?>"><?=htmlentities($val['title'])?></option>
						<?php }	?>
					</select>
					<font class="error-msg" id="requiredx_add_products">Please choose product !</font>
				</div>
				<div class="form-group">
					<label>Shelf Life</label>
					<input type="text" id="shelf_life" name="shelf_life" class="form-control" value="" />
				</div>
			</div>	
			<div class="col-sm-3">
				<div class="form-group">
					<label>Product Name <font color="red">*</font></label>
					<input type="text" id="product_name" name="product_name" class="form-control" value="" />
					<font class="error-msg" id="requiredx_add_productsname">Product name is required !</font>
				</div>
				<div class="form-group">
					<label>Packaging</label>
					<input type="text" name="packinging" id="packinging" class="form-control" value="" />
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group" style="position:relative">
					<label>HS Code <font color="red">*</font></label>
					<input type="hidden" name="hscode_id" class="hscode_id" id="hscode_id" value="" />
					<input type="text" name="hscode" class="form-control hscode" value="" placeholder="Type minimum 3 letter.." />
					<div class="results"><ul></ul></div>
					<font class="error-msg" id="requiredx_add_hscode">HS code is required !</font>
				</div>
				<div class="form-group">
					<label>AWards</label>
					<input type="text" class="form-control" name="awards" id="awards" value="" />
				</div>
			</div>	
			<div class="col-sm-3">
				<form action="" method="post" name="addproduct" id="addproduct" enctype="multipart/form-data">
				<input type="hidden" name="t" value="<?=$_SESSION["token_generator"]?>" />
				<input type="hidden" name="pi" id="pi" class="pi" value="" />
				<div class="form-group">
					<label>Product Photo <font color="red">*</font></label> 
					<div class="upload_img_tmp">
						<img src="<?=TEMPLATE?>img/img_upload.png" id="product_picture" class="img-responsive" width="100%" alt="" />
					</div>
					<div class="btn btn-upload btn-block"> 
						UPLOAD LOGO <input type="file" id="productfile" name="productfile" class="input_type_file" value="" />
					</div> 
					<font class="error-msg" id="requiredx_add_photo">Product photo is required !</font>
				</div>
				</form>
			</div>
			<div class="admin_inputs">
				<div class="col-sm-9">
					<div class="form-group">
						<label>Describe what are you offering or looking for <font color="red">*</font></label>
						<textarea class="form-control" id="product_description" name="product_description"></textarea>
						<font class="error-msg" id="requiredx_add_describe">Description field is required !</font>
					</div>				
				</div>	
				<div class="col-sm-3">
					<div class="text-right">
						<button class="btn btn-yellow" id="post_product" class="post_product">POST PRODUCT</button>
					</div>
				</div>
			</div>	
		</div>
		
		<hr>
		
		<div class="page_title_1">
			Products
		</div>

		<?php foreach($data["myproducts"] as $val) : ?>
		<div class="col-sm-12 padding_0 product_box">
			<div class="products">
				<div class="col-sm-12 col-md-12 col-xs-12 col-gl-12 product_item">
					<div class="col-sm-12 col-md-2 col-xs-12 col-lg-2 padding_0" style="padding-bottom:10px;">
					<?php
					$logo = (!empty($val["picture"])) ? WEBSITE.'image?f='.WEBSITE.'files/usersproducts/'.$val["picture"].'&w=180&h=180' : TEMPLATE.'img/p.png';
					?>
						<div class="image"><img src="<?=$logo?>" class="img-responsive" width="100%" alt="" /></div>
					</div>	
					<div class="col-sm-12 col-md-7 col-xs-12 col-gl-7 product_info padding_0">
						<ul>
							<li><span><?=htmlentities($val["title"])?> - </span>HS code: <?=$val["hs_title"]?></li>
							<li><span>Packaging </span><?=htmlentities($val["packaging"])?> </li>
							<li><span>Awards </span><?=htmlentities($val["awards"])?></li>
						</ul>
					</div>
					<div class="col-sm-12 col-md-8 col-xs-12 col-gl-8 product_info padding_0">
						<ul>
							<li><span>About - </span>
								<?=htmlentities($val["long_description"])?>
							</li>
						</ul>
					</div>
					<div class="col-sm-2 " style="margin-top:30px;">
						<?php 
						if($val["visibility"]==1){
							?>
							<button class="btn btn-yellow btn-sm btn-block makeitchange" data-prid="<?=$val["idx"]?>">MAKE CHANGES</button>
							<button class="btn btn-yellow btn-sm btn-block delete-product" data-prid="<?=$val["idx"]?>" style="background:red">DELETE</button>
							<button class="btn btn-aproved btn-sm btn-block">PENDING</button>
							<?php
						}else{
							?>
							<button class="btn btn-yellow btn-sm btn-block makeitchange" data-prid="<?=$val["idx"]?>">MAKE CHANGES</button>
							<button class="btn btn-yellow btn-sm btn-block delete-product" data-prid="<?=$val["idx"]?>" style="background:red">DELETE</button>
							<button class="btn btn-aproved btn-sm btn-block">APPROVED</button>
							<?php
						}
						?>
						
					</div>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
		
		
	</div>
<?php 
$make = phparray_to_jsarray::sectorSelects();
?>
<script type="text/javascript" charset="utf-8">
$(document).ready(function(){
//selectSectors(<?=$make[0]?>,<?=$make[1]?>,<?=$make[2]?>);
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