<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Newsletter</title>
<style type="text/css">
@font-face {
font-family:'roboto'; 
src: url('http://tradewithgeorgia.com/_plugins/roboto/Roboto-Regular.eot?#iefix') format('embedded-opentype'),  
url('http://tradewithgeorgia.com/_plugins/roboto/Roboto-Regular.woff') format('woff'), 
url('http://tradewithgeorgia.com/_plugins/roboto/Roboto-Regular.ttf')  format('truetype'), 
url('http://tradewithgeorgia.com/_plugins/roboto/Roboto-Regular.svg#Roboto-Regular') format('svg');
font-weight: normal;
font-style: normal;
} 
p{ margin: 0 0 5px 0; line-height: 16px; font-size: 14px; }
h3{ margin: 0 0 5px 0; line-height: 18px; font-size: 16px; }
</style>
</head>
<body style="margin: 0; padding: 0; border: 0; font-family:'roboto';">
<!-- <div class="toplink" style="margin: 10px 0 10px 10px; padding: 0; width: 715px; float:left; text-align: right; line-height: 14px; font-size: 12px;">Can’t you see mail properly? <a href="<?=$c["site.url"]?>_plugins/newsletter/index.php?u=<?=$_GET['u']?>&amp;e=<?=$_GET['e']?>&amp;r=<?=$_GET['r']?>&amp;t=<?=$_GET['t']?>">Click here»</a></div> -->
<div style="margin: 0; padding: 0; border: 0; width: 725px; float:left; background-color:#1279bb ">
<div class="header" style="margin: 0 10px; padding: 0; border: 0; width: 705px; float:left; height: 153px; float:left; ">
		<img src="http://tradewithgeorgia.com/_plugins/newsletter/logo.png" width="245" height="157" alt="Trade With Georgia Logo" />
		<img src="http://tradewithgeorgia.com/_plugins/newsletter/enterprise.png" width="118" height="74" alt="Enterprise Georgia Logo" style="float:right; margin:40px 15px 0px 0" />
</div>
<div class="title" style="margin: 0 10px; padding: 0; border: 0; width: 705px; float:left; line-height: 55px; font-size: 45px; color: #214199;"><?=html_entity_decode($fetch['subject'])?></div>
<!-- <div class="line" style="margin: 5px 10px; padding: 0; border: 0; width: 705px; float:left; height: 6px; background-image: url('http://tradewithgeorgia.com/_plugins/newsletter/line.png'); background-repeat: repeat-x; background-position: center center; background-size: 705px 6px;"></div> -->
<div class="content" style="margin: 15px; padding: 10px; border: 0; width: 675px; min-height:320px; float:left; font-size:16px; color:#555555; background-color:#ffffff; position:relative; overflow-y:auto">
<h2 style="margin:0; padding:0; font-family:roboto; padding-bottom:10px;">New Products</h2>
<div style="margin-top:0; width:100%; clear:both; float:left;">
	<?php
	$path = "/home/tradegeorgia/tradewithgeorgia.com/_newsletter/cache/products_email.json"; 
	if(file_exists($path)){
		$file_get = file_get_contents($path); 
		$encode = json_decode($file_get, true); 
		$count = count($encode); 
		$x = 1;
		foreach ($encode as $value) { 
			?>
			<a href="http://tradewithgeorgia.com/en/user?t=<?=$value["su_companytype"]?>&amp;i=<?=$value["users_id"]?>&amp;p=<?=$value["id"]?>&amp;token=nope" target="_blank" style="text-decoration: none; color: #555555;">
				<img src="http://tradewithgeorgia.com/image?f=http://tradewithgeorgia.com/files/usersproducts/<?=$value["picture"]?>&amp;w=300&amp;h=170" width="100%" alt="" align="left" style="border:solid 1px #c1c1c1; float:left; width:200px;" />
				<div style="float:right; width:450px;">
				<h3><?=$value["title"]?></h3>
				<p><strong>ID: </strong> <span><?=$value["id"]?></span></p>
				<p><strong>Insert Date: </strong> <span><?=date("d/m/Y",$value["date"])?></span></p>
				<p><strong>HS Code: </strong> <span><?=$value["su_hscode"]?></span></p>
				<p><strong>Packiging: </strong> <span><?=$value["packaging"]?></span></p>
				<p><strong>Shelf Life: </strong> <span><?=$value["shelf_life"]?></span></p>
				<p><strong>Awards: </strong> <span><?=$value["awards"]?></span></p>
				<p><strong>Description: </strong> </p>
				<p><?=strip_tags($value['long_description'])?></p>
				</div>
			</a>
			<div style="clear:both;"></div>
			<?php if($x!=$count){ ?>
			<hr style="width:100%; height:1px; background:#f2f2f2; margin:10px 0" />
			<?php
			}
			$x++;
		}
	}
	?>
</div>
</div>

<div class="footerLinks" style="margin: 10px; padding: 0; border: 0; width: 705px; float:left; text-align: center;">
<p style="margin: 0; padding: 0; line-height: 14px; font-size: 12px; color: #ffffff;">
	<a href="http://tradewithgeorgia.com/en/unsubscribe-email?e=<?=$_GET['r']?>" style="margin: 0; padding: 0 5px; border: 0; background: #ffffff; color: #555555; text-decoration:none">Unsubscribe</a>
</div><div class="br" style="margin: 0; padding: 0; border: 0; width: 100%; height: 10px;"></div>
</div>

</body>
</html>