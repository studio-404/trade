<?php
$x = 1; 
foreach($data["files_"] as $val) :
	$first = ($x==1) ? 'first' : '';
?>
<a class="fancybox <?=$first?>" href="<?=WEBSITE.$val->file?>" data-fancybox-group="gallery">
	<img src="<?=WEBSITE.$val->file?>" alt="" style="height:0px" />
</a>
<?php
$x++;
endforeach;
?>
<script type="text/javascript">
$(".first").click(); 
</script>