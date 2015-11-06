<!-- START PAGE COMPANY POPUP -->
<div id="makeservicechange" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
		<div class="modal-body">		
					<h3 class="modal-title">Change service data</h3>
					<input type="hidden" name="s_sid" class="s_sid" id="s_sid" value="" />
					<div class="form-group">
						<label for="s_service">Activity <font color="red">*</font></label>
						<select name="s_service" class="form-control" id="s_service" />
						</select>
						<div class="error_message p_prname_required">Activity is required !</div>
					</div>	

					<div class="form-group">
						<label for="s_service_x">Service <font color="red">*</font></label>
						<input type="text" name="s_service_x" class="form-control" id="s_service_x" />
						<div class="error_message p_prname_required_x">Service is required !</div>
					</div>			
					
					<div class="form-group">
						<label for="s_sdescription">Describe Service <font color="red">*</font></label>
						<textarea class="form-control s_sdescription" id="s_sdescription" name="s_sdescription"></textarea>
						<div class="error_message s_sdescription_required">Describtion field is required !</div>
					</div>	

					<div style="clear:both"></div>
					<div class="btn btn-block btn-yellow" style="font-size:19px; margin-top:15px;" id="change_service_inside">Change</div>
					<font color="red" style="width:100%; margin:10px 0; font-weight:bold">If you change anything service will became unaprooved again !</font>

			
		</div> 
    </div>
  </div>
</div>
<!-- END PAGE COMPANY POPUP -->
