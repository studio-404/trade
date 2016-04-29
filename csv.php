<?php
exit();
define('DIR',__FILE__);
include("config.php");
$host = 'mysql:host='.$c['database.hostname'].';dbname='.$c['database.name'].";charset=utf8"; 
$HANDLER = new PDO($host,$c['database.username'],$c['database.password']); 
$HANDLER->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
$HANDLER->exec("set names utf8"); 


$sql = 'SELECT * FROM `vectormap_new` ORDER BY `id` ASC';
$query = $HANDLER->query($sql);
$fetch = $query->fetchAll(PDO::FETCH_ASSOC); 
foreach($fetch as $v){
	// select max idx 6335
	$max = 'SELECT MAX(`idx`) AS maxid FROM `studio404_pages`';
	$queryMax = $HANDLER->query($max);
	$fetchMax = $queryMax->fetch(PDO::FETCH_ASSOC);
	$maxid = ($fetchMax["maxid"]) ? $fetchMax["maxid"]+1 : 1;

	// select max idx 
	$maxPosSelect = 'SELECT MAX(`position`) AS maxPos FROM `studio404_pages` WHERE `cid`=6335 AND `status`!=1';
	$queryMaxPos = $HANDLER->query($maxPosSelect);
	$fetchMaxPos = $queryMaxPos->fetch(PDO::FETCH_ASSOC);
	$maxPos = ($fetchMaxPos["maxPos"]>0) ? $fetchMaxPos["maxPos"]+1 : 1;

	$insert = 'INSERT INTO `studio404_pages` SET 
	`idx`=:idx, 
	`cid`=:cid, 
	`subid`=:cid, 
	`date`=:datex, 
	`expiredate`=:datex, 
	`menu_type`="sub", 
	`page_type`="textpage", 
	`title`=:code, 
	`shorttitle`=:countryname, 
	`text`=:textdefault, 
	`redirectlink`=:falseit, 
	`slug`=:slug, 
	`insert_admin`=:one, 
	`lang`=:five, 
	`visibility`=:two, 
	`position`=:maxPos 
	';
	$prepare = $HANDLER->prepare($insert);
	$prepare->execute(array(
		":idx"=>$maxid, 
		":cid"=>6335, 
		":datex"=>time(), 
		":code"=>$v["code"], 
		":countryname"=>$v["data"], 
		":textdefault"=>$v["title"], 
		":falseit"=>"false", 
		":slug"=>$v["code"], 
		":one"=>1, 
		":five"=>5, 
		":two"=>2, 
		":maxPos"=>$maxPos
	));

	echo $v["code"]." - ".$v["title"]."<br />";
}
// $sql = 'SELECT 
// `studio404_module_item`.`idx` AS smi_idx,  
// `studio404_module_item`.`title` AS smi_title 
// FROM 
// `studio404_module_attachment`, `studio404_module`, `studio404_module_item`
// WHERE 
// `studio404_module_attachment`.`connect_idx` IN (5196,5197) AND 
// `studio404_module_attachment`.`page_type`="catalogpage" AND 
// `studio404_module_attachment`.`lang`=5 AND 
// `studio404_module_attachment`.`status`!=1 AND 
// `studio404_module_attachment`.`idx`=`studio404_module`.`idx` AND 
// `studio404_module`.`lang`=5 AND 
// `studio404_module`.`status`!=1 AND 
// `studio404_module`.`idx`=`studio404_module_item`.`module_idx` AND 
// `studio404_module_item`.`lang`=5 AND 
// `studio404_module_item`.`status`!=1 
// ORDER BY 
// `studio404_module_item`.`date` DESC
// ';
// $query = $HANDLER->query($sql);
// $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
// echo "<pre>";
// print_r($fetch);
// echo "</pre>";

// foreach($fetch as $v){
// 	$insert = 'INSERT INTO `studio404_newsletter_task` SET `module_idx`="'.$v["smi_idx"].'"';
// 	$HANDLER->query($insert);
// }
?>