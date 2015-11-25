<?php
session_start();
$name = "images/s.png";
$im = imagecreatefrompng($name);

$im = imagecreate(100, 40);
$string = $_SESSION['protect_x'];
$bg = imagecolorallocate($im, 255, 255, 255);
$red = imagecolorallocate($im, 56, 149, 206);
$linecolor = imagecolorallocate($im, 254, 161, 0);
for($i=0; $i < 6; $i++) {
imagesetthickness($im, 1);
imageline($im, 0, rand(0,30), 120, rand(0,30), $linecolor);
}

imagestring($im, 35, 30, 12, $string, $red);



$filename = sha1("_".time().$_SERVER["REMOTE_ADDR"]).".png";
$name = "thumbs/".$filename;
imagepng($im,$name,9);
$dir    = 'thumbs/';
$files = scandir($dir); 
foreach($files as $file)
{
	if($file!="." && $file!=".." && $file!=$filename)
	{
		$cerationTime = @filemtime($file);
		$now = time() - 3600;
		if($cerationTime<$now)
		{
			@unlink($dir.$file);
		}
	}
}
header("location: " . $name);
?>