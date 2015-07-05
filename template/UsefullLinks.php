<?php 
	@include("parts/header.php"); 
?>
<div class="container" id="container">
	<div class="col-sm-3" id="sidebar">
		<div class="sidebar_menu">
			<ul>
				<?=$data["left_menu"]?>
			</ul>
		</div>
	</div>
	<div class="col-sm-9" id="content">
		<div class="row">
			 <div class="useful_div">
				<a href="#">
					<div class="col-sm-4 useful_item">
						<div class="image"><img src="<?=TEMPLATE?>img/useful_1.jpg"></div>
						<div class="title">Explore all the possibilities of investing in Georgian economy from here »</div>
					</div>
				</a>	
				<a href="#">
					<div class="col-sm-4 useful_item">
						<div class="image"><img src="<?=TEMPLATE?>img/useful_2.jpg"></div>
						<div class="title">This link will give you the opportunity to calculate all the transportation biils »</div>
					</div>
				</a>
				
			 </div>
		</div>
	</div>
</div>
<?php @include("parts/footer.php"); ?>