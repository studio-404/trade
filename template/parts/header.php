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
</head>
<body id="menu_responsive">
<!-- START LOGIN POPUP -->
<div id="login_popup" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width:340px;">
    <!-- Modal content-->
    <div class="modal-content">
		<div class="modal-body">
			<h3 class="modal-title">Login <small data-toggle="modal" data-target="#register_popup" onclick="$('#login_popup').modal('hide')">Register</small></h3>
			
			<div class="form-group">
				<label>E-mail Address</label>
				<input type="text" class="form-control"/>
			</div>
			<div class="form-group">
				<label>Password</label>
				<input type="password" class="form-control"/>
			</div>
			<div class="btn btn-block btn-yellow" style="font-size:19px; margin-top:35px;">REGISTER</div>
		</div> 
    </div>
  </div>
</div>
<!-- END LOGIN POPUP -->



<!-- START REGISTER POPUP -->
<div id="register_popup" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width:340px;">
    <!-- Modal content-->
    <div class="modal-content">
		<div class="modal-body">
			<h3 class="modal-title">Register in <small data-toggle="modal" data-target="#login_popup" onclick="$('#register_popup').modal('hide')">Login</small></h3>
			<ul class="" role="tablist">
				<li class="btn btn-block btn-blue active">
					<a href="#export_catalogue" aria-controls="export_catalogue" role="tab" data-toggle="tab">EXPORT CATALOGUE</a>
				</li>
				<li class="btn btn-block btn-blue">
					<a href="#bussines_enquires" aria-controls="bussines_enquires" role="tab" data-toggle="tab">BUSSINES ENQUIRES</a>
				</li>
			</ul>
			 
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="export_catalogue">
				</br/>
						<div class="form-group">
							<label>Company Type</label>
							<select class="form-control">
								<option>Manufacturing</option>
							</select>
						</div>
						<div class="form-group">
							<label>E-mail Address</label>
							<input type="text" class="form-control"/>
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" class="form-control"/>
						</div>
						<div class="form-group">
							<label>Repeat Password</label>
							<input type="password" class="form-control"/>
						</div>
						
						<input type="checkbox"  style="float:left; margin-right:5px; "/>
						<div class="text_formats">By clicking Register, you agree that you have read and accepted the <a href="#">User Agreement.</a> </div>
						
						<div class="btn btn-block btn-yellow" style="font-size:19px; margin-top:35px;">REGISTER</div>
				</div>
				<div role="tabpanel" class="tab-pane" id="bussines_enquires">
				</br/>
						<div class="form-group">
							<label>Register As</label>
							<select class="form-control">
								<option>Individual</option>
							</select>
						</div>
						<div class="form-group">
							<label>E-mail Address</label>
							<input type="text" class="form-control"/>
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" class="form-control"/>
						</div>
						<div class="form-group">
							<label>Repeat Password</label>
							<input type="password" class="form-control"/>
						</div>
						
						<input type="checkbox"  style="float:left; margin-right:5px; "/>
						<div class="text_formats">By clicking Register, you agree that you have read and accepted the <a href="#">User Agreement.</a> </div>
						
						<div class="btn btn-block btn-yellow" style="font-size:19px; margin-top:35px;">REGISTER</div>
				</div>
			</div>
 
		</div> 
    </div>
  </div>
</div>
<!-- END REGISTER POPUP -->

 
<header id="header" class="container-fluid" style="padding:0">
	<div class="container">
		<div id="header_line">
			<div class="col-sm-12 text-right padding_0">			
				<div id="members_area">					
					<a href="#" data-toggle="modal" data-target="#register_popup">Register</a> | 
					<a href="#" data-toggle="modal" data-target="#login_popup">Login</a>
					<div class="btn-group">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Profile <span class="caret"></span></a>	
						<ul class="dropdown-menu pull-right">
							<li><a href="#">Add Product</a></li>
							<li><a href="#">Manage Account</a></li>
						</ul>
					</div>					
				</div>
			</div>
		</div>
		<div id="header_2">
			<div class="col-sm-5 col-md-5 col-xs-5 col-lg-5 padding_0 logo_text">
				<a href="home.html">
					<img src="<?=TEMPLATE?>img/logo.png"/>
				</a>
			</div>
			<div class="col-sm-5 head_contact text-right">
				<div id="live_chat_div"><a href="#">Live Chat</a></div>
				<div id="header_contact">
					<li>Call us 24/7 on Hotline</li>
					<li><span>+995 32 2 96 00 10</span></li>
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
			<ul class="nav navbar-nav">
				<li class="active"><a href="#">START</a></li>
				<li><a href="#">COUNTRY PROFILE</a></li>
				<li><a href="#">EXPORT CATALOG</a></li>
				<li><a href="#">BUSSINES ENQUIRES</a></li>
				<li><a href="#">FOREIGN TRADE</a></li>
				<li><a href="#">ABOUT</a></li>
			</ul>          
		 </div>
		</div>
	  </div>
<!-- END MAIN MENU -->	