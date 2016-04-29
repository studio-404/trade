<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Fullscreen Map</title>
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="author" content="Niki Getsadze, George Gvazava, Valerian Apkazava, Zviad Ruxadze" />
<link rel="icon" type="image/gif" href="http://tradewithgeorgia.com/template/img/favicon.ico?v=1.4.5" />
<link type="text/plain" rel="author" href="http://tradewithgeorgia.com/humans.txt" />

<link href="http://tradewithgeorgia.com/template/css/fonts.css?v=1.4.5" type="text/css" rel="stylesheet"/>

<link href="http://tradewithgeorgia.com/template/css/fonts.css?v=1.4.5" type="text/css" rel="stylesheet"/> 
<link href='http://fonts.googleapis.com/css?family=Roboto:400,400italic,500,500italic,700,900' rel='stylesheet' type='text/css'>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js?v=1.4.5"></script>
<script src="http://tradewithgeorgia.com/template/js/scripts.js?v=1.4.5"></script>
<style>
body{ margin:0; padding: 0; background: #424862; font-family: roboto; }
.mymap{ position: relative; height: 730px;  }
.mymap svg{ position: absolute; z-index: 1000; width:800px; left:calc(50% - 400px);  }
.tooltip {
	display: none;
	position: absolute;
	background-color: #292929;
	border: solid 1px #CDCDCD;
	padding: 3px;
	color: #ffffff;
	font-size: 14px;
	font-family: 'Roboto';
	z-index: 1010;
	opacity: 1;
}
.tooltip p{
	padding: 3px;
	color: #ffffff;
	font-size: 14px;
	font-family: 'Roboto';
	margin: 0;
}
.openmap{ margin: 0; padding: 0; width: 21px; height: 21px; background-image: url('/_plugins/jvectormap/exsize2.svg'); background-size: 21px 21px; position: absolute; right: 10px; top: 10px; z-index: 1001 }
.openmap a{ margin: 0; padding: 0; width: 21px; height: 21px; display: block; text-decoration: none; }
.searchMap{ margin:0; padding: 0; border: 0; width: 100%; background: #424862; min-height: 180px; }
.searchMap .general-title{ padding: 10px; font-size: 26px; line-height: 26px; color: #ffffff; font-weight: bold; }
.searchMap .viewby{ margin: 10px; padding: 5px; width: calc(100% - 30px); float: left; border: solid 1px #fea100; }
.searchMap .viewby .title{ margin: 0; padding: 0; color:#fea100; font-size: 16px; }
.searchMap .viewby .content{ margin: 5px 0 0 0; padding: 0; color:#ffffff; }
.searchMap .viewby .content .input{ margin: 0 10px 0 0; font-size: 14px; padding: 0 0 0 30px; float: left; position: relative; cursor: pointer; }
.searchMap .viewby .content .input:hover{ color: #fea100; }

.searchMap .viewby .content .checked::after{ content:" "; margin:0; padding: 0; width: 14px; height: 14px; background-image: url('/_plugins/jvectormap/checked.png'); background-repeat: no-repeat; background-position: center center; position: absolute; top: 3px; left: 3px }
.searchMap .viewby .content .unchecked::after{ content:" "; margin:0; padding: 0; width: 14px; height: 14px; background-image: url('/_plugins/jvectormap/uncheked.png'); background-repeat: no-repeat; background-position: center center; position: absolute; top: 3px; left: 3px; }
.searchMap .traderegimes{ margin: 10px; padding: 5px; width: calc(100% - 30px); float: left; border: solid 1px #fea100; }
.searchMap .traderegimes .title{ margin: 0; padding: 0; color:#fea100; }
.searchMap .traderegimes .content{ margin: 5px 0 0 0; padding: 0; color:#ffffff; }
.searchMap .traderegimes .content .input2{ margin: 0 10px 0 0; padding: 0 0 0 30px; float: left; position: relative; cursor: pointer; }
.searchMap .traderegimes .content .input2:hover{ color: #fea100; }
.searchMap .traderegimes .content .checked::after{ content:" "; margin:0; padding: 0; width: 14px; height: 14px; background-image: url('/_plugins/jvectormap/checked.png'); background-repeat: no-repeat; background-position: center center; position: absolute; top: 3px; left: 3px }
.searchMap .traderegimes .content .unchecked::after{ content:" "; margin:0; padding: 0; width: 14px; height: 14px; background-image: url('/_plugins/jvectormap/uncheked.png'); background-repeat: no-repeat; background-position: center center; position: absolute; top: 3px; left: 3px; }
.clearfix{ clear: both; }
</style>
</head>
<body>
<div class="mymap">
				<!-- <div class="openmap"><a href="#" target="_blank">&nbsp;</a></div> -->
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
				<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" height="550" xml:space="preserve">
        			<g transform="translate(70,165) scale(0.7,0.7)">
	                    <?php
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

			</div>




<script>
function myReset(){
	<?php
    foreach ($data["vectormap_new"] as $value) {
    	echo '$("#code_'.$value["code"].'").attr({"title":"'.str_replace(array( "\n", "\r" ), array( "\\n", "\\r" ), $value["title"]).'"});';
    }
    ?>
}

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
					out += '<label class="input2 unchecked" data-type="traderegime" data-chosenid="'+obj[i].idx+'">'+obj[i].title+'</label>';
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
</body>
</html>