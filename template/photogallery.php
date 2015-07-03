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
		  
		
		<div class="other_videos photo_gallery">
			<div class="row">
				<?php
				$itemperpage = 2;
				$path = WEBSITE.LANG."/".$data["text_general"][0]["slug"]; 
				$model_template_pagination = new model_template_pagination();
				$photo_gallery_list = $data["photo_gallery_list"];
				$photo_gallery_list = $model_template_pagination->pager($photo_gallery_list,$itemperpage,$path);
				$gid = 1;
				foreach ($photo_gallery_list[0] as $val) {
				?>
				<div id="loadgallery" style="position:absolute; visibility:hidden"></div>
				<div class="col-sm-6">
					<div class="item" data-hrefload="<?=WEBSITE.LANG."/".$val->smi_slug?>" data-galleryid="loadgallery">
						<a href="javascript:;">
							<div class="image"><img src="<?=WEBSITE?>image?f=<?=WEBSITE.$val->pic?>&w=377&h=235" class="img-responsive"/></div>
						</a>
						<div class="text_formats">
							<?=$val->sg_title?>
						</div>
					</div>
				</div>
				<?php 
				$gid++;
				}
				?>
				<script type="text/javascript" charset="utf-8">
				$(document).on("click",".item", function(e){
					var hrefload = $(this).data("hrefload"); 
					var galleryid = $(this).data("galleryid"); 
					
					$.get(hrefload,{},function(data){
						$("#"+galleryid).html(data);
					});

				});
				</script>


				
				
			</div>
		</div>
		
		
		<div class="text-right">		
			<ul class="navigation">
				<?=$photo_gallery_list[1]?>
			</ul>
		</div>	
				
	</div>
</div>
<script type="text/javascript" charset="utf-8">
$(document).ready(function(){
	$('.fancybox').fancybox({
		width: 150,
    	height: 150, 
    	autoSize : false 
	});
});
</script>
<?php @include("parts/footer.php"); ?>