<?php if(!defined("DIR")){ exit(); }
class template_title{
	function __construct(){

	}

	public function getTitle($data){
		if(!empty($data["news_general"][0]["title"])){
			$out['title'] =  $data["news_general"][0]["title"];
			$out['desc'] =  $data["news_general"][0]["short_description"];
			$first = array_slice($data["last_news_files"], 0, 1);
			if($first[0]->file){ $out['shareImage'] = WEBSITE.'image?f='.WEBSITE.$first[0]->file.'&w=600&h=315'; }
			else{ $out['shareImage'] = TEMPLATE.'img/logoshare.png';  }
		}else if(!empty($data["events_general"])){
			$first = array_slice($data["events_general"],0,1);
			$out['title'] = $first[0]->title;
			$out['desc'] = $first[0]->short_description;
			$out['shareImage'] = TEMPLATE.'img/logoshare.png';
		}else if(!empty($data["news_list"])){
			$news_first = array_slice($data["news_list"],0,1);
			$out['title'] = $news_first[0]->title; 	
			$out['desc'] = $news_first[0]->short_description; 	
			$first = array_slice($data["last_news_files"], 0, 1);
			if($first[0]->file){ $out['shareImage'] = WEBSITE.'image?f='.WEBSITE.$first[0]->file.'&w=600&h=315'; }
			else{ $out['shareImage'] = TEMPLATE.'img/logoshare.png';  }
		}else if(!empty($data["eventsinside_general"])){
			$event_first = array_slice($data["eventsinside_general"],0,1);
			$out['title'] = $event_first[0]->title; 	
			$out['desc'] = $event_first[0]->short_description; 	
			$first = array_slice($data["eventsinside_general"], 0, 1);
			if($first[0]->file){ $out['shareImage'] = WEBSITE.'image?f='.WEBSITE.$first[0]->file.'&w=600&h=315'; }
			else{ $out['shareImage'] = TEMPLATE.'img/logoshare.png';  }
		}else if(!empty($data["team_general"][0]["title"])){
			$out['title'] = $data["team_general"][0]["title"];
			$out['desc'] = $data["team_general"][0]["short_description"];
			$out['shareImage'] = TEMPLATE.'img/logoshare.png';
		}else if(!empty($data["text_general"][0]["title"])){
			$out['title'] = $data["text_general"][0]["title"]; 
			$out['desc'] = $data["text_general"][0]["description"]; 
			$first = array_slice($data["text_files"], 0, 1);
			if($first[0]->file){ $out['shareImage'] = WEBSITE.'image?f='.WEBSITE.$first[0]->file.'&w=600&h=315'; }
			else{ $out['shareImage'] = TEMPLATE.'img/logoshare.png'; }
		}else{
			$out['title'] = $data["language_data"]["mainpage"]; 
			$out['desc'] = $title." - Enterprise Georgia"; 
			$out['shareImage'] = TEMPLATE.'img/logoshare.png';
		}
		return $out;
	}
}
?>