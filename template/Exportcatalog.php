<?php 
	@include("parts/header.php"); 
?>
<div class="container" id="container">
	<div class="export_menu">
		<ul>
			<li<?=(Input::method("GET","view")=="companies" || !Input::method("GET","view")) ? ' class="active"' : ''?>><a href="?view=companies">COMPANIES</a></li>
			<li<?=(Input::method("GET","view")=="products") ? ' class="active"' : ''?>><a href="?view=products">PRODUCTS</a></li>
			<li<?=(Input::method("GET","view")=="services") ? ' class="active"' : ''?>><a href="?view=services">SERVICES</a></li>
		</ul>
	</div>
	
	<div class="export_search_div">
		<div class="col-sm-10 padding_0">
			<input type="text" class="form-control" id="svalue" placeholder="Search By Name Or Phrase" value="<?=$data["get_search"]?>" />
		</div>
		<div class="col-sm-2 padding_0" style="padding-left:5px;" id="serachMe">
			<button class="btn btn-block btn-sm btn-yellow">SEARCH</button>
		</div>
		<script type="text/javascript"> 
		$(document).on("click","#serachMe",function(){
			var s = $("#svalue").val();
			var u = "http://"+document.domain+"/<?=LANG?>/export-catalog?view=<?=$data['get_view']?>&sort=<?=$data['get_sort']?>&sector=<?=$data['get_sector']?>&certificate=<?=$data['get_certificate']?>&search="+s+"&pn=<?=$data['get_pn']?>";
			location.href = u;
		});
		</script>
	</div>
	
	
	<?php if(Input::method("GET","view")=="companies" || !Input::method("GET","view")) : ?>
	<div class="export_companies">
		<div class="filters_div">
			<div class="col-sm-2 filter_cols">
				<a href="javascript:;">
					Company name 
				</a>		
			</div>
			<div class="col-sm-2 filter_cols<?=(isset($_GET['subsector']) && !empty($_GET['subsector'])) ? ' selected' : ''?>">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					Sub sector <span class="caret"></span> <?=(isset($_GET['subsector']) && !empty($_GET['subsector'])) ? '<div class="clearFilter" title="Clear filter" data-clearMe="subsector"></div>' : ''?>
				</a>
				<ul class="dropdown-menu">
					<?php foreach($data["subsector"] as $subsector) : ?>
					<li>
						<a href="?view=<?=$data["get_view"]?>&amp;sort=<?=$data["get_sort"]?>&amp;subsector=<?=$subsector->idx?>&amp;products=<?=$data["get_products"]?>&amp;exportmarkets=<?=$data["get_exportmarkets"]?>&amp;certificate=<?=$data["get_certificate"]?>&amp;search=<?=$data["get_search"]?>&amp;pn=<?=$data["get_pn"]?>" <?=(isset($_GET['subsector']) && $_GET['subsector']==$subsector->idx) ? 'style="color:#f97900 !important;"' : ''?>><?=$subsector->title?></a> 
					</li>
					<?php endforeach; ?>					
				</ul>
			</div>
			<div class="col-sm-2 filter_cols<?=(isset($_GET['products']) && !empty($_GET['products'])) ? ' selected' : ''?>">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					Products <span class="caret"></span> <?=(isset($_GET['products']) && !empty($_GET['products'])) ? '<div class="clearFilter" title="Clear filter" data-clearMe="products"></div>' : ''?>
				</a>
				<ul class="dropdown-menu">
					<?php foreach($data["products"] as $products) : ?>
					<?php 
						if(!empty($_GET["subsector"]) && $products->cid!=$_GET["subsector"]){ continue; } 
						if(empty($_GET["subsector"])){ $subsector_id = $products->cid; }else{ $subsector_id = $data["get_subsector"]; }
					?>
					<li>
						<a href="?view=<?=$data["get_view"]?>&amp;sort=<?=$data["get_sort"]?>&amp;subsector=<?=$subsector_id?>&amp;products=<?=$products->idx?>&amp;exportmarkets=<?=$data["get_exportmarkets"]?>&amp;certificate=<?=$data["get_certificate"]?>&amp;search=<?=$data["get_search"]?>&amp;pn=<?=$data["get_pn"]?>" <?=(isset($_GET['products']) && $_GET['products']==$products->idx) ? 'style="color:#f97900 !important;"' : ''?>><?=$products->title?></a> 
					</li>
					<?php endforeach; ?>					
				</ul>
			</div>
			<div class="col-sm-4 filter_cols<?=(isset($_GET['exportmarkets']) && !empty($_GET['exportmarkets'])) ? ' selected' : ''?>">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					Export markets <span class="caret"></span> <?=(isset($_GET['exportmarkets']) && !empty($_GET['exportmarkets'])) ? '<div class="clearFilter" title="Clear filter" data-clearMe="exportmarkets"></div>' : ''?>
				</a>
				<ul class="dropdown-menu">
					<?php foreach($data["countries"] as $countries) : ?>
					<li>
						<a href="?view=<?=$data["get_view"]?>&amp;sort=<?=$data["get_sort"]?>&amp;subsector=<?=$data["get_subsector"]?>&amp;products=<?=$data["get_products"]?>&amp;exportmarkets=<?=$countries->idx?>&amp;certificate=<?=$data["get_certificate"]?>&amp;search=<?=$data["get_search"]?>&amp;pn=<?=$data["get_pn"]?>" <?=(isset($_GET['exportmarkets']) && $_GET['exportmarkets']==$countries->idx) ? 'style="color:#f97900 !important;"' : ''?>><?=$countries->title?></a> 
					</li>
					<?php endforeach; ?>					
				</ul>
			</div>
			<div class="col-sm-2 filter_cols<?=(isset($_GET['certificate']) && !empty($_GET['certificate'])) ? ' selected' : ''?>">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					Certificate <span class="caret"></span> <?=(isset($_GET['certificate']) && !empty($_GET['certificate'])) ? '<div class="clearFilter" title="Clear filter" data-clearMe="certificate"></div>' : ''?>
				</a>
				<ul class="dropdown-menu">
					<?php foreach($data["certificates"] as $certificates) : ?>
					<li><a href="?view=<?=$data["get_view"]?>&amp;sort=<?=$data["get_asc"]?>&amp;subsector=<?=$data["get_subsector"]?>&amp;products=<?=$data["get_products"]?>&amp;exportmarkets=<?=$data["get_exportmarkets"]?>&amp;certificate=<?=$certificates->idx?>&amp;search=<?=$data["get_search"]?>&amp;pn=<?=$data["get_pn"]?>" <?=(isset($_GET['certificate']) && $_GET['certificate']==$certificates->idx) ? 'style="color:#f97900 !important;"' : ''?>><?=$certificates->title?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	
	<?php 
	$retrieve_users_info = new retrieve_users_info();
	foreach($data["fetch"] as $val){
	?>
	<a href="<?=WEBSITE.LANG?>/user?t=<?=$val["su_companytype"]?>&amp;i=<?=$val["su_id"]?>">	
		<div class="filter_content">
			<div class="names"><?=$val["su_namelname"]?></div>
			<div class="content_divs">
				<?php
				$logo = (!empty($val["su_picture"])) ? WEBSITE.'image?f='.WEBSITE.'files/usersimage/'.$val["su_picture"].'&w=150&h=75' : TEMPLATE.'img/noimage.png';
				?>
				<div class="col-sm-2 no-float itemssss"><img src="<?=$logo?>" class="img-responsive"></div>
				<div class="col-sm-2 no-float itemssss">
					<ul class="text_formats">
					<li><?=$retrieve_users_info->retrieveDb($val["su_sub_sector_id"])?></li>
					</ul>
				</div>
				<div class="col-sm-2 no-float itemssss">
					<ul class="text_formats">
						<li><?=$retrieve_users_info->retrieveDb($val["su_products"])?></li>
					</ul>
				</div>
				<div class="col-sm-4 no-float itemssss">
					<ul class="text_formats">
						<li><?=$retrieve_users_info->retrieveDb($val["su_export_markets_id"])?></li>
					</ul>
				</div>
				<div class="col-sm-2 no-float itemssss">
					<ul class="text_formats">
						<li><?=$retrieve_users_info->retrieveDb($val["su_certificates"])?></li>
					</ul>
				</div>
			</div>	
		</div>
	</a>
	<?php } ?>
	<div style="clear:both"></div>
	<div class="appends"></div>
	<div style="clear:both"></div>
	<div class="loader">Please wait...</div>
	<a href="javascript:;" class="gray_link loadmore" data-type="companylist" data-subsector="<?=Input::method("GET","subsector")?>" data-products="<?=Input::method("GET","products")?>" data-exportmarkets="<?=Input::method("GET","exportmarkets")?>" data-certificate="<?=Input::method("GET","certificate")?>" data-from="10" data-load="10">Load more »</a>
