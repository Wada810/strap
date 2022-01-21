<?php

//作業完了のダイアログを管理するセッションを確認次第けす。
if(isset($_POST["comp_msg"]) && $_POST["comp_msg"] == "close"){
    session_start();
    unset($_SESSION["comp_msg"]);
    exit;
}
//色のテーマを保存
if(isset($_POST["brightness_theme"])){
    session_start();
    if($_POST["brightness_theme"] == "dark"){
        $_SESSION["theme"] = $_POST["brightness_theme"];
    }else{
        unset($_SESSION["theme"]);
    }
    exit;
}
//画像の表示設定の保存
if(isset($_POST["image_visibility"])){
    session_start();
    if($_POST["image_visibility"] == "invisible"){
        $_SESSION["image_visibility"] = $_POST["image_visibility"];
    }else{
        unset($_SESSION["image_visibility"]);
    }
    exit;
}
