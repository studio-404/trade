<?php
// error_log(0);
/*
http://enterprise.404.ge/_plugins/googleCharts/barCharts.php?lang=ge&title=cols[]&vals[]
*/
try{
if(isset($_GET["lang"],$_GET["title"])){
	$lang = (!empty($_GET["lang"])) ? $_GET["lang"] : "en";
	$title = (!empty($_GET["title"])) ? $_GET["title"] : "Empty title";
	$cols = (count($_GET["cols"]) > 0) ? $_GET["cols"] : 0;
	$vals = (count($_GET["vals"]) > 0) ? $_GET["vals"] : 0; 
	if(count($cols)!=count($vals)){ die("Cols And Vals not match !"); }
	$colors = array('#1279bb','#94bed7','#68a6cd','#3d90c4','#93bdd6'); 
}
?>
<!DOCTYPE html>
<html lang="<?=$lang?>">
<head>
	<title>Bar charts - <?=$title?></title>
	<meta charset="utf-8">
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<style type="text/css">
	body{ margin:0; padding:0; border: 0;  }
	#piechart{ margin: 0; padding: 0; width:100%; height: 300px; }
	</style>
</head>
<body>
  <script type="text/javascript">
     google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day', 'color'],
          <?php
          $x =0;
          foreach($cols as $c){
          ?>
            ['<?=htmlentities($cols[$x])?>', <?=$vals[$x]?>, '#000'], 
          <?php 
            $x++;
          }
          ?>
        ]);

        var options = { 
        width: '100%',
        <?php if(isset($_GET["h"]) && is_numeric($_GET["h"])) : ?>
        height: <?=(int)$_GET["h"]?>, 
        <?php endif; ?>
        title: '<?=$title?>', 
        titleTextStyle: { 
          color: '#0d2065',
          fontName: 'roboto',
          fontSize: '14',
          bold: 0,
          italic: 0
        }, 
        legend: {position: 'right', textStyle: {color: '#1279bb', fontSize: 12}}, 
          backgroundColor: '#eaeaea', 
          colors:<?=json_encode($colors)?>, 
        };

        //data.setProperty('style', 'background:#244396');

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        //legend.alignment
        chart.draw(data, options);
      }
  </script>
<div id="piechart"></div>
</body>
</html>
<?php
}catch(Exception $e){
	die("Some kind of error !");
}
?>