<?php endif; ?>

<?php if(Input::method("GET","view")=="products") : ?>
	<div class="export_companies">
		<div class="filters_div">
			<div class="col-sm-2 filter_cols">
				<a href="javascript:;">
					Product name 
				</a>					
			</div>
			<div class="col-sm-2 filter_cols<?=(isset($_GET['subsector']) && !empty($_GET['subsector'])) ? ' selected' : ''?>">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					Sub sector <span class="caret"></span> <?=(isset($_GET['subsector']) && !empty($_GET['subsector'])) ? '<div class="clearFilter" title="Clear filter" data-clearMe="subsector"></div>' : ''?>
				</a>
				<ul class="dropdown-menu">
					<?php foreach($data["subsector"] as $subsector) : ?>
					<li>
						<a href="?view=<?=$data["get_view"]?>&amp;sort=<?=$data["get_sort"]?>&amp;subsector=<?=$subsector->idx?>&amp;products=<?=$data["get_products"]?>&amp;exportmarkets=<?=$data["get_exportmarkets"]?>&amp;certificate=<?=$data["get_certificate"]?>&amp;search=<?=$data["get_search"]?>&amp;pn=<?=$data["get_pn"]?>" <?=(isset($_GET['subsector']) && $_GET['subsector']==$subsector->idx) ? 'style="color:#f97900 !important;"' : ''?>><?=$subsector->title?></a> 
					</li>
					<?php endforeach; ?>					
				</ul>
			</div>
			<div class="col-sm-2 filter_cols<?=(isset($_GET['products']) && !empty($_GET['products'])) ? ' selected' : ''?>">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					Products <span class="caret"></span> <?=(isset($_GET['products']) && !empty($_GET['products'])) ? '<div class="clearFilter" title="Clear filter" data-clearMe="products"></div>' : ''?>
				</a>
				<ul class="dropdown-menu">
					<?php foreach($data["products"] as $products) : ?>
					<?php 
						if(!empty($_GET["subsector"]) && $products->cid!=$_GET["subsector"]){ continue; } 
						if(empty($_GET["subsector"])){ $subsector_id = $products->cid; }else{ $subsector_id = $data["get_subsector"]; }
					?>
					<li>
						<a href="?view=<?=$data["get_view"]?>&amp;sort=<?=$data["get_sort"]?>&amp;subsector=<?=$subsector_id?>&amp;products=<?=$products->idx?>&amp;exportmarkets=<?=$data["get_exportmarkets"]?>&amp;certificate=<?=$data["get_certificate"]?>&amp;search=<?=$data["get_search"]?>&amp;pn=<?=$data["get_pn"]?>" <?=(isset($_GET['products']) && $_GET['products']==$products->idx) ? 'style="color:#f97900 !important;"' : ''?>><?=$products->title?></a> 
					</li>
					<?php endforeach; ?>					
				</ul>
			</div>
			<div class="col-sm-2 filter_cols">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					Company
				</a>
			</div>
			<div class="col-sm-4 filter_cols">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					About
				</a>
			</div>
		</div>
		<?php
		$retrieve_users_info = new retrieve_users_info();
		$ctext = new ctext();
		foreach($data["fetch"] as $val) :
		?>
		<a href="<?=WEBSITE.LANG?>/user?t=<?=$val["su_companytype"]?>&amp;i=<?=$val["users_id"]?>&amp;p=<?=$val['id']?>">	
			<div class="filter_content">
				<div class="names"><?=htmlentities($val["title"])?></div>
				<div class="content_divs">
					<?php
						$logo = (!empty($val["picture"])) ? WEBSITE.'image?f='.WEBSITE.'files/usersproducts/'.$val["picture"].'&w=175&h=175' : TEMPLATE.'img/noimage.png';
					?>
					<div class="col-sm-2 no-float itemssss"><img src="<?=$logo?>" class="img-responsive" width="100%" alt="" /></div>
					<div class="col-sm-2 no-float itemssss">
						<ul class="text_formats">
							<li><?=$retrieve_users_info->retrieve_subsector_from_product(strip_tags($val["products"]))?></li>
						</ul>
					</div>
					<div class="col-sm-2 no-float itemssss">
						<ul class="text_formats">
							<li><?=$retrieve_users_info->retrieveDb(strip_tags($val["products"]))?></li>
						</ul>
					</div>
					<div class="col-sm-2 no-float itemssss">
						<ul class="text_formats">
							<li><?=htmlentities(strip_tags($val["users_name"]))?></li>
						</ul>
					</div>
					<div class="col-sm-4 no-float itemssss">
						<ul class="text_formats">
							<li><span>Packiging:</span> <?=htmlentities($val["packaging"])?></li>
							<li><span>Shelf Life:</span> <?=htmlentities($val["shelf_life"])?></li>
							<li><span>Awards:</span> <?=htmlentities($val["awards"])?></li>
						</ul>
						<ul class="text_formats" style="margin-top:20px;">
							<li><span>About:</span> <?=$ctext->cut(strip_tags($val["long_description"]),120)?></li>
						</ul>
					</div>
				</div>	
			</div>
		</a>
		<?php endforeach; ?>	
		<div style="clear:both"></div>
		<div class="appends"></div>
		<div style="clear:both"></div>
		<div class="loader">Please wait...</div>
		<a href="javascript:;" class="gray_link loadmore" data-type="productslist" data-subsector="<?=Input::method("GET","subsector")?>" data-products="<?=Input::method("GET","products")?>"  data-from="10" data-load="10">Load more »</a>

	</div>
