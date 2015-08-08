<?php if(!defined("DIR")){ exit(); } 
class model_admin_sqlcommand extends connection{

	public function load($c){
		$out = array();
		$conn = $this->conn($c); 
		if(isset($_GET["load"]) && !empty($_GET["load"])){
			try{
				$sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'geoweb_trade' AND TABLE_NAME = '".$_GET['load']."'";
				$prepare = $conn->prepare($sql);
				$prepare->execute();
				$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC);

				$sqlcommand = 'SELECT ';
				foreach($fetch as $f){
					$sqlcommand .= '`'.$f["COLUMN_NAME"].'`,';
				}
				$sqlcommand = rtrim($sqlcommand,","); 
				$sqlcommand .= ' FROM `'.$_GET["load"].'` WHERE 1';

				$out[0] = $fetch;
				$out[1] = $sqlcommand;
			}catch(Exception $e){

			}
		}
		return $out;
	}

}

?>