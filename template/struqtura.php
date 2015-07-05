<?php 
	@include("parts/header.php"); 
?>
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
			<?=$data["text_general"][0]["title"]?>
		</div>
		<!-- <div class="text_formats">
			<label><?=$data["text_general"][0]["shorttitle"]?></label>
		</div> -->

		<?php		
		$k = $data["structure"];
		$count_array = explode('],',$k); 
		$structure_array = new structure_array();
		?>
		<div id="chart_div" style="width:100%"></div>
		<div id="mobile_chart" style="width:100%">
		<?php
		echo '<ul class="mobile_structure">';
		$x=1;
		foreach($data["structure_m"] as $val){
			echo '<li><span>&nbsp;'.$x.') '.$val->title.'&nbsp;</span>';
			echo $structure_array->mob_sub_str($val->sub); 
			echo '</li>';
			$x++;
		}
		echo '</ul>';
		?>
		</div>
	</div>
</div>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript" charset="utf-8">
      google.load("visualization", "1", {packages:["orgchart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Name');
        data.addColumn('string', 'Manager');
        data.addColumn('string', 'ToolTip');

        data.addRows([
		  <?php echo $k; ?>
        ]);
		
		<?php
		$font = (LANG=="ge") ? 'bpg_sans_web' : 'roboto'; 
		$size = (LANG=="ge") ? '11px' : '12px'; 
		for($x=0; $x<(count($count_array)-1);$x++){
		?>
		data.setRowProperty(<?=$x?>, 'selectedStyle', 'border:0; font-size:<?=$size?>; -webkit-border-radius:0px; font-family:\'<?=$font?>\'; -webkit-box-shadow:none; background:#e37b0a; color:white; padding:0,30px');
		data.setRowProperty(<?=$x?>, 'style', 'width:auto; border:0; font-size:<?=$size?>; -webkit-border-radius:0px; font-family:\'<?=$font?>\'; -webkit-box-shadow:none; background:#244396; color:white; padding:0,30px');
		<?php
		}
		?>

	
        var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
        chart.draw(data, {allowHtml:true});
      }
   </script>


<?php @include("parts/footer.php"); ?>