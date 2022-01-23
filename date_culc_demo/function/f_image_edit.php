<?php
//指定サイズに縮小した際の縦と横の大きさを配列で返す
//引数：縮小後の縦、縮小後の横、縮小前の縦、縮小前の横

function after_shrink_size($after_height,$after_width,$before_height,$before_width){
    if($before_height <= $after_height && $before_width <= $after_width){
        $size['height'] = $before_height;
        $size['width'] = $before_width;
        return $size;
    }
    elseif($before_height >= $after_height && $before_width <= $after_width){
        $reduction_ratio = $after_height / $before_height;
        $size['height'] = $before_height * $reduction_ratio;
        $size['width'] = $before_width * $reduction_ratio;
        return $size;
    }
    elseif($before_height <= $after_height && $before_width >= $after_width){
        $reduction_ratio = $after_width / $before_width;
        $size['height'] = $before_height * $reduction_ratio;
        $size['width'] = $before_width * $reduction_ratio;
        return $size;
    }
    else{
        $reduction_ratio = $after_height / $before_height;
        if($after_width / $before_width < $reduction_ratio){
            $reduction_ratio = $after_width / $before_width;
        }
        $size['height'] = $before_height * $reduction_ratio;
        $size['width'] = $before_width * $reduction_ratio;
        return $size;
    }
}

/* 
var_dump(after_shrink_size(100,150,100,150)); 
var_dump(after_shrink_size(100,150,80,200)); 
var_dump(after_shrink_size(100,150,200,60)); 
var_dump(after_shrink_size(100,150,400,300)); 
var_dump(after_shrink_size(100,150,200,600)); 
*/

?>