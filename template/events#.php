<?php @include("parts/header.php"); ?>
<div class="container" id="container">
	<div class="col-sm-3" id="sidebar">
		<div class="breadcrumbs">
			<div class="your_are_here">Your are here: </div>
			<li><a href="#">Media Center</a><li>  >  
			<li><a href="#">Photo Gallery</a><li>   
		</div>
		<div class="sidebar_menu">
			<ul>
				<?=$data["left_menu"]?>
			</ul>
		</div>
	</div>
	<div class="col-sm-9" id="content">
		<div class="page_title_2">
			<?=$data["website_title"]?>
		</div>
		 
		<div class="page_title_3">
			<div class="row">
				<div class="col-sm-10 padding_0">Bussines excellence briefing for new organizations</div>
				<div class="col-sm-2 padding_0">
					<div class="icons">
						<div class="share"></div>
						<div class="print"></div>
					</div>
				</div>
			</div>			
		</div>

		<hr class="line_effects"/>
		
		<div class="row" id="event_div">
			<div class="col-sm-4">
				<div class="text_formats_blue">
					<div class="col-sm-3 padding_0" style="width:45px;">
						<div class="date_yellow">
							<span>01</span>May
						</div>
					</div>
					<div class="col-sm-9 padding_0">
						<ul> 
							<li class="text_formats_blue">Pinnacle Room 1, SPRING Singapore </li>
							<li class="text_formats_blue">1 Fusionopolis Walk </li>
							<li class="text_formats_blue">#01-02 South Tower, Solaris </li>
							<li class="text_formats_blue">Singapore 138628</li>
						</ul>	
					</div>
				</div>
			</div>
			<div class="col-sm-4 event_line_bg">
				<div class="yellow_title">When:</div>
				<div class="text_formats_blue">
					<ul>
						<li class="text_formats_blue">Everyday 01.06.2015 - 11.06.2015 15:00 - 17:00</li>
					</ul>	
				</div>
			</div>
			<div class="col-sm-4 event_line_bg">
				<div class="yellow_title">Fee:</div>
				<div class="text_formats_blue">
					<ul> 
						<li class="text_formats_blue">No  fees apply</li>
					</ul>	
				</div>
			</div>			
		</div>
		
		<div class="text_formats">
			<p><?=$data["website_text"]?></p>
		</div>
		
		<div class="event_prog">
			<div class="title" style="padding:10px 0;">Programme</div>
			<ul>
				<li><label></label>3.10 pm - Profiling Questionaire</li>
				<li><label></label>3.20 pm - The Revised BE Framework</li>
				<li><label></label>3.30 pm - Benefits of BE</li>
				<li><label></label>3.40 pm - Application Procedures for BE Certification (SQC, PD, I-Class, S-Class)</li>
				<li><label></label>4.00 pm - Support & Assistance for SMEs</li>
				<li><label></label>4.30 pm - Combined Q&A Session</li>
			</ul>
		</div>

		<div class="text_formats">
			<ul>
				<li class="text_formats">This briefing is suitable for:</li>
				<li class="text_formats">1. Organizations new to the Business Excellence (BE) Initiative. </li>
				<li class="text_formats">2. Organizations applying for any of the following BE Certifications for the first time:</li>
			</ul>
		</div>
		

		<hr class="line_effects" style="margin:20px 0;"/>

		

		<div class="text_formats">

				<label>Events Calendar</label>

			</div>

		

			<div class="events_calendar">
				<div class="events_cal_slide">
					<table id="calendar2">
						<thead>
							<tr class="first_tr_bg"><td class="left_arrow">
								<img src="<?=TEMPLATE?>img/event_arrow_left.png"/>
								<td colspan="5">
									<div class="title"></div>
									<td class="right_arrow">
										<img src="<?=TEMPLATE?>img/event_arrow_right.png"/>
							<tr><td><td><td><td><td><td><td>
						<tbody>
					</table>
				</div>	
			</div>


	</div>
