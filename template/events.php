<?php @include("parts/header.php"); ?>
<div class="container" id="container">
	<div class="col-sm-3" id="sidebar">
		<div class="sidebar_menu">
			<ul>
				<?=$data["left_menu"]?>
			</ul>
		</div>
	</div>
	<div class="col-sm-9" id="content">
		<div class="page_title_3">
			Sial - Asian Food Market Place
			<div class="icons">
				<div class="share"></div>
				<div class="print"></div>
			</div>
		</div>	
		
		<div class="row" id="event_div">
			<div class="col-sm-4">
				<img src="<?=TEMPLATE?>img/event_img.png" class="img-responsive">
			</div>
			<div class="col-sm-4 event_line_bg">
				<div class="yellow_title">When:</div>
				<div class="text_formats_blue">
					<ul>
						<li class="text_formats_blue"><span>17 April<span></span></span></li>
						<li class="text_formats_blue">Everyday 01.06.2015 - 11.06.2015 </li>
						<li class="text_formats_blue">15:00 - 17:00</li>
					</ul>	
				</div>
				<div class="yellow_title">Fee:</div>
				<div class="text_formats_blue">
					<ul>
						<li class="text_formats_blue"><span>No Fees Apply<span></span></span></li>
					</ul>	
				</div>
			</div>
			<div class="col-sm-4 event_line_bg">
				<div class="yellow_title">Venue:</div>
				<div class="text_formats_blue">
					<ul> 
						<li class="text_formats_blue">China, Bangkog </li>
						<li class="text_formats_blue">1 Fusionopolis Walk </li>
						<li class="text_formats_blue">#01-02 South Tower, Solaris </li>
						<li class="text_formats_blue">Bangkog 138628</li>
					</ul>	
				</div>
			</div>			
		</div>
		
		<div class="text_formats">
			<p>The Business Excellence (BE) Briefing is suitable for companies &amp; organizations that are new to business excellence, and are interested in finding out how the Revised BE Framework can help strengthen management systems to deliver superior results.</p>
		</div>
		
		<div class="event_prog">
			<div class="title">Programme</div>
			<ul>
				<li><label></label>3.10 pm - Profiling Questionaire</li>
				<li><label></label>3.20 pm - The Revised BE Framework</li>
				<li><label></label>3.30 pm - Benefits of BE</li>
				<li><label></label>3.40 pm - Application Procedures for BE Certification (SQC, PD, I-Class, S-Class)</li>
				<li><label></label>4.00 pm - Support &amp; Assistance for SMEs</li>
				<li><label></label>4.30 pm - Combined Q&amp;A Session</li>
			</ul>
		</div>
		
		<div class="text_formats">
			<ul>
				<li class="text_formats">This briefing is suitable for:</li>
				<li class="text_formats">1. Organizations new to the Business Excellence (BE) Initiative. </li>
				<li class="text_formats">2. Organizations applying for any of the following BE Certifications for the first time:</li>
			</ul>
		</div>
		
		<div class="btn btn-yellow" style="margin-top:30px;" data-toggle="modal" data-target="#register_for_event">REGISTER FOR  THIS EVENT</div>
		
		<hr class="line_effect">
		
		<div class="page_title_4">Events Schedule</div>
		
		<div class="row" id="events_items">
			<div class="col-sm-4 col-md-3 col-xs-4 event_item">
				<a href="#">
					<div class="date">29 May</div>
					<div class="image"><img src="<?=TEMPLATE?>img/event_1.jpg" class="img-responsive"></div>
					<div class="text">Georgian Cognac company is out in European market shelves...</div>
				</a>	
			</div>
			<div class="col-sm-4 col-md-3 col-xs-4 event_item">
				<div class="date">29 May</div>
				<div class="image"><img src="<?=TEMPLATE?>img/event_2.jpg" class="img-responsive"></div>
				<div class="text">Georgian Cognac company is out in European market shelves...</div>
			</div>
			
		</div>
		
		<a href="#" class="gray_link">Load Older Events »</a>
		
	</div>
</div>
<?php @include("parts/footer.php"); ?>