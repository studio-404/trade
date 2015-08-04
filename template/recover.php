<?php 
	@include("parts/header.php"); 
?>
<div class="container" id="container" style="min-height:350px;">
		<div class="page_title_2">
			<?=$data["text_general"][0]["title"]?>
		</div>
		<div class="text_formats">
			<form action="" method="post" id="recoverPassword_form">
				<?php
				if(isset($_POST['npassword'])){
					echo '<p>'.$data["message"].'</p>';
				}
				?>
			<div class="form-group">
				<label>New password</label>
				<input type="password" id="npassword" name="npassword" class="form-control" value="" />
				<div class="error_message npassword_required">Password required !</div>
				<div class="error_message npassword_must6cher">Password must be minimum 6 and maximum 20 character !</div>
			</div>
			<div class="form-group">
				<label>Comfirm password</label>
				<input type="password" id="cpassword" name="cpassword" class="form-control" value="" />
				<div class="error_message cpassword_match_required">Passwords do not match !</div>
			</div>
			</form>
			<button class="btn btn-yellow" id="change_re_password">CHANGE</button>
		</div>
		<div style="clear:both"></div>
		
</div>
<?php @include("parts/footer.php"); ?>