<!-- START FOOTER -->
<footer class="container-fluid padding_0">
	<div id="footer_div">
		<div id="footer" class="container">
			<div class="col-sm-9 padding_0">
				<div id="footer_links">
					<?php
					//echo $data["footer_menu"];
					?>

					<ul>
						<span>Country profile: &nbsp;</span>
						<li><a href="<?=WEBSITE.LANG?>/country-profile/facts-about-georgia">Facts about Georgia</a></li> / 
						<li><a href="<?=WEBSITE.LANG?>/country-profile/why-trade-with-Georgia">Why trade with Georgia</a></li> / 
						<li><a href="<?=WEBSITE.LANG?>/country-profile/doing-bussiness-in-Georgia">Doing bussiness in Georgia</a></li>
					</ul>
					<ul>
						<span>Export catalog: &nbsp;</span>
						<li><a href="<?=WEBSITE.LANG?>/export-catalog">Companies</a></li> / 
						<li><a href="<?=WEBSITE.LANG?>/export-catalog?view=products">Products</a></li> / 
						<li><a href="<?=WEBSITE.LANG?>/export-catalog?view=services">Services</a></li> 
						<!-- <li><a href="<?=WEBSITE.LANG?>/en/business-portal">Enquires</a></li> -->
					</ul>
					<ul>
						<span>About us: &nbsp;</span>
						<li><a href="<?=WEBSITE.LANG?>/about-us/our-services">Our services</a></li> / 
						<li><a href="<?=WEBSITE.LANG?>/about-us/events">Events</a></li> / 
						<li><a href="<?=WEBSITE.LANG?>/about-us/news">News</a></li> / 
						<li><a href="<?=WEBSITE.LANG?>/about-us/contact-us">Contact us</a></li>
					</ul>	

				</div>
			</div>
			<div class="col-sm-3 text-right padding_0" id="footer_fb">
				
					<?php
					foreach($data["components"] as $val){
						if($val->com_name != "social networks"){ continue; }
					?>
						<a href="<?=$val->url?>" target="_blank" style="text-decoration:none">
							<li><?=$val->title?></li>
							<img src="<?=WEBSITE.$val->image?>" alt="" />
						</a>
					<?php
					}
					?>

				
			</div>
		</div>	
	</div>	
	<div id="footer_div_2">
		<div id="footer_2" class="container">
			<div class="col-sm-4 padding_0">
				<li><?=$data["language_data"]["officelabel"]?>:</li>
				<li><?=$data["language_data"]["officevalue"]?></li>
				<li><?=$data["language_data"]["hotlinevalue"]?></li>
			</div>
			<div class="col-sm-2 padding_0">
				<li id="chatStatus">Offline</li>
				<li><a href="javascript:;" class="callChatButton"><?=$data["language_data"]["livechart"]?></a></li>
			</div>
			<div class="col-sm-4 padding_0">
				<li><?=$data["language_data"]["supportby"]?>:</li>
				<a href="https://www.giz.de" target="_blank"><img src="<?=TEMPLATE?>img/donor_org.png"/></a>
			</div>
			<div class="col-sm-2 padding_0 text-right getsadze_design">
				<a href="http://getsadze.co.uk/en/home" target="_blank">
					<img src="<?=TEMPLATE?>img/getsadze_design.png"/>
				</a>
			</div>
		</div>
	</div>
</footer>
<!-- END FOOTER -->


<script>

//Initial load of page
	$(document).ready(sizeContent);

	//Every resize of window
	$(window).resize(sizeContent);

	//Dynamically assign height
	function sizeContent() {
		var newHeight = $("#menu_responsive").height() - $("#header").height();
		$("#navbar-height-col").css("height", newHeight);
	}
	
	
	
	

	$(document).ready(sliderMargin);
	$(window).resize(sliderMargin);
	
	
	function sliderMargin() {
		var newWidth = $("#home_slider .carousel-inner .item img").width() / 2 ;
		$("#home_slider .carousel-inner .item img").css( "margin-left", - newWidth, "width", "120%" );
	}



</script>

</body>
</html>