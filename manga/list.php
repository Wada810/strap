<?php
session_start();
require_once "../../const.php";
require_once "const_error.php";
require_once "func.php";
$err = "";

//ダークテーマかどうか
$theme = "";
if(isset($_SESSION["theme"])){
    $theme = $_SESSION["theme"];
}
//画像の非表示
$visibility = "";
if(isset($_SESSION["image_visibility"])){
    $visibility = $_SESSION["image_visibility"];
}


//セッションを削除デバッグ機能
if(isset($_POST["session"]) && $_POST["session"] == "del"){
    $_SESSION = [];
    unset($_SESSION);
    session_destroy();
    header("Location: list.php");
    exit;
}

//ダウンロードボタンが押されたとき
if(isset($_POST["download_csv"])){
    header("location: download.php");
    exit;
}

//単行本を登録するボタンが押されたとき
if(isset($_POST["add_data"])){
    header("location: ./insert.php");
    exit;
}

//作業完了のダイアログがある時は表示する
$comp_msg = "";
$comp_hidden = "hidden";
if(isset($_SESSION["comp_msg"])){
    $comp_msg = $_SESSION["comp_msg"];
    $comp_hidden = "";
}

//１ページに表示する行数が変更されたとき
if(isset($_POST["rows_per_page"])){
    $_SESSION["rpp"] = $_POST["rows_per_page"];
}
//値の設定
$options = [
    5,10,20,50
];

//絞り込みの削除
if(isset($_POST["filter_delete"])){
    $phrases =  explode(",",$_POST["filter_delete"]);
    unset($_SESSION["filter"][$phrases[1]][$phrases[0]]);
    unset($_SESSION["page"]);
    header("location: list.php");
    exit;
}

//初期状態のSQL
$query_select = "SELECT * FROM m_book" ;
$query_where = " WHERE del_date IS NULL";
$query_order = "";

//検索ワードが入力された時
if(isset($_POST["search"]) && $_POST["search"] !== ""){
    $_SESSION["filter"]["where"]["title"] = search_gen($_POST["search"],"");
    unset($_SESSION["page"]);
    header("location: list.php");
    exit;
}
//詳細検索
if(isset($_POST["title_advanced_search"]) && $_POST["title_advanced_search"] !== ""){
    $_SESSION["filter"]["where"]["title"] = search_gen($_POST["title_advanced_search"],$_POST["title_advanced_search_type"]);
    unset($_SESSION["page"]);
    header("location: list.php");
    exit;
}
//巻数
if(isset($_POST["volume_search"]) && $_POST["volume_search"] !== "" && is_numeric(mb_convert_kana($_POST["volume_search"],"n"))){
    $second = "";
    if(isset($_POST["volume_search_range"])){
        $second = $_POST["volume_search_range"];
    }
    if($second == "" || is_numeric(mb_convert_kana($second,"n"))){
        $_SESSION["filter"]["where"]["volume"] = volume_search_gen($_POST["volume_search"],$second,$_POST["volume_search_type"]);
    }
    unset($_SESSION["page"]);
    header("location: list.php");
    exit;
}
//価格
if(isset($_POST["price_search"]) && $_POST["price_search"] !== "" && is_numeric(mb_convert_kana($_POST["price_search"],"n"))){
    $second = "";
    if(isset($_POST["price_search_range"])){
        $second = $_POST["price_search_range"];
    }
    if($second == "" || is_numeric(mb_convert_kana($second,"n"))){
        $_SESSION["filter"]["where"]["price"] = price_search_gen($_POST["price_search"],$second,$_POST["price_search_type"]);
    }
    unset($_SESSION["page"]);
    header("location: list.php");
    exit;
}
//発売日
//購入日


//ソートのボタンが押されたとき
if(isset($_POST["sort"])){
    $sort_values = explode(",",$_POST["sort"]);
    $str = "<span>" . $sort_values[0] . "</span>:" . $sort_values[3];
    $add_query = $sort_values[1] . " " . $sort_values[2];
    $_SESSION["filter"]["order"][$sort_values[1]] = [$str,$add_query,$sort_values[1] . ",order","arrow_drop_" . $sort_values[4]];
    unset($_SESSION["page"]);
    header("location: list.php");
    exit;
}

