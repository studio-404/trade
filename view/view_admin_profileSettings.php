<?php
//session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
	<title><?=$data["website_title"]?></title>
	<link href="<?=STYLES?>reset.css" type="text/css" rel="stylesheet" /> 
	<link href="<?=PLUGINS."font-awesome-4.3.0/css/font-awesome.css"?>" type="text/css" rel="stylesheet" />
	<link href="<?=STYLES?>en.css" type="text/css" rel="stylesheet" /> 
	<link href="<?=STYLES?>general.css" type="text/css" rel="stylesheet" /> 
	<script src="<?=SCRIPTS?>jquery-1.11.2.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?=SCRIPTS?>javascript.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>
	<?php
	@include("view/parts/header.php");
	?>
	<main>
		<div class="center">
			<?php
			@include("view/parts/breadcrups.php");
			?>
			<div class="content">
				<?php
				if(!empty($data["outMessage"]) && $data["outMessage"]==1){
				?>
					<div class="success message" onclick="hideMe('.message')">
					  <h2>Success</h2>
						<p>Data updated !</p>
					</div>
				<?php
				}
				if(!empty($data["outMessage"]) && $data["outMessage"]==2){
				?>
					<div class="error message" onclick="hideMe('.message')">
					  <h2>Error</h2>
						<p>Something went wrong !</p>
					</div>
				<?php
				}
				?>
				<form action="" method="post" class="my-form hundredPorsent" autocomplete="off">
					<div class="from-header" style="color:#ef4836; text-transform:uppercase">Profile settings</div>
					<label for="username">Username:</label>
					<input type="text" name="username" id="username" value="<?=$_SESSION["user404"]?>" disabled="disabled" />
					<label for="email">Firstname Lastname:</label>
					<input type="text" name="namelname" id="namelname" value="<?=htmlentities($data["profile"]["namelname"])?>" />
					
					<label for="city">City:</label>
					<input type="text" name="city" id="city" value="<?=htmlentities($data["profile"]["city"])?>" />

					<label for="address">Address:</label>
					<input type="text" name="address" id="address" value="<?=htmlentities($data["profile"]["address"])?>" />

					<label for="phone">Hotline:</label>
					<input type="text" name="phone" id="phone" value="<?=htmlentities($data["profile"]["phone"])?>" />

					<label for="email">Email:</label>
					<input type="text" name="email" id="email" value="<?=htmlentities($data["profile"]["email"])?>" />

					<label for="iframemap">Map iframe Link:</label>
					<input type="text" name="iframemap" id="iframemap" value="<?=htmlentities($data["profile"]["iframemap"])?>" />
					
					
					
					<div class="label">
						<a href="?action=changePassword">Change password</a>
					</div>
					<input type="submit" name="admin_change_profile" id="submit" value="Submit"><br>
				</form>
			</div>
		</div>
	</main>
	<div class="clearfix"></div>
	<?php
	@include("view/parts/footer.php");
	?>
</body>
</html>