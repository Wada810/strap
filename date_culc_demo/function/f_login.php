<?php
//ソルトハッシュ
function salt_hash($count,$salt,$key){
    for($i=0; $i<$count; $i++){
        $key = md5($salt.$key);
    }
    return $key;
}

//

?>