<!-- START REGISTER POPUP -->
<div id="register_popup" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width:340px;">
    <!-- Modal content-->
    <div class="modal-content">
		<div class="modal-body">
			<h3 class="modal-title" id="modal-register"><?=$data["language_data"]["register"]?> <small data-toggle="modal" data-target="#login_popup" onclick="$('#register_popup').modal('hide')"><?=$data["language_data"]["login"]?></small></h3>
			<ul class="" role="tablist">
				<li class="btn btn-block btn-blue active">
					<a href="#export_catalogue" aria-controls="export_catalogue" role="tab" data-toggle="tab"><?=strtoupper($data["language_data"]["exportcatalog"])?></a>
				</li>
				<li class="btn btn-block btn-blue">
					<a href="#bussines_enquires" aria-controls="bussines_enquires" role="tab" data-toggle="tab"><?=strtoupper($data["language_data"]["bussinesenquires"])?></a>
				</li>
			</ul>
			 
			<div class="tab-content" style="margin-top:10px">
				<div role="tabpanel" class="tab-pane active" id="export_catalogue">
					<div id="first-step">
						<div class="form-group">
							<label for="companytype1"><?=$data["language_data"]["companytype"]?></label>
							<select class="form-control" name="companytype" id="companytype1">
								<option value="manufacturer"><?=$data["language_data"]["manufacturing"]?></option>
								<option value="serviceprovider"><?=$data["language_data"]["serviceprovider"]?></option>
							</select>
							<div class="error_message companytype1_required"><?=$data["language_data"]["companytyperequired"]?> !</div>
						</div>
						<div class="form-group">
							<label for="emailaddress1"><?=$data["language_data"]["emailaddress"]?></label>
							<input type="text" class="form-control" name="emailaddress" value="" id="emailaddress1" autocomplete="off" />
							<div class="error_message emailaddress1_message"><?=$data["language_data"]["pleasecheckemail"]?> !</div>
							<div class="error_message emailaddress1_required"><?=$data["language_data"]["emailrequired"]?> !</div>
							<div class="error_message emailaddress1_exists"><?=$data["language_data"]["emailalreadyregistered"]?> !</div>
						</div>
						<div class="form-group">
							<label for="password1"><?=$data["language_data"]["password"]?></label>
							<input type="password" name="password" id="password1" class="form-control" value="" autocomplete="off" />
							<div class="error_message password1_length_message"><?=$data["language_data"]["passwordmust620"]?> !</div>
							<div class="error_message password1_required"><?=$data["language_data"]["passwordrequired"]?> !</div>
						</div>
						<div class="form-group">
							<label for="repeatpassword1"><?=$data["language_data"]["repeatpassword"]?></label>
							<input type="password" class="form-control" name="repeatpassword" id="repeatpassword1" value="" autocomplete="off" />
							<div class="error_message repeatpassword1_match_message"><?=$data["language_data"]["passwordmatchproblem"]?> !</div>
						</div>
						
						<input type="checkbox" name="agree" id="agree1" style="float:left; margin-right:5px; "/>
						<div class="text_formats"><font onclick="$('#agree1').click()"><?=$data["language_data"]["byclickuseragreement"]?></font> <a href="<?=WEBSITE.LANG?>/user-agreement" target="_blank"><?=$data["language_data"]["useragreement"]?>.</a> </div>
						<div class="error_message agree_required"><?=$data["language_data"]["agreerules"]?> !</div>
						<div class="btn btn-block btn-yellow" style="font-size:19px; margin-top:15px;" id="register_catalog"><?=strtoupper($data["language_data"]["next"])?></div>
					</div>
					<div id="second-step">
						<div class="form-group">
							<label for="emailcode"><?=$data["language_data"]["emailcode"]?></label>
							<input type="text" class="form-control" name="emailcode" value="" id="emailcode" autocomplete="off" />
							<div class="error_message emailcode_required"><?=$data["language_data"]["coderequired"]?> !</div>
						</div>
						<div class="btn btn-block btn-yellow" style="font-size:19px; margin-top:15px;" id="register__final_catalog"><?=strtoupper($data["language_data"]["register"])?></div>
						<div style="float:left; margin-top:15px;"><a href="javascript:;" id="reload"><?=$data["language_data"]["reload"]?></a></div>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane" id="bussines_enquires" style="margin-top:10px;">
						<div id="first-step2">
							<div class="form-group">
								<label for="registeras2"><?=$data["language_data"]["registeras"]?></label>
								<select class="form-control" name="registeras" id="registeras2">
									<option value="company"><?=$data["language_data"]["company"]?></option>
									<option value="individual"><?=$data["language_data"]["individual"]?></option>
								</select>
								<div class="error_message registeras2_required"><?=$data["language_data"]["registerasrequires"]?> !</div>
							</div>
							<div class="form-group">
								<label for="emailaddress2"><?=$data["language_data"]["emailaddress"]?></label>
								<input type="text" name="emailaddress2" id="emailaddress2" class="form-control" value="" autocomplete="off" />
								<div class="error_message emailaddress2_message"><?=$data["language_data"]["pleasecheckemail"]?> !</div>
								<div class="error_message emailaddress2_required"><?=$data["language_data"]["emailrequired"]?> !</div>
								<div class="error_message emailaddress2_exists"><?=$data["language_data"]["emailalreadyregistered"]?> !</div>
							</div>
							<div class="form-group">
								<label for="password2"><?=$data["language_data"]["password"]?></label>
								<input type="password" name="password2" id="password2" class="form-control" value="" autocomplete="off" />
								<div class="error_message password2_length_message"><?=$data["language_data"]["passwordmust620"]?> !</div>
								<div class="error_message password2_required"><?=$data["language_data"]["passwordrequired"]?> !</div>
							</div>
							<div class="form-group">
								<label for="repeatpassword2"><?=$data["language_data"]["repeatpassword"]?></label>
								<input type="password" class="form-control" name="repeatpassword2" id="repeatpassword2" value="" autocomplete="off" />
								<div class="error_message repeatpassword2_match_message"><?=$data["language_data"]["passwordmatchproblem"]?> !</div>
							</div>
							
							<input type="checkbox" id="agree2" style="float:left; margin-right:5px; "/>
							<div class="text_formats"><font onclick="$('#agree2').click()"><?=$data["language_data"]["byclickuseragreement"]?></font>  <a href="<?=WEBSITE.LANG?>/user-agreement" target="_blank"><?=$data["language_data"]["useragreement"]?>.</a> </div>
							<div class="error_message agree2_required"><?=$data["language_data"]["agreerules"]?> !</div>
							<div class="btn btn-block btn-yellow" style="font-size:19px; margin-top:15px;" id="register_enquires"><?=strtoupper($data["language_data"]["next"])?></div>
						</div>
						<div id="second-step2">
							<div class="form-group">
								<label for="emailcode"><?=$data["language_data"]["emailcode"]?></label>
								<input type="text" class="form-control" name="emailcode2" value="" id="emailcode2" autocomplete="off" />
								<div class="error_message emailcode_required2"><?=$data["language_data"]["coderequired"]?> !</div>
							</div>
							<div class="btn btn-block btn-yellow" style="font-size:19px; margin-top:15px;" id="register__final_catalog2"><?=strtoupper($data["language_data"]["register"])?></div>
							<div style="float:left; margin-top:15px;"><a href="javascript:;" id="reload"><?=$data["language_data"]["reload"]?></a></div>
						</div>

				</div>

			</div>
 
		</div> 
    </div>
  </div>
</div>
<!-- END REGISTER POPUP -->