<?php 
@include("parts/header.php");
@include("parts/eventregister.php");
$ctext = new ctext();
?>

 <div id="home_slider" class="carousel slide" data-ride="carousel">
	<div class="carousel-inner" role="listbox">
        <?php
		$x=1;
		foreach($data["components"] as $val){
			if($val->com_name != "Slider"){ continue; }
		?>
		<div class="<?=($x==1) ? 'active ' : ''?>item" style="background-image:url('<?=WEBSITE_.$val->image?>'); background-repeat:no-repeat; background-size: cover; background-position:center">
			<a href="<?=$val->url?>" style="display:block; width:100%; height:432px;">
			<!-- <img class="first-slide" src="" alt="First slide">  
				<img class="first-slide" src="<?=WEBSITE_.$val->image?>" alt="<?=strip_tags($val->title)?>" /> 
				<div class="container">
				<div class="carousel-caption">
					<div class="col-sm-4">
						
							<div class="slider_info">
								<div class="title"><?=$ctext->cut(strip_tags($val->title),55)?></div>
								<div class="text"><?=$ctext->cut(strip_tags($val->desc),75)?></div>
								<div class="url">Read more</div>
							</div>
						
					</div>
				</div>
			</div>-->
			</a>
        </div>
		<?php
			$x++;
		}
		?>


         
		<a class="carousel-control left" href="#home_slider" data-slide="prev">
			<div class="slider_arrow_left"></div>
		</a>
		<a class="carousel-control right" href="#home_slider" data-slide="next">
			<div class="slider_arrow_right"></div>
		</a>
    </div><!-- /.carousel -->
</div>




<div class="container" style="margin-top:-30px; position:relative;">
	<div class="home_search">
		<div class="col-sm-5 text">
			<span>Looking For Something in Particular?</span>
			<li><label><input type="checkbox" id="check_company" class="checkboxsearch" name="check_company" value="companies" checked="checked" /> Companies</label></li>
			<li><label><input type="checkbox" id="check_product" class="checkboxsearch" name="check_product" value="products" /> Products</label></li>
			<li><label><input type="checkbox" id="check_service" class="checkboxsearch" name="check_service" value="services" /> Services</label></li>
		</div>
		<div class="col-sm-5 home_search_input padding_0">
			<input type="text" class="form-control hpsv" id="hpsv" placeholder="Search By Name Or Phrase" onkeypress="submitme(event,'hitsearchhome')" />
		</div>
		<div class="col-sm-2 padding_0" style="padding-left:5px;">
			<button class="btn btn-block btn-sm btn-yellow searchButtonHomepage" id="hitsearchhome">SEARCH</button>
		</div>
	</div>
</div>




