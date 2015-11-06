<?php if(!defined("DIR")){ exit(); }
class model_template_makevars{
	public function vars($object){
		$out = array(); 
		if(is_array($object)){
			foreach($object as $o){
				$out[$o->variable] = $o->text;
			}
		}
		return $out;
	}
}
?>