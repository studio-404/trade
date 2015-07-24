<div id="register_for_event" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width:340px;">
    <!-- Modal content-->
    <div class="modal-content">
		<div class="modal-body">
			<h3 class="modal-title">
				Register For The Events 
				<!-- <div style="margin-top:-10px;">
					<small style="float:none;display:inline-block;"></small>
				</div> -->
			</h3>			
			<div class="form-group">
				<label for="chooseEvent">Choose event <font color="red">*</font></label>
				<select class="form-control" id="chooseEvent" name="chooseEvent">
					<option value="">Choose</option>
				</select>
				<div class="error_message er_chooseevent_require">Please choose event !</div>
			</div>
			<div class="form-group">
				<label for="comname">Company / Person name <font color="red">*</font></label>
				<input type="text" class="form-control" id="comname" name="comname" value="" />
				<div class="error_message er_name_require">Company / Person name is required !</div>
			</div>
			<div class="form-group">
				<label for="er_email">E-mail address <font color="red">*</font></label>
				<input type="text" class="form-control" id="er_email" name="er_email" value="" />
				<div class="error_message er_email_require">Email address is required !</div>
				<div class="error_message er_checkemail_require">Please check email address field !</div>
			</div>
			<div class="form-group">
				<label for="er_mobile_phone">Mobile / Phone number <font color="red">*</font></label>
				<input type="text" class="form-control" name="er_mobile_phone" id="er_mobile_phone" value="" />
				<div class="error_message er_mobile_require">Mobile or Phone number is required !</div>
			</div>
			<div class="btn btn-block btn-yellow regEvent" style="font-size:19px;">REGISTER</div>
		</div> 
    </div>
  </div>
</div>