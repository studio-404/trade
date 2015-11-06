<!DOCTYPE html>
<html>
<head>
  <title>jVectorMap demo</title>
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
  .openmap{ margin: 0; padding: 0; width: 16px; height: 16px; background-image: url('openmap.png'); position: absolute; right: 10px; top: 10px; z-index: 1001 }
  .openmap a{ margin: 0; padding: 0; width: 16px; height: 16px; display: block; text-decoration: none; }
  </style>
</head>
<body <?=(isset($_GET['big'])) ? 'style="background-color:#424862"' : ''?>>

  <div class="mymap">
    <?php if(!isset($_GET['big'])) : ?>
    <div class="openmap"><a href="http://trade.404.ge/_plugins/jvectormap/index.php?big" target="_blank">&nbsp;</a></div>
  <?php endif; ?>
    <div class="searchMap">
      <div class="general-title">Trade map of Georgia export 2015</div>
      <div class="viewby">
      
        <div class="title">View by</div>
        <div class="content">
          <label class="input checked" data-type="viewby" id="country">Countries </label>
          <label class="input unchecked" data-type="viewby" id="groups">Country groups </label>
        </div>
      
      </div>

      <div class="traderegimes">

        <div class="title">Trade regimes</div>
        <div class="content">
          <label class="input unchecked" data-type="traderegime" id="freetrade">Free trade </label>
          <label class="input unchecked" data-type="traderegime" id="gsp">GSP+ </label>
          <label class="input unchecked" data-type="traderegime" id="ongoing">On going free trade negotiation </label>
        </div>

      </div>
      <div class="clearfix"></div>

    </div>
    <div id="map1"></div>
  </div>
  <script type="text/javascript" charset="utf-8">
    jQuery.noConflict();
    // var countryGroups = new Array();
    // var countryGroups_color = new Array();

    // countryGroups[0] = new Array('Russia','Canada');
    // countryGroups_color[0] = "#dddddd"; 

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
          var insertHtml = (exportArray[code]) ? exportArray[code] : '0';

          var importArray = impFunction();
          var insertHtml2 = (importArray[code]) ? importArray[code] : '0';

          var tradeRArray = tradeFunction();
          var insertHtml3 = (tradeRArray[code]) ? tradeRArray[code] : '0';

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
     
      if(type=="viewby"){
          if(idx=="country"){
            resetColors();
            jQuery("#freetrade").attr({"class":"input unchecked"});
            jQuery("#gsp").attr({"class":"input unchecked"});
            jQuery("#ongoing").attr({"class":"input unchecked"});

            jQuery("#country").attr({"class":"input checked"});
            jQuery("#groups").attr({"class":"input unchecked"});
          }else if(idx=="groups"){
            resetColors();
            jQuery("#freetrade").attr({"class":"input unchecked"});
            jQuery("#gsp").attr({"class":"input unchecked"});
            jQuery("#ongoing").attr({"class":"input unchecked"});

            jQuery("#country").attr({"class":"input unchecked"});
            jQuery("#groups").attr({"class":"input checked"});

            var countryGroups = countryGroupsx(); 
            var colorArr = Array('#34c529','#ecda0d','#92a5fb','#666666','#333333');
            var vvv = new Array();
            for(i=0; i<countryGroups.length; i++){
              for(n=0; n<countryGroups[i].length; n++){
                  console.log(countryGroups[i][n] +" "+ colorArr[i]);
                  var contryCode = countryGroups[i][n].toString();
                  var contryColor = colorArr[i].toString();
                  vvv[contryCode] = contryColor;
                  
              }
            }
            
            mapx.series.regions[0].setValues(vvv);
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

          }else if(idx == "gsp"){
            resetColors();
            var onlyGspx = onlyGsp(); 
            var vvv3 = new Array();
            for (var k in onlyGspx) {
                vvv3[k] = onlyGspx[k];
            }
            mapx.series.regions[0].setValues(vvv3);
            jQuery("#freetrade").attr({"class":"input unchecked"});
            jQuery("#gsp").attr({"class":"input checked"});
            jQuery("#ongoing").attr({"class":"input unchecked"});
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
      }
  });
<?php
  $csv = array_map('str_getcsv', file('../../files/manager/vectormapdata.csv'));
  // echo '<pre>';
  // print_r($csv); 
  // echo '</pre>';
  
  ?>
/* TRADE REGIME START */
  function onlyFreeTrades(){
    var out = Array();
    <?php 
    $x = 0;
    foreach ($csv as $value) : 
      if($x==0){ $x=1; continue; }
      if($value[5]!="Free Trade"){ continue; }
    ?>
      out["<?=$value[2]?>"] = "#fea100";
    <?php 
    $x++; 
    endforeach; 
    ?>
    return out;
  }

  function onlyGsp(){
    var out = Array();
    <?php 
    $x = 0;
    foreach ($csv as $value) : 
      if($x==0){ $x=1; continue; }
      if($value[5]!="GSP+"){ continue; }
    ?>
      out["<?=$value[2]?>"] = "#fea100";
    <?php 
    $x++; 
    endforeach; 
    ?>
    return out;
  }

  function onlyongoing(){
    var out = Array();
    <?php 
    $x = 0;
    foreach ($csv as $value) : 
      if($x==0){ $x=1; continue; }
      if($value[5]!="On going free trade negotiation"){ continue; }
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
    foreach ($csv as $value) : 
      if($x==0){ $x=1; continue; }
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
    foreach ($csv as $value) : 
      if($x==0){ $x=1; continue; }
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
    foreach ($csv as $value) : 
      if($x==0){ $x=1; continue; }
    ?>
      out["<?=$value[2]?>"] = "<?=$value[5]?>";
    <?php 
    endforeach; 
    ?>
    return out;
  }
  /* MAIN DATA END */

  /* COUNTRY GROUP START */
  function countryGroupsx(){
    var out = Array();
    // out[0] = Array('KZ','RU'); 
    // out[1] = Array('CN','IN','AU'); 
    return out;
  }
  /* COUNTRY GROUP END */


/* RESET COLORS START */
  function resetColors(){
     var mapx = jQuery('#map1').vectorMap('get', 'mapObject');
     mapx.reset();
  }
/* RESET COLORS END */
  </script>
</body>
</html>