<?php 
	$s = filter_input(INPUT_GET, "s");
	@include("parts/header.php"); 
?>
<div class="container" id="container">
	
	<div class="col-sm-12" id="content_full">
		<div class="page_title_2">
			<?=$data["text_general"][0]["title"]?>
		</div>

		<div class="text_formats">
			<label><b><?=$data["language_data"]["searchword"]?></b>: <?=htmlentities($s)?> (<?=count($data["result"])?>)</label>
		</div>
		<?php
		if(count($data["result"])<=0){
		?>
		<div class="text_formats">
		<?=$data["language_data"]["notindatabase"]?> !
		</div>
		<?php
		}else{
		?>
		<div class="text_formats">
			<ul style="text-align: justify;">
				<?php
				$s = strip_tags($s);
				foreach($data["result"] as $val){
				?>
					<li>
						<a href="<?=WEBSITE.LANG."/".$val["page_slug"]?>"><?=strip_tags($val["page_title"])?></a><br />
						<?php
						$string = strip_tags($val["page_text"]);
						$pos = strpos($string,$s);
						$count = strlen($s);
						$from = $pos-120-$count;
						$to = 1000;
						$result = mb_substr($string, $from, $to,"utf-8");
						$replace = '<font color="#f25a0f">'.htmlentities($s).'</font>';
						$sentence = str_replace($s, $replace, $result);
						?>
						<span style="font-size:13px; font-weight:lighter"><?=$sentence?></span>
					</li>
				<?php
				}
				?>
			</ul>
		</div>	
		<?php
		}	
		?>
		</div>
	
		
	</div>
<?php @include("parts/footer.php"); ?>