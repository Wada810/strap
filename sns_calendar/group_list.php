<?php 
require_once './initial_setting.php';

//モーダルの表示に関する変数
$create_group_modal = 'none';

if(isset($_POST['button']) && $_POST['button'] == 'submit'){
    //================================
    //●エラーチェック
    //================================

    //エラー文を格納する連想配列
    $error = [];
    //グループ名（未入力）
    $error['group_name'] = not_entered_check($_POST['group_name']);
    //メンバー（未選択）
    if(!isset($_POST['member_id'])){
        $error['group_member'] = 'メンバーを最低１人選んで下さい';
    }
    //画像（形式チェック）
    $error['icon_img'] = format_check($_FILES['file'],['jpg','jpeg','png']);

    if(error_count($error) == 0){
        //エラーがない場合

        //================================
        //●メンバーidで重複したものを取り除く
        //================================
        $member_id = array_unique($_POST['member_id']);

        //================================
        //●画像を保存
        //================================

        //●ディレクトリ作成の為のidを取得

        //DB接続
        $link = mysqli_connect(HOST,USER_ID,PASSWORD,DB_NAME);
        //sqlを設定する
        $sql = "select Max(id) + 1 as 'id' from room"; 
        //sqlを実行する
        $result = db_run($link,$sql);
        //フェッチ処理
        $id = get_data($result);
        //is_null
        if(is_null($id[0]['id'])){
            $id[0]['id'] = 1;
        }

        //●画像保存処理

        //日本語ファイルに対応するためにエンコードする
        $file_name = mb_convert_encoding($_FILES['file']['name'],'sjis','utf8');
        //ディレクトリの作成
        if(!(file_exists("./img/group/" . $id[0]['id']))){
           mkdir("./img/group/" . $id[0]['id']);
        }
        //ファイルパスを変数に格納
        $file_pass = './img/group/' . $id[0]['id'] . '/' . $file_name;
        //imgフォルダに画像を保存する
        move_uploaded_file($_FILES['file']['tmp_name'] , $file_pass );

        //================================
        //●データベースに登録 (room)
        //================================

        //--データベースに接続する
        $link = mysqli_connect(HOST,USER_ID,PASSWORD,DB_NAME);
        //--sqlを設定する
        $table = "room";
        $colomn = ["name","img_name"];
        $data = [$_POST["group_name"],$file_name];
        $sql = create_insert_sql($table,$colomn,$data);
        //--sqlを実行する
        $result = db_run($link,$sql);

        //================================
        //●メンバー保存用の配列を作成
        //================================
        foreach($_POST['member_id'] as $value){
            $in_room[] = [$id[0]['id'],$value];
        }

        //================================
        //●データベースに登録 (room_member)
        //================================

        //--データベースに接続する
        $link = mysqli_connect(HOST,USER_ID,PASSWORD,DB_NAME);
        //--sqlを設定する
        $table = "room_member";
        $colomn = ["room_id","user_id"];
        $data = $in_room;
        $sql = create_insert_sql($table,$colomn,$data);
        //--sqlを実行する
        $result = db_run($link,$sql);
        
    }
    else{
        //エラーがある場合
        $create_group_modal = 'display';
    }
}
else{
    $_POST['group_name'] = '';
}
require_once './tpl/'.basename(__FILE__);
?>