<!-- START FOOTER -->
<footer class="container-fluid padding_0">
	<div id="footer_div">
		<div id="footer" class="container">
			<div class="col-sm-9 padding_0">
				<div id="footer_links">
					<?php
					$model_template_footer_navigation = new model_template_footer_navigation();
					echo $model_template_footer_navigation->select_all($c);
					?>
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
				<li><?=$data["contact_data"][0]["city"]?></li>
				<li><?=$data["contact_data"][0]["address"]?></li>
				<li><?=$data["contact_data"][0]["phone"]?></li>
			</div>
			<div class="col-sm-2 padding_0">
				<li id="chatStatus">Offline</li>
				<li><a href="javascript:;" class="callChatButton"><?=$data["language_data"]["livechart"]?></a></li>
			</div>
			<div class="col-sm-4 padding_0">
				<li><?=$data["language_data"]["supportby"]?>:</li>
				<a href="https://www.giz.de" target="_blank"><img src="/<?=LANG?>/load-public-files?datafrom=file&amp;ext=png&amp;dataid=46&amp;sizetype=false" style="width:250px;"/></a>
			</div>
			<div class="col-sm-2 padding_0 text-right getsadze_design">
				<a href="http://getsadze.co.uk/en/home" target="_blank">
					<img src="/<?=LANG?>/load-public-files?datafrom=file&amp;ext=png&amp;dataid=47&amp;sizetype=false"/>
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