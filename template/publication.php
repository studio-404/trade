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
			<p>
				<?=$data["text_general"][0]["description"]?>
			</p> 
		</div> -->
		 
		 
		<div class="publications"> 
			<?php
			$itemperpage = 10;
			$path = WEBSITE.LANG."/".$data["text_general"][0]["slug"]; 
			$model_template_pagination = new model_template_pagination();
			$publication_list = $model_template_pagination->pager($data["publication_list"],$itemperpage,$path);
			foreach ($publication_list[0] as $val) {
				$ext = explode(".",$val->doc);
				$ext = end($ext);
			?>
			<div class="item">
				<div class="col-sm-12">					
					<div class="row">
						<div class="col-sm-5">
							<div class="image">
								<img src="<?=WEBSITE?>image?f=<?=WEBSITE.$val->pic?>&w=290&h=108" class="img-responsive"/>
							</div>
						</div>	
						<div class="col-sm-7">
							<div class="text_formats">
								<li><?=$data["language_data"]["documenttype"]?>: <?=strtoupper($ext)?></li>
								<li><?=$data["language_data"]["documentname"]?>: <?=$val->title?></li>
								<li><?=$data["language_data"]["date"]?>: <?=date("d.m.Y",$val->date)?></li>
							</div>
							<div class="download"><a href="<?=WEBSITE.$val->doc?>" target="_blank"><?=$data["language_data"]["download"]?></a></div>
						</div>
					</div>					
				</div>				
			</div> 
			<?php
			}
			?>
				
			
		</div>		
	
		
		<div class="text-right">		
			<ul class="navigation">
				<?=$publication_list[1]?>
			</ul>
		</div>	
		
	</div>
</div>
<?php @include("parts/footer.php"); ?>