<?php
require_once './initial_setting.php';
//モーダルの表示に関する変数
$login_modal = 'none';
$signin_modal = 'none';
$add_schedule_modal = 'none';

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
if(isset($_COOKIE["login"])){
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

    //現在ログインしているユーザーのスケジュールカテゴリを取得
    $link = mysqli_connect(HOST,USER_ID,PASSWORD,DB_NAME);
    //sqlを設定する
    $sql = "SELECT DISTINCT category FROM personal_schedule_template WHERE user_id = " . $_COOKIE["login"];
    //sqlを実行する
    $result = db_run($link,$sql);
    //フェッチ処理
    $schedule_category_list = get_data($result);

    // スケジュール追加ボタンが押されたとき
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
            //DB接続
            $link = mysqli_connect(HOST,USER_ID,PASSWORD,DB_NAME);

            //クエリを作成
            $title = escape($link,$_POST["title"]);
            $explanation = escape($link,$_POST["explanation"]);
            $sql = "INSERT INTO personal_schedule_template (user_id, title, explanation, start, end, repeat_every, repeat_frequency, end_repeat, category,created_at)
            VALUES (" . $_COOKIE["login"] . ", '" . $title . "', '" . $explanation . "', '" . $_POST["start"] . "', '" . $_POST["end"] . "', '" . $_POST["repeat_every"] . "', '" . $_POST["repeat_frequency"] . "', '" . $_POST["end_repeat"] . "', '" . $_POST["category"] . "','" . date("Y-m-d") . "')";

            $result = db_run($link,$sql);
            embody_schedule();
            //ダイアログsession
            $_SESSION["dialog"] = "スケジュールを追加しました。";
            header("location: ./toppage.php");
            exit;
        }else{
            $add_schedule_modal = 'display';
        }
    }
}else{
    //////////非ログイン時の登録＆ログイン処理///////////////////////////////////
    if(isset($_POST['button']) && $_POST['button'] == "submit"){
        $_POST['signin_id'] = '';
        $_POST['signin_password'] = '';
        //================================
        //●エラーチェック
        //================================

        //エラー文を格納する連想配列
        $error = [];

        //ログインID（未入力、被りのチェック）
        $link = mysqli_connect(HOST,USER_ID,PASSWORD,DB_NAME);
        $error['login_id'] = login_id_check($link,'user',$_POST['login_id']);
        //氏名（未入力）
        $error['name'] = not_entered_check($_POST['name']);
        //パスワード（未入力、パターン）
        $error['password'] = password_check($_POST['password'],6,'A-Za-z0-9',['A-Za-z','0-9']);
        //確認用パスワード（一致・不一致チェック）
        $error['check_password'] = password_check_check($_POST['password'],$_POST['check_password']);
        //画像（形式チェック）
        $error['icon_img'] = format_check($_FILES['file'],['jpg','jpeg','png']);
        //エラーがない場合
        if(error_count($error) == 0){
            //================================
            //●パスワードのハッシュ化
            //================================
            //ソルトの生成
            $salt = uniqid();
            //ストレッチの回数を決める
            $stretch = mt_rand(1000,10000);
            //ハッシュ化
            $hashed_potato = salt_hash($stretch,$salt,$_POST['password']);
            //================================
            //●画像を保存
            //================================

            //●ディレクトリ作成の為のidを取得

            //DB接続
            $link = mysqli_connect(HOST,USER_ID,PASSWORD,DB_NAME);
            //sqlを設定する
            $sql = "select Max(id) + 1 as 'id' from user";
            //sqlを実行する
            $result = db_run($link,$sql);
            //フェッチ処理
            $id = get_data($result);

            //●画像保存処理

            //日本語ファイルに対応するためにエンコードする
            $file_name = mb_convert_encoding($_FILES['file']['name'],'sjis','utf8');
            //ディレクトリの作成
            if(!(file_exists("./img/user/" . $id[0]['id']))){
               mkdir("./img/user/" . $id[0]['id']);
            }
            //ファイルパスを変数に格納
            $file_pass = './img/user/' . $id[0]['id'] . '/' . $file_name;
            //imgフォルダに画像を保存する
            move_uploaded_file($_FILES['file']['tmp_name'] , $file_pass );

            //================================
            //●データベースに登録
            //================================

            //--データベースに接続する
            $link = mysqli_connect(HOST,USER_ID,PASSWORD,DB_NAME);
            //--sqlを設定する
            $table = "user";
            $colomn = ["user_name","login_id","hashed_pass","salt","stretch","img_name"];
            $data = [$_POST["name"],$_POST["login_id"],$hashed_potato,$salt,$stretch,$file_name];
            $sql = create_insert_sql($table,$colomn,$data);
            //--sqlを実行する
            $result = db_run($link,$sql);

            //================================
            //●画面遷移
            //================================
            header('location:./toppage.php');
            exit;
        }
        //エラーがあった場合
        else{
            //モーダルを表示するクラスに切り替える
            $login_modal = 'display';
        }
    }elseif(isset($_POST['button']) && $_POST['button'] == "signin_submit"){
        $_POST['login_id'] = '';
        $_POST['name'] = '';
        $_POST['password'] = '';
        $_POST['check_password'] = '';
        //どちらかが空白
        if($_POST["signin_id"] == "" || $_POST["signin_password"] == ""){
            $error["signin_error"] = "ユーザーIDもしくはパスワードが間違っています。";
            $signin_modal = 'display';
            require_once './tpl/'.basename(__FILE__);
            exit;
        }
        //DB接続
        $link = mysqli_connect(HOST,USER_ID,PASSWORD,DB_NAME);
        //ログインIDと一致するユーザーデータを取得
        $sql = "select * FROM user WHERE login_id = '" . $_POST['signin_id'] . "'";
        $result = db_run($link,$sql);
        $user_data = get_data($result);
        if(!$user_data){
            $error["signin_error"] = "ユーザーIDもしくはパスワードが間違っています。";
            $signin_modal = 'display';
            require_once './tpl/'.basename(__FILE__);
            exit;
        }
        $user_data = $user_data[0];
        //入力れたパスワードとユーザーデータでハッシュを生成
        $hash = salt_hash($user_data["stretch"],$user_data["salt"],$_POST['signin_password']);
        //ハッシュの一致を確認
        if($hash != $user_data["hashed_pass"]){
            $error["signin_error"] = "ユーザーIDもしくはパスワードが間違っています。";
            $signin_modal = 'display';
            require_once './tpl/'.basename(__FILE__);
            exit;
        }
        $expire = time() + 60 * 60 * 24 * 7;//1週間
        setcookie("login",$user_data["id"],$expire);
        header("location: ./toppage.php");
        exit;
    }else{
        $_POST['login_id'] = '';
        $_POST['name'] = '';
        $_POST['password'] = '';
        $_POST['check_password'] = '';
        $_POST['signin_id'] = '';
        $_POST['signin_password'] = '';
    }
}
require_once './tpl/'.basename(__FILE__);
?>