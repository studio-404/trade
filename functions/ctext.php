<?php if(!defined("DIR")){ exit(); }
class ctext{
	public function cut($text,$number)
	{
		$charset = 'UTF-8';
		$length = $number;
		$string = $text;
		if(mb_strlen($string, $charset) > $length) {
			$string = mb_substr($string, 0, $length, $charset) . '...';
		}
		else
		{
			$string=$text;
		}
		return $string; 
	}
}