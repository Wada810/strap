<?php
//特殊文字変換
function sp($str){
    return  htmlspecialchars($str,ENT_QUOTES | ENT_HTML5);
}
//ファイルの拡張子の判別 返り値：bool
//許可する拡張子(.は必要ない)を２番目の引数に配列として記述 e.g.) $accept = ["jpg","png"];
function extension_check ($file,$accept){
    $extension = substr(strrchr($file, '.'), 1);
    foreach($accept as $val){
        if($extension == $val){
            $admission = true;
        }
    }
    //拡張子が許可されたものである場合trueを返す
    if(isset($admission) && $admission == true){
        return true;
    }else{
        return false;
    }
}
//一括バリデーション
//$check = [
//    [target,item,[type,type...]],
//    [target,item,[type,type...]],
//    [age,年齢,[required,numeric,min-0,max-100]]...
//];
function form_vld($check){
    if(count($check) == 0){
        return false;
    }
    $result = [];
    foreach($check as $target){
        $result[$target[0]] = ["vld" => "valid","value" => sp($_REQUEST[$target[0]]),"msg" => ""];
        foreach($target[2] as $type){
            if($type == "required"){
                if($_REQUEST[$target[0]] == ""){
                    $result[$target[0]]["vld"] = "invalid";
                    $result[$target[0]]["msg"] = $target[1] . "を入力してください。";
                    break;
                }
            }elseif($type == "numeric"){//少数、マイナスも受け付ける
                $result[$target[0]]["value"] = sp(mb_convert_kana($_REQUEST[$target[0]],"n"));
                if(!is_numeric(mb_convert_kana($_REQUEST[$target[0]],"n"))){
                    $result[$target[0]]["vld"]  = "invalid";
                    $result[$target[0]]["msg"]  = $target[1] . "は数値で入力してください。";
                    break;
                }
            }elseif(preg_match('/^min-[\-\.0-9]+/',$type)){
                if($_REQUEST[$target[0]] < str_replace("min-","",$type)){
                    $result[$target[0]]["vld"]  = "invalid";
                    $result[$target[0]]["msg"]  = $target[1] . "は" . str_replace("min-","",$type) ."以上で入力してください。";
                    break;
                }
            }elseif(preg_match('/^minlength-[\-\.0-9]+/',$type)){
                if(mb_strlen($_REQUEST[$target[0]]) < str_replace("minlength-","",$type)){
                    $result[$target[0]]["vld"]  = "invalid";
                    $result[$target[0]]["msg"]  = $target[1] . "は" . str_replace("minlength-","",$type) ."文字以上で入力してください。";
                    break;
                }
            }elseif(preg_match('/^max-[\-\.0-9]+/',$type)){
                if($_REQUEST[$target[0]] > str_replace("max-","",$type)){
                    $result[$target[0]]["vld"]  = "invalid";
                    $result[$target[0]]["msg"]  = $target[1] . "は" . str_replace("max-","",$type) ."以下で入力してください。";
                    break;
                }
            }elseif(preg_match('/^maxlength-[\-\.0-9]+/',$type)){
                if(mb_strlen($_REQUEST[$target[0]]) > str_replace("maxlength-","",$type)){
                    $result[$target[0]]["vld"]  = "invalid";
                    $result[$target[0]]["msg"]  = $target[1] . "は" . str_replace("maxlength-","",$type) ."文字以下で入力してください。";
                    break;
                }
            }elseif($type == "natural_num"){//１以上の整数のみ
                $result[$target[0]]["value"] = sp(mb_convert_kana($_REQUEST[$target[0]],"n"));
                if(!is_numeric(mb_convert_kana($_REQUEST[$target[0]],"n"))){
                    $result[$target[0]]["vld"]  = "invalid";
                    $result[$target[0]]["msg"]  = $target[1] . "は数値で入力してください。";
                    break;
                }elseif(strpos($_REQUEST[$target[0]],".") !== false){
                    $result[$target[0]]["vld"]  = "invalid";
                    $result[$target[0]]["msg"]  = $target[1] . "は整数で入力してください。";
                    break;
                }elseif($_REQUEST[$target[0]] <= 0){
                    $result[$target[0]]["vld"]  = "invalid";
                    $result[$target[0]]["msg"]  = $target[1] . "は1以上で入力してください。";
                    break;
                }
            }elseif($type == "email"){//inpupt type=email　と同じバリデーションを行う。厳しすぎる又は緩すぎる表現は規制していない
                $reg_email = "/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/";
                if(preg_match($reg_email,$_REQUEST[$target[0]]) !== 1){
                    $result[$target[0]]["vld"]  = "invalid";
                    $result[$target[0]]["msg"]  = "正しいメールアドレスを入力してください。";
                    break;
                }
            }elseif($type == "mail_simple"){//課題用メールアドレスチェック　
                if(strpos($_REQUEST[$target[0]],"@") === false){
                    $result[$target[0]]["vld"]  = "invalid";
                    $result[$target[0]]["msg"]  = "正しいメールアドレスを入力してください。";
                    break;
                }
            }
        }
    }
    return $result;
}
//validationの結果を入れる配列の初期定義
function vld_ini($check){
    $arr = [];
    foreach($check as $val){
        $arr[$val[0]] = ["vld" => "","value" => "","msg" => ""];
    }
    return $arr;
}

