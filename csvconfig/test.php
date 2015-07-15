<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Test</title>
</head>
<body>
<?php 
exit();
try{
	$host = 'mysql:host=127.0.0.1;dbname=geoweb_trade;charset=utf8'; 
	$HANDLER = new PDO($host,'geoweb_enterpris','q+B14sx$Gp08H6UcO4'); 
	$HANDLER->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
	$HANDLER->exec("set names utf8"); 
}catch(PDOException $e){
	//$e->getMessage();
	die("Sorry, Database connection problem.."); 
}
$conn = $HANDLER;

// echo '<pre>';
// print_r($fetch); 
// echo '</pre>';
$parentid = 769;
$row = 1;
$pos = 1;
if (($handle = fopen("cc.csv", "r")) !== FALSE) {
  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    $num = count($data);
    $row++;
    $cco = 1;
    $o = '';
    for ($c=0; $c < $num; $c++) {
    	//echo $data[$c];
    	    	
    	if($cco==1){
    		$o .= $data[$c]." - ";
    		$cco = 2;
    	}else{
    		$o .= $data[$c]."<br />";
    		$cco = 1;   		


    		$sql = 'SELECT MAX(`idx`) AS maxidx FROM `studio404_pages`';
			$prepare = $conn->prepare($sql);
			$prepare->execute();
			$fetch = $prepare->fetch(PDO::FETCH_ASSOC);
			$maxidx = $fetch["maxidx"] + 1; 

	    	$titlex = $o; 
	    	// $titlex = explode("-", $titlex);  
	    	$uniqueslug = 'selectoption'.$titlex;
	    	// $titlex = ltrim($titlex[1], ' ');

	    	echo $pos."<br />"; 

	    	$sql2 = 'INSERT INTO `studio404_pages` SET `idx`=:maxidx, `cid`=:parentid, `subid`=:parentid, `menu_type`=:sub, `page_type`=:textpage, `title`=:titlex, `shorttitle`=:titlex, `slug`=:uniqueslug, `insert_admin`=:one, `lang`=:en, `visibility`=:two, `position`=:position';
			$prepare2 = $conn->prepare($sql2);
			$prepare2->execute(array(
				":maxidx"=>$maxidx,
				":parentid"=>$parentid, 
				":sub"=>'sub', 
				":textpage"=>'textpage', 
				":titlex"=>$titlex, 
				":uniqueslug"=>$uniqueslug, 
				":one"=>1, 
				":en"=>5, 
				":two"=>2, 
				":position"=>$pos
			));
			$pos++;
			$o='';

    	}
 

    }
  }
  fclose($handle);
}
?>
</body>
</html>