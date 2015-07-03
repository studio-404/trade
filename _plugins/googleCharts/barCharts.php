<?php
error_log(0);
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
	#barchart_values{ margin: 0; padding: 0; width:100%; }
	</style>
</head>
<body>
  <script type="text/javascript">
    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "", { role: "style" } ],
        <?php
        $x =0;
       	foreach($cols as $c){
        ?>
        	["<?=htmlentities($cols[$x])?>", <?=$vals[$x]?>, "<?=$colors[$x]?>"],
        <?php 
        	$x++;
    	}
        ?>
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "<?=$title?>",
        width: '100%',
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
      chart.draw(view, options);
  }
  </script>
<div id="barchart_values"></div>
</body>
</html>
<?php
}catch(Exception $e){
	die("Some kind of error !");
}
?>