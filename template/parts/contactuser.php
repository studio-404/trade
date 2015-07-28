<!-- START PAGE COMPANY POPUP -->
<div id="page_enquires_popup" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
		<div class="modal-body">
			<h3 class="modal-title">Contact</h3>
			<?php
			if(Input::method("GET","i")==$_SESSION["tradewithgeorgia_user_id"]){
				?>
				<div class="col-sm-6 padding_0">
					<div class="form-group">
						<font color="red">You can not send message to yourself!</font></label>
					</div>
				</div>
				<?php
			}else{
			?>
				<div class="col-sm-6 padding_0">
					<div class="form-group">
						<label>Company / Person Name <font color="red">*</font></label>
						<input type="text" class="form-control" id="ccname" name="ccname" value="" />
						<div class="error-msg" id="ccname_required">Company / person name is required !</div>
					</div>
					<div class="form-group">
						<label>Country <font color="red">*</font></label>
						<select class="form-control" id="cccountry" name="cccountry">
							<option value="">Choose</option>
						<?php foreach($data["countries"] as $val) : ?>
							<option value="<?=$val->idx?>"><?=$val->title?></option>
						<?php endforeach; ?>
						</select>
						<div class="error-msg" id="cccountry_required">Please choose country !</div>
					</div>
					<div class="form-group">
						<label>E-mail address <font color="red">*</font></label>
						<input type="text" class="form-control" id="ccemail" name="ccemail" value="" />
						<div class="error-msg" id="ccemail_required">Email is required !</div>
						<div class="error-msg" id="ccemail_check_required">Please check email address field !</div>
					</div>
					<div class="form-group">
						<label>Contact number <font color="red">*</font></label>
						<input type="text" class="form-control" id="cccontact_number" name="cccontact_number" value="" />
						<div class="error-msg" id="cccontact_number_required">Contact number is required !</div>
					</div>
				</div>
					
				<div class="col-sm-6" style="padding-left:40px;">
					<div class="form-group">
						<label>Your Message <font color="red">*</font></label>
						<textarea class="form-control" id="ccmessage" name="ccmessage" style="height:259px"></textarea>
						<div class="error-msg" id="ccmessage_required">Message is required !</div>
					</div>	

					<div class="btn  btn-yellow msgtouser" style="font-size:19px; float:right; padding:6px 50px">SUBMIT</div>
				</div>	
			<?php 
		}
			?>
		</div> 
    </div>
  </div>
</div>
<!-- END PAGE COMPANY POPUP -->