//検索の絞り込みのセッションでクエリを生成する
//初期状態
if(!isset($_SESSION["filter"])){
    $_SESSION["filter"]["order"]["release_date"] = ["<span>発売日</span>:降順","release_date DESC","release_date,order","arrow_drop_down"];
}

//WHERE句
if(isset($_SESSION["filter"]["where"])){
    foreach($_SESSION["filter"]["where"] as $value){
        $query_where .= $value[1];
    }
}

//ORDER BY句
if(isset($_SESSION["filter"]["order"])){
    $i = 0;
    foreach($_SESSION["filter"]["order"] as $value){
        if($i == 0){
            $query_order .= " ORDER BY " . $value[1];
        }else{
            $query_order .= " , " . $value[1];
        }
        $i ++;
    }
}


//db接続

$link = @connect_db (HOST,USER_ID,PASSWORD,DB_NAME);
if($link === false){
    $err = ERR1101 . ERR2001;
    require_once "tpl/error.php";
    exit;
}
//データの取得
$query = $query_select . $query_where . $query_order;
//var_dump($query);
$result = @mysqli_query($link,$query);
if($result === false){
    mysqli_close($link);
    $err = ERR1105 . ERR2001 . $query;
    require_once "tpl/error.php";
    exit;
}
//配列に格納
$books = [];
$has_image = [];
while($tmp = mysqli_fetch_assoc($result)){
    //画像があるか
    if(!file_exists(DIR_IMG . $tmp["id"] . ".jpg")){
        $has_image[] = ["no_image","data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="];
    }else{
        $has_image[] = ["", DIR_IMG . $tmp["id"] . ".jpg"];
    }
	$books[] = $tmp;
}

//結果が0件かどうか
$no_result = "no_result";
if(count($books) == 0){
    $no_result = "";
}
mysqli_close($link);

//絞り込みを生成する
$filters = [];
if(isset($_SESSION["filter"]["where"])){
    foreach($_SESSION["filter"]["where"] as $value){
        $filters[] = $value;
    }
}
if(isset($_SESSION["filter"]["order"])){
    foreach($_SESSION["filter"]["order"] as $value){
        $filters[] = $value;
    }
}
//ソートボタンの表示切り替え
$volume_sort = (isset($_SESSION["filter"]["order"]["volume"]))?$_SESSION["filter"]["order"]["volume"][3]:"";
$price_sort = (isset($_SESSION["filter"]["order"]["price"]))?$_SESSION["filter"]["order"]["price"][3]:"";
$release_date_sort = (isset($_SESSION["filter"]["order"]["release_date"]))?$_SESSION["filter"]["order"]["release_date"][3]:"";
$purchase_date_sort = (isset($_SESSION["filter"]["order"]["purchase_date"]))?$_SESSION["filter"]["order"]["purchase_date"][3]:"";


//ぺーじ管理
//ページ当たりの表示行
$rpp = 10;
if(isset($_SESSION["rpp"])){
    $rpp = $_SESSION["rpp"];
}
//全部で何ページあるか
//現在の位置
$total_page = get_total_page(count($books),$rpp);
if(isset($_GET["page"])){
    if($_GET["page"] <= 0){
        $_SESSION["page"] = 1;
    }elseif($_GET["page"] >= $total_page){
        $_SESSION["page"] = $total_page;
    }else{
        $_SESSION["page"] = $_GET["page"];
    }
}
$page_on = 1;
if(isset($_SESSION["page"])){
    $page_on = $_SESSION["page"];
}
//表示する行の選択
$page_books = [];
for($i = $rpp * ($page_on - 1); $i < $page_on * $rpp; $i++){
    if(isset($books[$i])){
        $page_books[$i] =  $books[$i];
    }else{
        break;
    }
}
$first_row = $rpp * ($page_on - 1) + 1;
$last_row = $i;

require_once "tpl/list.php";
?>