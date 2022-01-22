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
    <title>Top Page</title>
</head>
<body>
    <main id="contents_wrapper">
        <section id="left_column_contents">
            <?php if(!isset($_COOKIE["login"])){?>
            <section id="sign_box">
                <button class="btn full login" id="open_login_modal"><p>会員登録</p></button>
                <button class="btn full signin" id="open_signin_modal"><p>ログイン</p></button>
            </section><?php
            }else{ ?>
            <!-- アカウント -->
            <section id="account">
                <div class="account_box">
                    <img src="img/user/<?php print $user_data["id"] . "/" . $user_data["img_name"];?>" alt="アカウントアイコン">
                    <div class="profs">
                        <div>
                            <p class="name"><?php print $user_data["user_name"] ?></p>
                            <p class="id"><span>id:</span><?php print $user_data["login_id"] ?></p>
                        </div>
                        <form method="post"><button id="logout" name="logout">ログアウト</button></form>
                    </div>
                </div>
            </section>
            <!-- グループ -->
            <section id="groups">
                <h2>Schedule Group</h2>
                <div class="gorup_box">
                    <img src="" alt="グループアイコン">
                    <div class="box">
                        <p class="group_name">IH開発</p>
                        <p class="leader"><span>schedule leader:</span>矢野 昭介</p>
                        <p class="comment"><span>(今日)</span>Git勉強会&意見交換の日程について</p>
                    </div>
                </div>
                <div class="gorup_box">
                    <img src="" alt="グループアイコン">
                    <div class="box">
                        <p class="group_name">ときどき熊が来る島からの脱出「リアル脱出ゲーム」</p>
                        <p class="leader"><span>schedule leader:</span> 伊澤 聡真</p>
                        <p class="comment"><span>(1/31)</span>公演日の参加日程に関して</p>
                    </div>
                </div>
                <div class="gorup_box">
                    <img src="" alt="グループアイコン">
                    <div class="box">
                        <p class="group_name">ボードゲーム部</p>
                        <p class="leader"><span>schedule leader:</span>和田 有機</p>
                        <p class="comment"><span>(1/6)</span>ボードゲーム何する？</p>
                    </div>
                </div>
                <div class="gorup_box">
                    <img src="" alt="グループアイコン">
                    <div class="box">
                        <p class="group_name">ハッカソン</p>
                        <p class="leader"><span>schedule leader:</span>Canp運営_上野</p>
                        <p class="comment"><span>(2/12)</span>【新年１発目】SNSを盛り上げるWeb...</p>
                    </div>
                </div>
                <button class="btn btn-green icon_in full">Show more<span class="material-icons-outlined">slideshow</span></button>
            </section>
            <!-- To do -->
            <section id="todo">
                <h2>To Do</h2>
                <div class="task">
                    <p class="send_from">ハッカソン By 運営_上野</p>
                    <p class="closing_date">2022/01/17 締め切り</p>
                    <p class="comment">React × Firebaseの講習　2022/01/19 ～ 2022/01/28の日時希望を選択してください</p>
                </div>
                <div class="task">
                    <p class="send_from">ボードゲーム部</p>
                    <p class="closing_date">2022/01/15　17:00～</p>
                    <p class="comment">「チャオチャオ・ゴキブリポーカーで遊ぼう」がまもなくです。</p>
                </div>
                <div class="task">
                    <p class="send_from">ときどき熊が襲... By 伊澤 聡真</p>
                    <p class="closing_date">2022/01/17 締め切り</p>
                    <p class="comment">参加日時希望　2022/01/22 ～ 2022/02/23の日時希望を提出してください</p>
                </div>
                <div class="task">
                    <p class="send_from">IH開発</p>
                    <p class="closing_date">2022/01/17 締め切り</p>
                    <p class="comment">「第二回ネタ会議」がまもなくです。</p>
                </div>
                <button class="btn btn-green icon_in full">Show more<span class="material-icons-outlined">slideshow</span></button>
            </section>
        <?php } ?>
        </section>
        <!-- 右側 -->
        <section id="right_column_contents">
            <section>
                <?php if(isset($_COOKIE["login"])){?>
                <button class="btn btn-green icon_in" id="add_schedule_btn">Add Schedule<span class="material-icons-outlined">add_box</span></button>
                <?php } ?>
                <!-- カレンダー -->
                <div id="month"><button id="month_change"><span class="material-icons-outlined">arrow_back_ios_new</span>3月</button></div>
                <div id="schedule_board">
                    <div class="day_fixed"></div>
                    <div class="day_fixed">月</div>
                    <div class="day_fixed">火</div>
                    <div class="day_fixed">水</div>
                    <div class="day_fixed">木</div>
                    <div class="day_fixed">金</div>
                    <div class="day_fixed">土</div>
                    <div class="day_fixed">日</div>
                    <div class="day_fixed"></div>

                    <div class="day_col spacer"><button id="week_back"><span class="material-icons-outlined">arrow_back_ios_new</span></button></div>
                    <div class="day_col">1/17
                        <div class="schedule" style="top: 500px; height: 90px;">
                            <div class="title">IH12</div>
                            <div class="time">12:00~1:30</div>
                        </div>
                        <div class="schedule" style="top: 595px; height: 90px;">
                            <div class="title">IH12</div>
                            <div class="time">12:00~1:30</div>
                        </div>
                        <div class="schedule" style="top: 690px; height: 150px;">
                            <div class="title">IH12</div>
                            <div class="time">12:00~1:30</div>
                        </div>
                    </div>
                    <div class="day_col">1/18
                    </div>
                    <div class="day_col">1/19
                        <div class="schedule" style="top: 195px; height: 390px;">
                            <div class="title">IH12</div>
                            <div class="time">12:00~1:30</div>
                        </div>
                    </div>
                    <div class="day_col">1/20
                        <div class="schedule red" style="top: 390px; height: 150px;">
                            <div class="title">IH12</div>
                            <div class="time">12:00~1:30</div>
                        </div>
                    </div>
                    <div class="day_col">1/21
                    </div>
                    <div class="day_col">1/22
                    </div>
                    <div class="day_col">1/23
                    </div>
                    <div class="day_col spacer"><button id="week_next"><span class="material-icons-outlined">arrow_forward_ios</span></button></div>

                    <div class="hour_bg">
                        <div class="hour_row">0:00</div>
                        <div class="hour_row">1:00</div>
                        <div class="hour_row">2:00</div>
                        <div class="hour_row">3:00</div>
                        <div class="hour_row">4:00</div>
                        <div class="hour_row">5:00</div>
                        <div class="hour_row">6:00</div>
                        <div class="hour_row">7:00</div>
                        <div class="hour_row">8:00</div>
                        <div class="hour_row">9:00</div>
                        <div class="hour_row">10:00</div>
                        <div class="hour_row">11:00</div>
                        <div class="hour_row">12:00</div>
                        <div class="hour_row">13:00</div>
                        <div class="hour_row">14:00</div>
                        <div class="hour_row">15:00</div>
                        <div class="hour_row">16:00</div>
                        <div class="hour_row">17:00</div>
                        <div class="hour_row">18:00</div>
                        <div class="hour_row">19:00</div>
                        <div class="hour_row">20:00</div>
                        <div class="hour_row">21:00</div>
                        <div class="hour_row">22:00</div>
                        <div class="hour_row">23:00</div>
                        <div class="hour_row">24:00</div>
                    </div>
                </div>
            </section>
    </main>
    <?php //会員登録用モーダル ?>
    <div id="login_modal_wrapper" class="modal_wrapper <?php echo $login_modal ?>">
        <form id="login_modal" class="f_box modal_box" action="" method="post" enctype="multipart/form-data">
        <h2>新規 会員登録</h2>
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
    <!-- ログインモーダル -->
    <div id="signin_modal_wrapper" class="modal_wrapper <?php echo $signin_modal ?>">
        <form id="signin_modal" class="f_box modal_box" action="" method="post">
        <h2>ログイン</h2>
            <?php //閉じる用のアイコンボタン  ?>
            <span class="material-icons-outlined modal_close" id="signin_modal_close">cancel</span>
            <?php // 入力欄：「ログインID」 ?>
            <p class="f_error signin"><?php echo isset($error['signin_error']) ? $error['signin_error'] : ''; ?></p>
            <div class="f_container">
                <div class="f_title_parts">
                    <p class="f_title">ログインID</p>
                </div>
                <div class="f_input_parts">
                    <input class="f_input signin_form" type="text" name="signin_id">
                </div>
            </div>
            <?php // 入力欄：「パスワード」 ?>
            <div class="f_container">
                <div class="f_title_parts">
                    <p class="f_title">パスワード</p>
                </div>
                <div class="f_input_parts">
                    <input class="f_input signin_form" type="text" name="signin_password">
                </div>
            </div>
            <button class="f_submit" name="button" value="signin_submit">ログインする</button>
        </form>
    </div>
    <script src="./js/jquery-3.3.1.min.js"></script>
    <script src="./js/modal.js"></script>
    <script src="./js/img_display.js"></script>
    <script src="./js/key_forcus.js"></script>
</body>
</html>