<?php 
//----------------------------------------------------
//●データベース処理
//----------------------------------------------------
require_once './initial_setting.php';

//--データベースに接続する
$link = mysqli_connect(HOST,USER_ID,PASSWORD,DB_NAME);
//--sqlを設定する
$sql = "select * from user where login_id LIKE '%" . $_POST['user_id'] . "%'";
//--sqlを実行する
$result = db_run($link,$sql);
//--フェッチ処理
$experition_data = get_data($result);

echo json_encode($experition_data);
?>