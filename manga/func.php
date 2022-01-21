<?php
//特殊文字変換
function sp($str){
    return  htmlspecialchars($str,ENT_QUOTES | ENT_HTML5);
}

//sqlの特殊文字エスケープ
function escape ($link,$str){
    return  mysqli_real_escape_string($link,$str);
}

//dbに接続し、文字コードを指定
//返り値は失敗した場合false, 成功した場合接続情報
function connect_db ($host,$user,$pass,$db){
    $link = mysqli_connect($host,$user,$pass,$db);
    if(!$link){
        return false;
    }
    mysqli_set_charset($link,'utf8');
    return $link;
}

//空白チェック　空文字
function is_emp($check_str){
    $check_str = sp($check_str);
    $return["value"] = $check_str;
    if($check_str == ""){
        $return["vld"] = "invalid";
        $return["err_msg"] = ERR1001;
    }else{
        $return["err_msg"] = "";
        $return["vld"] = "valid";
    }
    return $return;
}

//整数チェック　
function is_num($check_str){
    $check_str = mb_convert_kana($check_str,"n");
    $return["value"] = $check_str;
    if(!is_numeric($check_str)){
        $return["vld"] = "invalid";
        $return["err_msg"] = ERR1002;
    }elseif(strpos($check_str,".") !== false){
        $return["vld"] = "invalid";
        $return["err_msg"] = ERR1005;
    }elseif($check_str < 0){
        $return["vld"] = "invalid";
        $return["err_msg"] = ERR1004;
    }else{
        $return["vld"] = "valid";
        $return["err_msg"] = "";
    }
    return $return;
}

