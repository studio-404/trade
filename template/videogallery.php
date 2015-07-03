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
		<?php
		$first = array_slice($data["videogallery_general"],0,1); 
		$others = array_slice($data["videogallery_general"],1); 
		?>
		 
		<div class="text_formats">
			<label><?=$first[0]->title?></label>
		</div>
		
		
		<div class="gallery_big">			
			<div id="myElement1">Loading the player...</div>
			<div class="gg-video-image">				
				<div class="play_icon" id="b_" style="cursor:pointer" onclick="jwplayer('myElement1').play();"></div>
			</div>		
			<div class="text_formats">
				<?=$first[0]->title?>
			</div>
		</div>
        <script type="text/javascript" charset="utf-8">
        <?php
        $mystring = $first[0]->file;
		$findme   = 'youtube';
		$pos = strpos($mystring, $findme);
		if($pos === false){//xmauri da bgeriti dartyma
			$playfile = WEBSITE.$first[0]->file;
		}else{
			$playfile = $first[0]->file;
		}
        ?>
		jwplayer("myElement1").setup({
			image: "<?=WEBSITE.$first[0]->filev?>", 
			file: "<?=$playfile?>",
			title: "",
			description: "2015-06-15 16:31:38.",
			primary: "html5",
			stretching:"exactfit", 
			width: "100%",
			height: "450",
			aspectratio: "3:2", 
			skin: '<?=PLUGINS?>player/skinning-sdk/five/five.xml'
		}); 
		//var loader = '<div id="loadergif" style="width:50px; height:50px; position:absolute; top:50%; left:50%; margin:-25px 0 0 -25px; z-index:20000; height:50px; width:50px;"><img src="<?=WEBSITE."images/loadingrotate.gif"?>" width="50" height="50" style="height:50px;"/></div>'; 
		$(document).on("click","#b_",function(e){
			$(this).hide();
		});
		jwplayer("myElement1").onPlay(function(e){ $("#b_").hide(); $("#loadergif").hide(); }); 
		jwplayer("myElement1").onPause(function(e){ $("#b_").show(); $("#loadergif").hide(); }); 
		jwplayer("myElement1").onComplete(function(e){ $("#b_").show(); $("#loadergif").hide(); }); 
		//jwplayer("myElement1").onBuffer(function(e){ $("#b_").hide(); $(".gg-video-image").html(loader); $("#loadergif").show(); }); 
		</script>
		 
		 
		<div class="text_formats margin_top_30">
			<label><?=$data["language_data"]["othervideos"]?></label>
		</div> 
		
		<div class="other_gallery">
			<div class="row">
				<?php
				//$others
				?>

				<?php
				$itemperpage = 1;
				$path = WEBSITE.LANG."/".$data["text_general"][0]["slug"]; 
				$model_template_pagination = new model_template_pagination();
				$video_list = $others;
				$video_list = $model_template_pagination->pager($video_list,$itemperpage,$path);
				$v=2;
				foreach ($video_list[0] as $val) {
				?>
					<div class="col-sm-6 videofile" style="position:relative" data-videofile="<?=$val->file?>" data-videoimage="<?=WEBSITE.$val->filev?>">
						<div class="item">
							<div class="cls<?=$v?>"></div>
							<div class="image">
								<div class="play_icon" id="b<?=$v?>"></div>
								<img src="<?=WEBSITE?>image?f=<?=WEBSITE.$val->filev?>&w=397&h=210" />
							</div>
							<div class="text_formats">
								<?=$val->title?>
							</div>
						</div>
					</div>

				<?php
				$v++;
				}
				?>

				<script type="text/javascript" charset="utf-8">
					$(document).on("click",".videofile",function(){
						var ff = $(this).data("videofile");
						var ii = $(this).data("videoimage");
						jwplayer("myElement1").load([{
						file: ff,
						image: ii
						}]);
						jwplayer("myElement1").play();
					});
				</script>

			</div>
		</div>
		
		
		<div class="text-right">		
			<ul class="navigation">
				<?=$video_list[1]?>
			</ul>
		</div>	
				
	</div>
</div>
<?php @include("parts/footer.php"); ?>