//ハッシュ化
function hash_sec ($pass,$salt,$stretch){
    $tmp = $pass;
    for($i = 0; $i < $stretch; $i ++){
        $tmp = md5($salt . $tmp);
    }
    return $tmp;
}
//ランダムなソルトを取得する
//min以上maxバイト以下の文字列を生成する
function get_rand_salt($min=5,$max=10){
    return  bin2hex(random_bytes(random_int($min,$max)));
}


//sqlの特殊文字エスケープ
function escape ($link,$str){
    return  mysqli_real_escape_string($link,$str);
}

//dbに接続し、文字コードを指定(utf8)
//返り値は失敗した場合false, 成功した場合接続情報
function connect_db ($host,$user,$pass,$db){
    $link = mysqli_connect($host,$user,$pass,$db);
    if(!$link){
        return false;
    }
    mysqli_set_charset($link,'utf8');
    return $link;
}


function get_option_data($query,$link){
    $result = mysqli_query($link,$query);
    if($result == false){
        //実行エラー
        mysqli_close($link);
        header("location: error.php?error=db_query_has_failed");
        exit;
    }
    $return_array = [];
    while($tmp = mysqli_fetch_assoc($result)){
        $return_array[] = $tmp;
    }
    return $return_array;
}
//pagenation//////////////////////////////////////////////////////////////////////
// if you want to use icons copy&paste link down below
/* <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> */
//ページの総数
function get_total_page($rows,$rpp){
    return ceil($rows / $rpp);
}
//今いるページを取得
function get_pege_on(){
    if(isset($_GET["page"])){
        $page_on = $_GET["page"];
    }else{
        $page_on = 1;
    }
    return $page_on;
}
//disabledを判定
//引数の$typeは最初か終端かの判定を指定する
function is_disabled($total_page,$page_on,$type = "first",$disabled_class = "disabled"){
    $disabled = "";
    if($type == "first"){
        if($page_on <= 1){
            $disabled = $disabled_class;
        }
    }else{
        if($page_on >= $total_page){
            $disabled = $disabled_class;
        }
    }
    return $disabled;
}
//戻るボタンを文字で生成
function gen_page_text_back($total_page,$page_on,$href,$class_name = "pagebutton page_back",$back_str="戻る"){
    $disabled = is_disabled($total_page,$page_on);
    $arrows = "";
    if($disabled == ""){
        $arrows = "<a class='" . $class_name . "' href='" . $href . "?page=" . ($page_on - 1) . "'>" . $back_str .  "</a>";
    }else{
        $arrows = "<a class='" . $class_name . " "  . $disabled . "'>" . $back_str .  "</a>";
    }
    return $arrows;
}
//戻るボタンと先頭ボタンを生成
function gen_page_text_back_top($total_page,$page_on,$href,$class_name = "pagebutton page_back",$back_str="戻る",$top_str="先頭へ"){
    $disabled = is_disabled($total_page,$page_on);
    $arrows = "";
    if($disabled == ""){
        $arrows = "<a class='" . $class_name . "' href='" . $href . "?page=" . 1 . "'>" . $top_str .  "</a>";
        $arrows .= "<a class='" . $class_name . "' href='" . $href . "?page=" . ($page_on - 1) . "'>" . $back_str .  "</a>";
    }else{
        $arrows = "<a class='" . $class_name . " "  . $disabled . "'>" . $top_str .  "</a>";
        $arrows .= "<a class='" . $class_name . " "  . $disabled . "'>" . $back_str .  "</a>";
    }
    return $arrows;
}

