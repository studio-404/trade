<?php @include("parts/header.php"); ?>
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
			<?=$data["text_general"][0]['title']?>
		</div>
		
		
		<div class="projects_li portfolio_project">
			<?php
			// echo "<pre>"; 
			// print_r($data["catalog_info_comments_list"]);
			// echo "</pre>"; 
			?>
			<div class="panel-group" id="accordion">


				<?php
				foreach($data["catalog_info_comments_list"] as $val) :
				?>
				<div class="panel">
					<div>
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" class="" href="#collapse1" aria-expanded="true">
								<li><?=$val->smi_title?></li>						
							</a>
						</h4>
					</div>
					<div id="collapse1" class="panel-collapse collapse in">
						<div class="panel-body">                   
							<?php
							if($val->pic->filex[0]):
							?>
							<div class="portfolio_image">
								<img src="<?=WEBSITE.'image?f='.$val->pic->filex[0]?>&w=812&h=129" />	 
							</div>
							<?php
							endif;
							?>

							<div class="text_formats">
								<?=$val->smi_long_description?>
							</div>
									 
							<div class="projects_person">	
								<?php
								for($x=0; $x<count($val->com->date);$x++){
								?>		
									<div class="col-sm-6 padding_0">
										<div class="item first_item">
											<div class="col-sm-4 image">
												<?php
												$img = ($val->com->file[$x]!="false") ? $val->com->file[$x] : WEBSITE.'images/no-image.png'; 
												?>
												<img src="<?=WEBSITE.'image?f='.$img?>&w=90&h=90" />
											</div>					
											<div class="col-sm-8">
												<div class="text">
												<?=$val->com->comment[$x]?>
												</div>
												<div class="name"><?=$val->com->namelname[$x]?></div>
											</div>					
										</div>
									</div>
								<?php
								}
								?>		
							</div>	
							
						</div>
					</div>
				</div>
				<?php
				endforeach;
				?>
				
				
			</div>
		</div>

		
		
		
		
		
		
		
		
		
		 
				
	</div>
</div>
<?php @include("parts/footer.php"); ?>