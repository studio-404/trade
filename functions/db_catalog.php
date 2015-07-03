<?php if(!defined("DIR")){ exit(); }
class db_catalog extends connection{
	public $smi_idx, $smi_uid, $smi_date, $smi_module_idx, $smi_title, $smi_short_description, $smi_long_description, $smi_tags, $smi_slug, $doc = array(), $pic = array(), $com = array(); 

	public function __construct(){
		global $c;
        $conn = $this->conn($c); 

        $sql = 'SELECT 
		`studio404_gallery_file`.`title` AS filename, 
		`studio404_gallery_file`.`file` AS filex 
		FROM 
		`studio404_gallery_attachment`,`studio404_gallery`,`studio404_gallery_file` 
		WHERE 
		`studio404_gallery_attachment`.`connect_idx`=:connect_idx AND 
		`studio404_gallery_attachment`.`pagetype`=:pagetype AND 
		`studio404_gallery_attachment`.`lang`=:lang AND 
		`studio404_gallery_attachment`.`status`!=:status AND 
		`studio404_gallery_attachment`.`idx`=`studio404_gallery`.`idx` AND 
		`studio404_gallery`.`lang`=:lang AND 
		`studio404_gallery`.`status`!=:status AND 
		`studio404_gallery`.`idx`=`studio404_gallery_file`.`gallery_idx` AND 
		`studio404_gallery_file`.`media_type`=:media_type_doc AND 
		`studio404_gallery_file`.`lang`=:lang AND 
		`studio404_gallery_file`.`status`!=:status 
		ORDER BY `studio404_gallery_file`.`position` ASC
        ';
        $prepare = $conn->prepare($sql); 
        $prepare->execute(array(
        	":connect_idx"=>$this->smi_idx, 
        	":pagetype"=>'catalogpage', 
        	":media_type_doc"=>'document', 
        	":lang"=>LANG_ID, 
        	":status"=>1
        ));
        $fetch = $prepare->fetchAll(PDO::FETCH_ASSOC); 
        foreach($fetch as $val){
        	$this->doc["filename"][] = $val['filename']; 
        	$this->doc["filex"][] = $val['filex']; 
        }
        unset($sql);
        unset($prepare);
        unset($fetch);
        $sql = 'SELECT 
		`studio404_gallery_file`.`title` AS filename, 
		`studio404_gallery_file`.`file` AS filex 
		FROM 
		`studio404_gallery_attachment`,`studio404_gallery`,`studio404_gallery_file` 
		WHERE 
		`studio404_gallery_attachment`.`connect_idx`=:connect_idx AND 
		`studio404_gallery_attachment`.`pagetype`=:pagetype AND 
		`studio404_gallery_attachment`.`lang`=:lang AND 
		`studio404_gallery_attachment`.`status`!=:status AND 
		`studio404_gallery_attachment`.`idx`=`studio404_gallery`.`idx` AND 
		`studio404_gallery`.`lang`=:lang AND 
		`studio404_gallery`.`status`!=:status AND 
		`studio404_gallery`.`idx`=`studio404_gallery_file`.`gallery_idx` AND 
		`studio404_gallery_file`.`media_type`=:media_type_doc AND 
		`studio404_gallery_file`.`lang`=:lang AND 
		`studio404_gallery_file`.`status`!=:status 
		ORDER BY `studio404_gallery_file`.`position` ASC
        ';
        $prepare = $conn->prepare($sql); 
        $prepare->execute(array(
        	":connect_idx"=>$this->smi_idx, 
        	":pagetype"=>'catalogpage', 
        	":media_type_doc"=>'photo', 
        	":lang"=>LANG_ID, 
        	":status"=>1
        ));
        $fetch = $prepare->fetchAll(PDO::FETCH_ASSOC); 
        foreach($fetch as $val){
        	$this->pic["filename"][] = $val['filename']; 
        	$this->pic["filex"][] = $val['filex']; 
        }
        unset($sql);
        unset($prepare);
        unset($fetch);
        $sql = 'SELECT 
		`date`, `namelname`, `file`, `comment`
		FROM 
		`studio404_comments`
		WHERE 
		`connect_idx`=:connect_idx AND 
		`page_type`=:pagetype AND 
		`lang`=:lang AND 
		`status`!=:status 
		ORDER BY `date` DESC
        ';
        $prepare = $conn->prepare($sql); 
        $prepare->execute(array(
        	":connect_idx"=>$this->smi_idx, 
        	":pagetype"=>'catalogpage', 
        	":lang"=>LANG_ID, 
        	":status"=>1
        ));
        $fetch = $prepare->fetchAll(PDO::FETCH_ASSOC); 
        foreach($fetch as $val){
        	$this->com["date"][] = $val['date']; 
        	$this->com["namelname"][] = $val['namelname']; 
        	$this->com["file"][] = $val['file']; 
        	$this->com["comment"][] = $val['comment']; 
        }


	}
}
?>