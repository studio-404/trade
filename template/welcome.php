<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php
if(!empty($data["news_general"][0]["title"])){
	echo $data["news_general"][0]["title"];
}else if(!empty($data["events_general"])){
	$first = array_slice($data["events_general"],0,1);
	echo $first[0]->title;
}else if(!empty($data["news_list"])){
	$news_first = array_slice($data["news_list"],0,1);
	echo $news_first[0]->title; 	
}else if(!empty($data["team_general"][0]["title"])){
	echo $data["team_general"][0]["title"];
}else if(!empty($data["text_general"][0]["title"])){
	echo $data["text_general"][0]["title"]; 
}else{
	echo $data["language_data"]["mainpage"]; 
}
?> - Enterprise Georgia</title>
<link rel="icon" type="image/gif" href="<?=TEMPLATE?>img/favicon.gif" />
<link href="<?php echo TEMPLATE;?>css/bootstrap.css" type="text/css" rel="stylesheet"/>
<link href="<?php echo TEMPLATE;?>css/bootstrap-theme.css" type="text/css" rel="stylesheet"/>
<link href="<?php echo TEMPLATE;?>css/fonts.css" type="text/css" rel="stylesheet"/>
<link href="<?php echo TEMPLATE;?>css/style.css" type="text/css" rel="stylesheet"/>
<link href="<?php echo TEMPLATE;?>css/custom_res.css" type="text/css" rel="stylesheet"/> 
<link href='http://fonts.googleapis.com/css?family=Roboto:400,400italic,500,500italic,700,900' rel='stylesheet' type='text/css'>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="<?php echo TEMPLATE;?>js/bootstrap.js"></script>
<?php 
if(LANG=="ge"){
?>
<link href="<?php echo TEMPLATE;?>css/ge.css" type="text/css" rel="stylesheet"/> 
<?php } ?>

</head>
<body id="welcome_body" style="height:auto; max-height:auto">
 
<div class="container-fluid padding_0" id="welcome_page">
	<div id="welcome_header" style="background-size:cover">
		<div id="welcome_logo" style="padding-left:15px; float: left;">
			<a href="<?=MAIN_PAGE?>"><img src="<?php echo TEMPLATE;?>img/welcome_logo.png" style="max-height:135px" class="img-responsive"/></a>
		</div>
		<div id="welcome_logo_2" style="margin-top:0px"> 
			<a href="<?=MAIN_PAGE?>"><img src="<?php echo TEMPLATE;?>img/welcome_enterprise.png" style="float:right; max-height:75px" class="img-responsive"/></a>
			<div style="clear:both"></div>
			<div class="enter_the_website" style="float:right"><a href="<?=MAIN_PAGE?>"><?=$data["language_data"]["enterwebsite"]?></a></div>
		</div>	<div style="clear:both"></div>	
		<div id="welcome_border"></div>	
		<div style="clear:both"></div>
	</div>
	
	
	<div id="welcome_content">
		
		<div id="or_find_out_more" style="margin-top:20px;">
			<div><?=$data["language_data"]["findoutmore"]?></div>
		</div>
		<div style="clear:both"></div>

		<?php
		$ctext = new ctext();
		foreach($data["components"] as $val){
		if($val->com_name != "Welcome page bunners"){ continue; }
		?>
			<div class="items_div">
				<a href="<?=$val->url?>" target="_blank">
					<div class="item">
						<div class="image">
							<img src="<?=WEBSITE?>image?f=<?=WEBSITE_.$val->image?>&w=229&h=229&baw=1" class="img-responsive" />
						</div>			
						<div class="title"><?php echo strip_tags($val->title); ?></div>
					</div>
					<div class="text" style="height:40px" title="<?=htmlentities(strip_tags($val->desc))?>"><?php echo $ctext->cut(strip_tags($val->desc),65); ?></div>
				</a>	
			</div>	
		<?php
		}
		?> <div style="clear:both"></div>
	</div>
	
	<div id="welcome_footer" style="padding:10px 10px 0 10px; background-image:none">
		<ul class="text-right text_formats_blue gio_10px"> 
			<li><a href="javascript:;"><span>Tel: <?=$data["language_data"]["hotlinevalue"]?></span></a></li>
			<li><a href="javascript:;" class="unclearemail"></a></li>
		</ul>
		<div id="welcome_border"></div>		
	</div>
	
</div>
<script type="text/javascript">
$(document).ready(function() {        
		insertEmailTo('<?=str_replace("@", "%*%", $data["language_data"]["emailvalue"])?>');
}); 
function insertEmailTo(e){
	var x = e.replace('%*%','@'); 
	$(".unclearemail").html(x);
} 
</script>




</body>
</html>