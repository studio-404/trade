<?php
// echo "<pre>";
// 			print_r($data["productinside"]);
// 			echo "</pre>";
?>
<div class="col-md-12" style="margin:0 -10px;"><div class="yellow_title_19"><?=$data["productinside"]->title?></div></div>
<?php
if(Input::method("GET","t")=="serviceprovider"){
	?>
	<div class="col-md-12" style="margin:0 -10px;">
		<p><strong>Service ID: </strong> <span><?php echo $data["productinside"]->id; ?></span></p>
		<p><strong>Insert Date: </strong> <span><?php echo date("d/m/Y",$data["productinside"]->date); ?></span></p>
		<p><strong>Description: </strong> <p><?php echo $data["productinside"]->long_description; ?></p></p>
		
	</div>
	<?php
}else{
	$picture = ($data["productinside"]->picture) ? WEBSITE.'image?f='.WEBSITE.'files/usersproducts/'.$data["productinside"]->picture.'&w=300&h=170' : '';
	?>
<!--Image Popup Start-->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-body">
            <img src="<?=WEBSITE?>files/usersproducts/<?=$data["productinside"]->picture?>" width="100%" class="img-responsive">
        </div>
    </div>
  </div>
</div>
<!--Image Popup END-->


	<div class="col-md-6" style="margin:0 -10px;">
		<img src="<?=$picture?>" width="100%" alt="" data-toggle="modal" data-target="#myModal" style="cursor:pointer" />
	</div>
	<div class="col-md-6" style="margin:0 -10px;">
		<p><strong>Product ID: </strong> <span><?php echo $data["productinside"]->id; ?></span></p>
		<p><strong>Insert Date: </strong> <span><?php echo date("d/m/Y",$data["productinside"]->date); ?></span></p>
		<p><strong>HS Code: </strong> <span><?php echo $data["productinside"]->hscode_title; ?></span></p>
		<p><strong>Packiging: </strong> <span><?php echo $data["productinside"]->packaging; ?></span></p>
		<p><strong>Shelf Life: </strong> <span><?php echo $data["productinside"]->shelf_life; ?></span></p>
		<p><strong>Awards: </strong> <span><?php echo $data["productinside"]->awards; ?></span></p>
		<p><strong>Description: </strong> <p><?php echo $data["productinside"]->long_description; ?></p></p>
		<p><strong>Product Analysis: </strong> <p><?php echo '<a href="'.WEBSITE.'files/document/'.$data["productinside"]->productanalisis.'" target="_blank">Load file</a>'; ?></p></p>
	</div>
	<?php
}
?>
<div class="col-md-12" style="margin:0 -10px;">
	<a href="?t=<?=$_GET["t"]?>&amp;i=<?=$_GET["i"]?>">« Go back To User Profile</a>
</div>