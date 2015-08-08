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
						<p>Data inserted !</p>
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

				// echo "<pre>";
				// print_r($data["table"]);
				// echo "</pre>";
				?>

				<form action="" method="post" class="my-form hundredPorsent" autocomplete="off">
					<div class="from-header" style="color:#ef4836; text-transform:uppercase">Exelator</div>
					
					<label for="table">Table: <font color="RED">*</font></label>
					<select name="table" id="table">
						<option value="">Choose</option>
						<?php 
						foreach($data["table"] as $tbt) : 
							$active = (isset($_GET['load']) && $_GET["load"]==$tbt['TABLE_NAME']) ? 'selected="selected"' : '';
						?>
						<option value="<?=$tbt['TABLE_NAME']?>" <?=$active?>><?=$tbt['TABLE_NAME']." (".$tbt['TABLE_ROWS'].")"?></option>
						<?php endforeach;?>
					</select>
					<label for="mysql">MySQL: <font color="RED">*</font></label>
					<?php if(isset($_GET['load'])) : ?>
					<textarea name="mysql" id="mysql" readonly="readonly"><?=$data["sqlcommand"][1]?></textarea>
					<?php endif; ?>

					<?php foreach($data["sqlcommand"][0] AS $column) : ?>
					<div style="clear:both"></div>
					<label for="mysql" style="width:100%; float:left;"><?=strtoupper($column["COLUMN_NAME"])?>: </label>
					<input type="checkbox" name="chk[]" value="<?=$column["COLUMN_NAME"]?>" checked="checked" style="foat:left; padding:0 20px 0 0" />
					<input type="text" name="input[]" value="<?=$column["COLUMN_NAME"]?>" style="width:600px; foat:left; " />
					<div style="clear:both"></div>
					<?php endforeach; ?>
					
					<input type="submit" name="add_admin" id="submit" value="Execute"><br>
				</form>
			</div>
		</div>
	</main>
	<div class="clearfix"></div>
	<script type="text/javascript" charset="utf-8">
	$(document).on("change","#table",function(){
		var ele = $(this).val();
		var host = document.URL;
		var splited = host.split("&load"); 
		location.href = splited[0]+"&load="+ele; 
	});
	</script>
	<?php
	@include("view/parts/footer.php");
	?>
</body>
</html>