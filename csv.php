<?php
define('DIR',__FILE__);
include("config.php");
$host = 'mysql:host='.$c['database.hostname'].';dbname='.$c['database.name'].";charset=utf8"; 
$HANDLER = new PDO($host,$c['database.username'],$c['database.password']); 
$HANDLER->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
$HANDLER->exec("set names utf8"); 

$sql = 'SELECT 
`studio404_module_item`.`idx` AS smi_idx,  
`studio404_module_item`.`title` AS smi_title 
FROM 
`studio404_module_attachment`, `studio404_module`, `studio404_module_item`
WHERE 
`studio404_module_attachment`.`connect_idx` IN (5196,5197) AND 
`studio404_module_attachment`.`page_type`="catalogpage" AND 
`studio404_module_attachment`.`lang`=5 AND 
`studio404_module_attachment`.`status`!=1 AND 
`studio404_module_attachment`.`idx`=`studio404_module`.`idx` AND 
`studio404_module`.`lang`=5 AND 
`studio404_module`.`status`!=1 AND 
`studio404_module`.`idx`=`studio404_module_item`.`module_idx` AND 
`studio404_module_item`.`lang`=5 AND 
`studio404_module_item`.`status`!=1 
ORDER BY 
`studio404_module_item`.`date` DESC
';
$query = $HANDLER->query($sql);
$fetch = $query->fetchAll(PDO::FETCH_ASSOC);
echo "<pre>";
print_r($fetch);
echo "</pre>";

foreach($fetch as $v){
	$insert = 'INSERT INTO `studio404_newsletter_task` SET `module_idx`="'.$v["smi_idx"].'"';
	$HANDLER->query($insert);
}

// $csv = array_map('str_getcsv', file('hs.csv'));
// foreach($csv as $v){
// 	$sqlm = 'SELECT MAX(`idx`)+1 AS maxid FROM `studio404_pages`';
// 	$querym = $HANDLER->query($sqlm);
// 	$rowm = $querym->fetch(PDO::FETCH_ASSOC);
// 	$maxidm = ($rowm['maxid']) ? $rowm['maxid'] : 1;

// 	$sqlm2 = 'SELECT MAX(`position`)+1 AS posx FROM `studio404_pages` WHERE `cid`=769';
// 	$querym2 = $HANDLER->query($sqlm2);
// 	$rowm2 = $querym2->fetch(PDO::FETCH_ASSOC);
// 	$maxidm2 = ($rowm2['posx']) ? $rowm2['posx'] : 1;

// 	$insert_csv = $v[0]." - ".$v[1];
// 	$insert_csv2 = $v[0].$v[1];

// 	$sql = 'INSERT INTO `studio404_pages` SET `idx`=:idx, `cid`=769, `subid`=769, `date`=888, `page_type`="textpage", `title`=:titlex, `shorttitle`=:shorttitle, `slug`=:slug, `insert_admin`=1, `lang`=5, `visibility`=2, `position`=:position ';
// 	$prepare = $HANDLER->prepare($sql);
// 	$prepare->execute(array(
// 		":idx"=>$maxidm, 
// 		":titlex"=>$insert_csv, 
// 		":shorttitle"=>$insert_csv, 
// 		":slug"=>$insert_csv2, 
// 		":position"=>$maxidm2, 
// 	));
// 	echo $insert_csv."<br />";
// }
?>