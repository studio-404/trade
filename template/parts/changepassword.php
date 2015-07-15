<!-- START LOGIN POPUP -->
<div id="changepass_popup" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width:340px;">
    <!-- Modal content-->
    <div class="modal-content">
		<div class="modal-body" id="modal_containerx">
			<h3 class="modal-title">Change passwod</h3>
			<div id="finalstep3">
				<div class="form-group">
					<label for="oldpass">Old password</label>
					<input type="password" name="oldpass" id="oldpass" class="form-control" value="" autocomplete="off" />
					<div class="error_message oldpass_message">Please check old password field !</div>
					<div class="error_message oldpass_required">Old password is required !</div>
				</div>
				<div class="form-group">
					<label for="newpass">New password</label>
					<input type="password" name="newpass" id="newpass" class="form-control" value="" autocomplete="off" />
					<div class="error_message newpass_message">Please check new password field !</div>
					<div class="error_message newpass_minmax">New password must be greater then 6 and less then 20 character !</div>
					<div class="error_message newpass_required">New password is required !</div>
				</div>
				<div class="form-group">
					<label for="repass">Repeat password</label>
					<input type="password" name="repass" id="repass" class="form-control" value="" autocomplete="off" />
					<div class="error_message repass_required">Passwords do not match !</div>
				</div>
				
				<div style="clear:both"></div>
				<div class="btn btn-block btn-yellow" style="font-size:19px; margin-top:15px;" id="change_pass">Change</div>
			</div>
		</div> 
    </div>
  </div>
</div>
<!-- END LOGIN POPUP -->