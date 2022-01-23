<?php
require_once './initial_setting.php';

$add_schedule_modal = 'none';
$block_modal = 'none';
//ダイアログがある時は表示する
$dialog = "";/* 内容 */
$dialog_visibility = "hidden";/* 表示 */
if(isset($_SESSION["dialog"])){
    $dialog = $_SESSION["dialog"];
    $dialog_visibility = "";
}

//カレンダーのボタン処理
$week_back = -1;
$week_next = 1;
$modf = "";
if(isset($_GET["week_change"])){
    $week_back = $_GET["week_change"] - 1;
    $week_next = $_GET["week_change"] + 1;
    $modf = $_GET["week_change"];
}

//ログアウトボタンが押されたとき
if(isset($_POST["logout"])){
    unset($_COOKIE["login"]);
    setcookie("login","",time() - 1000);
    header("location: ./toppage.php");
    exit;
}

//現在ログインしているユーザーの情報を取得
$link = mysqli_connect(HOST,USER_ID,PASSWORD,DB_NAME);
//sqlを設定する
$sql = "SELECT * FROM user WHERE id = " . $_COOKIE["login"];
//sqlを実行する
$result = db_run($link,$sql);
//フェッチ処理
$user_data = mysqli_fetch_assoc($result);

//現在ログインしているグループの情報を取得
$link = mysqli_connect(HOST,USER_ID,PASSWORD,DB_NAME);
//sqlを設定する
$sql = "SELECT * FROM room WHERE id = " . $_GET["room_id"];
//sqlを実行する
$result = db_run($link,$sql);
//フェッチ処理
$login_group = mysqli_fetch_assoc($result);
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
        $column = ['group_id','block_template_id','start','end'];
        $data = [];
        foreach($date_list as $value){
            $data[] = [$_GET['room_id'],$id,$value . ' ' . $_POST['start'],$value . ' ' . $_POST['end']];
        }
        $sql = create_insert_sql('block',$column,$data);
        //DBを実行
        $id = 1 + db_run_insert($link,$sql);
        $count = count($data);
        $block_id = $id - $count + 1;

        //=================================
        //●テンプレートからブロックを追加
        //=================================
        $personal_block = [];
        foreach($member as $value){
            for($i = 0; $i + $block_id <= $id; $i++){
                $personal_block[] = [$value['user_id'],$data[$i][0],$i + $block_id,$data[$i][3],$data[$i][4]];
            }
        }
        foreach($personal_block as $key => $value){
            //DB接続
            $link = mysqli_connect(HOST,USER_ID,PASSWORD,DB_NAME);
            //sqlを設定する
            $sql = "SELECT COUNT(*) AS 'result' FROM personal_schedule WHERE user_id = 13 AND NOT ((start < '" . $value[3] . "' AND end < '" . $value[3] . "') OR (start > '" . $value[4] . "' AND end > '" . $value[4] . "'))";
            //sqlを実行する
            $result = db_run($link,$sql);
            //フェッチ処理
            $count = get_data($result);
            if($count[0]['result'] > 0){
                $personal_block[$key][5] = 0;
            }
            else{
                $personal_block[$key][5] = 1;
            }
        }
        //DB接続
        $link = mysqli_connect(HOST,USER_ID,PASSWORD,DB_NAME);
        //クエリを作成
        $column = ['user_id','group_id','block_id','start','end','state'];
        $sql = create_insert_sql('personal_block',$column,$personal_block);
        //DBを実行
        $id2 = db_run_insert($link,$sql);
        //=================================
        //●集計
        //=================================
        for($i = 0; $i + $block_id <= $id; $i++){
            change_single_state($block_id + $i);
        }
    }else{
        $add_schedule_modal = 'display';
    }
}

require_once './tpl/'.basename(__FILE__);
?>