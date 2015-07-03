<?php 
	@include("parts/header.php"); 

?>
<div class="container" id="container" style="padding-top:0; padding-bottom:0">
	 
	<div class="row">
		<div class="col-sm-12" id="content_full" style="padding-bottom:0">
			<div class="home_slider" style="max-height:340px; overflow:hidden">
			
			
				<div id="featured" style="width:100%;">
					
					<div class="col-sm-8 padding_0">
						<?php
						$x=1;
						$ctext = new ctext();
						if(LANG=="ge"){
							$slider_title_number = 30;
							$slider_title_number2 = 30;
							$slider_desc_number = 75;
							$slider_desc_number2 = 85;
						}else{
							$slider_title_number = 30;
							$slider_title_number2 = 30;
							$slider_desc_number = 45;
							$slider_desc_number2 = 100;
						}
						foreach($data["components"] as $val){
							if($val->com_name != "Slider"){ continue; }
						?>
							<div id="fragment-<?=$x?>" class="ui-tabs-panel" style="">
								<a href="<?=$val->url?>" style="display:block">
									<img src="<?=WEBSITE?>image?f=<?=WEBSITE_.$val->image?>&w=773&h=344" alt="<?=strip_tags($val->title)?>" />
								</a>
								<div class="slider_info">
									<div class="title"><?=$ctext->cut(strip_tags($val->title),$slider_title_number)?></div><br />
									<div class="text"><?=$ctext->cut(strip_tags($val->desc),$slider_desc_number)?></div>
								</div>	
							</div>
						<?php
							$x++;
						}
						?>
					</div>	
					
					<div class="col-sm-4 padding_0">			
						<ul class="ui-tabs-nav">
							<?php
							$x=1;
							foreach($data["components"] as $val){
								if($val->com_name != "Slider"){ continue; }
							?>
							<li class="ui-tabs-nav-item" id="nav-fragment-<?=$x?>">
								<a href="#fragment-<?=$x?>" data-gotourl="<?=$val->url?>">
									<div>
										<span><?=$ctext->cut(strip_tags($val->title),$slider_desc_number)?></span><br/>
										<?=$ctext->cut(strip_tags($val->desc),$slider_desc_number2)?>
									</div>
								</a>
							</li>
							<?php
								$x++;
							}
							?>
						</ul>
					</div>
					
				</div>
			
			
			</div>
			
			<div class="page_title_6"><?=$data["language_data"]["multimedia"]?></div>
			
			
			<div class="col-sm-12 padding_0">
				<div class="other_gallery">
					<div class="row">
						
							<?php
							$v = 1;
							foreach($data["multimedia"] as $val){ 
								$ex = explode( "?v=", $val->file); 

						        $mystring = $val->file;
								$findme   = 'youtube';
								$pos = strpos($mystring, $findme);
								if($pos === false){
									$playfile = WEBSITE.$mystring;
								}else{
									$playfile = $mystring;
								}
					        ?>

						<div class="col-sm-4">
							<div class="item">
								<a class="youtube" href="<?=$mystring?>">
									<div class="image"><img src="<?=WEBSITE?>image?f=<?=WEBSITE.$val->filev?>&w=373&h=193" alt="<?=$val->title?>" class="img-responsive">
										<div class="play_icon"></div>
									</div>									
								</a>
								<div class="text_formats">
									<?=$val->title?>
								</div>
							</div>
						</div>

							<!-- <div class="col-sm-4">
								<div class="item">
										<div class="image">
											<div class="play_icon" id="b<?=$v?>" onclick="jwplayer('myElement<?=$v?>').play();"></div>
											<div id="myElement<?=$v?>">Loading the player...</div>
										</div>	
									<div class="text_formats">
										<?=$val->title?>
									</div>
								</div></div>
								<script type="text/javascript" charset="utf-8">
								<?php
						        $mystring = $val->file;
								$findme   = 'youtube';
								$pos = strpos($mystring, $findme);
								if($pos === false){
									$playfile = WEBSITE.$mystring;
								}else{
									$playfile = $mystring;
								}
						        ?>
								jwplayer("myElement<?=$v?>").setup({
									playlist: [{
										image: "<?=WEBSITE?>image?f=<?=WEBSITE.$val->filev?>&w=373&h=193", 
										sources: [{ 
											  file: "<?=$playfile?>"
										}],
										title: "",
										description: "2015-06-15 16:31:38.",
										primary: "html5",
									}],
									stretching:"exactfit", 
									width: "100%",
									height: "193",
									aspectratio: "3:2", 
									skin: '<?=PLUGINS?>player/skinning-sdk/five/five.xml'
								}); 
								jwplayer("myElement<?=$v?>").onPlay(function(e){ $("#b<?=$v?>").hide(); }); 
								jwplayer("myElement<?=$v?>").onPause(function(e){ $("#b<?=$v?>").show(); }); 
								jwplayer("myElement<?=$v?>").onComplete(function(e){ $("#b<?=$v?>").show(); }); 
								
								</script>-->
							<?php $v++; } ?>

						<div class="col-sm-4">
							<div class="home_div_3">
								<div class="row">
									<?php
									foreach($data["components"] as $val){
									if($val->com_name != "Banners"){ continue; }
									?>
										<div class="col-sm-12">
										<a href="<?php echo $val->url; ?>" target="_blank">
											<div class="item" style="position:relative">	
												<div class="bunnerText">
													<h4><?php echo strip_tags($val->title); ?></h4>
													<p><?php echo strip_tags($val->desc); ?></p>
													<span><?php echo strip_tags(str_replace( array("http://","http://www."), array("www.","www."), $val->url)); ?></span>
												</div>				
												<img src="<?php echo WEBSITE.$val->image; ?>" alt="<?=$val->title?>" class="img-responsive"/>							
											</div>
										</a>	
									</div>
									<?php
									}
									?>
								</div>	
							</div>
						</div> 
						
					</div>
				</div>				
			</div>
			 
			<div class="row">
				<div class="col-sm-12 padding_0">
					
					<div class="col-sm-4">
						<div class="home_news_events" role="tabpanel">			
							<ul class="tablist_div" role="tablist">
								
								<li class="active home_news_event_tab">
									<a href="#home_news" role="tab" data-toggle="tab">
										<img src="<?php echo TEMPLATE?>img/home_news_tab.png" alt="" />
										<?=$data["language_data"]["newsheader"]?>
									</a>
								</li>
								<li class="home_news_event_tab">
									<a href="#home_events" role="tab" data-toggle="tab">
										<img src="<?php echo TEMPLATE?>img/home_events_tab.png" alt="" />
										<?=$data["language_data"]["eventsheader"]?>
									</a>
								</li>
							</ul>
							<?php
							if(LANG=="ge"){
								$news_title_number = 50;
							}else{
								$news_title_number = 50;
							}
							?>
							<div class="tab-content">
								<div role="tabpanel" class="tab-pane fade in active" id="home_news">	
									<div class="page_title_6" style="float:left;"><?=$data["language_data"]["newsheader"]?></div>									
										<ul class="hone_news_slide">
										<?php
										$newArray1 = array_slice($data["news"], 0, 5, true);
										if(is_array($newArray1) && count($newArray1)>0){
										?>
										<div>
											<div class="news_div">
											<?php 
											foreach($newArray1 as $val){
											?>
												<div class="col-sm-12 news_item">
													<a href="<?=WEBSITE.LANG."/".htmlentities($val->slug)?>">
														<div class="date"><span><?=date("d",$val->date)?></span> <?=date("M",$val->date)?></div>
														<div class="text"><?=$ctext->cut($val->title,$news_title_number)?></div>
													</a>	
												</div>
											<?php
											}
											?>	
											</div>
										</div>
										<?php } ?>


										<?php
										$newArray2 = array_slice($data["news"], 5, 5, true);
										if(is_array($newArray2) && count($newArray2)>0){
										?>
										<div>
											<div class="news_div">
											<?php 
											foreach($newArray2 as $val){
											?>
												<div class="col-sm-12 news_item">
													<a href="<?=WEBSITE.LANG."/".htmlentities($val->slug)?>">
														<div class="date"><span><?=date("d",$val->date)?></span> <?=date("M",$val->date)?></div>
														<div class="text"><?=$ctext->cut($val->title,$news_title_number)?></div>
													</a>	
												</div>
											<?php
											}
											?>	
											</div>
										</div>
										<?php } ?>

										<?php
										$newArray3 = array_slice($data["news"], 10, 5, true);
										if(is_array($newArray3) && count($newArray3)>0){
										?>
										<div>
											<div class="news_div">
											<?php 
											foreach($newArray3 as $val){
											?>
												<div class="col-sm-12 news_item">
													<a href="<?=WEBSITE.LANG."/".htmlentities($val->slug)?>">
														<div class="date"><span><?=date("d",$val->date)?></span> <?=date("M",$val->date)?></div>
														<div class="text"><?=$ctext->cut($val->title,$news_title_number)?></div>
													</a>	
												</div>
											<?php
											}
											?>	
											</div>
										</div>
										<?php } ?>
										
									</ul>		
								</div>
								<div role="tabpanel" class="tab-pane fade" id="home_events">	

							<div class="page_title_6" style="float:left;"><?=$data["language_data"]["eventsheader"]?></div>									
									<ul class="hone_news_slide2">
										<?php
										$eventArray1 = array_slice($data["events"], 0, 5, true);
										if(is_array($eventArray1) && count($eventArray1)>0){
										?>
										<div>
											<div class="news_div">
											<?php 
											foreach($eventArray1 as $val){
											?>
												<div class="col-sm-12 news_item">
													<a href="<?=WEBSITE.LANG."/".htmlentities($val->slug)?>">
														<div class="date"><span><?=date("d",$val->date)?></span> <?=date("M",$val->date)?></div>
														<div class="text"><?=$val->title?></div>
													</a>	
												</div>
											<?php
											}
											?>	
											</div>
										</div>
										<?php } ?>

										<?php
										$eventArray2 = array_slice($data["events"], 5, 5, true);
										if(is_array($eventArray2) && count($eventArray2)>0){
										?>
										<div>
											<div class="news_div">
											<?php 
											foreach($eventArray2 as $val){
											?>
												<div class="col-sm-12 news_item">
													<a href="<?=WEBSITE.LANG."/".htmlentities($val->slug)?>">
														<div class="date"><span><?=date("d",$val->date)?></span> <?=date("M",$val->date)?></div>
														<div class="text"><?=$val->title?></div>
													</a>	
												</div>
											<?php
											}
											?>	
											</div>
										</div>
										<?php } ?>

										<?php
										$eventArray3 = array_slice($data["events"], 10, 5, true);
										if(is_array($eventArray3) && count($eventArray3)>0){
										?>
										<div>
											<div class="news_div">
											<?php 
											foreach($eventArray3 as $val){
											?>
												<div class="col-sm-12 news_item">
													<a href="<?=WEBSITE.LANG."/".htmlentities($val->slug)?>">
														<div class="date"><span><?=date("d",$val->date)?></span> <?=date("M",$val->date)?></div>
														<div class="text"><?=$val->title?></div>
													</a>	
												</div>
											<?php
											}
											?>	
											</div>
										</div>
										<?php } ?>										
										
									</ul>		
								</div>
							</div>
							
						</div>
					</div>
					
					
					<div class="col-sm-4">
						<?php
						foreach($data["components"] as $val){
						if($val->com_name != "Big homepage banner"){ continue; }
						?>
							<div class="sme_service">
								<div class="image"><img src="<?php echo WEBSITE.$val->image; ?>" alt="<?=$val->title?>" class="img-responsive"/></div>
								<div class="title"><?=strip_tags($val->title)?></div>
								<div class="text"><?=$val->desc?></div>
								<div class="find_out_more"><a href="<?php echo $val->url; ?>" target="_blank"><?=$data["language_data"]["findoutmore"]?></a></div>
							</div>
						<?php
						}
						?>
						
					</div>
					
					
					
					<div class="col-sm-4">
						
						<div class="bussiness_ing_georgia" style="background:#eaeaea; margin-bottom:10px; position:relative">
							<div style="color:#0d2065; font-family:roboto; font-size:18px; font-weight:bold; line-height:18px; padding:10px 10px 0 10px; position:absolute; z-index:1">Business in Georgia</div>
							<div id="piechart"></div>
							<!-- <iframe src="http://enterprise.404.ge/_plugins/canvas/index.php" style="margin:0; padding:0; border:0; width:100%; height:100%;"></iframe> -->
						</div>
					
						<div id="home_subscribe">
							<div class="row">
								<div class="col-sm-12">
									<div class="item">
										<div class="title"><?=$data["language_data"]["subscribeheader"]?></div>
										<div class="text">
	    									<?=$data["language_data"]["subscribelabel"]?>
										</div>
										<div class="form-group">
											<div class="input-group"> 
												<input type="text" class="input_home" id="clinetEmail" placeholder="<?=$data["language_data"]["subscribeemailplaceholder"]?>"/>
												<div class="input-group-addon btn-home" id="subsc">
													<?=$data["language_data"]["subscribebutton"]?>
												</div>
											</div>
										</div>
									</div>
								</div>	
							</div>
						</div>
					</div>
					
					
				</div>
			</div>

			
			
			
			
		</div>
	</div>
</div>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
$(function () {
		$(".youtube").YouTubeModal({autoplay:0, width:'100%', height:'400'});
	});
    
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Large',9633.6],
          ['Medium', 1243.1],
          ['small', 1262.3]
        ]);

        var options = { 
          width: '100%',
          title: 'Value Added by Enterprise Size  2013 y.', 
          titleTextStyle: { 
          	color: '#0d2065',
		  	fontName: 'roboto',
		  	fontSize: '14',
		  	bold: 0,
		  	italic: 0
		  }, 
		  legend: {position: 'right', textStyle: {color: '#1279bb', fontSize: 12}}, 
          backgroundColor: '#eaeaea', 
          colors:['#1279bb','#94bed7','#68a6cd','#3d90c4','#93bdd6'], 
          chartArea:{left:10,top:65,width:'100%',height:'62%'}
        };

        //data.setProperty('style', 'background:#244396');

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        //legend.alignment
        chart.draw(data, options);
      }


      

    </script>

<?php @include("parts/footer.php"); ?>


