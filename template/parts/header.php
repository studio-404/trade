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
	else{ $shareImage = "/".LANG."/load-public-files?datafrom=file&amp;ext=png&amp;dataid=45&amp;sizetype=false";  }
	$tags = $data["news_general"][0]["keywords"];
}else if(!empty($data["event_list"])){
	$first = array_slice($data["event_list"],0,1);
	$title = $first[0]["title"];
	$desc = $first[0]["short_description"];
	$first = array_slice($data["event_list"], 0, 1);
	if($first[0]["pic"]){ $shareImage = WEBSITE.'image?f='.WEBSITE.$first[0]["pic"].'&w=600&h=315'; }
	else{ $shareImage = "/".LANG."/load-public-files?datafrom=file&amp;ext=png&amp;dataid=45&amp;sizetype=false";  }
	$tags = $first[0]["keywords"];
}else if(!empty($data["news_list"])){
	$news_first = array_slice($data["news_list"],0,1);
	$title = $news_first[0]->title; 	
	$desc = $news_first[0]->short_description; 	
	$first = array_slice($data["last_news_files"], 0, 1);
	if($first[0]->file){ $shareImage = WEBSITE.'image?f='.WEBSITE.$first[0]->file.'&w=600&h=315'; }
	else{ $shareImage = "/".LANG."/load-public-files?datafrom=file&amp;ext=png&amp;dataid=45&amp;sizetype=false";  }
	$tags = $news_first[0]->keywords;
}else if(!empty($data["team_general"][0]["title"])){
	$title = $data["team_general"][0]["title"];
	$desc = $data["team_general"][0]["short_description"];
	$shareImage = "/".LANG."/load-public-files?datafrom=file&amp;ext=png&amp;dataid=45&amp;sizetype=false";
	$tags = $data["team_general"][0]["keywords"];
}else if(!empty($data["text_general"][0]["title"])){
	$title = $data["text_general"][0]["title"]; 
	$desc = $data["text_general"][0]["description"]; 
	$first = array_slice($data["text_files"], 0, 1);
	if($first[0]->file){ $shareImage = WEBSITE.'image?f='.WEBSITE.$first[0]->file.'&w=600&h=315'; }
	else{ $shareImage = "/".LANG."/load-public-files?datafrom=file&amp;ext=png&amp;dataid=45&amp;sizetype=false"; }
	$tags = $data["text_general"][0]["keywords"];
}else{
	$title = $data["language_data"]["mainpage"]; 
	$desc = $title." - Trade With Georgia"; 
	$shareImage = "/".LANG."/load-public-files?datafrom=file&amp;ext=png&amp;dataid=45&amp;sizetype=false";
	$tags = $data["language_data"]["tags"];
}
if(Input::method("GET","t") && Input::method("GET","i") && $data["fetch"]["namelname"]!=""){
	$title = htmlentities($data["fetch"]["namelname"]);
	$shareImage = (!empty($data["fetch"]["picture"])) ? WEBSITE.'image?f='.WEBSITE.'files/usersimage/'.$data["fetch"]["picture"].'&w=600&h=315' : "/".LANG."/load-public-files?datafrom=file&amp;ext=png&amp;dataid=45&amp;sizetype=false";
	
	if(Input::method("GET","p") && $data["productinside"]->title!=""){
		$title = htmlentities($data["productinside"]->title);
		$shareImage = ($data["productinside"]->picture) ? WEBSITE.'image?f='.WEBSITE.'files/usersproducts/'.$data["productinside"]->picture.'&w=600&h=315' : "/".LANG."/load-public-files?datafrom=file&amp;ext=png&amp;dataid=45&amp;sizetype=false";
	}
}
echo $title; 
?> - Trade with Georgia</title>
<!-- FB Meta tags (start) -->
<meta property="fb:app_id" content="552933334875517" />
<meta property="og:title" content="<?=htmlentities(strip_tags($title))?> - Trade With Georgia" />
<meta property="og:type" content="website" />
<meta property="og:url" content="<?=WEBSITE_.$_SERVER['REQUEST_URI']?>"/>
<meta property="og:image" content="<?=$shareImage?>" />
<meta property="og:image:width" content="600" />
<meta property="og:image:height" content="315" />
<meta property="og:site_name" content="Trade With Georgia"/>
<meta property="og:description" content="<?=htmlentities(strip_tags($desc))?>"/>
<!-- FB Meta tags (end)-->
<meta name="description" content="<?=htmlentities(strip_tags($desc))?>">
<meta name="keywords" content="<?=$tags?>">
<meta name="author" content="Niki Getsadze, Giorgi Gvazava, Valerian Apkazava, Zviad Ruxadze" />
<link rel="icon" type="image/gif" href="/<?=LANG?>/load-public-files?datafrom=file&amp;ext=ico&amp;dataid=44&amp;sizetype=false" />
<link type="text/plain" rel="author" href="/<?=LANG?>/load-public-files?datafrom=file&amp;ext=txt&amp;dataid=38&amp;sizetype=false" />
<link href="/<?=LANG?>/load-public-files?datafrom=file&amp;ext=css&amp;dataid=1,2,3,4,34,43&amp;v=<?=$c['websitevertion']?>" type="text/css" rel="stylesheet"/>
<script src="/<?=LANG?>/load-public-files?datafrom=file&amp;ext=js&amp;dataid=42,39,40,41&amp;sizetype=false"></script>
</head>
<body id="menu_responsive">
<?php 
/* captcha code generation */
include("analitics.php"); 
include("login.php");
include("register.php");
include("recover_password.php");
include("message.php");
include("addcertificate.php");
?>
<center style="width:100%; height:35px; font-size:16px; color:white; line-height:35px; font-family:roboto; position:absolute; top:0; text-align:center; z-index:1000">Website Is Under Development</center>
<header id="header" class="container-fluid" style="padding:0;">
	<div class="container">
		<div id="header_line">
			<div class="col-sm-12 text-right padding_0">			
				<div id="members_area" style="position:relative; z-index:1001">	
					<?php if(!isset($_SESSION["tradewithgeorgia_username"])) { ?>			
					<a href="#" data-toggle="modal" data-target="#register_popup">Register</a> | 
					<a href="#" data-toggle="modal" data-target="#login_popup">Log In</a> 
					<!-- <a href="#" data-toggle="modal" data-target="#recover_password"><?=$data["language_data"]["recoverpassword"]?></a> -->
					<?php }else if(isset($_SESSION["tradewithgeorgia_company_type"])){ ?>
					<a href="javascript:void(0);" onclick="return false">
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
					<a href="javascipt:void(0);" id="logoutbutton" onclick="return false">Log Out</a> 
					<?php } ?>
				</div>
			</div>
		</div>
		<div id="header_2">
			<div class="col-sm-5 col-md-5 col-xs-5 col-lg-5 padding_0 logo_text">
				<a href="<?=MAIN_PAGE?>">
					<img src="/en/load-public-files?datafrom=file&amp;ext=svg&amp;dataid=8&amp;sizetype=false" width="195" height="107" alt="Trade With Georgia Logo" />
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
					<img src="/en/load-public-files?datafrom=file&amp;ext=svg&amp;dataid=9&amp;sizetype=false" width="118" height="74" alt="Enterprise Georgia Logo" />
				</a>
			</div>
			<div style="clear:both"></div>
		</div>
		<div style="clear:both"></div>
	</div>
	<div style="clear:both"></div>
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