//次へボタンを文字で生成
function gen_page_text_next($total_page,$page_on,$href,$class_name="page_button page_next",$next_str="次へ"){
    $disabled = is_disabled($total_page,$page_on,"last");
    $next_text = "";
    if($disabled == ""){
        $next_text = "<a class='" . $class_name . "' href='" . $href . "?page=" . ($page_on + 1) . "'>" . $next_str . "</a>";
    }else{
        $next_text = "<a class='" . $class_name . " " . $disabled . "'>" . $next_str . "</a>";
    }
    return $next_text;
}
//次へボタンと最後へを文字で生成
function gen_page_text_next_last($total_page,$page_on,$href,$class_name="page_button page_next",$next_str="次へ",$last_str="最後へ"){
    $disabled = is_disabled($total_page,$page_on,"last");
    $next_text = "";
    if($disabled == ""){
        $next_text = "<a class='" . $class_name . "' href='" . $href . "?page=" . ($page_on + 1) . "'>" . $next_str . "</a>";
        $next_text .= "<a class='" . $class_name . "' href='" . $href . "?page=" . $total_page . "'>" . $last_str . "</a>";
    }else{
        $next_text = "<a class='" . $class_name . " " . $disabled . "'>" . $next_str . "</a>";
        $next_text .= "<a class='" . $class_name . " " . $disabled . "'>" . $last_str . "</a>";
    }
    return $next_text;
}
//数字でページリンクを生成
function gen_page_num($total_page,$page_on,$href,$offset = 2){
    $pages = [];
    $pages[$offset] = "<a class='current_page page_num'>" . $page_on . "</a>";
    for($i = 1; $i <= $offset; $i ++){
        if($page_on - $i > 0){
            $pages[$offset - $i] = "<a class='page_num' href='" . $href . "?page=" . ($page_on - $i) . "'>" . ($page_on - $i) . "</a>";
        }
    }
    for($i = 1; $i <= $offset; $i ++){
        if($page_on + $i <= $total_page){
            $pages[$offset + $i] = "<a class='page_num' href='" . $href . "?page=" . ($page_on + $i) . "'>" . ($page_on + $i) . "</a>";
        }
    }
    ksort($pages);
    return implode("",$pages);
}

//数字でページリンクを生成 1 2 3 ..5.. 8 9 10
function gen_page_num_all($total_page,$page_on,$href,$offset = 3){
    $pages = [];
    for($i = 1; $i <= $offset; $i ++){
        if($i == $page_on){
            $pages[] = "<a class='page_num current_page'>" . $i . "</a>";
        }else{
            $pages[] = "<a class='page_num' href='" . $href . "?page=" . $i . "'>" . $i . "</a>";
        }
    }
    $tmp_page = "";
    if($page_on > $offset && $page_on <= ($total_page - $offset)){
        $tmp_page = $page_on;
    }
    $pages[] = "<a>. . " . $tmp_page . " . .</a>";
    for($i = $offset - 1; $i >= 0; $i --){
        if(($total_page - $i) == $page_on){
            $pages[] = "<a class='page_num current_page'>" . ($total_page - $i) . "</a>";
        }else{
            $pages[] = "<a class='page_num' href='" . $href . "?page=" . ($total_page - $i) . "'>" . ($total_page - $i) . "</a>";
        }
    }
    return implode("",$pages);
}


