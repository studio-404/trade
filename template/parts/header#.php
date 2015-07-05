<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php
$template_title = new template_title();
$header_data = $template_title->getTitle($data);
echo $header_data["title"]; 
?> - Enterprise Georgia</title>
<link rel="icon" type="image/gif" href="<?=TEMPLATE?>img/favicon.gif" />
<link type="text/plain" rel="author" href="<?php echo WEBSITE;?>humans.txt" />
<!-- FB Meta tags (start) -->
<meta property="og:title" content="<?=htmlentities(strip_tags($header_data["title"]))?> - Enterprise Georgia" />
<meta property="og:type" content="website" />
<meta property="og:url" content="<?=WEBSITE_.$_SERVER['REQUEST_URI']?>"/>
<meta property="og:image" content="<?=$header_data["shareImage"]?>" />
<meta property="og:site_name" content="Enterprise Georgia"/>
<meta property="og:description" content="<?=htmlentities(strip_tags($header_data["desc"]))?>"/>
<!-- FB Meta tags (end)-->
<link href="<?php echo TEMPLATE;?>css/compress.css" type="text/css" rel="stylesheet"/>
<link href="<?php echo TEMPLATE;?>css/style.css" type="text/css" rel="stylesheet"/>
<link href='http://fonts.googleapis.com/css?family=Roboto:400,400italic,500,500italic,700,900' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="<?php echo TEMPLATE;?>js/compress.js"></script>
<!--JW player START-->
<script src="<?php echo PLUGINS;?>player/jwplayer.js"></script>
<script type="text/javascript">jwplayer.key="Jew4tEqF7WQiHaekwfYlMGfugyHPJ6jax0b3sw==";</script>
<!--JW player END -->
<?php 
if(LANG=="ge"){
?>
<link href="<?php echo TEMPLATE;?>css/compress_ge.css" type="text/css" rel="stylesheet"/> 
<?php } ?>
</head>
<body id="menu_responsive">
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
					<img src="<?php echo TEMPLATE?>img/<?=$logo?>" alt="logo" />
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