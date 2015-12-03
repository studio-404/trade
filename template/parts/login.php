<!--START LOGIN POPUP -->
<div id="login_popup" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width:340px;">
    <!-- Modal content-->
    <div class="modal-content">
		<div class="modal-body">
			<h3 class="modal-title">Log In <small data-toggle="modal" data-target="#register_popup" onclick="$('#login_popup').modal('hide')">Register as Exporter</small></h3>
			<div id="finalstep3">
				<div class="form-group">
					<?php if(isset($_GET['hash'])) : ?>
					<p><font color="green">You have registered successfully !</font></p>
					<?php endif; ?>
					<label for="logAs">Log In As</label>
					<select class="form-control" id="logAs">
						<option value="manufacturer">Product</option>
						<option value="serviceprovider">Service</option>
					</select>
					<!-- <option value="company">Company</option>
					<option value="individual">Individual</option> -->
				</div>
				<div class="form-group">
					<label for="emailaddress3"><?=$data["language_data"]["emailaddress"]?></label>
					<input type="text" name="emailaddress" id="emailaddress3" class="form-control" value="" autocomplete="off" onkeypress="submitme(event,'login_user')" />
					<div class="error_message emailaddress3_message"><?=$data["language_data"]["pleasecheckemail"]?> !</div>
					<div class="error_message emailaddress3_required"><?=$data["language_data"]["emailrequired"]?> !</div>
				</div>
				<div class="form-group">
					<label for="password3"><?=$data["language_data"]["password"]?></label>
					<input type="password" name="password" id="password3" class="form-control" value="" autocomplete="off" onkeypress="submitme(event,'login_user')" />
					<div class="error_message password3_required"><?=$data["language_data"]["passwordrequired"]?> !</div>
				</div>
				
				<div class="form-group">
					<label for="captcha"><?=$data["language_data"]["captchavalue"]?></label>
					<input type="text" name="captcha" id="captcha" class="form-control" value="" autocomplete="off" onkeypress="submitme(event,'login_user')" />
					<div class="error_message captcha_required"><?=$data["language_data"]["captcharquired"]?> !</div>
					<div style="clear:both"></div>
					<img src="<?=WEBSITE?>protect.php" alt="" style="float:left; margin-top:15px; border:solid 1px #3895ce; width:95px; height:35px;" class="protectimage" />
				</div>
				<div style="clear:both"></div>
				<div class="btn btn-block btn-yellow" style="font-size:19px; margin-top:15px;" id="login_user"><?=strtoupper($data["language_data"]["login"])?></div>
			</div>
			<div style="float:left; margin-top:15px;">
				<a href="javascript:;" id="reload"><?=$data["language_data"]["reload"]?></a> / 
				<a href="javascript:;" data-toggle="modal" data-target="#recover_password" onclick="$('#login_popup').modal('hide')">Recover Password</a>
			</div>

		</div> 
    </div>
  </div>
</div>
<!-- END LOGIN POPUP-->