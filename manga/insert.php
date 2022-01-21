<?php
session_start();
require_once "func.php";
require_once "../../const.php";
require_once "const_error.php";

$theme = "";
if(isset($_SESSION["theme"])){
    $theme = $_SESSION["theme"];
}

$value = [];
$err_msg = [];
$vld = [];

$elements_reqired = [
    "title",
    "volume",
    "price",
    "release_date"
];
$elements_numeric = [
    "volume",
    "price",
    "release_date",
    "purchase_date"
];
$elements_date = [
    "release_date",
    "purchase_date"
];
$elements_all = [
    "title",
    "volume",
    "price",
    "release_date",
    "purchase_date"
];
for($i = 0; $i < count($elements_all); $i++){
    $value[$elements_all[$i]] = "";
    $vld[$elements_all[$i]] = "";
    $err_msg[$elements_all[$i]] = "";
}
$vld["cover_img"] = "";
$err_msg["cover_img"] = "";

//キャンセルボタンが押されたとき
if(isset($_POST["btn_state"]) && $_POST["btn_state"] == "cancel"){
    header("location: ./list.php");
    exit;
}

if(isset($_POST["btn_state"]) && $_POST["btn_state"] == "submit"){
}

//登録ボタンが押された時
if(isset($_POST["btn_state"]) && $_POST["btn_state"] == "submit"){
    for($i = 0; $i < count($elements_all); $i++){
        $value[$elements_all[$i]] = "";
        $vld[$elements_all[$i]] = "valid";
        $err_msg[$elements_all[$i]] = "";
    }
    //未入力チェック
    for($i = 0; $i < count($elements_reqired); $i++){
        $tmp = is_emp($_POST[$elements_reqired[$i]]);
        $value[$elements_reqired[$i]] = $tmp["value"];
        $err_msg[$elements_reqired[$i]] = $tmp["err_msg"];
        $vld[$elements_reqired[$i]] = $tmp["vld"];
    }
    //数値チェック
    for($i = 0; $i < count($elements_numeric); $i++){
        if(isset($vld[$elements_numeric[$i]]) && $vld[$elements_numeric[$i]] == "valid"){
            $tmp = is_num($_POST[$elements_numeric[$i]]);
            $value[$elements_numeric[$i]] = $tmp["value"];
            $err_msg[$elements_numeric[$i]] = $tmp["err_msg"];
            $vld[$elements_numeric[$i]] = $tmp["vld"];
        }
    }
    //日付チェック
    for($i = 0; $i < count($elements_date); $i++){
        if(isset($vld[$elements_date[$i]]) && $vld[$elements_date[$i]] == "valid"){
            $tmp = is_date($_POST[$elements_date[$i]]);
            $value[$elements_date[$i]] = $tmp["value"];
            $err_msg[$elements_date[$i]] = $tmp["err_msg"];
            $vld[$elements_date[$i]] = $tmp["vld"];
        }
    }
    if($_POST["purchase_date"] == ""){
        $vld["purchase_date"] = "";
        $err_msg["purchase_date"] = "";
    }

    //画像が選択されているかどうか
    //選択した画像がエラーを起こさずに正常に送信されているか
    var_dump($_FILES['cover_img']["error"]);
    if(isset($_FILES['cover_img']['error']) && $_FILES['cover_img']['error'] === 0){
        //拡張子チェック
        $accept = [
            "jpg",
            "jpeg",
            "png",
            "gif"
        ];
        $file = $_FILES['cover_img']["name"];
        if(extension_check($file,$accept)){
            //ファイルサイズ圧縮
            $tmp_file = $_FILES['cover_img']["tmp_name"];
            //縦横比決定
            $size = getimagesize($tmp_file);
            $w = 260;
            $h = round(($w / $size[0]) * $size[1]);
            //画像を書き出す
            $extension = substr(strrchr($file, '.'), 1);
            if($extension == "jpg" || $extension == "jpeg"){
                $original_image = imagecreatefromjpeg($tmp_file);
            }elseif($extension == "png"){
                $original_image = imagecreatefrompng($file);
            }elseif ($extension == "gif"){
                $original_image = imagecreatefromgif($file);
            }
            //空の画像を生成
            $canvas = imagecreatetruecolor($w,$h);
            //リサイズ
            imagecopyresampled($canvas, $original_image, 0,0,0,0, $w, $h, $size[0], $size[1]);
            //.jpgに変換し保存はｄｂ登録後に行う
            print "ok";
        }else{
            $vld["cover_img"] = "invalid";
            $err_msg["cover_img"] = ERR1203;
        }
    }elseif(isset($_FILES['cover_img']['error']) && $_FILES['cover_img']['error'] !== 0){
        if($_FILES['cover_img']['error'] === 1 || $_FILES['cover_img']['error'] === 2 ){//ファイルサイズが規定値以上
            $vld["cover_img"] = "invalid";
            $err_msg["cover_img"] = ERR1201;
        }elseif($_FILES['cover_img']['error'] === 4){//選択されていない・送信されていない
            $vld["cover_img"] = "";
            $err_msg["cover_img"] = "";
        }else{
            $vld["cover_img"] = "invalid";
            $err_msg["cover_img"] = ERR1202;
        }
    }

    //入力値に誤りがないかチェック
    $has_error = true;
    foreach($vld as $is_ok){
        if($is_ok == "invalid"){
            $has_error = false;
        }
    }
    //すべての入力値が正しいときdbに登録しlist.phpに返す
    if($has_error){
        //dbに接続
        $link = @connect_db (HOST,USER_ID,PASSWORD,DB_NAME);
        if($link === false){
            imagedestroy($original_image);
            imagedestroy($canvas);
            $err = ERR1101 . ERR2001;
            require_once "tpl/error.php";
            exit;
        }
        //INSERT↓
        $title = escape($link,$value["title"]);
        $volume = escape($link,$value["volume"]);
        $price = escape($link,$value["price"]);
        $release_date = escape($link,$value["release_date"]);
        $purchase_date = 'NULL';
        //購入日が入力されており、空白でないとき
        if($value["purchase_date"] !== ""){
            $purchase_date = escape($link,$value["purchase_date"]);
            $purchase_date =  "'" . $purchase_date . "'";
        }
        $query = "
            INSERT INTO m_book (title,volume,price,release_date,purchase_date,del_date)
            VALUES ('" . $title . "'," . $volume . "," . $price . ",'" . $release_date . "'," . $purchase_date . ",NULL)";
            var_dump($query);
        //INSERT実行
        $result = mysqli_query($link,$query);
        if($result === false){
            imagedestroy($original_image);
            imagedestroy($canvas);
            mysqli_close($link);
            $err = ERR1102 . ERR2002;
            require_once "tpl/error.php";
            exit;
        }
        //追加したデータのidを取得
        $id = mysqli_insert_id($link);
        mysqli_close($link);
        $_SESSION["comp_msg"] = "データの登録が完了しました。";

        //画像を保存する
        if(isset($_FILES['cover_img']['error']) && $_FILES['cover_img']['error'] === 0){
            $path = DIR_IMG . $id . ".jpg";
            imagejpeg($canvas,$path);
            imagedestroy($original_image);
            imagedestroy($canvas);
        }

        header("location: list.php");
        exit;
    }
}
require_once "tpl/insert.php";
?>