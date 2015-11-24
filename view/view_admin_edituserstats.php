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
	<script src="<?=SCRIPTS?>drop.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?=SCRIPTS?>drop_files.js" type="text/javascript" charset="utf-8"></script>
	<link rel="stylesheet" href="<?=PLUGINS?>jquery-ui-1.11.4.custom/jquery-ui.css">
	<script src="<?=PLUGINS?>jquery-ui-1.11.4.custom/jquery-ui.js"></script>
	<!--Fancybox popup START-->
	<script type="text/javascript" src="<?=PLUGINS?>jquery.fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
	<script type="text/javascript" src="<?=PLUGINS?>jquery.fancybox/source/jquery.fancybox.pack.js"></script>
	<script type="text/javascript" src="<?=PLUGINS?>jquery.fancybox/source/jquery.fancybox.js"></script>
	<link rel="stylesheet" type="text/css" href="<?=PLUGINS?>jquery.fancybox/source/jquery.fancybox.css" media="screen" />
	<!--Fancybox popup END-->
	<!--Start timepicker-->
	<link href="<?=STYLES?>jquery-ui-timepicker-addon.css" type="text/css" rel="stylesheet" /> 
	<script src="<?=SCRIPTS?>jquery-ui-timepicker-addon.js" type="text/javascript" charset="utf-8"></script>
	<!--End timepicker-->
	<?php @include("view/parts/tinyMce.php"); ?>
	<script type="text/javascript">
	$(function() {
		$( "#tabs" ).tabs();
		$(".justlink").attr({"aria-controls":""});
	});
	</script>
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

				<form action="" method="post" class="my-form hundredPorsent" autocomplete="off" enctype="multipart/form-data">
					<div class="from-header" style="color:#ef4836; text-transform:uppercase">Edit users statement</div>
					<?php
					switch($_GET["type"]){

						case "products":
						?>
						<label for="username">Username: <font color="RED">*</font></label>
						<input type="text" name="username" id="username" value="<?=($data["data"][0]["username"]) ? htmlentities($data["data"][0]["username"]) : '' ?>" autocomplete="off" disabled="disabled" />
						<label for="pname">Product name: <font color="RED">*</font></label>
						<input type="text" name="pname" id="pname" value="<?=($data["data"][0]["title"]) ? htmlentities($data["data"][0]["title"]) : '' ?>" autocomplete="off" />
						<label for="pck">Packiging: <font color="RED">*</font></label>
						<input type="text" name="pck" id="pck" value="<?=($data["data"][0]["packaging"]) ? htmlentities($data["data"][0]["packaging"]) : '' ?>" autocomplete="off" />
						<label for="hscode">HS code: <font color="RED">*</font></label>
						<div style="width:100%; height:42px; position:relative">
							<input type="hidden" name="hscode-idx" id="hscode-idx" value="<?=$data["data"][0]["hscode_id"]?>" />
							<input type="text" name="hscode" id="hscode" value="<?=($data["data"][0]["hscode"]) ? htmlentities(rtrim($data["data"][0]["hscode"],"<br />")) : '' ?>" autocomplete="off" />
							<div id="hscode-box">
								<ul id="hscode-ul">
								</ul>
							</div>
						</div>
						<script type="text/javascript">
						
						$( "#hscode" ).keyup(function(e) {
							console.log(e.target.value);
						  	$.post("http://"+document.domain+"/en/ajax",{ hscode:true, s:e.target.value },function(data){
								if(data=="Error"){
									$("#hscode-box").slideUp();
								}else{
									$("#hscode-box").slideDown("slow");
									console.log(data);
									$("#hscode-ul").html(data);
								}
							});
						});
						$(document).on("click",".resultx",function(){
							var idx = $(this).data("idx"); 
							var vv = $(this).html(); 
							$("#hscode-idx").val(idx);
							$("#hscode").val(vv);
							$("#hscode-box").slideUp();
						});
						</script>
						<label for="awards">Awards: <font color="RED">*</font></label>
						<input type="text" name="awards" id="awards" value="<?=($data["data"][0]["awards"]) ? htmlentities($data["data"][0]["awards"]) : '' ?>" autocomplete="off" />
						<label for="shlf_life">Shelf life: <font color="RED">*</font></label>
						<input type="text" name="shlf_life" id="shlf_life" value="<?=($data["data"][0]["shelf_life"]) ? htmlentities($data["data"][0]["shelf_life"]) : '' ?>" autocomplete="off" />
						<label for="img">Image: <font color="RED">*</font></label><br />
						<img src="<?=WEBSITE?>image?f=<?=WEBSITE?>files/usersproducts/<?=$data["data"][0]['picture']?>&amp;w=180&amp;h=180" alt="" /><br />
						<input type="file" name="pimage" id="pimage" value="" autocomplete="off" /><br />
						<label for="desc">Description: <font color="RED">*</font></label>
						<textarea name="desc" class="tinyMce" id="desc"><?=($data["data"][0]["long_description"]) ? htmlentities($data["data"][0]["long_description"]) : '' ?></textarea>
						<label for="admin_com">Admin comment: </label>
						<input type="text" name="admin_com" id="admin_com" value="<?=($data["data"][0]["admin_com"]) ? htmlentities($data["data"][0]["admin_com"]) : '' ?>" autocomplete="off" />
						<label for="admin_com">Show: <font color="RED">*</font></label>
						<select name="show" id="show">
							<option value="1" <?=($data["data"][0]["visibility"]==1) ? 'selected="selected"' : ''?>>Hidden</option>
							<option value="2" <?=($data["data"][0]["visibility"]==2) ? 'selected="selected"' : ''?>>Show</option>
						</select>
						<?php
						break;
						case "services":
						?>
						<label for="username">Username: <font color="RED">*</font></label>
						<input type="text" name="username" id="username" value="<?=($data["data"][0]["username"]) ? htmlentities($data["data"][0]["username"]) : '' ?>" autocomplete="off" disabled="disabled" />
						<label for="service">Activity: <font color="RED">*</font></label>
						<?php
						$retrieve_users_info = new retrieve_users_info();
						$p = $retrieve_users_info->retrieveDb($data["data"][0]["products"]); 
						?>
						<select name="service" id="service" disabled="disabled">
							<option value=""><?=htmlentities($p)?></option>
						</select>
						<label for="servicex">Service: <font color="RED">*</font></label>
						<input type="text" name="servicex" class="servicex" id="servicex" value="<?=($data["data"][0]["title"]) ? htmlentities($data["data"][0]["title"]) : '' ?>" />
						<label for="desc">Description: <font color="RED">*</font></label>
						<textarea name="desc" class="tinyMce" id="desc"><?=($data["data"][0]["long_description"]) ? htmlentities($data["data"][0]["long_description"]) : '' ?></textarea>
						<label for="admin_com">Admin comment: </label>
						<input type="text" name="admin_com" id="admin_com" value="<?=($data["data"][0]["admin_com"]) ? htmlentities($data["data"][0]["admin_com"]) : '' ?>" autocomplete="off" />
						<label for="admin_com">Show: <font color="RED">*</font></label>
						<select name="show" id="show">
							<option value="1" <?=($data["data"][0]["visibility"]==1) ? 'selected="selected"' : ''?>>Hidden</option>
							<option value="2" <?=($data["data"][0]["visibility"]==2) ? 'selected="selected"' : ''?>>Show</option>
						</select>
						<?php
						break;
						case "enquires": 
						?>
						<label for="username">Username: <font color="RED">*</font></label>
						<input type="text" name="username" id="username" value="<?=($data["data"][0]["username"]) ? htmlentities($data["data"][0]["username"]) : '' ?>" autocomplete="off" disabled="disabled" />
						<label for="type">Type: <font color="RED">*</font></label>
						<select name="type" id="type" disabled="disabled">
							<option value="buy">I want to <?=$data["data"][0]["type"]?></option>
						</select>
						<label for="sector">Sector: <font color="RED">*</font></label>
						<select name="sector" id="sector" disabled="disabled">
							<option value=""><?=$data["data"][0]["sector_name"]?></option>
						</select>
						<label for="title">Title: <font color="RED">*</font></label>
						<input type="text" name="title" id="title" value="<?=htmlentities($data["data"][0]["title"])?>" autocomplete="off" />
						<label for="desc">Description: <font color="RED">*</font></label>
						<textarea name="desc" class="tinyMce" id="desc"><?=($data["data"][0]["long_description"]) ? htmlentities($data["data"][0]["long_description"]) : '' ?></textarea>
						<label for="admin_com">Admin comment: </label>
						<input type="text" name="admin_com" id="admin_com" value="<?=($data["data"][0]["admin_com"]) ? htmlentities($data["data"][0]["admin_com"]) : '' ?>" autocomplete="off" />
						<label for="admin_com">Show: <font color="RED">*</font></label>
						<select name="show" id="show">
							<option value="1" <?=($data["data"][0]["visibility"]==1) ? 'selected="selected"' : ''?>>Hidden</option>
							<option value="2" <?=($data["data"][0]["visibility"]==2) ? 'selected="selected"' : ''?>>Show</option>
						</select>
						<?php
					}
					?>
					<input type="submit" name="edit_user_statements" id="submit" value="Submit"><br>
					<button id="cancel" onclick="redirect('_self','<?=WEBSITE.LANG."/".ADMIN_SLUG?>?action=fusersstat&amp;load=<?=$_GET['type']?>'); return false;">Back</button>
				</form>
			</div>
		</div>
	</main>
	<div class="clearfix"></div>
	<?php
	@include("view/parts/footer.php");
	?>
	<script type="text/javascript">
	$('.makeFileDragable').click(function(e) { 
		e.stopPropagation();
		e.preventDefault();
		var status = $("#dragText",this).html();   
		if(status=="Start sorting"){
			$(".makeFileDragable").attr("style","background-color:red");
			$("#dragText",this).html("Stop sorting");
			$("main .center .content .dropArea .dragElements").sortable({
				 disabled: false
			});
		}else if(status=="Stop sorting"){
			$(".makeFileDragable").attr("style","background-color:green");
			$("#dragText",this).html("Start sorting");
			$("main .center .content .dropArea .dragElements").sortable({
		   		 disabled: true
			});
			var send_idx_array = new Array();
			$("main .center .content .dropArea .dragElements .filebox").each(function(index){
				var get_id = $(this).attr("id");
				var idx = get_id.split("flexbox-");
				send_idx_array.push(idx[1]); 
			}); 
			$.get("/en/ajaxupload",{ idxes:send_idx_array },function(d){
				console.log(d);
			});
		}        
    });

    $(".fancyBox").fancybox({
		'overlayShow'	: false,
		'transitionIn'	: 'elastic',
		'transitionOut'	: 'elastic'
	});

    $('.makeFileDragable2').click(function(e) { 
    	e.stopPropagation();
		e.preventDefault();
		var status = $("#dragText2",this).html();   
		if(status=="Start sorting"){
			$(".makeFileDragable2").attr("style","background-color:red");
			$("#dragText2",this).html("Stop sorting");
			$("main .center .content .dropArea2 .dragElements2").sortable({
				 disabled: false
			});
		}else if(status=="Stop sorting"){
			$(".makeFileDragable2").attr("style","background-color:green");
			$("#dragText2",this).html("Start sorting");
			$("main .center .content .dropArea2 .dragElements2").sortable({
		   		 disabled: true
			});
			var send_idx_array = new Array();
			$("main .center .content .dropArea2 .dragElements2 .filebox2").each(function(index){
				var get_id = $(this).attr("id");
				var idx = get_id.split("flexbox2-");
				send_idx_array.push(idx[1]); 
			}); 
			$.get("/en/ajaxupload",{ idxes_photos:send_idx_array },function(d){
				console.log(d);
			});
		}        
    });

    $('.makeFileDragable3').click(function(e) { 
    	e.stopPropagation();
		e.preventDefault();
		var status = $("#dragText3",this).html();   
		if(status=="Start sorting"){
			$(".makeFileDragable3").attr("style","background-color:red; margin-left:10px;");
			$("#dragText3",this).html("Stop sorting");
			$("main .center .content .my-form #tabs .dragElements3 #appmoreinfo").sortable({
				 disabled: false
			});
			$(".ddrag").css({"color":"#ef4836"});
		}else if(status=="Stop sorting"){
			$(".makeFileDragable3").attr("style","background-color:green; margin-left:10px;");
			$("#dragText3",this).html("Start sorting");
			$("main .center .content .my-form #tabs .dragElements3 #appmoreinfo").sortable({
		   		 disabled: true
			});
			$(".ddrag").css({"color":"#555555"});
			// var send_idx_array = new Array();
			// $("main .center .content .my-form #tabs .dragElements3 .info-list").each(function(index){
			// 	var get_id = $(this).attr("id");
			// 	var idx = get_id.split("flexbox2-");
			// 	send_idx_array.push(idx[1]); 
			// }); 
			// $.get("/en/ajaxupload",{ idxes_photos:send_idx_array },function(d){
			// 	console.log(d);
			// });
		}        
    });
	</script>
</body>
</html>