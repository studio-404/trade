<!-- START LOGIN POPUP -->
<div id="login_popup" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width:340px;">
    <!-- Modal content-->
    <div class="modal-content">
		<div class="modal-body">
			<h3 class="modal-title"><?=$data["language_data"]["login"]?> <small data-toggle="modal" data-target="#register_popup" onclick="$('#login_popup').modal('hide')"><?=$data["language_data"]["register"]?></small></h3>
			
			<div class="form-group">
				<label for="emailaddress3"><?=$data["language_data"]["emailaddress"]?></label>
				<input type="text" name="emailaddress" id="emailaddress3" class="form-control" value="" />
			</div>
			<div class="form-group">
				<label for="password3"><?=$data["language_data"]["password"]?></label>
				<input type="password" name="password" id="password3" class="form-control" value="" />
			</div>
			<div class="btn btn-block btn-yellow" style="font-size:19px; margin-top:35px;" id="login_user"><?=strtoupper($data["language_data"]["register"])?></div>
		</div> 
    </div>
  </div>
</div>
<!-- END LOGIN POPUP -->