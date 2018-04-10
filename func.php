<?php
    function resize_image($type, $name){
        switch($type) {
            case 'jpeg':
            $img = imagecreatefromjpeg($name);
            break;
                
            case 'gif':
            $img = imagecreatefromgif($name);
            break;
            
            case 'png':
            $img = imagecreatefrompng($name);
            break;
        }
       
        $img_width = imageSX($img);
		var_dump($img_width);
        $img_height = imageSY($img);
		var_dump($img_height);
        
        $width = $_POST['width'];
        $height = $_POST['height'];
		var_dump($width);
		var_dump($height);
        //$k = $img_width/$width;
        //$k = $img_height/$width;
        
       // $new_width = round($img_width/$k);
        //$new_height = round($img_height/$k);
			
        
        //$k_w = $img_width / $width;
		//$k_h = $img_height / $height;
		
		if ($img_width > $img_height){
		
			$new_width = round(($img_width*$height)/$img_height);
			var_dump($new_width);
			$new_height = $height;
			var_dump($new_height);
			
			$new_img = imagecreatetruecolor($width,$height);
			$z = round(($new_width-$width)/2);
			var_dump($z);
			$g = 0;
			if ($z<0) {
				$g = (-1)*$z;
				$z = $z*(-1);
			} 
			var_dump($g);
			//$x = round((max($new_width,$new_height)-min($new_width,$new_height))/2);
			//var_dump($x);
			
			$res = imagecopyresampled($new_img,$img,-$z,-$g,0,0,$width+(2*$z),$height+(2*$g),$img_width,$img_height);
			//$res=imagecopyresampled($new_img,$img,0,0,round($width*50/100),100,$width,$height+80,min($img_width,$img_height)+20,$img_height-20);
		} elseif ($img_width < $img_height) {
			$new_width = $width;
			var_dump($new_width);
			$new_height = round(($img_height*$width)/$img_width);
			var_dump($new_height);
			$z = round(($new_height-$height)/2);
			var_dump($z);
			$g = 0;
			if ($z<0) {
				$g = (-1)*$z;
				$z = $z*(-1);
			} 
			var_dump($g);
			$new_img = imagecreatetruecolor($width,$height);
			
			//$x = round((max($new_width,$new_height)-min($new_width,$new_height))/2);
			//var_dump($x);
			$res = imagecopyresampled($new_img,$img,-$g,-$z+round((50*$z)/100),0,0,$width+(2*$g),$height+(2*$z),$img_width,$img_height);
		} else {
			$new_width = round(($img_width*$height)/$img_height);
			$new_height = round(($img_height*$width)/$img_width);
			$new_img = imagecreatetruecolor($width,$height);
			if ($width > $height) {
				$z = round(($new_height-$height)/2);
				var_dump($z);
				$g = round(($new_width-$width)/4);
				var_dump($g);
				$g = -1*$g;
			} else {
				$z = round(($new_height-$height)/4);
				var_dump($z);
				$z = -1*$z;
				$g = round(($new_width-$width)/2);
				var_dump($g);
			}
			$res = imagecopyresampled($new_img,$img,-$g,-$z,0,0,$width+(2*$g),$height+(2*$z),$img_width,$img_height);
		}

        
        switch($type) {
            case 'jpeg':
            $res = imagejpeg($new_img,'images/mini/'.$_FILES['image']['name']);
            break;
            case 'gif':
            $res = imagegif($new_img,'images/mini/'.$_FILES['image']['name']);
            break;
            case 'png':
            $res = imagepng($new_img,'images/mini/'.$_FILES['image']['name']);
            break;
        }
		
		
        imagedestroy($new_img);
        imagedestroy($img);
        
        return $res;
        
    }
?>