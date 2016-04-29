<?php if(!defined("DIR")){ echo "Sorry, You dont have a permittion !"; exit(); }
class src_json_makefile{
	public function mk($f,$t){
		$myfile = fopen($f, "w") or die("Unable to open file!");
		fwrite($myfile, $t);
		fclose($myfile);
	}
}
?>