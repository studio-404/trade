<?php @include("parts/header.php"); ?>
<div class="container" id="container">
	<div class="col-sm-3" id="sidebar">
		<div class="breadcrumbs">
			<div class="your_are_here"><?=$data["language_data"]["path"]?>: </div>
			<li><a href="<?=MAIN_PAGE?>"><?=$data["language_data"]["mainpage"]?></a><li>  >
			<?php 
			$count = count($data["breadcrups"]); 
			$x=1;
			foreach($data["breadcrups"] as $val)
			{
				if($x<$count){ $seperarator = ">"; }else{ $seperarator=""; }
			?>
				<li><a href="<?=WEBSITE.LANG."/".$val->slug?>"><?=$val->title?></a><li>  <?=$seperarator?>
			<?php
				$x++;
			}
			?>  
		</div>
		<div class="sidebar_menu">
			<ul>
				<?=$data["left_menu"]?>
			</ul>
		</div>
	</div>
	<div class="col-sm-9" id="content">
		<div class="page_title_2">
			<?=$data["language_data"]['eventsheader']?>
		</div>
		 
		<div class="page_title_3">
			<div class="row">
				<?php
				$first = $data["eventsinside_general"];
				?>
				<div class="col-sm-10 padding_0"><?=$first[0]->title?></div>
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
							<span><?=date("d",$first[0]->date)?></span><?=$data["language_data"][date("M",$first[0]->date)]?>
						</div>
					</div>
					<div class="col-sm-9 padding_0 text_formats_blue">
						<div class="yellow_title"><?=$data["language_data"]["place"]?>:</div>
						<?=$first[0]->event_desc?>
					</div>
				</div>
			</div>
			<div class="col-sm-4 event_line_bg">
				<div class="yellow_title"><?=$data["language_data"]["when"]?>:</div>
				<div class="text_formats_blue">
					<?=$first[0]->event_when?>	
				</div>
			</div>
			<div class="col-sm-4 event_line_bg">
				<div class="yellow_title"><?=$data["language_data"]["fee"]?>:</div>
				<div class="text_formats_blue">
					<?=$first[0]->event_fee?>	
				</div>
			</div>			
		</div>
		
		<!-- <div class="text_formats">
			<p><?=$data["website_text"]?></p>
		</div> -->
		
		<div class="event_prog" style="margin:0">
			<div class="title" style="padding:10px 0;"><?=$data["language_data"]["programme"]?></div>
		</div>
		<div class="text_formats">
			<?=$first[0]->long_description?>
		</div>
		

		

		

			<!-- <hr class="line_effects" style="margin:20px 0;"/><div class="text_formats">

				<label><?=$data["language_data"]["eventscalendar"]?></label>

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
			</div> -->


	</div>
</div>
<script>
// <?php
// $edates = '';
// $etitle = '';
// foreach($data["events_general"] as $o){
// 	$edates .= "'" . date("j-F-Y", $o->date) . "',";
// 	$etitle .=  "'".date("jFY", $o->date) ."':'".$o->title."',"; 
// 	$eslugs .= "'".date("jFY", $o->date) ."':'".$o->slug."',";
// }
// $edates = rtrim($edates, ","); 
// $etitle = rtrim($etitle, ","); 
// $eslugs = rtrim($eslugs, ","); 
// ?>

// var event_array = [<?=$edates?>];
// var event_titles = [{<?=$etitle?>}];
// var event_slugs = [{<?=$eslugs?>}]; 

//  // var out = '';
//  //    for (var i in event_titles[0]) {
//  //        out += i + ": " + event_titles[0][i] + "\n";
//  //    }

//  //    alert(out);
//  // alert();
// function include(arr,obj) {
//     return (arr.indexOf(obj) != -1);
// }


// function Calendar2(event_array,id, year, month) {


// 	var Dlast = new Date(year,month+1,0).getDate(),
// 		D = new Date(year,month,Dlast),
// 		DNlast = new Date(D.getFullYear(),D.getMonth(),Dlast).getDay(),
// 		DNfirst = new Date(D.getFullYear(),D.getMonth(),1).getDay(),
// 		calendar = '<tr>',
// 		month= [
// 		"<?=$data["language_data"]["January"]?>",
// 		"<?=$data["language_data"]["February"]?>",
// 		"<?=$data["language_data"]["March"]?>",
// 		"<?=$data["language_data"]["April"]?>",
// 		"<?=$data["language_data"]["May"]?>",
// 		"<?=$data["language_data"]["June"]?>",
// 		"<?=$data["language_data"]["July"]?>",
// 		"<?=$data["language_data"]["August"]?>",
// 		"<?=$data["language_data"]["September"]?>",
// 		"<?=$data["language_data"]["October"]?>",
// 		"<?=$data["language_data"]["November"]?>",
// 		"<?=$data["language_data"]["December"]?>"
// 		],
// 		month_english = [
// 		"January", 
// 		"February", 
// 		"March", 
// 		"April", 
// 		"May", 
// 		"June", 
// 		"July", 
// 		"August",
// 		"September", 
// 		"October", 
// 		"November", 
// 		"December"
// 		];
		
