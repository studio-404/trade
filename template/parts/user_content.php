<?php if($data["get_type"]=="manufacturer") : ?>
			<ul class="text_formats_ul">
				<li class="text_formats"><b>Company description</b></li>
				<li class="text_formats">
					<?=nl2br(strip_tags($data["fetch"]["about"]))?>
				</li>
			</ul>	
			<?php if(is_array($data["userstatements"])) { ?>
			<div class="yellow_title_19">Product</div>
			<div class="product_more_item">
				<div class="products white_bg">
					
					<?php 
					foreach($data["userstatements"] as $val) : 
					?>
						<div class="col-sm-12 col-md-12 col-xs-12 col-gl-12 product_item" style="margin-bottom:10px;">
							<div class="col-sm-12 col-md-3 col-xs-12 col-lg-3 padding_0">
								<?php
								$picture = ($val["picture"]) ? WEBSITE.'image?f='.WEBSITE.'files/usersproducts/'.$val["picture"].'&w=175&h=175' : '';
								?>
								<div class="image"><img src="<?=$picture?>" class="img-responsive" alt="" /></div>
							</div>	
							<div class="col-sm-12 col-md-7 col-xs-12 col-gl-7 product_info padding_0">
								<ul>
									<li><span><?=$val["title"]?></span> - HS <?=$val["hscode"]?> </li>
									<?php if($val["packaging"]) : ?>
									<li><span>Packiging: </span><?=$val["packaging"]?></li>
									<?php endif; ?>
									<?php if($val["shelf_life"]) : ?>
									<li><span>Shelf life: </span><?=$val["shelf_life"]?> </li>
									<?php endif; ?>
									<?php if($val["awards"]) :?>
									<li><span>Awards: </span><?=$val["awards"]?></li>
									<?php endif; ?>
									<li style="margin-top:15px;"><a href="?t=<?=$_GET['t']?>&amp;i=<?=$_GET['i']?>&amp;p=<?=$val["id"]?>" class="readmore">View describtion</a></li>
								</ul>
							</div>
						</div>
					<?php 
					endforeach; 
					?>
					<div style="clear:both"></div>
					<div class="appends"></div>
					<div style="clear:both"></div>
					<div class="loader">Please wait...</div>
					<a href="javascript:;" class="gray_link loadmore" data-type="userspagemanufacturer"  data-from="5" data-load="10" style="padding:0">Load more »</a>


				</div>
			</div>
		<?php } endif; ?>


		<?php if($data["get_type"]=="serviceprovider") : ?>
			<ul class="text_formats_ul">
				<li class="text_formats"><b>About</b></li>
				<li class="text_formats">
					<?=nl2br(strip_tags($data["fetch"]["about"]))?>
				</li>
			</ul>
			<?php if($data["userstatements"]) { ?>	
			<div class="yellow_title_19">Services</div>
			<?php 
			$retrieve_users_info = new retrieve_users_info();
			foreach($data["userstatements"] as $val) : 
				$p = $retrieve_users_info->retrieveDb($val["products"]); 
			?>
			<div class="service_box readmore" style="cursor:pointer">
				<a href="?t=<?=$_GET['t']?>&amp;i=<?=$_GET['i']?>&amp;p=<?=$val["id"]?>" style="display:block">
				<ul class="text_formats_ul">
					<li class="text_formats"><span>Activity: <?=$p?></span></li>
					<li class="text_formats"><span><?=$val["title"]?></span></li>
					<li class="text_formats">
						<p><?=strip_tags($val["long_description"])?></p>
					</li>
				</ul>
			</a>
			</div>
		<?php 
			endforeach; 
			?>
			<div style="clear:both"></div>
			<div class="appends"></div>
			<div style="clear:both"></div>
			<div class="loader">Please wait...</div>
			<br /><p><a href="javascript:;" class="gray_link loadmore" data-type="userspageserviceprovider"  data-from="5" data-load="10" style="margin:5px -10px">Load more »</a></p>
			<?php
			} 
		endif; 
		?>

		<?php if($data["get_type"]=="company" || $data["get_type"]=="individual") : ?>

			<?php 
			if(is_array($data["userstatements"])){
				$first = array_slice($data["userstatements"],0,1);
				$others = array_slice($data["userstatements"],1,4);
			}
			?>

			<div class="enquire enquire_small no_border readmore" data-pid="<?=$first[0]["id"]?>" style="cursor:pointer">
				<div class="date"><?=date("d.m.Y",$first[0]["date"])?></div>
				<div class="col-sm-12" style="float:none;">
					<div class="title">
						<?=$first[0]["title"]?>
					</div>
					<div class="text">
						<?=$first[0]["long_description"]?>
						<small><?=$first[0]["type"]?></small>
					</div>
				</div>	 
			</div>
				
			<div class="yellow_title_19">Previous adds</div>
			<?php
			foreach ($others as $val) :
			?>
			<div class="enquire enquire_small readmore" data-pid="<?=$val["id"]?>" style="cursor:pointer">
				<div class="date"><?=date("d.m.Y",$val["date"])?></div>
				<div class="col-sm-12" style="float:none;">
					<div class="title">
						<?=$val["title"]?>
					</div>
					<div class="text">
						<?=$val["long_description"]?>
						<small><?=$val["type"]?></small>
					</div>
				</div>	 
			</div> 
			<?php endforeach; ?>
			<div style="clear:both"></div>
			<div class="appends"></div>
			<div style="clear:both"></div>
			<div class="loader">Please wait...</div>
			<a href="javascript:;" class="gray_link loadmore" data-type="userspageenquires"  data-from="5" data-load="10">Load more »</a>
		<?php endif; ?>