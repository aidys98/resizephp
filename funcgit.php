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
        $img_height = imageSY($img);
        
        $width = $_POST['width'];
        $height = $_POST['height'];
        /*$k = $img_width/$width;
        $k = $img_height/$width;
        
        $new_width = round($img_width/$k);
        $new_height = round($img_height/$k);*/
			
        
        
        if ($img_width/$width>$img_height/$height){
			$new_width = $width;
			$new_height = round($img_height*$width/$img_width);
			$new_img = imagecreatetruecolor($new_width,$new_height);
			
           $res = imagecopyresampled($new_img,$img,0,0,0,0,$new_width,$new_height,$img_width,$img_height);
			//$res=imagecopyresampled($new_img,$img,0,0,round((max($img_width,$img_height)-min($img_width,$img_height))/2),0,$width,$height,min($img_width,$img_height),min($img_width,$img_height));
        }
        if ($img_width/$width<$img_height/$height){
			$new_height = $height;
			$new_width = round($img_width*$height/$img_height);
			$new_img = imagecreatetruecolor($new_width,$new_height);
			$res = imagecopyresampled($new_img,$img,0,0,0,0,$new_width,$new_height,$img_width,$img_height);
           //$res=imagecopyresampled($new_img,$img,0,0,0,0,$width,$height,min($img_width,$img_height),min($img_width,$img_height));
        }
        if ($img_width/$width==$img_height/$height){
			$new_width = $width;
			$new_height = $height;
			$new_img = imagecreatetruecolor($new_width,$new_height);
			$res = imagecopyresampled($new_img,$img,0,0,0,0,$new_width,$new_height,$img_width,$img_height);
            //$res = imagecopyresampled($new_img,$img,0,0,0,0,$new_width,$new_height,$img_width,$img_height);
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