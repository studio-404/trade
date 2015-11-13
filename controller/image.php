<?php if(!defined("DIR")){ exit(); }

class image extends connection{

	function __construct(){
		error_reporting(0); 
		global $c;
		if(!isset($_GET["f"]) || !isset($_GET["w"]) || !isset($_GET["h"])){ die(); }
		else{ $this->loadimage($c);  }
	}

	public function loadimage($c){ 
		//http://enterprise.404.ge/image?f=http://enterprise.404.ge/files/photo/15d74475956962d0e4dd1cfae1469122.jpg&w=377&h=235
		try
		{
			$f = filter_input(INPUT_GET, "f"); 
			$f = str_replace( array("\\",";","(",")"), array("","","",""), strip_tags($f));
			$w = filter_input(INPUT_GET, "w"); 
			$w = str_replace( array("\\",";","(",")"), array("","","",""), strip_tags($w));
			$h = filter_input(INPUT_GET, "h"); 
			$h = str_replace( array("\\",";","(",")"), array("","","",""), strip_tags($h));

			$img = isset($f) && $f!='' ? $f : null;
			$w = isset($w) && !empty($w) ? $w : null;
			$h = isset($h) && !empty($h) ? $h : null;
			$w = is_null($w) ? $h : $w;
			$h = is_null($h) ? $w : $h;
			$ext = substr(strrchr($img, '.'), 1);
			if (!in_array($ext, array('jpg', 'jpeg', 'png', 'gif', 'JPG', 'JPEG', 'PNG', 'GIF'))) die;
			$cache_file_name = sha1('crop_' . $img . $w . $h) . '.' . $ext;
			$file_path = '_temporaty/' . $cache_file_name;
			ini_set("gd.jpeg_ignore_warning", 1);
			if (file_exists($file_path))
			{
			    header("location: " .WEBSITE. $file_path);
			}
			else
			{
				$src = '_temporaty/' . sha1('to_crop_' . $img . $w . $h) . '.' . $ext;
				$without = str_replace(WEBSITE, "", $img);
				@copy($without, $src);
				$this->make_thumb($src, $w, $h, $file_path,$ext);
				@unlink($src);
				header("location: " .WEBSITE. $file_path);
			}
		}catch(Exception $e){
				die();
		}
	}

	public function make_thumb($img_name, $new_w, $new_h, $new_name = null,$ext)
	{
		try
		{
			$bw = filter_input(INPUT_GET, "bw"); 
			$bw = str_replace( array("\\",";","(",")"), array("","","",""), strip_tags($bw));
		    switch($ext)
		    {
		        case 'JPEG':
		        case 'JPG':
		        case 'jpeg':
		        case 'jpg':
		            $src_img = imagecreatefromjpeg($img_name);
		            break;
		        case 'PNG':
		        case 'png':
		            $src_img = imagecreatefrompng($img_name);
		            break;
		        case 'GIF':
		        case 'gif':
		            $src_img = imagecreatefromgif($img_name);
		            break;
		        default:
		            die();
		    }

		    $old_w = (imagesx($src_img)) ? imagesx($src_img) : 1;
		    $old_h = (imagesy($src_img)) ? imagesy($src_img) : 1;

		    $new_x = 0;
		    $new_y = 0;
		    if($old_h==0 || $new_h==0){ exit(); }
			
			if($old_w/$old_h > $new_w/$new_h) {
		        $orig_h = $old_h;
		        $orig_w = round($new_w * $orig_h / $new_h);
		        $new_x = ($old_w - $orig_w) / 2;
			} else {
		        $orig_w = $old_w;
		        $orig_h = round($new_h * $orig_w / $new_w);
		        $new_y = ($old_h - $orig_h) / 2;
			}

		    $dst_img = @imagecreatetruecolor($new_w, $new_h);
		    if(isset($bw) && $bw==1){
		    	$this->ImageToBlackAndWhite($src_img);
			}
			@imagecopyresampled($dst_img, $src_img, 0, 0, $new_x, $new_y, $new_w, $new_h, $orig_w, $orig_h);
		    @imagejpeg($dst_img, $new_name, 95);

		    @imagedestroy($dst_img);
		    @imagedestroy($src_img);
		}catch(Exception $e){
			die();
		}
	}

	public function ImageToBlackAndWhite($im) {
		try
		{
			for ($x = imagesx($im); $x--;) {
		        for ($y = imagesy($im); $y--;) {
		            $rgb = imagecolorat($im, $x, $y);
		            $r = ($rgb >> 16) & 0xFF;
		            $g = ($rgb >> 8 ) & 0xFF;
		            $b = $rgb & 0xFF;
		            $gray = ($r + $g + $b) / 3;
		            if ($gray < 0xFF) {
		                imagesetpixel($im, $x, $y, 0xFFFFFF);
		            }else{
		                imagesetpixel($im, $x, $y, 0x000000);
		            }
		        }
		    }
		    imagefilter($im, IMG_FILTER_NEGATE);
		}catch(Exception $e){ die(); }
	}
}
?>