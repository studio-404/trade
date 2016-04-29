<?php
session_start();
if(isset($_GET['t']) && $_GET['t']=="login"){
	$t = 'l';
	$name = "images/l.png";
	$string = $_SESSION['protect_login'];
}elseif(isset($_GET['t']) && $_GET['t']=="register"){
	$t = 'r';
	$name = "images/r.png";
	$string = $_SESSION['protect_register'];
}elseif(isset($_GET['t']) && $_GET['t']=="recover"){
	$t = 'rc';
	$name = "images/rc.png";
	$string = $_SESSION['protect_recover'];
}
$im = imagecreatefrompng($name);
$im = imagecreate(100, 40);
$bg = imagecolorallocate($im, 255, 255, 255);
$red = imagecolorallocate($im, 56, 149, 206);
$linecolor = imagecolorallocate($im, 254, 161, 0);
for($i=0; $i < 6; $i++) {
imagesetthickness($im, 1);
imageline($im, 0, rand(0,30), 120, rand(0,30), $linecolor);
}

imagestring($im, 35, 30, 14, $string, $red);



$filename = sha1("_".time().$_SERVER["REMOTE_ADDR"]).$t.".png";
$name = "thumbs/".$filename;
imagepng($im,$name,9);
$dir    = 'thumbs/';
$files = scandir($dir); 
foreach($files as $file)
{
	if($file!="." && $file!=".." && $file!=$filename)
	{
		$cerationTime = filemtime($dir.$file);
		$now = time() - 3600;
		if($cerationTime<$now)
		{
			@unlink($dir.$file);
		}
	}
}
header("location: " . $name);
?>