<!--START ADDcertificates POPUP -->
<div id="addCertificate" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width:340px;">
    <!-- Modal content-->
    <div class="modal-content">
		<div class="modal-body">
			<h3 class="modal-title">Ask to add certificate</h3>
			<div id="certificateAddBox">
				
				<div class="form-group">
					<label for="certi">Certificate</label>
					<input type="text" name="certi" id="certi" class="form-control" value="" autocomplete="off" />
					<div class="error_message certi_required">Certificate is required !</div>
				</div>
				
				
				<div style="clear:both"></div>
				<div class="btn btn-block btn-yellow" style="font-size:19px; margin-top:15px;" id="askToAddCertificate">Add</div>
			</div>
		</div> 
    </div>
  </div>
</div>
<!-- END ADDcertificates POPUP-->