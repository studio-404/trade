<!-- START FOOTER -->
<footer class="container-fluid padding_0">
	<div id="footer_div">
		<div id="footer" class="container">
			<div class="col-sm-9 padding_0">
				<div id="footer_links">
					<ul>
						<span>Home / Country Profile:</span>
						<li><a href="#">Facts about Georgia</a></li> /
						<li><a href="#">Why trade with Georgia</a></li> / 
						<li><a href="#">Doing business in Georgia</a></li> / 
						<li><a href="#">Success Stories</a></li>
					</ul>		
					<ul>
						<span>Export Catalog / business Enquiries / Foreign Trade:</span>
						<li><a href="#">Trade map</a></li> / 
						<li><a href="#">Export Analysis</a></li> / 
						<li><a href="#">How To export From Georgia</a></li> / 
						<li><a href="#">Useful Links</a></li>
					</ul>
					<ul>					
						<span>About Us: </span>
						<li><a href="#">Events</a></li> / 
						<li><a href="#">News</a></li> / 
						<li><a href="#">Our Services</a></li> / 
						<li><a href="#">Contact Us</a></li>
					</ul>	
				</div>
			</div>
			<div class="col-sm-3 text-right padding_0" id="footer_fb">
				<li>Connect With Us</li>
				<img src="<?=TEMPLATE?>img/footer_fb.png"/>
			</div>
		</div>	
	</div>	
	<div id="footer_div_2">
		<div id="footer_2" class="container">
			<div class="col-sm-4 padding_0">
				<li>Tbilisi Office:</li>
				<li>Faliashvili street 80, 0179, Tbilisi, Georgia</li>
				<li>Tel: +995 322339893</li>
				<li>E-Mail: info@enterprise.ge</li>
			</div>
			<div class="col-sm-2 padding_0">
				<li>Hotline 24/7</li>
				<li>+995 32 2 96 00 10</li>
				<li><a href="#">Online Help Chat</a></li>
			</div>
			<div class="col-sm-4 padding_0">
				<li>Donor Organization:</li>
				<a href="#"><img src="<?=TEMPLATE?>img/donor_org.png"/></a>
			</div>
			<div class="col-sm-2 padding_0 text-right getsadze_design">
				<img src="<?=TEMPLATE?>img/getsadze_design.png"/>
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