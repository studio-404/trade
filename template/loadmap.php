<?php 
	@include("parts/header.php"); 
?>
<div class="container" id="container">
	<div class="col-sm-3" id="sidebar">
		<div class="sidebar_menu">
			<ul>
				<?=$data["left_menu"]?>
			</ul>
		</div>
	</div>
	<div class="col-sm-9" id="content">
			<div class="mobileMapBox">
				<div class="mobileMapBox-title"><?=$data["mapfilter"][0]["mainTitle"]?></div>
				<div class="mobileMapBox-selectBox">
					<label>View By</label>
					<select class="mobileMapBox-viewBy">
						<option value="">Choose</option>
						<?php
			        	foreach ($data["mapfilter"] as $value) {
			        		echo '<option data-type="viewby" data-chosenid="'.$value["idx"].'">'.$value["title"].'</option>'; 
			        	}
			        	?>
					</select>
				</div>
				<div class="mobileMapBox-viewBySub" style="display:none">
					<label class="mobileMapBox-viewBySublabel">View By</label>
					<select class="mobileMapBox-viewBySubSelector">
					</select>
				</div>
				<table style="display:none">
					<?php
	                    foreach ($data["vectormap_new"] as $value) {
	                    	if($value["color"]==""){
	                    		$value["color"] = "#249fea"; 
	                    		$hashover = "true";
	                    	}else{
	                    		$hashover = "false";
	                    	}
	                    	// echo '<path id="code_'.$value["code"].'" data-hashover="'.$hashover.'" cs="100,100" title="'.htmlentities($value["title"]).'" d="'.$value["data"].'" transform="translate(0,-230)" stroke-width="0.975922042640789" fill="'.$value["color"].'" fill-opacity="1" stroke="#3d5373" stroke-opacity="1" class="amcharts-map-area amcharts-map-area-'.$value["code"].'" countryId="'.$value["code"].'"></path>';
	                    	echo '<tr>';
	                    	echo '<td id="mobcode_'.$value["code"].'">'.html_entity_decode($value["title"]).'</td>';
	                    	echo '</tr>';
	                    }
	                    ?>
				</table>
				<div style="clear:both"></div>
			</div>

			<div class="mymap">
				<div class="openmap"><a href="http://tradewithgeorgia.com/en/world-map-on-fullscreen" target="_blank">&nbsp;</a></div>
				<div class="searchMap">
					<div class="general-title"><?=$data["mapfilter"][0]["mainTitle"]?></div>
					<div class="viewby">
      
			        <div class="title">View By</div>
			        <div class="content">
			        	<!-- checked -->
			        	<?php
			        	foreach ($data["mapfilter"] as $value) {
			        		echo '<label class="input unchecked" data-type="viewby" data-chosenid="'.$value["idx"].'">'.$value["title"].'</label>'; 
			        	}
			        	?>
			        </div>
			      
			      </div>

			      <div class="traderegimes content_regime_box" style="display:none">

			        <div class="title">Trade regimes</div>
			        <div class="content content_regime">
			        </div>

			      </div>
			      <div class="clearfix"></div>
				</div>
				<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" height="480" xml:space="preserve">
        			<g transform="translate(70,165) scale(0.7,0.7)">
	                    <?php
	                    // echo '<path id="code_MT" data-hashover="true" cs="100,100" title="Malta" d="M520,363,L522,359.33,L524,359.33,L527,363,L532,363Z" transform="translate(0,-230)" stroke-width="0.975922042640789" fill="MT" fill-opacity="1" stroke="#3d5373" stroke-opacity="1" class="amcharts-map-area amcharts-map-area-MT" countryId="MT"></path>';
	                    foreach ($data["vectormap_new"] as $value) {
	                    	if($value["color"]==""){
	                    		$value["color"] = "#249fea"; 
	                    		$hashover = "true";
	                    	}else{
	                    		$hashover = "false";
	                    	}
	                    	echo '<path id="code_'.$value["code"].'" data-hashover="'.$hashover.'" cs="100,100" title="'.htmlentities($value["title"]).'" d="'.$value["data"].'" transform="translate(0,-230)" stroke-width="0.975922042640789" fill="'.$value["color"].'" fill-opacity="1" stroke="#3d5373" stroke-opacity="1" class="amcharts-map-area amcharts-map-area-'.$value["code"].'" countryId="'.$value["code"].'"></path>';
	                    }
	                    ?>
	                </g>
    			</svg>
    			<div style="clear:both"></div>
			</div>

			
	</div>
