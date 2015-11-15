<?php if(!defined("DIR")){ exit(); }
class clearemptyvalues{
	public static function cl($array){
		foreach( $array as $key => $value )
		{
		    if( empty( $value ) )
		    {
		       unset( $array[$key] );
		    }
		}

		return $array;
	}
}