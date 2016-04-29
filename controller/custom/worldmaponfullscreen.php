<?php if(!defined("DIR")){ exit(); }
class worldmaponfullscreen{
	function __construct($c){
		$this->template($c,"worldmaponfullscreen");
	}
	
	public function template($c,$page){
		$cache = new cache();
		$include = WEB_DIR."/worldmaponfullscreen.php";
		$languages = $cache->index($c,"languages");
		$data["languages"] = json_decode($languages); 

		/* language variables */
		$language_data = $cache->index($c,"language_data");
		$language_data = json_decode($language_data);
		$model_template_makevars = new  model_template_makevars();
		$data["language_data"] = $model_template_makevars->vars($language_data); 

		/* components */
		$components = $cache->index($c,"components");
		$data["components"] = json_decode($components); 

		//vectormap_new
		$vectormap_new = $cache->index($c,"vectormap_new");
		$data["vectormap_new"] = json_decode($vectormap_new, true); 

		// mapfilter
		$mapfilter = $cache->index($c,"mapfilter");
		$data["mapfilter"] = json_decode($mapfilter, true);

		$include = WEB_DIR."/worldmaponfullscreen.php";
		if(file_exists($include)){
			@include($include);
		}
	}
}
?>