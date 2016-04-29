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
	<link rel="stylesheet" href="<?=PLUGINS?>jquery-ui-1.11.4.custom/jquery-ui.css">
</head>
<body>
	<?php
	@include("view/parts/header.php");
	?>
	<main>
		<div class="center">
			<?php
				@include("view/parts/change_language.php");
				@include("view/parts/breadcrups.php");
			?>
			<div class="content">
				<?php
				if(!isset($_GET['loadtickets'])){
				?>
				<div class="button">
					<a href="?action=addNews&amp;newsidx=<?=$_GET['id']?>&amp;type=<?=$_GET['type']?>&amp;super=<?=$_GET['super']?>"><i class="fa fa-plus-circle"></i> <span>Add</span></a>
				</div>
				<div class="wrap">
					<div class="search">
					<input type="text" class="searchTerm" placeholder="What are you looking for?">
					<input type="submit" class="searchButton">
					</div>
				</div>
				<?php
				}else{
					?>
					<div class="wrap" style="margin-bottom:20px;">
						<div class="search">
						<input type="text" class="searchTerm" placeholder="Enter Ticket Id" value="<?=(isset($_GET['search']) ? $_GET['search'] : '')?>" />
						<input type="submit" class="searchButton">
						</div>
					</div>
					<?php
				}
				?>			

				<div id="table">
					<div class="header-row row">
						<?php
						if(isset($_GET['loadtickets']) && is_numeric($_GET['loadtickets'])){
							?>
							<span class="cell primary">Ticket ID</span>
							<span class="cell">Date</span>
							<span class="cell">First &amp; Last Name</span>
							<span class="cell">Email</span>
							<span class="cell">Mobile</span>
							<span class="cell">Action</span>
							<?php
						}else{
						?>
							<span class="cell primary">Vis.</span>
							<span class="cell">Id</span>
							<span class="cell">Date</span>
							<?php
							if(isset($_GET['type']) && $_GET['type']=="eventpage"){
								echo '<span class="cell">Expire Date</span>';
							}
							?>
							<span class="cell">title</span>
							<?php
							if(isset($_GET['type']) && $_GET['type']=="eventpage"){
								echo '<span class="cell">Registration</span>';
								echo '<span class="cell">Members</span>';
							}
							?>
							<span class="cell">tags</span>
							<span class="cell" style="width:100px">Action</span>
						<?php
						}
						?>
					</div>					
					<?=$data['table']?>
				</div>
			<?=$data['pager']?>
			<?php
			if(isset($_GET['type']) && $_GET['type']=="eventpage" && $_GET['loadtickets']){
				?>
				<p style="margin:20px 0px;">
					<a href="<?=WEBSITE?>en/tadmin?action=newsModule&amp;type=eventpage&amp;id=<?=$_GET['id']?>&amp;super=<?=$_GET['super']?>&amp;loadtickets=<?=$_GET['loadtickets']?>&amp;token=<?=$_GET['token']?>&amp;csv=true" target="_blank" style="color:#ef4836">Export Tickets</a> 
				</p>
				<?php
			}
			?>			
		</div>
	</main>
	<div class="clearfix"></div>
	<?php
	@include("view/parts/footer.php");
	?>
</body>
</html>