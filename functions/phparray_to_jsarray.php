<?php if(!defined("DIR")){ exit(); }
class phparray_to_jsarray{
	public static function make($array)
	{
		$temp = array_map('js_str', $array);
    	return '[' . implode(',', $array) . ']';
	}

	public static function sectorSelects(){
		$array = explode(",",$_SESSION["user_data"]["sector"]);
		$array2 = explode(",",$_SESSION["user_data"]["subsector"]);
		$array3 = explode(",",$_SESSION["user_data"]["products"]);
		$o[] = phparray_to_jsarray::make($array);
		$o[] = phparray_to_jsarray::make($array2);
		$o[] = phparray_to_jsarray::make($array3);
		return $o;
	}
}
?>