<?php
session_start();
require_once "func.php";
require_once "../../const.php";
require_once "const_error.php";


$theme = "";
if(isset($_SESSION["theme"])){
    $theme = $_SESSION["theme"];
}
//キャンセルボタンが押されたとき
if(isset($_POST["btn_state"]) && $_POST["btn_state"] == "cancel"){
    header("location: list.php");
    exit;
}

//削除ボタンが押されたとき
if(isset($_POST["btn_state"]) && $_POST["btn_state"] == "delete"){
    $id = $_POST["id"];
    //dbに接続
    $link = @connect_db (HOST,USER_ID,PASSWORD,DB_NAME);
    if($link === false){
        $err = ERR1101 . ERR2001;
        require_once "tpl/error.php";
        exit;
    }
    //UPDATE
    $del_date = date("Ymd");
    $query = "
        UPDATE m_book
        SET del_date = '" . $del_date . "'
        WHERE id=" . $id;

    //UPDATE実行
    $result = mysqli_query($link,$query);
    if($result === false){
        mysqli_close($link);
        $err = ERR1103 . ERR2002;
        require_once "tpl/error.php";
        exit;
    }
    mysqli_close($link);

    //画像を削除
    $path = DIR_IMG . $id . ".jpg";
    unlink($path);
    $_SESSION["comp_msg"] = "データの削除が完了しました。";
    header("location: list.php");
    exit;
}

//一覧から削除リンクで来たとき
$value = [];
if(isset($_GET["book"])){
    $id = $_GET["book"];
    //dbに接続
    $link = @connect_db (HOST,USER_ID,PASSWORD,DB_NAME);
    if($link === false){
        $err = ERR1101 . ERR2001;
        require_once "tpl/error.php";
        exit;
    }
    $query = "
        SELECT *
        FROM m_book
        WHERE id=" . $_GET["book"];
    //データの取得
    $result = @mysqli_query($link,$query);
    if($result === false){
        mysqli_close($link);
        $err = ERR1105 . ERR2001;
        require_once "tpl/error.php";
        exit;
    }
    //配列に格納
    $book = mysqli_fetch_assoc($result);
    if($book === NULL){
        mysqli_close($link);
        $err = ERR404;
        require_once "tpl/error.php";
        exit;
    }
    $value["title"] = $book["title"];
    $value["volume"] = $book["volume"];
    $value["price"] = $book["price"];
    $value["release_date"] = $book["release_date"];
    $value["purchase_date"] = $book["purchase_date"];
    $value["release_date"] = $value["release_date"];
    $value["purchase_date"] = $value["purchase_date"];
    mysqli_close($link);
    $src = "data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==";
    if(file_exists(DIR_IMG . $book["id"] . ".jpg")){
        $src = DIR_IMG . $book["id"] . ".jpg";
    }
    require_once "tpl/delete.php";
    exit;
}

require_once "tpl/delete.php";
?>