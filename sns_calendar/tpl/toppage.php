<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/destyle.css"><!-- destyle -->
    <link rel="stylesheet" href="css/style.css"><!-- 共通css -->
    <link rel="stylesheet" href="css/style.css"><!-- 各ページの固有css -->
    <link rel="stylesheet" href="css/modal.css"><!-- モーダルのcss -->
    <link rel="stylesheet" href="css/form.css"><!-- フォームのcss -->
    <!-- Googel Font CDN -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- Google Icon CDN  Outlined-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <main id="contents_wrapper">
        <section id="left_column_contents">
            <section id="account"></section>
            <section id="groups"></section>
            <section id="todo"></section>
        </section>
        <section id="right_column_contents">
            <section id="schedule_board"></section>
        </section>
    </main>
    <?php //会員登録用モーダル表示ボタン ?>
    <p id="open_login_modal">会員登録</p>
    <?php //会員登録用モーダル ?>
    <div id="login_modal_wrapper" class="modal_wrapper <?php echo $login_modal ?>">
        <form id="login_modal" class="f_box modal_box" action="" method="post" enctype="multipart/form-data">
            <?php //閉じる用のアイコンボタン  ?>
            <span class="material-icons-outlined modal_close" id="login_modal_close">cancel</span>
            <?php // 入力欄：「ログインID」 ?>
            <div class="f_container">
                <div class="f_title_parts">
                    <p class="f_required">必須</p>
                    <p class="f_title">ログインID</p>
                </div>
                <div class="f_input_parts">
                    <input class="f_input login_form" type="text" name="login_id" value="<?php echo $_POST['login_id']; ?>">
                </div>
                <div class="f_discription_parts">
                    <p class="f_explanation">他のユーザーと被らないユニークなIDを入力してください　<span></span></p>
                    <p class="f_error"><?php echo isset($error['login_id']) ? $error['login_id'] : ''; ?></p>
                </div>
            </div>
            <?php // 入力欄：「氏名」 ?>
            <div class="f_container">
                <div class="f_title_parts">
                    <p class="f_required">必須</p>
                    <p class="f_title">氏名</p>
                </div>
                <div class="f_input_parts">
                    <input class="f_input login_form" type="text" name="name" value="<?php echo $_POST['name']; ?>">
                </div>
                <div class="f_discription_parts">
                    <p class="f_error"><?php echo isset($error['name']) ? $error['name'] : ''; ?></p>
                </div>
            </div>
            <?php // 入力欄：「パスワード」 ?>
            <div class="f_container">
                <div class="f_title_parts">
                    <p class="f_required">必須</p>
                    <p class="f_title">パスワード</p>
                </div>
                <div class="f_input_parts">
                    <input class="f_input login_form" type="text" name="password" value="<?php echo $_POST['password']; ?>">
                </div>
                <div class="f_discription_parts">
                    <p class="f_explanation">半角ファイル角数字を組み合わせた6文字以上のパスワードを設定してください</p>
                    <p class="f_error"><?php echo isset($error['password']) ? $error['password'] : ''; ?></p>
                </div>
            </div>
            <?php // 入力欄：「確認用パスワード」 ?>
            <div class="f_container">
                <div class="f_title_parts">
                    <p class="f_required">必須</p>
                    <p class="f_title">確認用パスワード</p>
                </div>
                <div class="f_input_parts">
                    <input id="end_form" class="f_input login_form" type="text" name="check_password" value="<?php echo $_POST['check_password']; ?>">
                </div>
                <div class="f_discription_parts">
                    <p class="f_error"><?php echo isset($error['check_password']) ? $error['check_password'] : ''; ?></p>
                </div>
            </div>
            <?php // 入力欄：「アイコン画像」 ?>
            <div class="f_container">
                <div class="f_title_parts">
                    <p class="f_required">必須</p>
                    <p class="f_title">アイコン画像</p>
                </div>
                <div class="f_input_parts">
                    <div class="f_img_display"><img id="display_img" class="f_display_img" src="./img/jpg/human.jpg" alt=""></div>
                    <label class="f_file_button">画像をアップロード<input id="file" type="file" name="file"></label>
                    <div id="selected_file" class="f_selected_file">ファイルが選択されていません</div>
                </div>
                <div class="f_discription_parts">
                    <p class="f_explanation">対応ファイル形式：「png」「jpg」「jpeg」のいずれか</p>
                    <p class="f_error"><?php echo isset($error['icon_img']) ? $error['icon_img'] : ''; ?></p>
                </div>
            </div>
            <button class="f_submit" name="button" value="submit">会員登録を行う</button>
        </form>
    </div>
    <script src="./js/jquery-3.3.1.min.js"></script>
    <script src="./js/modal.js"></script>
    <script src="./js/img_display.js"></script>
    <script src="./js/key_forcus.js"></script>
</body>
</html>