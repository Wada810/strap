<?php
require_once './initial_setting.php';

$add_schedule_modal = 'none';
//ダイアログがある時は表示する
$dialog = "";/* 内容 */
$dialog_visibility = "hidden";/* 表示 */
if(isset($_SESSION["dialog"])){
    $dialog = $_SESSION["dialog"];
    $dialog_visibility = "";
}

//======================================
//●不正アクセスを防ぐ処理
//======================================

//ログインしていなければはじく
if(!isset($_COOKIE['login'])){
    header('location:./toppage.php');
    exit;
}
//ルームidを持っていない場合もはじく
elseif(!isset($_GET['room_id'])){
    header('location:./toppage.php');
    exit;
}
//ログインしているが、そのグループに属していない場合もはじく
else{
    //▶グループのメンバーのuser_idを取得
    //DB接続
    $link = mysqli_connect(HOST,USER_ID,PASSWORD,DB_NAME);
    //sqlを設定する
    $sql = "SELECT user_id FROM room_member WHERE room_id =".$_GET['room_id'];
    //sqlを実行する
    $result = db_run($link,$sql);
    //フェッチ処理
    $member = get_data($result);
    //▶メンバーかどうかを確認する($flg…[0:メンバーでない][1:メンバーである])
    $flg = 0;
    foreach($member as $value){
        if($value['user_id'] == $_COOKIE['login']){
            $flg = 1;
        }
    }
    //▶メンバーでなければはじく
    if($flg == 0){
        header('location:./toppage.php');
        exit;
    }
}

//現在ログインしているユーザーの情報を取得
$link = mysqli_connect(HOST,USER_ID,PASSWORD,DB_NAME);
//sqlを設定する
$sql = "SELECT * FROM user WHERE id = " . $_COOKIE["login"];
//sqlを実行する
$result = db_run($link,$sql);
//フェッチ処理
$user_data = mysqli_fetch_assoc($result);
//================================
//●グループ情報の取得
//================================
//DB接続
$link = mysqli_connect(HOST,USER_ID,PASSWORD,DB_NAME);
//sqlを設定する
$sql = "SELECT room.name as 'group_name' , room.img_name as 'icon_img' , room.id as 'group_id' FROM room_member INNER JOIN room ON room_member.room_id = room.id WHERE room_member.user_id = ".$_COOKIE['login'] . " LIMIT 4";
//sqlを実行する
$result = db_run($link,$sql);
//フェッチ処理
$group_data = get_data($result);
if(!$group_data){
    $group_data = [];
}


require_once './tpl/'.basename(__FILE__);
?>