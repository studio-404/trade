<div id="recover_password" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width:340px;">
    <!-- Modal content-->
    <div class="modal-content">
		<div class="modal-body">
			<h3 class="modal-title" id="modal-register">Recover password</h3>
				<div class="boxarea">
				 	<div class="form-group">
						<label for="recoveremail">Registered email</label>
						<input type="text" class="form-control" name="recoveremail" value="" id="recoveremail" autocomplete="off" onkeypress="submitme(event,'recover_submit')" />
						<div class="error_message recover_email_required">Email is required!</div>
						<div class="error_message recover_emailcorrect_required">Please check email filed!</div>
					</div>

					<div class="form-group">
						<label for="recovercaptcha"><?=$data["language_data"]["captchavalue"]?></label>
						<input type="text" name="recovercaptcha" id="recovercaptcha" class="form-control" value="" autocomplete="off" onkeypress="submitme(event,'recover_submit')" />
						<div class="error_message recover_captcha_required"><?=$data["language_data"]["captcharquired"]?> !</div>
						<div style="clear:both"></div>
						<?php 
						$_SESSION['protect_recover'] = uid::captcha(2).ustring::random(2); 
						setcookie("protect_recover", md5($_SESSION['protect_recover']), time() + 86400, "/", "tradewithgeorgia.com");
						?>
						<img src="<?=WEBSITE?>protect.php?t=recover" alt="" style="float:left; margin-top:15px; border:solid 1px #3895ce; width:95px; height:35px;" class="protectimage" />
					</div><div style="clear:both"></div>
							
					<div class="btn btn-block btn-yellow" style="font-size:19px; margin-top:15px;" id="recover_submit">Submit</div>
				</div>
		</div> 
    </div>
  </div>
</div>