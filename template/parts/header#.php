<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php
if(!empty($data["news_general"][0]["title"])){
	$title =  $data["news_general"][0]["title"];
	$desc =  $data["news_general"][0]["short_description"];
	$first = array_slice($data["last_news_files"], 0, 1);
	if($first[0]->file){ $shareImage = WEBSITE.'image?f='.WEBSITE.$first[0]->file.'&w=600&h=315'; }
	else{ $shareImage = TEMPLATE.'img/logoshare.png';  }
	
}else if(!empty($data["events_general"])){
	$first = array_slice($data["events_general"],0,1);
	$title = $first[0]->title;
	$desc = $first[0]->short_description;
	$shareImage = TEMPLATE.'img/logoshare.png';
}else if(!empty($data["news_list"])){
	$news_first = array_slice($data["news_list"],0,1);
	$title = $news_first[0]->title; 	
	$desc = $news_first[0]->short_description; 	
	$first = array_slice($data["last_news_files"], 0, 1);
	if($first[0]->file){ $shareImage = WEBSITE.'image?f='.WEBSITE.$first[0]->file.'&w=600&h=315'; }
	else{ $shareImage = TEMPLATE.'img/logoshare.png';  }
}else if(!empty($data["team_general"][0]["title"])){
	$title = $data["team_general"][0]["title"];
	$desc = $data["team_general"][0]["short_description"];
	$shareImage = TEMPLATE.'img/logoshare.png';
}else if(!empty($data["text_general"][0]["title"])){
	$title = $data["text_general"][0]["title"]; 
	$desc = $data["text_general"][0]["description"]; 
	$first = array_slice($data["text_files"], 0, 1);
	if($first[0]->file){ $shareImage = WEBSITE.'image?f='.WEBSITE.$first[0]->file.'&w=600&h=315'; }
	else{ $shareImage = TEMPLATE.'img/logoshare.png'; }
}else{
	$title = $data["language_data"]["mainpage"]; 
	$desc = $title." - Enterprise Georgia"; 
	$shareImage = TEMPLATE.'img/logoshare.png';
}
echo $title; 
?> - Enterprise Georgia</title>
<link rel="icon" type="image/gif" href="<?=TEMPLATE?>img/favicon.gif" />
<link type="text/plain" rel="author" href="<?php echo WEBSITE;?>humans.txt" />
<!-- FB Meta tags (start) -->
<meta property="og:title" content="<?=htmlentities(strip_tags($title))?> - Enterprise Georgia" />
<meta property="og:type" content="website" />
<meta property="og:url" content="<?=WEBSITE_.$_SERVER['REQUEST_URI']?>"/>
<meta property="og:image" content="<?=$shareImage?>" />
<meta property="og:site_name" content="Enterprise Georgia"/>
<meta property="og:description" content="<?=htmlentities(strip_tags($desc))?>"/>
<!-- FB Meta tags (end)-->
<link href="<?php echo TEMPLATE;?>css/bootstrap.css" type="text/css" rel="stylesheet"/>
<link href="<?php echo TEMPLATE;?>css/bootstrap-theme.css" type="text/css" rel="stylesheet"/>
<link href="<?php echo TEMPLATE;?>css/fonts.css" type="text/css" rel="stylesheet"/>
<link href="<?php echo TEMPLATE;?>css/style.css" type="text/css" rel="stylesheet"/>
<link href="<?php echo TEMPLATE;?>css/home_slide.css" type="text/css" rel="stylesheet"/>
<link href="<?php echo TEMPLATE;?>css/jquery.bxslider.css" type="text/css" rel="stylesheet"/>
<link href="<?php echo TEMPLATE;?>css/custom_res.css" type="text/css" rel="stylesheet"/> 
<link href='http://fonts.googleapis.com/css?family=Roboto:400,400italic,500,500italic,700,900' rel='stylesheet' type='text/css'>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE;?>js/jquery-ui-1.9.0.custom.min.js"></script>
<script type="text/javascript" src="<?=TEMPLATE?>js/jquery-ui-tabs-rotate.js" ></script>
<script src="<?php echo TEMPLATE;?>js/bootstrap.js"></script>
<script src="<?php echo TEMPLATE;?>js/jquery.bxslider.min.js"></script>
<script src="<?php echo TEMPLATE;?>js/jquery.easing.1.3.js"></script>
<script src="<?php echo TEMPLATE;?>js/jquery.fitvids.js"></script>
<!-- <script src="<?php echo TEMPLATE;?>js/youtube_popup.js"></script> --> 
<script src="<?php echo TEMPLATE;?>js/responsive_menu.js"></script>
<script src="<?php echo TEMPLATE;?>js/scripts.js"></script>
<!-- Add fancyBox main JS and CSS files START-->
<script type="text/javascript" src="<?php echo PLUGINS;?>jquery.fancybox/source/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="<?php echo PLUGINS;?>jquery.fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />
<!-- Add fancyBox main JS and CSS files END-->
<script src="<?php echo TEMPLATE;?>js/youtube_popup.js"></script>

