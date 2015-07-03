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
	<script src="<?=PLUGINS?>/tinymce/tinymce.min.js"></script>
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
				?>

				<form action="" method="post" class="my-form hundredPorsent" autocomplete="off">
					<div class="from-header" style="color:#ef4836; text-transform:uppercase">Add website user</div>
					
					<label for="chartType">Choose chart type: <font color="RED">*</font></label>
					<select name="chartType" class="chartType">
						<option value="barChart">Bar chart</option>
						<option value="columnChart">Column chart</option>
						<option value="pieChart">Pie chart</option>
						<option value="donutChart">Donut chart</option>						
						<option value="areaChart">Area chart</option>						
						<option value="steppedAreaChart">Stepped area chart</option>					
					</select>
					<label for="example">Example:</label>
					<div id="example" style="border:solid 1px #ccc"><iframe src="<?=WEBSITE?>_plugins/googleCharts/examples/barChart.html" width="100%" height="230"></iframe></div>

					<label for="title">Title: <font color="RED">*</font></label>
					<input type="text" name="title" id="title" value="">
					<label for="datachart">Chart data: <a href="javascript:;" class="moreDataColumn" style="color:#ef4836"><i class="fa fa-plus"></i></a></label><div style="clear:both"></div>
					<div class="innerInputs" style="margin:0">
						<input type="text" name="col[]" value="" style="width:40%; float:left; margin-top:10px;" placeholder="Column name" />
						<input type="text" name="val[]" value="" style="width:40%; float:left; margin-top:10px; margin-left:10px;" placeholder="Column value" />
						<div style="clear:both"></div>
					</div>

					<input type="submit" name="add_chart" id="submit" value="Submit"><br>
				</form>
			</div>
		</div>
	</main>
	<div class="clearfix"></div>
	<?php
	@include("view/parts/footer.php");
	?>
	<script type="text/javascript">
	$(document).on("change",".chartType", function(){
		var chosen = $(this).val();
		var ifr = '<iframe src="<?=WEBSITE?>_plugins/googleCharts/examples/'+chosen+'.html" width="100%" height="230"></iframe>';
		var o = '';
		$("#example").html(ifr); 
		if(chosen=="areaChart" || chosen=="steppedAreaChart"){
			o += '<input type="text" name="year[]" value="" style="width:30%; float:left; margin-top:10px;" placeholder="Year" />';
			o += '<input type="text" name="col[]" value="" style="width:30%; float:left; margin-top:10px; margin-left:10px;" placeholder="Column name" />';
			o += '<input type="text" name="val[]" value="" style="width:30%; float:left; margin-top:10px; margin-left:10px;" placeholder="Column value" />';
			o += '<div style="clear:both"></div>';
		}else{
			o += '<input type="text" name="col[]" value="" style="width:40%; float:left; margin-top:10px;" placeholder="Column name" />';
			o += '<input type="text" name="val[]" value="" style="width:40%; float:left; margin-top:10px; margin-left:10px;" placeholder="Column value" />';
			o += '<div style="clear:both"></div>';
		}

		$(".innerInputs").html(o);
	});
	
	$(document).on("click", ".moreDataColumn", function(e){
		var chosen = $(".chartType").val();
		var oo = '';
		if(chosen=="areaChart" || chosen=="steppedAreaChart"){
			oo += '<input type="text" name="year[]" value="" style="width:30%; float:left; margin-top:10px;" placeholder="Year" />';
			oo += '<input type="text" name="col[]" value="" style="width:30%; float:left; margin-top:10px; margin-left:10px;" placeholder="Column name" />';
			oo += '<input type="text" name="val[]" value="" style="width:30%; float:left; margin-top:10px; margin-left:10px;" placeholder="Column value" />';
			oo += '<div style="clear:both"></div>';
		}else{
			oo += '<input type="text" name="col[]" value="" style="width:40%; float:left; margin-top:10px;" placeholder="Column name" />';
			oo += '<input type="text" name="val[]" value="" style="width:40%; float:left; margin-top:10px; margin-left:10px;" placeholder="Column value" />';
			oo += '<div style="clear:both"></div>';
		}
		$(".innerInputs").append(oo);
	});
	</script>
</body>
</html>