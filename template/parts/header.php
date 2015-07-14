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
?> - Trade with Georgia</title>
<link type="text/plain" rel="author" href="<?php echo WEBSITE;?>humans.txt" />
<link href="<?php echo TEMPLATE;?>css/bootstrap.css" type="text/css" rel="stylesheet"/>
<link href="<?php echo TEMPLATE;?>css/bootstrap-theme.css" type="text/css" rel="stylesheet"/>
<link href="<?php echo TEMPLATE;?>css/fonts.css" type="text/css" rel="stylesheet"/>
<link href="<?php echo TEMPLATE;?>css/style.css" type="text/css" rel="stylesheet"/>
<link href="<?php echo TEMPLATE;?>css/custom_res.css" type="text/css" rel="stylesheet"/> 
<link href="<?php echo TEMPLATE;?>css/fonts.css" type="text/css" rel="stylesheet"/> 
<link href='http://fonts.googleapis.com/css?family=Roboto:400,400italic,500,500italic,700,900' rel='stylesheet' type='text/css'>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="<?php echo TEMPLATE;?>js/bootstrap.js"></script>
<script src="<?php echo TEMPLATE;?>js/responsive_menu.js"></script>
<script src="<?php echo TEMPLATE;?>js/scripts.js"></script>
<!--Start of Zopim Live Chat Script-->
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="//v2.zopim.com/?39RyjmvEGfikM3GPxh7EiUJlsKNbZgyI";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
</script>
<!--End of Zopim Live Chat Script-->
</head>
<body id="menu_responsive">
	<div style="margin:0; padding:0; width:100%; text-align:center; background-color:#ffa100; color:white; line-height:25px; font-size:14px">Under Development</div>
<?php
include("login.php");
include("register.php");
include("message.php");
?>

 
<header id="header" class="container-fluid" style="padding:0">
	<div class="container">
		<div id="header_line">
			<div class="col-sm-12 text-right padding_0">			
				<div id="members_area">	
					<?php if(!isset($_SESSION["tradewithgeorgia_username"])) { ?>			
					<a href="#" data-toggle="modal" data-target="#register_popup"><?=$data["language_data"]["register"]?></a> | 
					<a href="#" data-toggle="modal" data-target="#login_popup"><?=$data["language_data"]["login"]?></a>
					<?php }else if(isset($_SESSION["tradewithgeorgia_company_type"])){ ?>
					<a href="javascript:;"><?=$_SESSION["tradewithgeorgia_username"]?></a> | 
					<a href="<?=company_type::profilelink()?>"><?=$data["language_data"]["profile"]?></a> | 
					<a href="javascipt:;" id="logoutbutton"><?=$data["language_data"]["logout"]?></a> 
					<?php } ?>
				</div>
			</div>
		</div>
		<div id="header_2">
			<div class="col-sm-5 col-md-5 col-xs-5 col-lg-5 padding_0 logo_text">
				<a href="<?=MAIN_PAGE?>">
					<img src="<?=TEMPLATE?>img/logo.png"/>
				</a>
			</div>
			<div class="col-sm-5 head_contact text-right">
				<div id="live_chat_div"><a href="#"><?=$data["language_data"]["livechart"]?></a></div>
				<div id="header_contact">
					<li><?=$data["language_data"]["hotlinelabel"]?></li>
					<li><span><?=$data["language_data"]["hotlinevalue"]?></span></li>
				</div>
			</div>
			<div class="col-sm-2 header_map text-right">
				<img src="<?=TEMPLATE?>img/enterprise_georgia.png"/>
			</div>
		</div>
	</div>	
</header>


<!-- START MAIN MENU -->
	<div class="navbar navbar-trade navbar-fixed-top" role="navigation" id="slide-nav">
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
			<?php echo $data["main_menu"]; ?>         
		 </div>
		</div>
	  </div>
<!-- END MAIN MENU -->	