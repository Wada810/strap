<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/destyle.css"><!-- destyle -->
    <link rel="stylesheet" href="css/style.css"><!-- 共通css -->
    <link rel="stylesheet" href="css/group.css"><!-- 各ページの固有css -->
    <link rel="stylesheet" href="css/group_list.css"><!-- 各ページの固有css -->
    <link rel="stylesheet" href="css/modal.css"><!-- モーダルのcss -->
    <link rel="stylesheet" href="css/form.css"><!-- フォームのcss -->
    <!-- Googel Font CDN -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- Google Icon CDN  Outlined-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <!-- Font Awesome CDN  Outlined-->
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <header>
        <ul>
            <li><a href="toppage.php">個人スケジュール</a></li>
            <!-- <li><a href="group.php">グループスケジュール</a></li> -->
        </ul>
    </header>
    <main id="contents_wrapper">
        <section id="left_column_contents">
            <section>
                <div id="group_add_section">
                    <h2>
                        Create <br>
                        New Group
                    </h2>
                    <p>
                    プロジェクトチームや休日の予定調整を <br>
                    グループ単位で管理することができます <br>
                    メンバーをチームに招待するには <br>
                    相手のログインidを教えてもらう必要が <br>
                    あります
                    </p>
                    <button id="open_create_group_modal" class="btn btn-green icon_in full">Create!!<span class="material-icons-outlined">add_circle</span></button>
                </div>
            </section>
        </section>
        <section id="right_column_contents">
            <section>
                <h1 id="contents_title">Shedule Group</h1>
                <div id="group_list_container">
                    <?php foreach($group_data as $key => $value): ?>
                        <a id="group_list" href="./group.php?room_id=<?php echo $value['group_id']; ?>">
                            <div class='group_box'>
                                <div class='left_group_box'>
                                    <img src="./img/group/<?php echo $value['group_id']; ?>/<?php echo $value['icon_img']; ?>" alt="">
                                </div>
                                <div class='right_group_box'>
                                    <h3 class="group_title"><?php echo $value['group_name']; ?></h3>
                                    <div class="group_member_box_container">
                                        <p class="member_title">Member</p>
                                        <div class="group_member_box">
                                            <?php foreach($members[$key] as $value): ?>
                                                <p class="group_member_icon"><img src="./img/user/<?php echo $value['user_id']; ?>/<?php echo $value['img_name']; ?>" alt=""></p>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <p>resent talk contents</p>
                                    </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </section>
        </section>
    </main>
    <?php //グループ作成用モーダル ?>
    <div id="create_group_modal_wrapper" class="modal_wrapper <?php echo $create_group_modal ?>">
        <form id="create_group_modal" class="f_box modal_box" action="" method="post" enctype="multipart/form-data">
            <?php //タイトル ?>
            <h2 class="f_big_title">グループを作成する</h2>
            <br>
            <br>
            <br>
            <?php //閉じる用のアイコンボタン  ?>
            <span class="material-icons-outlined modal_close" id="create_group_modal_close">cancel</span>
            <?php // 入力欄：「グループ名」 ?>
            <h2 class="f_big_title">グループ名</h2>
            <p><input class="f_input login_form f_inputsize_creategroup" type="text" name="group_name" value="<?php echo $_POST['group_name']; ?>"></p>
            <p class="f_error gl_unique_parts2"><?php echo isset($error['group_name']) ? $error['group_name'] : ''; ?></p>
            <?php // 入力欄：「グループメンバー」 ?>
            <h2 class="f_big_title">グループメンバー</h2>
            <p>
                <input class="f_input login_form f_inputsize_creategroup gl_unique_parts1" type="text" name="user_search" value="">
                <p class="f_error gl_unique_parts2"><?php echo isset($error['group_member']) ? $error['group_member'] : ''; ?></p>
                <div id='candidate'>
                    <div class="candidate_box">
                    </div>
                </div>
            </p>
            <div class="select_display_area" id="select_display_area">
            </div>
            <?php // 入力欄：「アイコン画像」 ?>
            <div class="f_input_parts f_center">
                <div class="f_img_display_2"><img id="display_img" class="f_display_img" src="./img/jpg/human.jpg" alt=""></div>
                <label class="f_file_button">画像をアップロード<input id="file" type="file" name="file"></label>
                <div id="selected_file" class="f_selected_file">ファイルが選択されていません</div>
            </div>
            <div class="f_discription_parts f_center">
                <p class="f_explanation">対応ファイル形式：「png」「jpg」「jpeg」のいずれか</p>
                <p class="f_error"><?php echo isset($error['icon_img']) ? $error['icon_img'] : ''; ?></p>
            </div>
            <br>
            <br>
            <button class="f_submit" name="button" value="submit">会員登録を行う</button>
        </form>
    </div>
    <script src="./js/jquery-3.3.1.min.js"></script>
    <script src="./js/modal.js"></script>
    <script src="./js/img_display.js"></script>
    <script src="./js/key_forcus.js"></script>
    <script src="./js/user_search.js"></script>
</body>
</html>