</div>
<script>
function myReset(){
	<?php
    foreach ($data["vectormap_new"] as $value) {
    	echo '$("#code_'.$value["code"].'").attr({"title":"'.str_replace(array( "\n", "\r" ), array( "\\n", "\\r" ), $value["title"]).'"});';
    }
    ?>
}
// mobile Version Start
$(document).on("change",".mobileMapBox-viewBy", function(){
	$(".mobileMapBox-viewBySub").fadeOut("slow"); 
	$(".mobileMapBox table").fadeOut("slow");
	var type = $('.mobileMapBox-viewBy option:selected').attr("data-type");
	var chosenid = $('.mobileMapBox-viewBy option:selected').attr("data-chosenid");
	if(typeof(type)!="undefined" && typeof(chosenid)!="undefined"){
		if(type=="viewby"){
			$.post("http://"+document.domain+"/en/ajax", { mapfilter:true, t:type, c:chosenid }, function(data){	
				if(data!="Empty"){
					var obj = JSON.parse(data);
					var out = "<option value=''>Choose</option>";
					var shorttitle = obj[0].shorttitle; 
					$(".mobileMapBox-viewBySublabel").text(shorttitle);
					for(var i = 0; i < obj.length; i++){
						// out += '<label class="input2 unchecked" data-type="traderegime" data-chosenid="'+obj[i].idx+'" style="width:100%">'+obj[i].title+'</label>';
						out += '<option data-type="traderegime" data-chosenid="'+obj[i].idx+'">'+obj[i].title+'</option>';
					}
					$(".mobileMapBox-viewBySubSelector").html(out);
					$(".mobileMapBox-viewBySub").fadeIn("slow"); 
				}
			});
		}
	}
});

$(document).on("change",".mobileMapBox-viewBySub", function(){
	$(".mobileMapBox table").fadeOut("slow");
	var type = $('.mobileMapBox-viewBySub option:selected').attr("data-type");
	var chosenid = $('.mobileMapBox-viewBySub option:selected').attr("data-chosenid");
	if(type=="traderegime"){
		$.post("http://"+document.domain+"/en/ajax", { mapfilter:true, t:type, c:chosenid }, function(data){	
			if(data!="Empty"){
				var obj = JSON.parse(data);
				//alert("a");
				if(obj.length){
					for(var i = 0; i < obj.length; i++){
						var code = obj[i].smi_title;
						var descr = obj[i].smi_long_description;
						var colr = obj[i].smi_color;
						// nowTitle.push(code.toUpperCase());
						// $("#code_" + code.toUpperCase()).css({ fill: colr });
						$("#mobcode_" + code.toUpperCase()).html(obj[i].smi_long_description);
						$("#mobcode_" + code.toUpperCase()).css("background-color",colr);
						
					}
				}
			}
		});
		$(".mobileMapBox table").fadeIn("slow");
	}
});

// mobile Version End

// amcharts-map-area
$('.amcharts-map-area').hover(function(){
		var tooltip = "tooltip";
		var title = $(this).attr('title');
		$(this).data('tipText', title).removeAttr('title');
		$('<p class="'+tooltip+'"></p>').html(title).appendTo('body').fadeIn('slow');
	}, function() {
			var tooltip = "tooltip";
			$(this).attr('title', $(this).data('tipText'));
			$('.'+tooltip).remove();
	}).mousemove(function(e) {
			var tooltip = "tooltip";
			var mousex = e.pageX + 20;
			var mousey = e.pageY + 10; 
			$('.'+tooltip).css({ top: mousey, left: mousex })
	});

$("svg g path").hover(function(){
	if($(this).attr("data-hashover")=="true"){
		$(this).css({"fill":"#298dcf","cursor":"pointer"});
	}
}, function(){
	if($(this).attr("data-hashover")=="true"){
		$(this).css({"fill":"#249fea"});
	}
});

$(document).on("click",".input",function(){
	var type = $(this).attr("data-type");
	var chosenid = $(this).attr("data-chosenid");
	myReset();
	//alert(chosenid);
	$(".viewby .input").removeClass("checked"); 
	$(".viewby .input").addClass("unchecked"); 
	$("svg g path").removeAttr("style");
	$(this).removeClass("unchecked"); 
	$(this).addClass("checked"); 
	if(type=="viewby"){
		$.post("http://"+document.domain+"/en/ajax", { mapfilter:true, t:type, c:chosenid }, function(data){	
			if(data!="Empty"){
				var obj = JSON.parse(data);
				var out = "";
				var shorttitle = obj[0].shorttitle; 
				$(".content_regime_box .title").text(shorttitle);
				for(var i = 0; i < obj.length; i++){
					out += '<label class="input2 unchecked" data-type="traderegime" data-chosenid="'+obj[i].idx+'" style="width:100%">'+obj[i].title+'</label>';
				}
				$(".content_regime").html(out);
				$(".content_regime_box").fadeIn("slow"); 
			}
		});
	}
});
var nowTitle = new Array();

$(document).on("click",".input2",function(){
	var type = $(this).attr("data-type");
	var chosenid = $(this).attr("data-chosenid");
	//alert(chosenid);
	myReset();
	$(".content_regime .input2").removeClass("checked"); 
	$(".content_regime .input2").addClass("unchecked"); 
	$("svg g path").removeAttr("style");
	$(this).removeClass("unchecked"); 
	$(this).addClass("checked"); 
	if(type=="traderegime"){
		$.post("http://"+document.domain+"/en/ajax", { mapfilter:true, t:type, c:chosenid }, function(data){	
			if(data!="Empty"){
				var obj = JSON.parse(data);
				if(obj.length){
					for(var i = 0; i < obj.length; i++){
						var code = obj[i].smi_title;
						var descr = obj[i].smi_long_description;
						var colr = obj[i].smi_color;
						nowTitle.push(code.toUpperCase());
						$("#code_" + code.toUpperCase()).css({ fill: colr });
						$("#code_" + code.toUpperCase()).attr({"title": descr });
						$("#code_" + code.toUpperCase()).attr("data-hashover","false");
					}
				}
			}
		});

	}
});

</script>
<?php @include("parts/footer.php"); ?>