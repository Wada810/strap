<?php

session_start();
require_once "../../const.php";
require_once "const_error.php";
require_once "func.php";

// 出力情報の設定
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=book_" . date("YmdHis") . ".csv");
header("Content-Transfer-Encoding: binary");

$query_select = "
    SELECT *
    FROM m_book" ;
$query_where = " WHERE del_date IS NULL";
$query_order = "";

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
    $err = ERR1203 . ERR2002;
    require_once "tpl/error.php";
    exit;
}
//データの取得
$query = $query_select . $query_where . $query_order;
$result = @mysqli_query($link,$query);
if($result === false){
    mysqli_close($link);
    $err = ERR1203 . ERR2002;
    require_once "tpl/error.php";
    exit;
}
//配列に格納
$books = [];
$has_image = [];
while($tmp = mysqli_fetch_assoc($result)){
	$books[] = $tmp;
}
mysqli_close($link);

// 1行目のラベルを作成
$csv = '"タイトル","巻数","価格","発売日","購入日"' . "\n";

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
$csv .= "絞り込む条件\n";
foreach($filters as $value){
    $str = str_replace("<span>","",$value[0]);
    $str = str_replace("</span>","",$str);
    $csv .= $str . ",";
}
$csv .= "\n";

// 出力データ生成
foreach( $books as $value ) {
	$csv .= '"' . $value['title'] . '",' . $value['volume'] . ',' . $value['price'] . ',' . $value['release_date'] . ',' . $value['purchase_date'] . "\n";
}

// CSVファイル出力
print $csv;
return;
?>