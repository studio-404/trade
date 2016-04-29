<?php
$file = file_get_contents("vectormap.json");
$decode = json_decode($file, true); 
// echo "<pre>";
// print_r($decode);
// echo "</pre>";
foreach ($decode["all"] as $v) {
	echo 'INSERT INTO `vectormap_new`(`code`,`title`, `data`) VALUES ("'.$v['id'].'","'.$v['title'].'","'.$v['d'].'"); <br />';
}
?>