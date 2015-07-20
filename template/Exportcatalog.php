<?php 
	@include("parts/header.php"); 
?>
<div class="container" id="container">
	<div class="export_menu">
		<ul>
			<li<?=(Input::method("GET","view")=="companies" || !Input::method("GET","view")) ? ' class="active"' : ''?>><a href="?view=companies&amp;token=<?=$_SESSION["token_generator"]?>">COMPANIES</a></li>
			<li<?=(Input::method("GET","view")=="products") ? ' class="active"' : ''?>><a href="?view=products&amp;token=<?=$_SESSION["token_generator"]?>">PRODUCTS</a></li>
			<li<?=(Input::method("GET","view")=="services") ? ' class="active"' : ''?>><a href="?view=services&amp;token=<?=$_SESSION["token_generator"]?>">SERVICES</a></li>
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
			var u = "http://"+document.domain+"/<?=LANG?>/export-catalog?view=<?=$data['get_view']?>&sort=<?=$data['get_sort']?>&sector=<?=$data['get_sector']?>&certificate=<?=$data['get_certificate']?>&search="+s+"&pn=<?=$data['get_pn']?>&token=<?=$_SESSION['token_generator']?>";
			location.href = u;
		});
		</script>
	</div>
	
	
	<?php if(Input::method("GET","view")=="companies" || !Input::method("GET","view")) : ?>
	<div class="export_companies">
		<div class="filters_div">
			<div class="col-sm-2">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					Product name <span class="caret"></span> 
				</a>					
				<ul class="dropdown-menu">
					<li><a href="?view=<?=$data["get_view"]?>&amp;sort=asc&amp;subsector=<?=$data["get_subsector"]?>&amp;products=<?=$data["get_products"]?>&amp;exportmarkets=<?=$data["get_exportmarkets"]?>&amp;certificate=<?=$data["get_certificate"]?>&amp;search=<?=$data["get_search"]?>&amp;pn=<?=$data["get_pn"]?>&amp;token=<?=$_SESSION["token_generator"]?>">Order by ascending</a></li>
					<li><a href="?view=<?=$data["get_view"]?>&amp;sort=desc&amp;subsector=<?=$data["get_subsector"]?>&amp;products=<?=$data["get_products"]?>&amp;exportmarkets=<?=$data["get_exportmarkets"]?>&amp;certificate=<?=$data["get_certificate"]?>&amp;search=<?=$data["get_search"]?>&amp;pn=<?=$data["get_pn"]?>&amp;token=<?=$_SESSION["token_generator"]?>">Order by descending</a></li>
				</ul>
			</div>
			<div class="col-sm-2">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					Sub sector <span class="caret"></span> 
				</a>
				<ul class="dropdown-menu">
					<?php foreach($data["subsector"] as $subsector) : ?>
					<li>
						<a href="?view=<?=$data["get_view"]?>&amp;<?=$data["get_sort"]?>=asc&amp;subsector=<?=$subsector->idx?>&amp;products=<?=$data["get_products"]?>&amp;exportmarkets=<?=$data["get_exportmarkets"]?>&amp;certificate=<?=$data["get_certificate"]?>&amp;search=<?=$data["get_search"]?>&amp;pn=<?=$data["get_pn"]?>&amp;token=<?=$_SESSION["token_generator"]?>"><?=$subsector->title?></a> 
					</li>
					<?php endforeach; ?>					
				</ul>
			</div>
			<div class="col-sm-2">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					Products <span class="caret"></span> 
				</a>
				<ul class="dropdown-menu">
					<?php foreach($data["products"] as $products) : ?>
					<li>
						<a href="?view=<?=$data["get_view"]?>&amp;sort=<?=$data["get_sort"]?>&amp;subsector=<?=$data["get_subsector"]?>&amp;products=<?=$products->idx?>&amp;exportmarkets=<?=$data["get_exportmarkets"]?>&amp;certificate=<?=$data["get_certificate"]?>&amp;search=<?=$data["get_search"]?>&amp;pn=<?=$data["get_pn"]?>&amp;token=<?=$_SESSION["token_generator"]?>"><?=$products->title?></a> 
					</li>
					<?php endforeach; ?>					
				</ul>
			</div>
			<div class="col-sm-4">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					Export markets <span class="caret"></span> 
				</a>
				<ul class="dropdown-menu">
					<?php foreach($data["countries"] as $countries) : ?>
					<li>
						<a href="?view=<?=$data["get_view"]?>&amp;sort=<?=$data["get_sort"]?>&amp;subsector=<?=$data["get_subsector"]?>&amp;products=<?=$data["get_products"]?>&amp;exportmarkets=<?=$countries->idx?>&amp;certificate=<?=$data["get_certificate"]?>&amp;search=<?=$data["get_search"]?>&amp;pn=<?=$data["get_pn"]?>&amp;token=<?=$_SESSION["token_generator"]?>"><?=$countries->title?></a> 
					</li>
					<?php endforeach; ?>					
				</ul>
			</div>
			<div class="col-sm-2">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					Choose certificate<span class="caret"></span> 
				</a>
				<ul class="dropdown-menu">
					<?php foreach($data["certificates"] as $certificates) : ?>
					<li><a href="?view=<?=$data["get_view"]?>&amp;sort=<?=$data["get_asc"]?>&amp;subsector=<?=$data["get_subsector"]?>&amp;products=<?=$data["get_products"]?>&amp;exportmarkets=<?=$data["get_exportmarkets"]?>&amp;certificate=<?=$certificates->idx?>&amp;search=<?=$data["get_search"]?>&amp;pn=<?=$data["get_pn"]?>&amp;token=<?=$_SESSION["token_generator"]?>"><?=$certificates->title?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	
	<?php 
	$retrieve_users_info = new retrieve_users_info();
	foreach($data["fetch"] as $val){
	?>
	<a href="<?=WEBSITE.LANG?>/export-catalog/company?view=<?=$val["su_id"]?>&token=<?=$_SESSION["token_generator"]?>">	
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
<?php endif; ?>

<?php if(Input::method("GET","view")=="products") : ?>
	<div class="export_companies">
		<div class="filters_div">
			<div class="col-sm-2">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					Product name <span class="caret"></span> 
				</a>					
				<ul class="dropdown-menu">
					<li><a href="?view=<?=$data["get_view"]?>&amp;sort=asc&amp;subsector=<?=$data["get_subsector"]?>&amp;products=<?=$data["get_products"]?>&amp;exportmarkets=<?=$data["get_exportmarkets"]?>&amp;certificate=<?=$data["get_certificate"]?>&amp;search=<?=$data["get_search"]?>&amp;pn=<?=$data["get_pn"]?>&amp;token=<?=$_SESSION["token_generator"]?>">Order by ascending</a></li>
					<li><a href="?view=<?=$data["get_view"]?>&amp;sort=desc&amp;subsector=<?=$data["get_subsector"]?>&amp;products=<?=$data["get_products"]?>&amp;exportmarkets=<?=$data["get_exportmarkets"]?>&amp;certificate=<?=$data["get_certificate"]?>&amp;search=<?=$data["get_search"]?>&amp;pn=<?=$data["get_pn"]?>&amp;token=<?=$_SESSION["token_generator"]?>">Order by descending</a></li>
				</ul>
			</div>
			<div class="col-sm-2">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					Sub sector <span class="caret"></span> 
				</a>
				<ul class="dropdown-menu">
					<?php foreach($data["subsector"] as $subsector) : ?>
					<li>
						<a href="?view=<?=$data["get_view"]?>&amp;<?=$data["get_sort"]?>=asc&amp;subsector=<?=$subsector->idx?>&amp;products=<?=$data["get_products"]?>&amp;exportmarkets=<?=$data["get_exportmarkets"]?>&amp;certificate=<?=$data["get_certificate"]?>&amp;search=<?=$data["get_search"]?>&amp;pn=<?=$data["get_pn"]?>&amp;token=<?=$_SESSION["token_generator"]?>"><?=$subsector->title?></a> 
					</li>
					<?php endforeach; ?>					
				</ul>
			</div>
			<div class="col-sm-2">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					Products <span class="caret"></span> 
				</a>
				<ul class="dropdown-menu">
					<?php foreach($data["products"] as $products) : ?>
					<li>
						<a href="?view=<?=$data["get_view"]?>&amp;sort=<?=$data["get_sort"]?>&amp;subsector=<?=$data["get_subsector"]?>&amp;products=<?=$products->idx?>&amp;exportmarkets=<?=$data["get_exportmarkets"]?>&amp;certificate=<?=$data["get_certificate"]?>&amp;search=<?=$data["get_search"]?>&amp;pn=<?=$data["get_pn"]?>&amp;token=<?=$_SESSION["token_generator"]?>"><?=$products->title?></a> 
					</li>
					<?php endforeach; ?>					
				</ul>
			</div>
			<div class="col-sm-2">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					Company
				</a>
			</div>
			<div class="col-sm-4">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
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
		<a href="<?=WEBSITE.LANG?>/export-catalog/company?view=<?=$val['users_id']?>&product=<?=$val['id']?>&token=<?=$_SESSION["token_generator"]?>">	
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
	</div>
<?php endif; ?>

<?php if(Input::method("GET","view")=="services") : ?>
	<div class="export_companies">
		<div class="filters_div">
			<div class="col-sm-2">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					Company Name <span class="caret"></span> 
				</a>					
				<ul class="dropdown-menu">
					<li><a href="?view=<?=$data["get_view"]?>&amp;sort=asc&amp;subsector=<?=$data["get_subsector"]?>&amp;products=<?=$data["get_products"]?>&amp;search=<?=$data["get_search"]?>&amp;pn=<?=$data["get_pn"]?>&amp;token=<?=$_SESSION["token_generator"]?>">Order by ascending</a></li>
					<li><a href="?view=<?=$data["get_view"]?>&amp;sort=desc&amp;subsector=<?=$data["get_subsector"]?>&amp;products=<?=$data["get_products"]?>&amp;search=<?=$data["get_search"]?>&amp;pn=<?=$data["get_pn"]?>&amp;token=<?=$_SESSION["token_generator"]?>">Order by descending</a></li>
				</ul>
			</div>
			<div class="col-sm-2">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					Sub Sector <span class="caret"></span> 
				</a>
				<ul class="dropdown-menu">
					<?php foreach($data["subsector"] as $subsector) : ?>
					<li>
						<a href="?view=<?=$data["get_view"]?>&amp;sort=<?=$data["get_sort"]?>&amp;subsector=<?=$subsector->idx?>&amp;products=<?=$data["get_products"]?>&amp;search=<?=$data["get_search"]?>&amp;pn=<?=$data["get_pn"]?>&amp;token=<?=$_SESSION["token_generator"]?>"><?=$subsector->title?></a> 
					</li>
					<?php endforeach; ?>
				</ul>
			</div>
			<div class="col-sm-2">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					Services <span class="caret"></span> 
				</a>
				<ul class="dropdown-menu">
					<?php foreach($data["products"] as $products) : ?>
					<li>
						<a href="?view=<?=$data["get_view"]?>&amp;sort=<?=$data["get_sort"]?>&amp;subsector=<?=$data["get_subsector"]?>&amp;products=<?=$products->idx?>&amp;search=<?=$data["get_search"]?>&amp;pn=<?=$data["get_pn"]?>&amp;token=<?=$_SESSION["token_generator"]?>"><?=$products->title?></a> 
					</li>
					<?php endforeach; ?>
				</ul>
			</div>
			<div class="col-sm-6">
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
	<a href="<?=WEBSITE.LANG?>/export-catalog/service?view=<?=$val['users_id']?>&product=<?=$val['id']?>&token=<?=$_SESSION["token_generator"]?>">	
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
	</div>
<?php endif; ?>
	
</div>
	
	
</div>
<?php @include("parts/footer.php"); ?>