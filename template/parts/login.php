<!-- START LOGIN POPUP -->
<div id="login_popup" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width:340px;">
    <!-- Modal content-->
    <div class="modal-content">
		<div class="modal-body">
			<h3 class="modal-title"><?=$data["language_data"]["login"]?> <small data-toggle="modal" data-target="#register_popup" onclick="$('#login_popup').modal('hide')"><?=$data["language_data"]["register"]?></small></h3>
			
			<div class="form-group">
				<label for="emailaddress3"><?=$data["language_data"]["emailaddress"]?></label>
				<input type="text" name="emailaddress" id="emailaddress3" class="form-control" value="" autocomplete="off" />
				<div class="error_message emailaddress3_message">Please check E-mail address field !</div>
				<div class="error_message emailaddress3_required">E-mail is required !</div>
			</div>
			<div class="form-group">
				<label for="password3"><?=$data["language_data"]["password"]?></label>
				<input type="password" name="password" id="password3" class="form-control" value="" autocomplete="off" />
				<div class="error_message password3_required">Password is required !</div>
			</div>
			<div class="form-group">
				<label for="captcha"><?=$data["language_data"]["captchavalue"]?></label>
				<input type="text" name="captcha" id="captcha" class="form-control" value="" autocomplete="off" />
				<div class="error_message captcha_required">Captcha is required !</div>
				<div style="clear:both"></div>
				<?php $_SESSION['protect_'] = uid::captcha(7); ?>
				<img src="<?=WEBSITE?>protect.php" alt="" style="float:left; margin-top:15px; border:solid 1px #3895ce; width:95px; height:35px;" />
			</div>
				<div style="clear:both"></div>
			<div class="btn btn-block btn-yellow" style="font-size:19px; margin-top:15px;" id="login_user"><?=strtoupper($data["language_data"]["login"])?></div>
		</div> 
    </div>
  </div>
</div>
<!-- END LOGIN POPUP -->