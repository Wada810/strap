<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/destyle.css"><!-- destyle -->
    <link rel="stylesheet" href="css/style.css"><!-- 共通css -->
    <link rel="stylesheet" href="css/group.css"><!-- 各ページの固有css -->
    <link rel="stylesheet" href="css/modal.css"><!-- モーダルのcss -->
    <link rel="stylesheet" href="css/form.css"><!-- フォームのcss -->
    <!-- Googel Font CDN -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- Google Icon CDN  Outlined-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <title>Group</title>
</head>
<body>
    <div id="dialog" class="<?php print $dialog_visibility;?>"><?php print $dialog;?><span class="material-icons-outlined" id="dialog_close">close</span></div>
    <header>
        <ul>
            <li><a href="toppage.php">個人スケジュール</a></li>
            <li class="active"><a>グループスケジュール</a></li>
        </ul>
    </header>
    <main id="contents_wrapper">
        <section id="left_column_contents">
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
                <?php foreach($group_data as $val){?>
                    <a href="group.php?room_id=<?php print $val["group_id"] ?>" class="gorup_box">
                        <img src="./img/group/<?php echo $val['group_id']; ?>/<?php echo $val['icon_img']; ?>" alt="グループアイコン">
                        <div class="box">
                            <p class="group_name"><?php print $val["group_name"] ?></p>
                        </div>
                    </a><?php
                } ?>
                <a href="./group_list.php" class="btn btn-green icon_in full">Show more<span class="material-icons-outlined">slideshow</span></a>
            </section>
        </section>
        <section id="right_column_contents">
            <section>
                <div class="top_navis">
                    <button><a href="group.php?room_id=<?php print $_GET["room_id"] ?>"><span class="material-icons-outlined">person</span></a></button>
                    <button class="active"><a href="group2.php?room_id=<?php print $_GET["room_id"] ?>"><span class="material-icons-outlined">groups</span></a></button>
                    <button><a href="group3.php?room_id=<?php print $_GET["room_id"] ?>"><span class="material-icons-outlined">info</span></a></button>
                </div>
                <button class="btn btn-green icon_in" id="open_add_schedule_modal">Add Schedule<span class="material-icons-outlined">add_box</span></button>
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
                    </div>
                    <div class="day_col">1/18
                    </div>
                    <div class="day_col">1/19
                    </div>
                    <div class="day_col">1/20
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
        </section>
    </main>
    <div id="add_schedule_modal_wrapper" class="modal_wrapper <?php echo $add_schedule_modal ?>">
        <form id="add_schedule_modal" class="f_box modal_box" method="post">
        <h2>スケジュールブロックを追加する</h2>
            <?php //閉じる用のアイコンボタン  ?>
            <span class="material-icons-outlined modal_close" id="add_schedule_modal_close">cancel</span>
                <!--入力欄：タイトル-->
                <div class="f_container_opt">
                    <div class="f_title_parts">
                        <p class="f_title">タイトル</p>
                    </div>
                    <div class="f_input_parts">
                        <input class="f_input" type="text" name="title" value="">
                    </div>
                    <div class="f_discription_parts">
                        <p class="f_error"><?php echo isset($error['title']) ? $error['title'] : ''; ?></p>
                    </div>
                </div>
                <!--入力欄：開始時間の選択-->
                <div class="f_container_opt">
                    <div class="f_title_parts">
                        <p class="f_title">開始時間の選択</p>
                    </div>
                    <div class="f_input_parts">
                        <input class="f_input" type="time" name="start" value="">
                    </div>
                    <div class="f_discription_parts">
                        <p class="f_error"><?php echo isset($error['start']) ? $error['start'] : ''; ?></p>
                    </div>
                </div>
                <!--入力欄：終了時間の選択-->
                <div class="f_container_opt">
                    <div class="f_title_parts">
                        <p class="f_title">終了時間の選択</p>
                    </div>
                    <div class="f_input_parts">
                        <input class="f_input" type="time" name="end" value="">
                    </div>
                    <div class="f_discription_parts">
                        <p class="f_error"><?php echo isset($error['end']) ? $error['end'] : ''; ?></p>
                    </div>
                </div>
                <div class="hr"></div>
                <!--入力欄：繰り返し-->
                <div class="f_container_opt">
                    <div class="f_title_parts">
                        <p class="f_title">繰り返しの単位</p>
                    </div>
                    <div class="f_input_parts">
                        <select class="f_input" name="repeat_every" id="repeat_every">
                            <option value="no" selected>しない</option>
                            <option value="days">毎日</option>
                            <option value="weeks">毎週</option>
                            <option value="months">毎月</option>
                            <option value="yeas">毎年</option>
                        </select>
                    </div>
                    <div class="f_discription_parts">
                        <p class="f_error"></p>
                    </div>
                </div>
                <!--入力欄：繰り返し-->
                <div class="f_container_opt hidden repeat">
                    <div class="f_title_parts">
                        <p class="f_title">繰り返しの頻度</p>
                    </div>
                    <div class="f_input_parts">
                        <select class="f_input" name="repeat_frequency" id="repeat_frequency">
                        </select>
                    </div>
                    <div class="f_discription_parts">
                        <p class="f_error"></p>
                    </div>
                </div>
                <!--入力欄：終了日時の設定-->
                <div class="f_container_opt hidden repeat">
                    <div class="f_title_parts">
                        <p class="f_title">繰り返しの終了日</p>
                    </div>
                    <div class="f_input_parts">
                        <input class="f_input" type="date" name="end_repeat" value="">
                    </div>
                    <div class="f_discription_parts">
                        <p class="f_error"><?php echo isset($error['end_repeat']) ? $error['end_repeat'] : ''; ?></p>
                    </div>
                </div>
                <div class="hr"></div>
                <!--入力欄：終了日時の設定-->
                <div class="f_container_opt">
                    <div class="f_title_parts">
                        <p class="f_title">スケジュールカテゴリ</p>
                    </div>
                    <div class="f_input_parts">
                        <input class="f_input" type="text" name="category" value="" list="schedule_category">
                        <datalist id="schedule_category">
                            <?php
                            foreach($schedule_category_list as $val){?>
                                <option value="<?php print $val["category"]?>"></option><?php
                            }
                            ?>
                        </datalist>
                    </div>
                    <div class="f_discription_parts">
                    </div>
                </div>
                <div class="submit_box"><button class="btn btn-green" name="button" value="add_schedule">ブロックを追加する</button></div>
        </form>
    </div>
    <script src="./js/jquery-3.3.1.min.js"></script>
    <script src="./js/modal.js"></script>
    <script src="./js/key_forcus.js"></script>
    <script src="./js/add_schedule.js"></script>
    <script src="./js/dialog.js"></script>
    <script src="./js/personal_schedule.js"></script>
</body>
</html>