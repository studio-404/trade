<?php
// define("DIR", __FILE__);
// @include('../../config.php');
// @include('../../functions/connection.php');
// $connection = new connection();
// $conn = $connection->conn($c);
// if(!isset($_GET['u']) || empty($_GET['u']) || !is_numeric($_GET['u'])){ die("Error"); }
// try{
// $sql = 'SELECT `individualemail`,`subject`,`message` FROM `studio404_newsletter` WHERE `type`=:type AND `uid`=:uid';
// $prepare = $conn->prepare($sql);
// $prepare->execute(array(
// ":type"=>'send', 
// ":uid"=>$_GET['u']
// ));
// $fetch = $prepare->fetch(PDO::FETCH_ASSOC);
// }catch(Exception $e){
// die($e);
// }
// if(!$fetch['subject']){ die('Error'); }
// if(!empty($fetch['individualemail'])){ $to = $fetch['individualemail']; }else{ $to = (isset($_GET['e'])) ? $_GET['e'] : "group"; }
?>
<html>
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
</style>
</head>
<body style="margin: 0; padding: 0; border: 0; font-family:'roboto';">
<div class="toplink" style="margin: 10px 0 10px 10px; padding: 0; width: 715px; float:left; text-align: right; line-height: 14px; font-size: 12px;">Can’t you see mail properly? <a href="<?=$c["site.url"]?>_plugins/newsletter/index.php?u=<?=$_GET['u']?>&amp;e=<?=$_GET['e']?>&amp;r=<?=$_GET['r']?>&amp;t=<?=$_GET['t']?>">Click here»</a></div>
<div style="margin: 0; padding: 0; border: 0; width: 725px; float:left; background-color:#1279bb ">
<div class="header" style="margin: 0 10px; padding: 0; border: 0; width: 705px; float:left; height: 153px; float:left; ">
		<img src="http://tradewithgeorgia.com/template/img/logo.svg" width="245" height="157" alt="Trade With Georgia Logo" />
		<img src="http://tradewithgeorgia.com/template/img/enterprise_georgia.svg" width="118" height="74" alt="Enterprise Georgia Logo" style="float:right; margin:40px 15px 0px 0" />
</div>
<div class="title" style="margin: 0 10px; padding: 0; border: 0; width: 705px; float:left; line-height: 55px; font-size: 45px; color: #214199;"><?=html_entity_decode($fetch['subject'])?></div>
<!-- <div class="line" style="margin: 5px 10px; padding: 0; border: 0; width: 705px; float:left; height: 6px; background-image: url('http://tradewithgeorgia.com/_plugins/newsletter/line.png'); background-repeat: repeat-x; background-position: center center; background-size: 705px 6px;"></div> -->
<div class="content" style="margin: 15px; padding: 10px; border: 0; width: 675px; min-height:320px; float:left; font-size:16px; color:#555555; background-color:#ffffff; position:relative; overflow:hidden">
<h2 style="margin:0; padding:0; font-family:roboto; padding-bottom:10px;">The best wine</h2>
<img src="http://tradewithgeorgia.com/image?f=http://tradewithgeorgia.com/files/usersproducts/mabramiab13d2522d142160829e1a07afd90f5eb.jpg&amp;w=300&amp;h=170" width="100%" alt="" align="left" style="padding:0 0 20px 0; border:solid 1px #c1c1c1; float:left" />
<div style="margin-top:0; width:100%; clear:both; float:left;">
	<p><strong>Product ID: </strong> <span>260</span></p>
	<p><strong>Insert Date: </strong> <span>21/12/2015</span></p>
	<p><strong>HS Code: </strong> <span>220429 - Wine, fr grape nesoi &amp; gr must with alc, nesoi<br></span></p>
	<p><strong>Packiging: </strong> <span>Glass Bottle</span></p>
	<p><strong>Shelf Life: </strong> <span>N/A</span></p>
	<p><strong>Awards: </strong> <span>N/A</span></p>
	<p><strong>Description: </strong> </p>
	<p>Rkatsiteli is a white dry wine made from grapes Rkatsiteli and Mtsvane grown in Kakheti region. The wine has light-straw color, pleasant, well expressed bouquet and tones of wildflowers. Moderate acidity and pronounced varietal floral aroma gives the wine harmonious taste.</p>
</div>
</div>

<div class="footerLinks" style="margin: 10px; padding: 0; border: 0; width: 705px; float:left; text-align: center;">
<p style="margin: 0; padding: 0; line-height: 14px; font-size: 12px; color: #ffffff;">
	<a href="<?=$c["site.url"]?>unsubscribe/<?=$_GET['r']?>" style="margin: 0; padding: 0 5px; border: 0; background: #ffffff; color: #555555; text-decoration:none">Unsubscribe</a>
</div><div class="br" style="margin: 0; padding: 0; border: 0; width: 100%; height: 10px;"></div>
</div>

</body>
</html>