<?php
try{
  $host = 'mysql:host=mysql1.tradewithgeorgia.com;dbname=tradegeorgia;charset=utf8'; 
  $HANDLER = new PDO($host,"tradegeorgia","georgiadbtrade"); 
  $HANDLER->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $HANDLER->exec("set names utf8"); 
}catch(PDOException $e){
  die("Sorry, Database connection problem.."); 
}
if(isset($_GET['title'])){
  $title = urldecode($_GET['title']);
}else{
  $title = "Trade Map";
}
setlocale(LC_MONETARY,"en_US");
?>
<!DOCTYPE html>
<html>
<head>
  <title><?=$title?></title>
  <link rel="stylesheet" href="jquery-jvectormap-2.0.1.css" type="text/css" media="screen"/>
  <script src="jquery.js"></script>
  <script src="jquery-jvectormap-2.0.2.min.js"></script>
  <script src="jquery-jvectormap-world-mill-en.js"></script>
  <style type="text/css">
  @font-face {
  font-family: 'Roboto-Regular';
    src: url('Roboto-Regular.eot?#iefix') format('embedded-opentype'),  
    url('../roboto/Roboto-Regular.woff') format('woff'), 
    url('../roboto/Roboto-Regular.ttf')  format('truetype'), 
    url('../roboto/Roboto-Regular.svg#Roboto-Regular') format('svg');
    font-weight: normal;
    font-style: normal;
  }
  .clearfix{ clear: both; }
  body{ margin:0; padding:0; border:0; font-family: 'Roboto-Regular'; }
  .mymap{ margin:0; padding:0; border:0; width:100%; height:400px; position: relative; }
  .searchMap{ margin:0; padding: 0; border: 0; width: 100%; background: #424862; min-height: 180px; }
  .searchMap .general-title{ margin:0; padding: 10px 30px; font-size: 26px; line-height: 26px; color: #ffffff; font-weight: bold; }
  .searchMap .viewby{ margin: 10px 30px; padding: 5px; width: 30%; float: left; border: solid 1px #fea100; }
  .searchMap .viewby .title{ margin: 0; padding: 0; color:#fea100; }
  .searchMap .viewby .content{ margin: 5px 0 0 0; padding: 0; color:#ffffff; }
  .searchMap .viewby .content .input{ margin: 0 10px 0 0; padding: 0 0 0 30px; float: left; position: relative; cursor: pointer; }
  .searchMap .viewby .content .input:hover{ color: #fea100; }
  .searchMap .viewby .content .checked::after{ content:" "; margin:0; padding: 0; width: 14px; height: 14px; background-image: url('checked.png'); background-repeat: no-repeat; background-position: center center; position: absolute; top: 3px; left: 3px }
  .searchMap .viewby .content .unchecked::after{ content:" "; margin:0; padding: 0; width: 14px; height: 14px; background-image: url('uncheked.png'); background-repeat: no-repeat; background-position: center center; position: absolute; top: 3px; left: 3px; }

  .searchMap .traderegimes{ margin: 10px 30px; padding: 5px; width: 50%; float: left; border: solid 1px #fea100; }
  .searchMap .traderegimes .title{ margin: 0; padding: 0; color:#fea100; }
  .searchMap .traderegimes .content{ margin: 5px 0 0 0; padding: 0; color:#ffffff; }
  .searchMap .traderegimes .content .input{ margin: 0 10px 0 0; padding: 0 0 0 30px; float: left; position: relative; cursor: pointer; }
  .searchMap .traderegimes .content .input:hover{ color: #fea100; }
  .searchMap .traderegimes .content .checked::after{ content:" "; margin:0; padding: 0; width: 14px; height: 14px; background-image: url('checked.png'); background-repeat: no-repeat; background-position: center center; position: absolute; top: 3px; left: 3px }
  .searchMap .traderegimes .content .unchecked::after{ content:" "; margin:0; padding: 0; width: 14px; height: 14px; background-image: url('uncheked.png'); background-repeat: no-repeat; background-position: center center; position: absolute; top: 3px; left: 3px; }
  #map1{ width: 100%; height:400px; }
  .openmap{ margin: 0; padding: 0; width: 21px; height: 21px; background-image: url('exsize2.svg'); background-size: 21px 21px; position: absolute; right: 10px; top: 10px; z-index: 1001 }
  .openmap a{ margin: 0; padding: 0; width: 21px; height: 21px; display: block; text-decoration: none; }
  </style>
  <?php 
$sql1 = 'SELECT `idx`,`title`,`code`,`export`,`import`,`trade_regime`,`colorcode`,`countrygroups` FROM `studio404_vectormap` WHERE `group`=0 AND `lang`=5';
$prepare1 = $HANDLER->prepare($sql1);
$prepare1->execute();
$fetch1 = $prepare1->fetchAll(PDO::FETCH_NUM); 

$sql2 = 'SELECT `title`,`code`,`trade_regime`,`colorcode` FROM `studio404_vectormap` WHERE `group`=1 AND `lang`=5';
$prepare2 = $HANDLER->prepare($sql2);
$prepare2->execute();
$fetch2 = $prepare2->fetchAll(PDO::FETCH_NUM); 
?>
</head>
<body <?=(isset($_GET['big'])) ? 'style="background-color:#424862"' : ''?>>
  <div class="mymap">
    <?php if(!isset($_GET['big'])) : ?>
    <div class="openmap"><a href="/_plugins/jvectormap/index.php?big" target="_blank">&nbsp;</a></div>
  <?php endif; ?>
    <div class="searchMap">
      <div class="general-title"><?=$title?></div>
      <div class="viewby">
      
        <div class="title">View by</div>
        <div class="content">
          <label class="input checked" data-type="viewby" id="country">Countries </label>
          <label class="input unchecked" data-type="viewby" id="groups">Country groups </label>
        </div>
      
      </div>

      <div class="traderegimes content_regime_box">

        <div class="title">Trade regimes</div>
        <div class="content content_regime">
          <label class="input unchecked" data-type="traderegime" id="freetrade" style="width:100%">Free trade </label>
          <label class="input unchecked" data-type="traderegime" id="ongoing" style="width:100%">On going free trade negotiation </label>
        </div>

      </div>
      <div class="clearfix"></div>

    </div>
    <div id="map1"></div>
    <!-- Ukraine And Uzbekistan associative members START  -->
    <div class="assoc" style="display:none; width:160px; height:20px; position:relative; z-index:10000; margin-top:-20px; top:-20px; left:20px;">
      <div style="width:20px; height:20px; float:left; background-color:#ace6f0"></div>
      <div style="width:120px; height:20px; font-size:12px; line-height:20px; float:left; margin-left:10px; color:white; font-family: roboto">Associate States</div>
    </div>
    <!-- Ukraine And Uzbekistan associative members END  -->

    <!-- Ukraine And Uzbekistan associative members START  -->
    <div class="all_data" style="display:none; width:160px; position:absolute; right:20px; bottom:-160px; border:solid 1px #ace6f0">
      <p style="margin:10px 0px; height:20px; font-size:18px; line-height:20px; margin-left:10px; color:white; font-family: roboto">Total</p>
      <p style="margin:5px 0px; height:20px; font-size:12px; line-height:20px; margin-left:10px; color:white; font-family: roboto" id="totalexport">Export: 0</p>
      <p style="margin:5px 0px; height:20px; font-size:12px; line-height:20px; margin-left:10px; color:white; font-family: roboto" id="totalimport">Import: 0</p>      
    </div>
    <!-- Ukraine And Uzbekistan associative members END  -->
  </div>
  <script type="text/javascript" charset="utf-8">
    jQuery.noConflict();
    jQuery(function(){
      var $ = jQuery;
       var mapx = $('#map1').vectorMap({
        map: 'world_mill_en',
        backgroundColor: '#424862', 
        panOnDrag: true,
        regionsSelectable:true, 
        regionStyle:{
        initial: {
          fill: '#249fea',
          "fill-opacity": 1,
          stroke: 'none',
          "stroke-width": 0,
          "stroke-opacity": 1
          },
          hover: {
            "fill-opacity": 0.8,
            cursor: 'pointer'
          },
          selected: {
            fill: '#0278c1'
          },
          selectedHover: {
          }
        }, 
        series: {
          regions: [{
            values: {"GE":"#ffae00"},
            attribute: 'fill'
          }],
        }, 
        onRegionTipShow: function(e, el, code){ 
          var exportArray = expFunction();
          var insertHtml = (exportArray[code]) ? parseFloat(exportArray[code]).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,') : '0.00';

          // console.log(parseFloat(exportArray[code]));

          var importArray = impFunction();
          var insertHtml2 = (importArray[code]) ? parseFloat(importArray[code]).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,') : '0.00';

          var tradeRArray = tradeFunction();
          var insertHtml3 = (tradeRArray[code]) ? tradeRArray[code] : 'Not Defind';

          var loadx = '<b style="font-size:12px; font-family:\'Roboto-Regular\'">'+el.html()+" - "+code+'</b>';
          loadx += '<br />';
          loadx += '<font style="font-size:11px; font-family:\'Roboto-Regular\'">Export: '+insertHtml+'</font>';
          loadx += '<br />';
          loadx += '<font style="font-size:11px; font-family:\'Roboto-Regular\'">Import: '+insertHtml2+'</font>';
          loadx += '<br />';
          loadx += '<font style="font-size:11px; font-family:\'Roboto-Regular\'">Trade regime: '+insertHtml3+'</font>';
          el.html(loadx);
        }
      });
    }); 


  jQuery(document).on("click",".input",function(e){
      var type = jQuery(this).data("type");
      var idx = jQuery(this).attr("id"); 
      var mapx = jQuery('#map1').vectorMap('get', 'mapObject');
      jQuery(".assoc").hide();
      jQuery(".all_data").hide();
      if(type=="viewby"){
          if(idx=="country"){
            resetColors();
            var ihtml = '<label class="input unchecked" data-type="traderegime" id="freetrade" style="width:100%">Free trade </label><label class="input unchecked" data-type="traderegime" id="ongoing" style="width:100%">On going free trade negotiation </label>';
            jQuery(".content_regime_box .title").html("Trade Regimes");
            jQuery(".content_regime").html(ihtml);
            jQuery("#freetrade").attr({"class":"input unchecked"});
            jQuery("#ongoing").attr({"class":"input unchecked"});
            jQuery("#country").attr({"class":"input checked"});
            jQuery("#groups").attr({"class":"input unchecked"});
          }else if(idx=="groups"){
            resetColors();
            var ihtml = '<label class="input unchecked" data-type="groupname" id="efta" style="width:100%">EFTA</label>';
            ihtml += '<label class="input unchecked" data-type="groupname" id="cis" style="width:100%">CIS</label>';
            ihtml += '<label class="input unchecked" data-type="groupname" id="eu" style="width:100%">EU</label>';
            jQuery(".content_regime_box .title").html("Group Name (s)");
            jQuery(".content_regime").html(ihtml);
            
            
            jQuery("#country").attr({"class":"input unchecked"});
            jQuery("#groups").attr({"class":"input checked"});
                     
            
            //mapx.series.regions[0].setValues(vvv);
          }

      }else if(type=="traderegime"){
          // if choose trade regime turn off group view
          jQuery("#country").click(); 
        
          if(idx == "freetrade"){
            resetColors();
            jQuery("#freetrade").attr({"class":"input checked"});
            jQuery("#gsp").attr({"class":"input unchecked"});
            jQuery("#ongoing").attr({"class":"input unchecked"});

            var onlyFreeTrade = onlyFreeTrades(); 
            var vvv2 = new Array();
            for (var k in onlyFreeTrade) {
                vvv2[k] = onlyFreeTrade[k];
            }
            mapx.series.regions[0].setValues(vvv2);

          }else if(idx == "ongoing"){
            resetColors();
            var onlyongoingx = onlyongoing(); 
            var vvv4 = new Array();
            for (var k in onlyongoingx) {
                vvv4[k] = onlyongoingx[k];
            }
            mapx.series.regions[0].setValues(vvv4);
            jQuery("#freetrade").attr({"class":"input unchecked"});
            jQuery("#gsp").attr({"class":"input unchecked"});
            jQuery("#ongoing").attr({"class":"input checked"});
          }
      }else if(type=="groupname"){
        jQuery(".all_data").show();
        resetColors();
        if(idx=="efta"){
           jQuery("#efta").attr({"class":"input checked"});
           jQuery("#cis").attr({"class":"input unchecked"});
           jQuery("#eu").attr({"class":"input unchecked"});
           var onlyEfta = (function() {
               var out = Array();
              <?php 
                $x = 0;
                $allCountries = array();
                foreach ($fetch2 as $value) : 
                // if($x==0){ $x=1; continue; }
                if($value[1]!="EFTA"){ continue; }
                $explode = explode(",",$value[0]);
                foreach ($explode as $v) {
              ?>
                  out["<?=trim($v)?>"] = "#fea100";
              <?php 
                  $allCountries[] = trim($v);
                }
                $x++; 
                endforeach; 
                $totalimport = 0;
                $totalexport = 0;
                foreach ($fetch1 as $value) : 
                  if(in_array($value[2], $allCountries)){
                    $totalimport += $value[4];
                    $totalexport += $value[3];
                  }
                endforeach;
              $e = str_replace("USD","",money_format('%i',$totalexport));
              $im = str_replace("USD","",money_format('%i',$totalimport));
              ?>
              jQuery("#totalexport").text("Export: <?=$e?>");
              jQuery("#totalimport").text("Import: <?=$im?>");
              return out;
            })(); 
            var vvv2 = new Array();
            for (var k in onlyEfta) {
                vvv2[k] = onlyEfta[k];
            }
            mapx.series.regions[0].setValues(vvv2);
        }else if(idx=="cis"){
          jQuery("#efta").attr({"class":"input unchecked"});
          jQuery("#cis").attr({"class":"input checked"});
          jQuery("#eu").attr({"class":"input unchecked"});
          var onlyCiS = (function() {
               var out = Array();
              <?php 
                $x = 0;
                $allCountries = array();
                foreach ($fetch2 as $value) : 
                // if($x==0){ $x=1; continue; }
                if($value[1]!="CIS"){ continue; }
                $explode = explode(",",$value[0]);
                foreach ($explode as $v) {
              ?>
                  out["<?=trim($v)?>"] = "#fea100";
              <?php 
                  $allCountries[] = trim($v);
                }
                $x++; 
                endforeach; 
                $totalimport = 0;
                $totalexport = 0;
                foreach ($fetch1 as $value) : 
                  if(in_array($value[2], $allCountries)){
                    $totalimport += $value[4];
                    $totalexport += $value[3];
                  }
                endforeach;
                $e = str_replace("USD","",money_format('%i',$totalexport));
              $im = str_replace("USD","",money_format('%i',$totalimport));
              ?>
              jQuery("#totalexport").text("Export: <?=$e?>");
              jQuery("#totalimport").text("Import: <?=$im?>");
              /* Ukraine And Uzbekistan associative members START */
              jQuery(".assoc").show();
              out["UA"] = "#ace6f0";
              out["UZ"] = "#ace6f0";
              /* Ukraine And Uzbekistan associative members END */
              return out;
            })(); 
            var vvv2 = new Array();
            for (var k in onlyCiS) {
                vvv2[k] = onlyCiS[k];
            }
            mapx.series.regions[0].setValues(vvv2);
        }else if(idx=="eu"){
          jQuery("#efta").attr({"class":"input unchecked"});
          jQuery("#cis").attr({"class":"input unchecked"});
          jQuery("#eu").attr({"class":"input checked"});

          var onlyEu = (function() {
               var out = Array();
              <?php 
                $x = 0;
                $allCountries = array();
                foreach ($fetch2 as $value) : 
                if($value[1]!="EU"){ continue; }
                $explode = explode(",",$value[0]);
                foreach ($explode as $v) {
              ?>
                  out["<?=trim($v)?>"] = "#fea100";
              <?php 
                  $allCountries[] = trim($v);
                }
                $x++; 
                endforeach; 
                $totalimport = 0;
                $totalexport = 0;
                foreach ($fetch1 as $value) : 
                  if(in_array($value[2], $allCountries)){
                    $totalimport += $value[4];
                    $totalexport += $value[3];
                  }
                endforeach;
                $e = str_replace("USD","",money_format('%i',$totalexport));
                $im = str_replace("USD","",money_format('%i',$totalimport));
              ?>
              jQuery("#totalexport").text("Export: <?=$e?>");
              jQuery("#totalimport").text("Import: <?=$im?>");
              return out;
            })(); 
            var vvv2 = new Array();
            for (var k in onlyEu) {
                vvv2[k] = onlyEu[k];
            }
            mapx.series.regions[0].setValues(vvv2);
        }
      }
  });

/* TRADE REGIME START */
  function onlyFreeTrades(){
    var out = Array();
    <?php 
    $x = 0;
    foreach ($fetch1 as $value) : 
      if(trim($value[5])!="Free trade"){ continue; }
    ?>
      out["<?=$value[2]?>"] = "#fea100";
    <?php 
    $x++; 
    endforeach; 
    ?>
     console.log(out);
    return out;
  }

  function onlyongoing(){
    var out = Array();
    <?php 
    $x = 0;
    foreach ($fetch1 as $value) : 
      // if($x==0){ $x=1; continue; }
      if($value[5]!="Ongoing Free Trade Negotiation"){ continue; }
    ?>
      out["<?=$value[2]?>"] = "#fea100";
    <?php 
    endforeach; 
    ?>
    return out;
  }
/* TRADE REGIME END */


/* MAIN DATA START */
  function expFunction(){
    var out = Array();
    <?php 
    $x = 0;
    foreach ($fetch1 as $value) : 
      // if($x==0){ $x=1; continue; }
    ?>
      out["<?=$value[2]?>"] = "<?=$value[3]?>";
    <?php 
    endforeach; 
    ?>
    return out;
  }
  function impFunction(){
    var out = Array();
    <?php 
    $x = 0;
    foreach ($fetch1 as $value) : 
      // if($x==0){ $x=1; continue; }
    ?>
      out["<?=$value[2]?>"] = "<?=$value[4]?>";
    <?php 
    endforeach; 
    ?>
    return out;
  }
  function tradeFunction(){
    var out = Array();
    <?php 
    $x = 0;
    foreach ($fetch1 as $value) : 
      // if($x==0){ $x=1; continue; }
    ?>
      out["<?=$value[2]?>"] = "<?=$value[5]?>";
    <?php 
    endforeach; 
    ?>
    return out;
  }
  /* MAIN DATA END */

/* RESET COLORS START */
  function resetColors(){
     var mapx = jQuery('#map1').vectorMap('get', 'mapObject');
     mapx.reset();
  }
/* RESET COLORS END */
  </script>
</body>
</html>