</div>
<script>
var event_array = ["1-June-2015","3-June-2015","4-June-2015","7-June-2015","8-June-2015","13-June-2015","19-June-2015","27-June-2015","28-June-2015","30-June-2015",];
function include(arr,obj) {
    return (arr.indexOf(obj) != -1);
}


function Calendar2(event_array,id, year, month) {


	var Dlast = new Date(year,month+1,0).getDate(),
		D = new Date(year,month,Dlast),
		DNlast = new Date(D.getFullYear(),D.getMonth(),Dlast).getDay(),
		DNfirst = new Date(D.getFullYear(),D.getMonth(),1).getDay(),
		calendar = '<tr>',
		month=["January","February","March","April","May","June","July","August","September","October","November","December"];
	if (DNfirst != 0) {
	  for(var  i = 1; i < DNfirst; i++) calendar += '<td class="not_date">';
	}else{
	  for(var  i = 0; i < 6; i++) calendar += '<td class="not_date">';
	}
	for(var  i = 1; i <= Dlast; i++) {

	 
	
	var c_date = i+"-"+month[D.getMonth()]+"-"+D.getFullYear();
	if(include(event_array,c_date)){ var event_exists = ' events_true';  }
	else{ var event_exists = ''; }
	
	  if (i == new Date().getDate() && D.getFullYear() == new Date().getFullYear() && D.getMonth() == new Date().getMonth()) {
	  	if(event_exists){
	  		calendar += '<td class="today'+event_exists+'"><a href="?d='+c_date+'">' + i + ' </a>';
	  	}else{
	  		calendar += '<td class="today"><div>' + i;
	  	}
		
	  }else{
	  	if(event_exists){
			calendar += '<td class=" '+event_exists+'"><a href="?d='+c_date+'" class="event_deys" data-container="body" data-content="Two day event will be held in Tbillisi Marriot,to support small bussines development in all regions"	rel="popover" data-placement="bottom">' + i + '</a>';
		}else{
			calendar += '<td class="no_event"><div>' + i;
		}
	  }
	  if (new Date(D.getFullYear(),D.getMonth(),i).getDay() == 0) {
		calendar += '<tr>';
	  }
	}
	for(var  i = DNlast; i < 7; i++) calendar += '<td class="not_date">&nbsp;';
	document.querySelector('#'+id+' tbody').innerHTML = calendar;
	document.querySelector('#'+id+' thead td:nth-child(2)').innerHTML = month[D.getMonth()] +' '+ D.getFullYear();
	document.querySelector('#'+id+' thead td:nth-child(2)').dataset.month = D.getMonth();
	document.querySelector('#'+id+' thead td:nth-child(2)').dataset.year = D.getFullYear();
	if (document.querySelectorAll('#'+id+' tbody tr').length < 6) {  // чтобы при перелистывании месяцев не "подпрыгивала" вся страница, добавляется ряд пустых клеток. Итог: всегда 6 строк для цифр
		document.querySelector('#'+id+' tbody').innerHTML += '<tr>';
	}
	}


	//var event_array = [];

	Calendar2(event_array,"calendar2", new Date().getFullYear(), new Date().getMonth());

	// переключатель минус месяц
	document.querySelector('#calendar2 thead tr:nth-child(1) td:nth-child(1)').onclick = function() {
	  Calendar2(event_array,"calendar2", document.querySelector('#calendar2 thead td:nth-child(2)').dataset.year, parseFloat(document.querySelector('#calendar2 thead td:nth-child(2)').dataset.month)-1);
	}
	// переключатель плюс месяц
	document.querySelector('#calendar2 thead tr:nth-child(1) td:nth-child(3)').onclick = function() {
	  Calendar2(event_array,"calendar2", document.querySelector('#calendar2 thead td:nth-child(2)').dataset.year, parseFloat(document.querySelector('#calendar2 thead td:nth-child(2)').dataset.month)+1);
	}
</script>

<script>
 

	$('#popoverData').popover();
	$('.event_deys').popover({ trigger: "hover" });
	$('.event_deys').tooltip({ container: 'body' }) 

</script>
<?php @include("parts/footer.php"); ?>