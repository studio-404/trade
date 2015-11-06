<?php 
	@include("parts/header.php"); 
	if(isset($_SESSION["tradewithgeorgia_username"])) { 
		@include('parts/changepassword.php'); 
		@include('parts/makeservicechange.php'); 
		if(isset($_SESSION["user_data"]["sector"],$_SESSION["user_data"]["subsector"],$_SESSION["user_data"]["products"])){
			$sector_array = array_filter(explode(",",$_SESSION["user_data"]["sector"]));
			$sector_array2 = array_filter(explode(",",$_SESSION["user_data"]["subsector"]));
			$sector_array3 = array_filter(explode(",",$_SESSION["user_data"]["products"]));
			$sector_array5 = array_filter(explode(",",$_SESSION["user_data"]["certificates"]));
		}else{
			$sector_array = array();
			$sector_array2 = array();
			$sector_array3 = array();
			$sector_array5 = array();
		}
?>
<div class="container" id="container">
	<div class="page_title_1">
		Profile (Service provider)
	</div>
	<div class="row">
		<!--first column START-->
		<div class="col-lg-3">
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
				<label>Company Size</label>
				<select id="companysize" name="companysize" class="form-control">
					<option value="">Choose</option>
					<?php foreach($data["companysize"] as $companysize) : ?>
					<option value="<?=$companysize->idx?>" <?=($_SESSION["user_data"]["companysize"]==$companysize->idx) ? 'selected="selected"' : ''?>><?=$companysize->title?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="form-group">
				<label>Web Page</label>
				<input type="text" id="webaddress" name="webaddress" class="form-control" value="<?=($_SESSION["user_data"]["webaddress"]) ? htmlentities($_SESSION["user_data"]["webaddress"]) : ''?>" placeholder="www.yourwebsite.com" />
				<font class="error-msg" id="requiredx_webformat">Website mast start with www (www.yourwebsite.com) !</font>
			</div>
		</div>
		<!--first column END-->
		
		<!--Second colum START-->
		<div class="col-lg-3">
			<div class="form-group">
				<label>Company Name <font color="red">*</font></label>
				<input type="text" id="companyname" name="companyname" class="form-control" value="<?=($_SESSION["user_data"]["companyname"]) ? htmlentities($_SESSION["user_data"]["companyname"]) : ''?>" />
				<font class="error-msg" id="requiredx_companyname">Please fill company name field !</font>
			</div>
			<div class="form-group">
				<label>Office Number</label>
				<input type="text" id="officephone" name="officephone" class="form-control" value="<?=($_SESSION["user_data"]["officephone"]) ? htmlentities($_SESSION["user_data"]["officephone"]) : ''?>" />
			</div>
			<div class="form-group ">
				<label>Sub-Sector <font color="red">*</font></label>
				<div class="multiselectBox2">
					<div class="selectBoxWithCheckbox2" data-toggle="drop_sector2">
						<?=(count($sector_array2)>0) ? 'Selected '.count($sector_array2).' items' : 'Choose'?>
					</div>
					<div class="selectBoxWithCheckbox_dropdown2" id="drop_sector2">
						<?php 
						if(count($sector_array) > 0) :
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
						endif;
						?>
					</div>
				</div>
				<font class="error-msg" id="requiredx_subsector">Please select minimum one Sub-Sector !</font>
			</div>
			<div class="form-group">
				<label>Number of Employees</label>
				<input type="text" id="numemploy" name="numemploy" class="form-control" value="<?=($_SESSION["user_data"]["numemploy"]) ? htmlentities($_SESSION["user_data"]["numemploy"]) : ''?>" />
			</div>
			<div class="form-group">
				<label>Certificates</label>
				<div class="multiselectBox5">
					<div class="selectBoxWithCheckbox5" data-toggle="drop_sector5">
						<?=(count($sector_array5)>0) ? 'Selected '.count($sector_array5).' items' : 'Choose'?>
					</div>
					<div class="selectBoxWithCheckbox_dropdown5" id="drop_sector5">
						<?php 
						$x = 1;
						foreach($data['certificates'] as $val) :
							echo '<div class="selectItem5" data-checkbox="selectItemxxxxxxxxxx'.$x.'">';
							$checked = (is_array($sector_array5) && in_array($val->idx, $sector_array5)) ? 'checked="checked"' : '';
							echo '<input type="checkbox" name="selectItem5[]" class="sector_ids5" id="selectItemxxxxxxxxxx'.$x.'" value="'.$val->idx.'" '.$checked.' />';
							echo '<span> '.htmlentities($val->title).'</span>';
							echo '</div>';
							$x++;
						endforeach;
						?>
					</div>
				</div>
			</div>
		</div>
		<!--Second colum END-->
		
		<!--Third colum START-->
		<div class="col-lg-3">
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
				<label>Activity <font color="red">*</font></label>
				<div class="multiselectBox3">
					<div class="selectBoxWithCheckbox3" data-toggle="drop_sector3">
						<?=(count($sector_array3)>0) ? 'Selected '.count($sector_array3).' items' : 'Choose'?>
					</div>
					<div class="selectBoxWithCheckbox_dropdown3" id="drop_sector3">
						<?php 
						if(count($sector_array2) > 0) :
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
						endif;
						?>
					</div>
				</div>
				<font class="error-msg" id="requiredx_products">Please select minimum one service !</font>
			</div>
			<div class="form-group">
				<label>Export Markets <font color="red">*</font></label>
				<?php $markets = explode(",",$_SESSION["user_data"]["exportmarkets"]); ?>
				<div class="multiselectBox4">
					<div class="selectBoxWithCheckbox4" data-toggle="drop_sector4">
						<?=(count($markets) > 0) ? "Selected ".count($markets)." items" : "Choose"?>
					</div>
					<div class="selectBoxWithCheckbox_dropdown4" id="drop_sector4">
						<div class="selectItem44">
							<input type="text" id="searchExportMarket" class="form-control searchExportMarket" placeholder="Search Country" value="" />
						</div>
						<div class="loadCountriesExport"> 
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
				</div>
				<font class="error-msg" id="requiredx_exportmarkets">Please check minimum one export market</font>
			</div>
			<!--<div class="form-group">
				<label>Upload Catalogue <span style="font-size:10px; color:red">PDF</span></label>
				<input type="file" id="attachment" name="attachment" class="form-control" value="" />
			</div>-->
		</div>
		<!--Third colum END-->
		
		<!--Fourth colum START-->
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
		<!--Fourth colum START-->
		
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
						<input type="text" id="contactpersonposition" name="contactpersonposition" class="form-control" value="" />
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-12">
					<div class="form-group">
						<label>Mobile Number</label>
						<input type="text" id="mobile" name="mobile" class="form-control" value="<?=($_SESSION["user_data"]["mobiles"]) ? htmlentities($_SESSION["user_data"]["mobiles"]) : ''?>" />
						<font class="error-msg" id="requiredx_mobile">Mobile number mast start with +995 (13 character) !</font>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-12">
					<div class="form-group">
						<label>Email</label>
						<input type="text" id="contactpersonemail" name="contactpersonemail" class="form-control" value="<?=($_SESSION["user_data"]["mobiles"]) ? htmlentities($_SESSION["user_data"]["mobiles"]) : ''?>" />
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-12">
					<div class="form-group">
						<label>Person 2</label>
						<input type="text" id="contactperson" name="contactperson" class="form-control" value="<?=($_SESSION["user_data"]["contactpersones"]) ? htmlentities($_SESSION["user_data"]["contactpersones"]) : ''?>" />
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-12">
					<div class="form-group">
						<label>Position</label>
						<input type="text" id="contactpersonposition" name="contactpersonposition" class="form-control" value="" />
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
						<input type="text" id="contactpersonemail" name="contactpersonemail" class="form-control" value="<?=($_SESSION["user_data"]["mobiles"]) ? htmlentities($_SESSION["user_data"]["mobiles"]) : ''?>" />
					</div>
				</div>
			</div>
			<div class="col-sm-3">
				
			</div>
		</div>
		<!--Contact persons END-->
		
		<!--Describtion field START-->
		<div class="admin_inputs">
			<div class="col-sm-9">
				<div class="form-group">
					<label>Company Description</label>
					<textarea id="about" name="about" class="form-control"><?=($_SESSION["user_data"]["about"]) ? htmlentities($_SESSION["user_data"]["about"]) : ''?></textarea>
					<div id="maxlength" style="width:100%; text-align:left; color:#555555"><?=strlen($_SESSION["user_data"]["about"])?> / 250</div>
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
		<!--Describtion field END-->
	</div>
	<hr>
	
	<div class="page_title_1">
		Add New Service
	</div>
	
		<div class="row">
			<div class="col-sm-5">
				<div class="form-group">
					<label for="service_title">Activity <font color="red">*</font></label>
					<select class="form-control" id="service_title" class="service_title" name="service_title">
						<option value="">Choose</option>
						<?php 
						foreach($fetch2 as $val){	
							if(!in_array($val["idx"], $sector_array3)){ continue; }
						?>
							<option value="<?=htmlentities($val['idx'])?>"><?=htmlentities($val['title'])?></option>
						<?php }	?>
					</select>
					<font class="error-msg" id="servicetitle_required">Please select activity !</font>
				</div>
			</div>	
			<div class="col-sm-12">
				<div class="form-group">
					<label for="service_real_title">Service <font color="red">*</font></label>
					<input type="text" class="form-control" id="service_real_title" name="service_real_title" />
					<font class="error-msg" id="servicerealtitle_required">Please fill service title field !</font>
				</div>				
			</div>
			<div class="col-sm-12">
				<div class="form-group">
					<label for="service_description">Describe Service <font color="red">*</font></label>
					<textarea class="form-control" id="service_description" name="service_description"></textarea>
					<div id="maxlengthservice" style="width:100%; text-align:left; color:#555555">0 / 250</div>
					<font class="error-msg" id="servicedesc_required">Please describe your service !</font>
				</div>				
			</div>	
			<div class="col-sm-12">
				<div class="text-right">
					<button class="btn btn-yellow" id="post_service">POST SERVICE</button>
				</div>
			</div>
		</div>
		
		<hr>
		
		<div class="page_title_1">
			Services
		</div>
		<?php
		// echo "<pre>"; 
		// print_r($data["myservices"]); 
		// echo "</pre>";
		?>
		<div class="col-sm-12 padding_0">
			
			<?php
			$retrieve_users_info = new retrieve_users_info();
			foreach($data["myservices"] as $val): 
				$p = $retrieve_users_info->retrieveDb($val["products"]); 
			?>
			<div class="services" style="float:left; margin-bottom:10px; width:100%">
				<div class="col-sm-12 col-md-12 col-xs-12 col-gl-12 service_item">
					<div class="col-sm-10 col-md-10 col-xs-12 col-gl-10 product_info padding_0">
						<div class="title">Activity: <?=$p?></div>
						<div class="title"><?=$val["title"]?></div>
						<div class="text">
							<?=$val["long_description"]?>
							<?php if(!empty($val["admin_com"])) : ?>
							<p style="color:red"><b>Admin comment:</b> <?=$val["admin_com"]?></p>
							<?php endif; ?>
						</div>
					</div>
					<div class="col-sm-2">
							<button class="btn btn-yellow btn-sm btn-service_item" style="width:100%;" id="change_service" data-sid="<?=$val["id"]?>">MAKE CHANGES</button>
							<button class="btn btn-yellow btn-sm btn-service_item" style="background:red; width:100%;" id="delete_service" data-srvid="<?=$val["idx"]?>">DELETE</button>
							<button class="btn btn-aproved btn-sm btn-service_item" style="width:100%;"><?=($val["visibility"]==2) ? 'APPROVED' : 'PENDING'?></button>
					</div>
				</div>
			</div>
			<?php endforeach; ?>
			<?php if($data["count"]>5) : ?>
			<div style="clear:both"></div>
			<div class="appends"></div>
			<div style="clear:both"></div>
			<div class="loader">Please wait...</div>
			<a href="javascript:;" class="gray_link loadmore" data-type="profileservicelist"  data-from="5" data-load="10" style="padding:0">Load more »</a>
			<?php endif; ?>
		</div>
		
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