<div class="container" id="container" style="margin-top:30px">	
		<div class="page_title_4"><?=$data["language_data"]["eventschedule"]?></div>
		<?php 
		$eventArray1 = array_slice($data["events"], 0, 6, true);
		?>
		<div class="row" id="events_items">
			<?php 
			foreach($eventArray1 as $val){
				$old = ($val->expiredate < time()) ? ' oldeventitem' : '';
				$bw = ($val->expiredate < time()) ? '&amp;bw=1' : '';
			?>
				<div class="col-sm-4 col-md-2 col-xs-4 event_item<?=$old?>">
					<a href="<?=WEBSITE.LANG."/".htmlentities($val->slug)?>">
						<div class="date"><?=date("d M Y",$val->date)?></div>
						<div class="image"><img src="<?=WEBSITE?>image?f=<?=WEBSITE.$val->pic?>&amp;w=170&amp;h=90<?=$bw?>" class="img-responsive" alt="" /></div>
						<div class="text">
							<b><?=$ctext->cut($val->title,20)?></b>
							<p class="booth">Booth N: <?=$ctext->cut($val->event_booth,40)?></p>
						</div>
					</a>	
				</div>
			<?php
			}
			?><div style="clear:both"></div>
			<div class="alleventsLink"><a href="<?=WEBSITE?>en/about-us/events">View More Events »</a></div>
		</div>
	
		<!--<div class="page_title_4"><?=$data["language_data"]["latestnews"]?></div>
		
		<div class="row news_div">

			<?php 
			$newArray1 = array_slice($data["news"], 0, 3, true);
			foreach($newArray1 as $val){
			?>
				<div class="col-sm-4 col-md-4 col-xs-4 news_item">
					<a href="<?=WEBSITE.LANG."/".htmlentities($val->slug)?>">
						<div class="date"><span><?=date("d",$val->date)?></span> <?=date("M",$val->date)?></div>
						<div class="text"><?=$ctext->cut($val->title,120)?></div>
					</a>	
				</div>
			<?php
			}
			?><div style="clear:both"></div>
			<div class="alleventsLink"><a href="<?=WEBSITE?>en/about-us/news">View More News »</a></div>
		</div>-->
		
		<div class="home_div_3">
			<div class="row">
			<?php
			$x=1;
			foreach($data["components"] as $val){
				if($val->com_name != "Home page small banners"){ continue; }
				$expl = explode("::",$val->url);
				if(!empty($expl[1])){ $target = 'target="_self"'; }else{ $target = 'target="_blank"'; }
			?>
		     <div class="col-sm-4">
					<a href="<?=$expl[0]?>" <?=$target?> class="homePageSmallBanner" style="display:block">
						<div class="item" style="background-image:url('<?=WEBSITE?>image?f=<?=WEBSITE_.$val->image?>&amp;w=366&amp;h=85')">					
							<div class="title"><p style="padding-top:25px; text-align:center"><?=$ctext->cut(strip_tags($val->title),55)?></p></div>
							<!--<div class="text">
								<?=$ctext->cut(strip_tags($val->desc),53)?><br/>
								<?php
								$repl = str_replace(array('http://','www.'), "", $val->url);
								$repl = rtrim($repl,'/');
								echo 'www.'.$repl;
								?>
							</div>-->							
						</div>
					</a>	
			</div>

			<?php
				$x++;
			}
			?>
			</div>
		</div> 
		
		<div class="page_title_4">Top Exports Product</div>
		
		<div id="home_products" class="carousel slide" data-interval="5000" data-ride="carousel">
			<div class="carousel-inner">


				<?php
				$x=1;
				$f_top = 1;
				$f_bottom = 1;
				foreach($data["components"] as $val){
					if($val->com_name != "Top Exports Product"){ continue; }
				?>

				<?php if($f_top==1) : ?>
				<div class="<?=($x==1) ? 'active ' : ''?>item"><div class="row">
				<?php endif; ?>

					<div class="col-sm-4">
						<a href="<?=$val->url?>">
							<div class="product_item">
								<div class="image"><img src="<?=WEBSITE?>image?f=<?=WEBSITE_.$val->image?>&amp;w=365&amp;h=275" class="img-responsive" alt="" /></div>
								<?php
								if($val->title) :
								?>
								<div class="text">
									<?=$ctext->cut(strip_tags($val->title),45)?><br />
									<?=$ctext->cut(strip_tags($val->desc),55)?>
								</div>
								<?php
								endif; 
								?>
							</div>
						</a>	
					</div>

				<?php if($f_bottom==3) : ?>
				</div></div>
				<?php 
				endif; 
					if($f_top==3){ $f_top=0; $f_bottom=0; }
					$x++;
					$f_top++;
					$f_bottom++;
				}
				if(($x%3 && $x>4)!=0){ echo '</div></div>'; $allitems = ceil($x / 3) - 1; }
				?>

				
			</div>
			<?php if($allitems) : ?>
				<ol class="carousel-indicators">
					<?php for($i=0;$i<=$allitems;$i++) : ?>
						<li data-target="#home_products" data-slide-to="<?=$i?>" class="<?=($i==0) ? 'active' : ''?>"></li>
					<?php endfor; ?>
				</ol>
			<?php endif; ?>


		</div> 


		
		<div id="home_subscribe">
			<div class="row">
				<div class="col-sm-4">
					<div class="item">
						<div class="title">Subscribe for latest updates</div>
						<div class="text">get new products and bussines enquires straight in your email inbox. </div>
						<div class="form-group">
							<div class="input-group"> 
								<input type="text" class="input_home" name="spe_val" id="spe_val" onkeypress="submitme(event,'hitsubscribe')" placeholder="Your Email Address" value="" />
								<div class="input-group-addon btn-home subscribeproductsenquires" id="hitsubscribe">Subscribe</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="item">
						<div class="title">Register for Suppliers database</div>
						<div class="text">And Join our Community to gain access to our services for companies interested in finding business partners.</div>
						<div class="form-group">
							<div class="input-group"> 
								<input type="text" class="input_home" id="rnu_val" name="rnu_val" placeholder="Your Email Address" value="" onkeypress="submitme(event,'hitregister')" />
								<div class="input-group-addon btn-home <?=(isset($_SESSION["tradewithgeorgia_username"])) ? 'usersigned' : 'registernewuser'?>" id="hitregister">Register</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="item">
						<div class="title">Register for the event</div>
						<div class="text">Find out more about our or international events <br/> and register </div>
						<div class="form-group">
							<div class="input-group">  
								<div class="btn-home btn-home-2 homepageEventRegister" data-homepage="true">Register</div>
							</div>
						</div>
					</div>
				</div>
			</div>	
		</div>
		
</div>
<?php
@include("parts/footer.php"); 
?>