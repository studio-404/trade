<!-- START PAGE COMPANY POPUP -->
<div id="makeenquireschange" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
		<div class="modal-body">		
					<h3 class="modal-title">Change enquires data</h3>
					<input type="hidden" name="e_eid" class="e_eid" id="e_eid" value="" />
					<div class="form-group">
						<label for="e_type">Type <font color="red">*</font></label>
						<select name="e_type" class="form-control" id="e_type" />
							<option value="sell">SELL</option>
							<option value="buy">BUY</option>
						</select>
						<div class="error_message e_type_required">Type is required !</div>
					</div>

					<div class="form-group">
						<label>Sector <font color="red">*</font></label>
						<select class="form-control" id="e_sector" name="e_sector">
							<?php foreach($data["sector"] as $val) : ?>
								<option value="<?=$val->idx?>" title="<?=htmlentities($val->title)?>"><?=$val->title?></option>
							<?php endforeach; ?>
						</select>
						<font class="error-msg" id="e_sector_required">Sector is required !</font>
					</div>		

					<div class="form-group">
						<label>Title <font color="red">*</font></label>
						<input type="text" class="form-control" id="e_title" name="e_title" value="" />
						<font class="error-msg" id="e_title_required">Tilte is required !</font>
					</div>

					<div class="form-group">
						<label>Describe what are you offering or looking for <font color="red">*</font></label>
						<textarea class="form-control" id="e_description" name="e_description"></textarea>
						<font class="error-msg" id="e_description_required">Description is required !</font>
					</div>

					<div style="clear:both"></div>
					<div class="btn btn-block btn-yellow" style="font-size:19px; margin-top:15px;" id="change_enquire_inside">Change</div>
					<font color="red" style="width:100%; margin:10px 0; font-weight:bold">If you change anything enquiry will became unaprooved again !</font>

			
		</div> 
    </div>
  </div>
</div>
<!-- END PAGE COMPANY POPUP -->
