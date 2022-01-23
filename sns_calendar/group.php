<?php
require_once './initial_setting.php';

$add_schedule_modal = 'none';

if(isset($_POST['room_id'])){
    $_GET['room_id'] = $_POST['room_id'];
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

//======================================
//●ブロック追加処理
//======================================
if(isset($_POST['button']) && $_POST['button'] == "add_schedule"){
    //================================
    //●エラーチェック
    //================================

    //エラー文を格納する連想配列
    $error = [];

    //(未入力)
    $error['title'] = not_entered_check($_POST['title']);
    $error['start'] = not_entered_check($_POST['start']);
    $error['end'] = not_entered_check($_POST['end']);
    if($_POST["repeat_every"] != "no"){
        $error['end_repeat'] = not_entered_check($_POST['end_repeat']);
        $today = new DateTime();
        $end_repeat = new DateTime($_POST['end_repeat']);
        if($today > $end_repeat){
            $error["end_repeat"] = DATE_INVALID;
        }
    }
    //日付の妥当性チェック
    if($_POST["start"] > $_POST["end"]){
        $error["start"] = TIME_INVALID;
        $error["end"] = TIME_INVALID;
    }

    //エラーがない場合
    if(error_count($error) == 0){
        //=================================
        //●テンプレートに追加
        //=================================

        //DB接続
        $link = mysqli_connect(HOST,USER_ID,PASSWORD,DB_NAME);
        //クエリを作成
        $title = escape($link,$_POST["title"]);
        $column = ['group_id','title','start','end','repeat_every','repeat_frequency','end_repeat','created_at'];
        $data = [$_GET['room_id'],$title,$_POST['start'],$_POST['end'],$_POST['repeat_every'],$_POST['repeat_frequency'],$_POST['end_repeat'],date("Y-m-d")];
        $sql = create_insert_sql('block_template',$column,$data);
        //DBを実行
        $id = db_run_insert($link,$sql);

        //=================================
        //●テンプレートからブロックを追加
        //=================================
        $date_list = get_date_list($_POST['repeat_every'],$_POST['repeat_frequency'],$_POST['end_repeat']);

        //DB接続
        $link = mysqli_connect(HOST,USER_ID,PASSWORD,DB_NAME);
        //クエリを作成
        $column = ['group_id','block_template_id','title','start','end'];
        $data = [];
        foreach($date_list as $value){
            $data[] = [$_GET['room_id'],$id,$title,$value . ' ' . $_POST['start'],$value . ' ' . $_POST['end']];
        }
        $sql = create_insert_sql('block',$column,$data);
        //DBを実行
        $id = db_run_insert($link,$sql);

    }else{
        $add_schedule_modal = 'display';
    }
}

require_once './tpl/'.basename(__FILE__);
?>