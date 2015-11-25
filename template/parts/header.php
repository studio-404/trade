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
	$tags = $data["news_general"][0]["keywords"];
}else if(!empty($data["event_list"])){
	$first = array_slice($data["event_list"],0,1);
	$title = $first[0]["title"];
	$desc = $first[0]["short_description"];
	$first = array_slice($data["event_list"], 0, 1);
	if($first[0]["pic"]){ $shareImage = WEBSITE.'image?f='.WEBSITE.$first[0]["pic"].'&w=600&h=315'; }
	else{ $shareImage = TEMPLATE.'img/logoshare.png';  }
	$tags = $first[0]["keywords"];
}else if(!empty($data["news_list"])){
	$news_first = array_slice($data["news_list"],0,1);
	$title = $news_first[0]->title; 	
	$desc = $news_first[0]->short_description; 	
	$first = array_slice($data["last_news_files"], 0, 1);
	if($first[0]->file){ $shareImage = WEBSITE.'image?f='.WEBSITE.$first[0]->file.'&w=600&h=315'; }
	else{ $shareImage = TEMPLATE.'img/logoshare.png';  }
	$tags = $news_first[0]->keywords;
}else if(!empty($data["team_general"][0]["title"])){
	$title = $data["team_general"][0]["title"];
	$desc = $data["team_general"][0]["short_description"];
	$shareImage = TEMPLATE.'img/logoshare.png';
	$tags = $data["team_general"][0]["keywords"];
}else if(!empty($data["text_general"][0]["title"])){
	$title = $data["text_general"][0]["title"]; 
	$desc = $data["text_general"][0]["description"]; 
	$first = array_slice($data["text_files"], 0, 1);
	if($first[0]->file){ $shareImage = WEBSITE.'image?f='.WEBSITE.$first[0]->file.'&w=600&h=315'; }
	else{ $shareImage = TEMPLATE.'img/logoshare.png'; }
	$tags = $data["text_general"][0]["keywords"];
}else{
	$title = $data["language_data"]["mainpage"]; 
	$desc = $title." - Enterprise Georgia"; 
	$shareImage = TEMPLATE.'img/logoshare.png';
	$tags = $data["language_data"]["tags"];
}
echo $title; 
?> - Trade with Georgia</title>
<!-- FB Meta tags (start) -->
<meta property="og:title" content="<?=htmlentities(strip_tags($title))?> - Enterprise Georgia" />
<meta property="og:type" content="website" />
<meta property="og:url" content="<?=WEBSITE_.$_SERVER['REQUEST_URI']?>"/>
<meta property="og:image" content="<?=$shareImage?>" />
<meta property="og:site_name" content="Enterprise Georgia"/>
<meta property="og:description" content="<?=htmlentities(strip_tags($desc))?>"/>
<!-- FB Meta tags (end)-->
<meta name="description" content="<?=htmlentities(strip_tags($desc))?>">
<meta name="keywords" content="<?=$tags?>">
<meta name="author" content="Studio 404, Niki Getsadze"/>
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
</head>
<body id="menu_responsive">
	<!-- <div style="margin:0; padding:0; width:100%; text-align:center; background-color:#ffa100; color:white; line-height:25px; font-size:14px">Under Development</div> -->
<?php 
/* captcha code generation */
$_SESSION['protect_x'] = uid::captcha(2).ustring::random(2); 
include("login.php");
include("register.php");
include("recover_password.php");
include("message.php");
include("addcertificate.php");
?>
<center>Website Is Under Development</center>
<header id="header" class="container-fluid" style="padding:0;">
	<div class="container">
		<div id="header_line">
			<div class="col-sm-12 text-right padding_0">			
				<div id="members_area">	
					<?php if(!isset($_SESSION["tradewithgeorgia_username"])) { ?>			
					<a href="#" data-toggle="modal" data-target="#register_popup"><?=$data["language_data"]["register"]?></a> | 
					<a href="#" data-toggle="modal" data-target="#login_popup"><?=$data["language_data"]["login"]?></a> | 
					<a href="#" data-toggle="modal" data-target="#recover_password"><?=$data["language_data"]["recoverpassword"]?></a>
					<?php }else if(isset($_SESSION["tradewithgeorgia_company_type"])){ ?>
					<a href="javascript:;">
					<?php 
						if($_SESSION["user_data"]["companyname"]){
							echo $_SESSION["user_data"]["companyname"];
						}else if($_SESSION["tradewithgeorgia_user_namelname"]){
							echo $_SESSION["tradewithgeorgia_user_namelname"];
						}else{
						 	echo $_SESSION["tradewithgeorgia_username"];
						}
						?>
					</a> | 
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
				<div id="live_chat_div"><a href="javascript:;" class="callChatButton"><?=$data["language_data"]["livechart"]?></a></div>
				<div id="header_contact">
					<li><?=$data["language_data"]["hotlinelabel"]?></li>
					<li><span><?=$data["language_data"]["hotlinevalue"]?></span></li>
				</div>
			</div>
			<div class="col-sm-2 header_map text-right">
				<a href="http://enterprise.gov.ge" target="_blank">
					<img src="<?=TEMPLATE?>img/enterprise_georgia.png"/>
				</a>
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