//日付の妥当性チェック YYYYMMDD　形式
function is_date($check_str){
    $check_str = mb_convert_kana($check_str,"n");
    $return["value"] = $check_str;
    if(preg_match("/[0-9]{8}/",$check_str)){
        $year = substr($check_str,0,4);
        $month = substr($check_str,4,2);
        $day = substr($check_str,6,2);
        if(!checkdate($month,$day,$year)){
            $return["vld"] = "invalid";
            $return["err_msg"] = ERR1006;
        }else{
            $return["vld"] = "valid";
            $return["err_msg"] = "";
        }
    }else{
        $return["vld"] = "invalid";
        $return["err_msg"] = ERR1006;
    }
    return $return;
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

//ファイルサイズが規定値以下かどうか調べる
function size_check ($file,$limit){
    if(filesize($file) >= $limit){
        return false;
    }
    return true;
}

//YYYY-MM-DDの日付型の文字列をYYYY年MM月DD日に変換する
//引数は常に正しい値が入ることを期待する
function conv_date_jp($date){
    $y = substr($date,0,4);
    $m = (int) substr($date,5,2);
    $d = (int) substr($date,8,2);
    return $y . "年" . $m . "月" . $d . "日";
}

//検索ワードからセッションに必要な値を生成する
//[条件を日本語化したもの,sql文,消す時のキー]
function search_gen ($origin_word,$type){
    $link = @connect_db (HOST,USER_ID,PASSWORD,DB_NAME);
    if($link === false){
        $err = ERR1101 . ERR2001;
        require_once "tpl/error.php";
        exit;
    }
    $search = mb_convert_kana($origin_word,"s");
    $search = trim($search);
    $words = explode(" ",$search);
    $add_query = " AND (";
    $str = "タイトルに";
    foreach($words as $key => $word){
        if($word !== ""){
            $not = "";
            if ($type == "not"){
                $not = " NOT ";
            }
            //クエリを生成
            $add_query .= "title" . $not . " LIKE '%" . escape($link,$word) . "%'";
            $str .=  "<span>" . sp($word) . "</span>";
            $and_or = [" AND ","と"];
            if($type == "or"){
                $and_or = [" OR ","か"];
            }
            if(count($words) !== $key + 1){
                $add_query .= $and_or[0];
                $str .= $and_or[1];
            }
        }
    }
    $add_query .= ")";
    if ($type == "not"){
        $str .= "を含まない";
    }else{
        $str .= "を含む";
    }
    mysqli_close($link);
    return [$str,$add_query,"title,where"];
}


//巻数の検索入力値からセッションに必要な値を生成する
function volume_search_gen($first,$second,$type){
    $link = @connect_db (HOST,USER_ID,PASSWORD,DB_NAME);
    if($link === false){
        $err = ERR1101 . ERR2001;
        require_once "tpl/error.php";
        exit;
    }
    $search = mb_convert_kana($first,"s");
    $search = str_replace(" ","",$search);
    $search = mb_convert_kana($search,"n");
    $search = round($search);
    if($type == "more"){
        $add_query = ' AND (volume >= ' . escape($link,$search) . ") " ;
        $str = "<span>" . $search . "巻</span>以上";
    }elseif($type == "less"){
        $add_query = ' AND (volume <= ' . escape($link,$search) . ") " ;
        $str = "<span>" . $search . "巻</span>以下";
    }elseif($type == "match"){
        $add_query = " AND (volume = " . escape($link,$search) . ") " ;
        $str = "<span>" . $search . "巻</span>";
    }elseif($type == "range"){
        $search_second = mb_convert_kana($second,"s");
        $search_second = str_replace(" ","",$search_second);
        $search_second = mb_convert_kana($search_second,"n");
        $search_second = round($search_second);
        $bigger = $search_second;
        $smaller = $search;
        if($search >= $search_second){
            $smaller = $search_second;
            $bigger = $search;
        }
        $add_query = " AND (volume >= " . escape($link,$smaller) . " AND volume <= " . escape($link,$bigger) . ") ";
        $str = "<span>" . sp($smaller) . "巻</span>から<span>" . sp($bigger) . "巻</span>";
    }
    mysqli_close($link);
    return [$str,$add_query,"volume,where"];
}

//価格の検索入力値からセッションに必要な値を生成する
function price_search_gen($first,$second,$type){
    $link = @connect_db (HOST,USER_ID,PASSWORD,DB_NAME);
    if($link === false){
        $err = ERR1101 . ERR2001;
        require_once "tpl/error.php";
        exit;
    }
    $search = mb_convert_kana($first,"s");
    $search = str_replace(" ","",$search);
    $search = mb_convert_kana($search,"n");
    $search = round($search);
    if($type == "more"){
        $add_query = ' AND (price >= ' . escape($link,$search) . ") " ;
        $str = "<span>" . $search . "円</span>以上";
    }elseif($type == "less"){
        $add_query = ' AND (price <= ' . escape($link,$search) . ") " ;
        $str = "<span>" . $search . "円</span>以下";
    }elseif($type == "match"){
        $add_query = " AND (price = " . escape($link,$search) . ") " ;
        $str = "<span>" . $search . "円</span>";
    }elseif($type == "range"){
        $search_second = mb_convert_kana($second,"s");
        $search_second = str_replace(" ","",$search_second);
        $search_second = mb_convert_kana($search_second,"n");
        $search_second = round($search_second);
        $bigger = $search_second;
        $smaller = $search;
        if($search >= $search_second){
            $smaller = $search_second;
            $bigger = $search;
        }
        $add_query = " AND (price >= " . escape($link,$smaller) . " AND price <= " . escape($link,$bigger) . ") " ;
        $str = "<span>" . sp($smaller) . "円</span>から<span>" . sp($bigger) . "円</span>";
    }
    mysqli_close($link);
    return [$str,$add_query,"price,where"];
}

//pagenation
//ページの総数
function get_total_page($rows,$rpp){
    return ceil($rows / $rpp);
}
//disabledを判定
function is_disabled($total_page,$page_on,$type = "first"){
    $disabled = "";
    if($type == "first"){
        if($page_on <= 1){
            $disabled = "disabled";
        }
    }else{
        if($page_on >= $total_page){
            $disabled = "disabled";
        }
    }
    return $disabled;
}
//戻るボタンを生成
function gen_page_arrows_back($total_page,$page_on,$href){
    $disabled = is_disabled($total_page,$page_on);
    if($disabled == ""){
        $arrows = "<a href='" . $href . "?page=1'><span class='material-icons' id='first_page'>first_page</span></a>";
        $arrows .= "<a href='" . $href . "?page=" . ($page_on - 1) . "'><span class='material-icons' id='navigate_before'>navigate_before</span></a>";
    }else{
        $arrows = "<span class='material-icons " . $disabled . "' id='first_page'>first_page</span>";
        $arrows .= "<span class='material-icons " . $disabled . "' id='navigate_before'>navigate_before</span>";
    }
    return $arrows;
}
//次へボタンを生成
function gen_page_arrows_next($total_page,$page_on,$href){
    $disabled = is_disabled($total_page,$page_on,"last");
    $arrows = "";
    if($disabled == ""){
        $arrows .= "<a href='" . $href . "?page=" . ($page_on + 1) . "'><span class='material-icons' id='navigate_next'>navigate_next</span></a>";
        $arrows .= "<a href='" . $href . "?page=" . $total_page ."'><span class='material-icons' id='last_page'>last_page</span></a>";
    }else{
        $arrows .= "<span class='material-icons " . $disabled . "' id='navigate_next'>navigate_next</span>";
        $arrows .= "<span class='material-icons " . $disabled . "' id='last_page'>last_page</span>";
    }
    return $arrows;
}
//数字でページリンクを生成
function gen_page_num($total_page,$page_on,$href,$offset = 2){
    $pages = [];
    $pages[$offset] = "<span class='current_page page_num'>" . $page_on . "</span>";
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

//矢印のみ
function gen_page_arrows($total_page,$page_on,$href){
    $pagenation = gen_page_arrows_back($total_page,$page_on,$href);
    $pagenation .= gen_page_arrows_next($total_page,$page_on,$href);
    return $pagenation;
}
//矢印 + 数字リンク
function gen_page_arrows_num($total_page,$page_on,$href,$range = 2){
    $pagenation = gen_page_arrows_back($total_page,$page_on,$href);
    $pagenation .= gen_page_num($total_page,$page_on,$href,$range);
    $pagenation .= gen_page_arrows_next($total_page,$page_on,$href);
    return $pagenation;
}

//セレクトボックス
//option 生成
function gen_options($options,$selected = NULL){//引数　配列
    $created_options = "";
    foreach($options as $option){
        if($option == $selected){
            $created_options .= "<option selected>" . $option . "</option>";
        }else{
            $created_options .="<option>" . $option . "</option>";
        }
    }
    return $created_options;
}