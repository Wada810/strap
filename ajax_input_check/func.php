<?php
//特殊文字変換
function sp($str){
    return  htmlspecialchars($str,ENT_QUOTES | ENT_HTML5);
}
?>