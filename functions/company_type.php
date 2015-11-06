<?php if(!defined("DIR")){ exit(); }
class company_type extends connection{
	public static function profilelink(){
		$link = '';
		switch($_SESSION["tradewithgeorgia_company_type"]){
			case 'manufacturer':
			$link = WEBSITE.LANG.'/profile-products';
			break;
			case 'serviceprovider':
			$link = WEBSITE.LANG.'/profile-service';
			break;
			case 'company':
			$link = WEBSITE.LANG.'/profile-enquires';
			break;
			case 'individual':
			$link = WEBSITE.LANG.'/profile-enquires';
			break;
		}
		return $link; 
	}
}
?>