//戻る・次へ + 数字リンク
function gen_page_text_num($total_page,$page_on,$href,$range = 2,$class_back = "page_button page_back",$class_next = "page_button page_next",$back_str = "戻る",$next_str = "次へ",$top_str="先頭へ",$last_str="最後へ"){
    $pagenation = gen_page_text_back_top($total_page,$page_on,$href,$class_back,$back_str,$top_str);
    $pagenation .= gen_page_text_next_last($total_page,$page_on,$href,$class_next,$next_str,$last_str);
    return $pagenation;
}

//全部入り
function gen_page($total_page,$page_on,$href,$range = 2,$class_back = "page_button page_back",$class_next = "page_button page_next",$back_str = "戻る",$next_str = "次へ"){
    $pagenation = gen_page_text_back_top($total_page,$page_on,$href,$class_back,$back_str);
    $pagenation .= gen_page_num($total_page,$page_on,$href,$range);
    $pagenation .= gen_page_text_next_last($total_page,$page_on,$href,$class_next,$next_str);
    return $pagenation;
}

//1ページに表示するデータのみを返す
function get_one_page($array,$rpp,$page_on){
    $tmp = [];
    for($i = $rpp * ($page_on - 1); $i < $rpp * $page_on; $i ++){
        if(!isset($array[$i])){
            break;
        }
        $tmp[] = $array[$i];
    }
    return $tmp;
}

////////gd libraly//////
//拡張子を取得（ファイル名の最後の.以降の文字列を取得）
function get_extension($file_name){
    return substr(strrchr($file_name, '.'), 1);
}
//縦横比決定
function get_reduced_size($file,$max_width,$max_height){
    $original_size = getimagesize($file);
    $w_ratio = $original_size[0] / $max_width;
    $h_ratio = $original_size[1] / $max_height;
    $size = [];
    if($w_ratio < 1 && $h_ratio < 1){
        $size["width"] = $original_size[0];
        $size["height"] = $original_size[1];
    }elseif($w_ratio < $h_ratio){
        $size["width"] = $original_size[0] / $h_ratio;
        $size["height"] = $original_size[1] / $h_ratio;
    }else{
        $size["width"] = $original_size[0] / $w_ratio;
        $size["height"] = $original_size[1] / $w_ratio;
    }
    return $size;
}

//.jpgの画像を指定したサイズに縮めて$pathに保存する
function get_reduced_copy($original_img,$width,$height,$save_path){
    $original_size = getimagesize($original_img);
    $reduced_size = get_reduced_size($original_img,$width,$height);

    //元の画像を生成
    $image = imagecreatefromjpeg($original_img);
    //空の画像を生成
    $canvas = imagecreatetruecolor($reduced_size["width"],$reduced_size["height"]);
    //リサイズ
    imagecopyresampled($canvas, $image, 0,0,0,0, $reduced_size["width"], $reduced_size["height"], $original_size[0], $original_size[1]);

    //保存
    imagejpeg($canvas,$save_path);
    //メモリの解放
    imagedestroy($image);
    imagedestroy($canvas);
}

function get_item_list($where = ""){
    $item = [];
    $link = connect_db(HOST,USER_ID,PASSWORD,DB_NAME);
    $query = "SELECT  item.id,item.user_id,item.name,item.price,item.discription,category_id,item_condition_id,who_pays_fee,inspection_id,pickup_id,item.img,sell_date ,user.prime_status,user.id as 'u_id' FROM item JOIN user
    ON item.user_id = user.id
    WHERE item.sell_date IS NULL" . $where . "
    ORDER BY item.id DESC";
    //var_dump($query);
    $result = mysqli_query($link,$query);
    $result = mysqli_query($link,$query);
    mysqli_close($link);
    while($tmp = mysqli_fetch_assoc($result)){
        $item[] = $tmp;
    }
    return $item;
}
