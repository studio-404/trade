<?php @include("parts/header.php"); ?>
<div class="container" id="container">
	<div class="page_title_2">
		<?=$data["text_general"][0]["title"]?>
	</div>
	<div class="col-sm-3" id="sidebar">
		<div class="text_formats">
			<label><?=$data["text_general"][0]["shorttitle"]?></label>
		</div>	
		<div class="text_formats" style="line-height:1px;">
			<?=$data["text_general"][0]["text"]?>
			<p class="unclearemail"></p>
		</div>
		<div class="find_us_map">
			<span>Find us on a map:</span>
			<div class="image" style="height:120px; width:100%;">
			<iframe src="https://www.google.com/maps/d/u/1/embed?mid=zoNh_VKUSO0k.kSOo8h81kK4E&z=16" width="100%" height="140" border="0" style="border:none"></iframe>
			</div>
		</div>


	</div>
	<div class="col-sm-9" id="content">	
		 
		<div class="text_formats">
			<label><?=$data["language_data"]["contactformtitle"]?></label>
		</div>
		 
	<div class="contact_page_div">	 
		<div class="col-sm-12 padding_0">
			<div class="col-sm-5 padding_0">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="<?=$data["language_data"]["contactformsubject"]?>"/>
				</div>
			</div>	
		</div>	
		<div class="col-sm-12 padding_0">
			<div class="col-sm-5 padding_0">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="<?=$data["language_data"]["contactformnamelname"]?>"/>
				</div>
			</div>	
		</div>
		<div class="col-sm-12 padding_0">
			<div class="col-sm-5 padding_0">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="<?=$data["language_data"]["contactformemail"]?>"/>
				</div>
			</div>	
		</div>
		<div class="col-sm-12 padding_0"> 
			<div class="form-group">
				<textarea class="form-control"></textarea>
			</div> 
		</div>
		 
		<div class="col-sm-12 padding_0">
			<div class="text-right">		
				<button class="btn btn-yellow"><?=$data["language_data"]["contactformbutton"]?></button>
			</div>
		</div> 
	</div>	 
	<?php
		$cc=0;
		foreach($data["components"] as $val){
			if($val->com_name != "Career opportunities"){ continue; }
			$cc++;
		}
	if($cc){
	?>		 
		<div class="career_opp">
			<?=$data["language_data"]["careeropportunities"]?>
		</div>
		 <?php
}
		 ?>
 
		
		
<div class="contact_us_vakansy">
    <div class="panel-group" id="accordion">

    	<?php
		$x=1;
		foreach($data["components"] as $val){
			if($val->com_name != "Career opportunities"){ continue; }
		?>
			<div class="panel">
            <div>
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$x?>">
						<div class="job_title_list">
							<li>
								<span><?=$data["language_data"]["careeropportunitiestitle"]?>:</span> <?=$val->title?>
								<label>
									<span><?=$data["language_data"]["careeropportunitiesapply"]?>:</span> <?=date("d.m.Y",$val->date)?>
								</label>	
							</li>
						</div>
					</a>
                </h4>
            </div>
            <div id="collapse<?=$x?>" class="panel-collapse collapse">
                <div class="panel-body">                   
					<div class="text_formats">
						<?=$val->desc?>
					</div>				   
                </div>
            </div>
        </div>	
		<?php
			$x++;
		}
		?>   
		
    </div>
</div>

				
	</div>
</div>


<?php @include("parts/footer.php"); ?>