<?php endif; ?>

<?php if(Input::method("GET","view")=="services") : ?>
	<div class="export_companies">
		<div class="filters_div">
			<div class="col-sm-2 filter_cols">
				<a href="javascript:;">
					Company Name 
				</a>		
			</div>
			<div class="col-sm-2 filter_cols<?=(isset($_GET['subsector']) && !empty($_GET['subsector'])) ? ' selected' : ''?>">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					Sub Sector <span class="caret"></span> <?=(isset($_GET['subsector']) && !empty($_GET['subsector'])) ? '<div class="clearFilter" title="Clear filter" data-clearMe="subsector"></div>' : ''?>
				</a>
				<ul class="dropdown-menu">
					<?php foreach($data["subsector"] as $subsector) : ?>
					<li>
						<a href="?view=<?=$data["get_view"]?>&amp;sort=<?=$data["get_sort"]?>&amp;subsector=<?=$subsector->idx?>&amp;products=<?=$data["get_products"]?>&amp;search=<?=$data["get_search"]?>&amp;pn=<?=$data["get_pn"]?>" <?=(isset($_GET['subsector']) && $_GET['subsector']==$subsector->idx) ? 'style="color:#f97900 !important;"' : ''?>><?=$subsector->title?></a> 
					</li>
					<?php endforeach; ?>
				</ul>
			</div>
			<div class="col-sm-2 filter_cols<?=(isset($_GET['products']) && !empty($_GET['products'])) ? ' selected' : ''?>">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					Services <span class="caret"></span> <?=(isset($_GET['products']) && !empty($_GET['products'])) ? '<div class="clearFilter" title="Clear filter" data-clearMe="products"></div>' : ''?>
				</a>
				<ul class="dropdown-menu">
					<?php foreach($data["products"] as $products) : ?>
					<?php 
						if(!empty($_GET["subsector"]) && $products->cid!=$_GET["subsector"]){ continue; }  
						if(empty($_GET["subsector"])){ $subsector_id = $products->cid; }else{ $subsector_id = $data["get_subsector"]; }
					?>
					<li>
						<a href="?view=<?=$data["get_view"]?>&amp;sort=<?=$data["get_sort"]?>&amp;subsector=<?=$subsector_id?>&amp;products=<?=$products->idx?>&amp;search=<?=$data["get_search"]?>&amp;pn=<?=$data["get_pn"]?>" <?=(isset($_GET['products']) && $_GET['products']==$products->idx) ? 'style="color:#f97900 !important;"' : ''?>><?=$products->title?></a> 
					</li>
					<?php endforeach; ?>
				</ul>
			</div>
			<div class="col-sm-6 filter_cols">
				<a href="#">
					About
				</a>
			</div> 
		</div>

	<?php
	// echo "<pre>";
	// print_r($data["fetch"]); 
	// echo "</pre>";
	
	$retrieve_users_info = new retrieve_users_info();
	$ctext = new ctext();
	foreach($data["fetch"] as $val) :
	?>		
	<a href="<?=WEBSITE.LANG?>/user?t=<?=$val["su_companytype"]?>&amp;i=<?=$val["users_id"]?>&amp;p=<?=$val['id']?>">	
		<div class="filter_content">
			<div class="names"><?=$val["users_name"]?></div>
			<div class="content_divs">
				<?php
					$logo = (!empty($val["users_picture"])) ? WEBSITE.'image?f='.WEBSITE.'files/usersimage/'.$val["users_picture"].'&w=150&h=75' : TEMPLATE.'img/noimage.png';
				?>
				<div class="col-sm-2 no-float itemssss">
					<img src="<?=$logo?>" class="img-responsive" alt="" />
				</div>
				<div class="col-sm-2 no-float itemssss">
					<ul class="text_formats">
						<li><?=$retrieve_users_info->retrieveDb($val["sub_sector_id"])?></li>
					</ul>
				</div>
				<div class="col-sm-2 no-float itemssss">
					<ul class="text_formats">
						<li><?=$retrieve_users_info->retrieveDb($val["products"])?></li>
					</ul>
				</div>
				<div class="col-sm-6 no-float itemssss">
					<ul class="text_formats">
						<li><?=$ctext->cut($val["long_description"],100)?></li>
					</ul>
				</div>
			</div>	
		</div>
	</a>	
	<?php
	endforeach;
	?>
	<div style="clear:both"></div>
	<div class="appends"></div>
	<div style="clear:both"></div>
	<div class="loader">Please wait...</div>
	<a href="javascript:;" class="gray_link loadmore" data-type="servicelist" data-subsector="<?=Input::method("GET","subsector")?>" data-products="<?=Input::method("GET","products")?>"  data-from="10" data-load="10">Load more »</a>
</div>
<?php endif; ?>
	
</div>
	
	
</div>
<?php @include("parts/footer.php"); ?>