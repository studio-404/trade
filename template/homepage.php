<?php 
@include("parts/header.php");
?>

 <div id="home_slider" class="carousel slide" data-ride="carousel">
	<div class="carousel-inner" role="listbox">
        <div class="active item">
			<img class="first-slide" src="<?=TEMPLATE?>img/slide_1.jpg" alt="First slide">
				<div class="container">
					<div class="carousel-caption">
						<div class="col-sm-4">
							<div class="slider_info">
								<div class="title">Georgian Food Industry Is on the rise</div>
								<div class="text">This website Is a must tool for the international bussines organisations to explore trading opportunities</div>
								<div class="url"><a href="#">Company Profile</a></div>
							</div>
						</div>
				</div>
			  </div>
        </div>
         
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
				<li><input type="checkbox"/> Companies</li>
				<li><input type="checkbox"/> Products</li>
				<li><input type="checkbox"/> Services</li>
		</div>
		<div class="col-sm-5 home_search_input padding_0">
			<input type="text" class="form-control" placeholder="Search By Name Or Phrase"/>
		</div>
		<div class="col-sm-2 padding_0" style="padding-left:5px;">
			<button class="btn btn-block btn-sm btn-yellow">SEARCH</button>
		</div>
	</div>
</div>




<div class="container" id="container">	
		<div class="page_title_4">Events Schedule</div>
		
		<div class="row" id="events_items">
			<div class="col-sm-4 col-md-2 col-xs-4 event_item">
				<a href="#">
					<div class="date">29 May</div>
					<div class="image"><img src="<?=TEMPLATE?>img/event_1.jpg" class="img-responsive"/></div>
					<div class="text">Georgian Cognac company is out in European market shelves...</div>
				</a>	
			</div>
			<div class="col-sm-4 col-md-2 col-xs-4 event_item">
				<div class="date">29 May</div>
				<div class="image"><img src="<?=TEMPLATE?>img/event_2.jpg" class="img-responsive"/></div>
				<div class="text">Georgian Cognac company is out in European market shelves...</div>
			</div>
			<div class="col-sm-4 col-md-2 col-xs-4 event_item">
				<div class="date">29 May</div>
				<div class="image"><img src="<?=TEMPLATE?>img/event_3.jpg" class="img-responsive"/></div>
				<div class="text">Georgian Cognac company is out in European market shelves...</div>
			</div>
			<div class="col-sm-4 col-md-2 col-xs-4 event_item">
				<div class="date">29 May</div>
				<div class="image"><img src="<?=TEMPLATE?>img/event_4.jpg" class="img-responsive"/></div>
				<div class="text">Georgian Cognac company is out in European market shelves...</div>
			</div>
			<div class="col-sm-4 col-md-2 col-xs-4 event_item">
				<div class="date">29 May</div>
				<div class="image"><img src="<?=TEMPLATE?>img/event_1.jpg" class="img-responsive"/></div>
				<div class="text">Georgian Cognac company is out in European market shelves...</div>
			</div>
			<div class="col-sm-4 col-md-2 col-xs-4 event_item">
				<div class="date">29 May</div>
				<div class="image"><img src="<?=TEMPLATE?>img/event_2.jpg" class="img-responsive"/></div>
				<div class="text">Georgian Cognac company is out in European market shelves...</div>
			</div>
		</div>
	
		<div class="page_title_4">Latest News</div>
		
		<div class="row news_div">
			<div class="col-sm-4 col-md-2 col-xs-4 news_item">
				<a href="#">
					<div class="date"><span>01</span> May</div>
					<div class="text">Trade with Georgia is the new website for international people.</div>
				</a>	
			</div>
			<div class="col-sm-4 col-md-2 col-xs-4 news_item">
				<a href="#">
					<div class="date"><span>01</span> May</div>
					<div class="text">Trade with Georgia is the new website for international people.</div>
				</a>	
			</div>
			<div class="col-sm-4 col-md-2 col-xs-4 news_item">
				<a href="#">
					<div class="date"><span>01</span> May</div>
					<div class="text">Trade with Georgia is the new website for international people.</div>
				</a>	
			</div>
			<div class="col-sm-4 col-md-2 col-xs-4 news_item">
				<a href="#">
					<div class="date"><span>01</span> May</div>
					<div class="text">Trade with Georgia is the new website for international people.</div>
				</a>	
			</div>
			<div class="col-sm-4 col-md-2 col-xs-4 news_item">
				<a href="#">
					<div class="date"><span>01</span> May</div>
					<div class="text">Trade with Georgia is the new website for international people.</div>
				</a>	
			</div>
			<div class="col-sm-4 col-md-2 col-xs-4 news_item">
				<a href="#">
					<div class="date"><span>01</span> May</div>
					<div class="text">Trade with Georgia is the new website for international people.</div>
				</a>	
			</div>
		</div>
		
		<div class="home_div_3">
			<div class="row">
				<div class="col-sm-4">
					<a href="#">
						<div class="item trade_map">					
							<div class="title">Trade Map</div>
							<div class="text">
								learn foreign trade statistics by years and countiresSearch countries with most Georgian products on export.
							</div>							
						</div>
					</a>	
				</div>
				<div class="col-sm-4">
					<a href="#">
						<div class="item enterprise_georgia">					
							<div class="title">Enterprise Georgia</div>
							<div class="text">
								External Website<br/>
								www.enterprise.ge
							</div>								
						</div>
					</a>
				</div>
				<div class="col-sm-4">
					<a href="#">
						<div class="item produced_in_georgia">					
							<div class="title">Produced In Georgia</div>
							<div class="text">
								External Website<br/>
								www.qartuli.ge
							</div>							
						</div>
					</a>
				</div>
			</div>	
		</div>
		
		<div class="page_title_4">Top Exports Product</div>
		
		<div id="home_products" class="carousel slide" data-interval="5000" data-ride="carousel">
			<div class="carousel-inner">
				<div class="active item">
					<div class="row">
						<div class="col-sm-4">
							<a href="#">
								<div class="product_item">
									<div class="image"><img src="<?=TEMPLATE?>img/home_product_1.jpg" class="img-responsive"/></div>
									<div class="text">Mineral water industry holds the largest portion of the Georgian export </div>
								</div>
							</a>	
						</div>
						<div class="col-sm-4">
							<a href="#">
								<div class="product_item">
									<div class="image"><img src="<?=TEMPLATE?>img/home_product_1.jpg" class="img-responsive"/></div>
									<div class="text">Mineral water industry holds the largest portion of the Georgian export </div>
								</div>
							</a>	
						</div>
						<div class="col-sm-4">
							<a href="#">
								<div class="product_item">
									<div class="image"><img src="<?=TEMPLATE?>img/home_product_1.jpg" class="img-responsive"/></div>
									<div class="text">Mineral water industry holds the largest portion of the Georgian export </div>
								</div>
							</a>	
						</div>
					</div>
				</div>
				<div class="item">
					<div class="row">
						<div class="col-sm-4">
							<a href="#">
								<div class="product_item">
									<div class="image"><img src="<?=TEMPLATE?>img/home_product_1.jpg" class="img-responsive"/></div>
									<div class="text">Mineral water industry holds the largest portion of the Georgian export </div>
								</div>
							</a>	
						</div>
						<div class="col-sm-4">
							<a href="#">
								<div class="product_item">
									<div class="image"><img src="<?=TEMPLATE?>img/home_product_1.jpg" class="img-responsive"/></div>
									<div class="text">Mineral water industry holds the largest portion of the Georgian export </div>
								</div>
							</a>	
						</div>
						<div class="col-sm-4">
							<a href="#">
								<div class="product_item">
									<div class="image"><img src="<?=TEMPLATE?>img/home_product_1.jpg" class="img-responsive"/></div>
									<div class="text">Mineral water industry holds the largest portion of the Georgian export </div>
								</div>
							</a>	
						</div>
					</div>
				</div>
			</div>
			<ol class="carousel-indicators">
				<li data-target="#home_products" data-slide-to="0" class="active"></li>
				<li data-target="#home_products" data-slide-to="1"></li> 
			</ol>
		</div> 


		
		<div id="home_subscribe">
			<div class="row">
				<div class="col-sm-4">
					<div class="item">
						<div class="title">Subscribe for latest updates</div>
						<div class="text">get new products and bussines enquires straight in your email inbox. </div>
						<div class="form-group">
							<div class="input-group"> 
								<input type="text" class="input_home" placeholder="Your Email Address"/>
								<div class="input-group-addon btn-home">Subscribe</div>
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
								<input type="text" class="input_home" placeholder="Your Email Address"/>
								<div class="input-group-addon btn-home">Register</div>
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
								<div class="btn-home btn-home-2">Subscribe</div>
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