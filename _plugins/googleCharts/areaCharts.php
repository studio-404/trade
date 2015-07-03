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
	$years = (count($_GET["years"]) > 0) ? $_GET["years"] : 0;
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
	#chart_div{ margin: 0; padding: 0; width:100%; height: 300px; }
	</style>
</head>
<body>
  <script type="text/javascript">
     google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          <?php
          $in_cols = "";
          foreach($cols as $c){
            $in_cols .= "'".$c."',";  
          }
          ?>
          ['Year', <?=$in_cols?>],
          <?php
          $tx = 0;
          foreach($years as $y){
          ?>
          ['<?=$y?>',  1000*<?=$tx?>,250*<?=$tx?>],
          <?php 
            $tx++;
          } 
          ?>
        ]);

        var options = {
          title: '<?=$title?>',
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
  </script>
<div id="chart_div"></div>
</body>
</html>
<?php
}catch(Exception $e){
	die("Some kind of error !");
}
?>