// 	if (DNfirst != 0) {
// 	  for(var  i = 1; i < DNfirst; i++) calendar += '<td class="not_date">';
// 	}else{
// 	  for(var  i = 0; i < 6; i++) calendar += '<td class="not_date">';
// 	}
// 	for(var  i = 1; i <= Dlast; i++) {

	 
// 	//month[]
// 	var c_date = i+"-"+month_english[D.getMonth()]+"-"+D.getFullYear();
// 	var c_date2 = i+month_english[D.getMonth()]+D.getFullYear();
// 	var c_date3 = '<?php echo WEBSITE.LANG."/"; ?>'+event_slugs[0][c_date2];
// 	if(include(event_array,c_date)){ var event_exists = ' events_true';  }
// 	else{ var event_exists = ''; }
	
// 	  if (i == new Date().getDate() && D.getFullYear() == new Date().getFullYear() && D.getMonth() == new Date().getMonth()) {
// 	  	if(event_exists){
// 	  		calendar += '<td class="today'+event_exists+'"><a href="'+c_date3+'">' + i + ' </a>';
// 	  	}else{
// 	  		calendar += '<td class="today"><div>' + i;
// 	  	}
		
// 	  }else{
// 	  	if(event_exists){
// 			calendar += '<td class=" '+event_exists+'"><a href="'+c_date3+'" class="event_deys" data-container="body" data-content="'+event_titles[0][c_date2]+'"	rel="popover" data-placement="bottom">' + i + '</a>';
// 		}else{
// 			calendar += '<td class="no_event"><div>' + i;
// 		}
// 	  }
// 	  if (new Date(D.getFullYear(),D.getMonth(),i).getDay() == 0) {
// 		calendar += '<tr>';
// 	  }
// 	}
// 	for(var  i = DNlast; i < 7; i++) calendar += '<td class="not_date">&nbsp;';
// 	document.querySelector('#'+id+' tbody').innerHTML = calendar;
// 	document.querySelector('#'+id+' thead td:nth-child(2)').innerHTML = month[D.getMonth()] +' '+ D.getFullYear();
// 	document.querySelector('#'+id+' thead td:nth-child(2)').dataset.month = D.getMonth();
// 	document.querySelector('#'+id+' thead td:nth-child(2)').dataset.year = D.getFullYear();
// 	if (document.querySelectorAll('#'+id+' tbody tr').length < 6) {  // чтобы при перелистывании месяцев не "подпрыгивала" вся страница, добавляется ряд пустых клеток. Итог: всегда 6 строк для цифр
// 		document.querySelector('#'+id+' tbody').innerHTML += '<tr>';
// 	}
// 	}


// 	//var event_array = [];

// 	Calendar2(event_array,"calendar2", new Date().getFullYear(), new Date().getMonth());

// 	// переключатель минус месяц
// 	document.querySelector('#calendar2 thead tr:nth-child(1) td:nth-child(1)').onclick = function() {
// 	  Calendar2(event_array,"calendar2", document.querySelector('#calendar2 thead td:nth-child(2)').dataset.year, parseFloat(document.querySelector('#calendar2 thead td:nth-child(2)').dataset.month)-1);
// 	}
// 	// переключатель плюс месяц
// 	document.querySelector('#calendar2 thead tr:nth-child(1) td:nth-child(3)').onclick = function() {
// 	  Calendar2(event_array,"calendar2", document.querySelector('#calendar2 thead td:nth-child(2)').dataset.year, parseFloat(document.querySelector('#calendar2 thead td:nth-child(2)').dataset.month)+1);
// 	}
</script>

<script>
 

	// $('#popoverData').popover();
	// $('.event_deys').popover({ trigger: "hover" });
	// $('.event_deys').tooltip({ container: 'body' }) 

</script>
<?php @include("parts/footer.php"); ?>