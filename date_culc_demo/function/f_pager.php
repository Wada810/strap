<?php

function get_pager_num($data_count,$num_per_page){
   return ceil($data_count / $num_per_page);
}

function set_pager_class($now_page,$pager_count){
   $color = [];
   for($i=0; $i<$pager_count; $i++){
      if($i + 1 == $now_page){
         $color[] = "checked";
      }
      else{
         $color[] = "unchecked";
      }
   }
   return $color;
}

function set_pager_class_button($now_page,$pager_count){
   //戻るボタンのclass属性値を格納します
   if($now_page == 1){
      $button['back'] = "checked";
   }
   else{
      $button['back'] = "unchecked";
   }

   //進むボタンのclass属性値を格納します
   if($now_page == $pager_count){
      $button['go'] = "checked";
   }
   else{
      $button['go'] = "unchecked";
   }
   return $button;
}

//●現在のページ：
function pager_number($now_page,$pager_count,$num_per_page){
   $pager_list = [];
   if($pager_count > $num_per_page){
      if(2 < $now_page && $now_page < $pager_count - 1){
         for($i=0; $i<$num_per_page; $i++){
            $pager_list[] = $now_page - 2 + $i;
         }
      }
      elseif($now_page == 1 || $now_page == 2){
         for($i=1; $i<($num_per_page + 1); $i++){
            $pager_list[] = $i;
         }
      }
      elseif($now_page == $pager_count || $now_page == $pager_count-1){
         for($i=$pager_count-($num_per_page - 1); $i<$pager_count+1; $i++){
            $pager_list[] = $i;
         }
      }
   }
   else{
      for($i=1; $i<$pager_count+1; $i++){
         $pager_list[] = $i;
      }
   }
   return $pager_list;
}

?>