<!--JW player START-->
<script src="<?php echo PLUGINS;?>player/jwplayer.js"></script>
<script type="text/javascript">jwplayer.key="Jew4tEqF7WQiHaekwfYlMGfugyHPJ6jax0b3sw==";</script>
<!--JW player END -->
<?php 
if(LANG=="ge"){
?>
<link href="<?php echo TEMPLATE;?>css/ge.css" type="text/css" rel="stylesheet"/> 
<?php } ?>
</head>
<body id="menu_responsive">
<div style="background:#244396; color:white; width:100%; text-align:center; font-size:14px; line-height:16px; border-bottom:1px solid #000">Under development...</div>
<header id="header" class="container padding_0">
	<div class="container padding_0">
		<div id="header_line">
			<div class="col-sm-12 text-right padding_0">			
				
			</div>
		</div>
		<div id="header_2">
			<div class="col-sm-4 col-md-4 col-xs-4 col-lg-4 padding_0 logo_text">
				<a href="<?php echo MAIN_PAGE; ?>">
					<?php
					$logo = (LANG=="ge") ? 'logo2.svg' : 'logo1.svg';
					?>
					<img src="<?php echo TEMPLATE?>/img/<?=$logo?>" alt="logo" />
				</a>
			</div>
			<div class="col-sm-8 head_contact padding_0"  style="text-align:right;">
					
				<div class="language">
                	<?php 
                	$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                	foreach($data['languages'] as $val){ 
						$replaced = str_replace("/".LANG."/", "/".$val->langs."/", $actual_link);
                		echo '<a href="'.$replaced .'"><img src="'.WEBSITE.$val->lang_img.'" alt="" /></a>';
                	}
                	?>
				</div>	
				
				<div id="live_chat_div">
					<li id="chatstatus" style="font-family:roboto">Loading status...</li>
					<li><span><a href="javascript:;" class="callZopim"><?=$data["language_data"]["livechatvalue"]?></a></span></li>
				</div>
				<div id="header_contact">
					<li><?=$data["language_data"]["hotlinelabel"]?></li>
					<li><span><?=$data["language_data"]["hotlinevalue"]?></span></li>
				</div>				
				
				<div class="header_search" style="height:50px; margin-top:20px;width:100%;">
					<div class="form-group" style=" text-align:right">
						<div class="input-group" style=""> 
							<?php $s = filter_input(INPUT_GET, "s"); ?>
							<input type="text" class="input-sm searchinput" placeholder="<?=$data["language_data"]["search"]?>" value="<?=(isset($s)) ? htmlentities($s) : ''?>" style="width:180px;"/>
							<span class="input-group-addon" id="searchinput" data-prefix="<?=WEBSITE.LANG."/search?s="?>" style="margin-right:10px; padding:2px 7px;">
								<div class="glyphicon glyphicon-search"></div>
							</span>
						</div>
					</div>
				</div>
				
				 <div style="position:absolute; right:5px; top:90px; z-index:9999">
					<a class="open_div" href="#nav">
						<div class="icon-bar"></div>
						<div class="icon-bar"></div>
						<div class="icon-bar"></div>
						<div class="icon-bar"></div>
					</a>
				 </div>
				 
				 <!-- START MAIN MENU -->
						<div class="navbar navbar-enterprise navbar-fixed-top" role="navigation" id="slide-nav">
							<div class="container">
							 <div class="navbar-header">
								<a class="navbar-toggle"> 
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</a> 
							 </div>
							 <div id="slidemenu" class="dropdown">
								<?=$data["main_menu"]?>         
							 </div>
							</div>
						  </div>
					<!-- END MAIN MENU -->	
								
			</div>
		</div>
	</div>	
</header>