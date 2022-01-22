<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/destyle.css"><!-- destyle -->
    <link rel="stylesheet" href="css/style.css"><!-- 共通css -->
    <link rel="stylesheet" href="css/group.css"><!-- 各ページの固有css -->
    <!-- Googel Font CDN -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- Google Icon CDN  Outlined-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <title>Group</title>
</head>
<body>
    <main id="contents_wrapper">
        <section id="left_column_contents">
            <section id="group_chat">
                <h2>Group Chat</h2>
                <div class="chat_box">
                    <div class="chat">
                        <div class="user">
                            <p class="img"><img src="" alt="icon"></p>
                            <p class="time">11:30</p>
                        </div>
                        <div class="text">
                            <div class="user_name">ユーザー名</div>
                            <p>おつー。<br>
                            そろそろネタ決めしたいよね？<br>
                            どっか教室借りてやらない？</p>
                            <p>明日とかどう？</p>
                        </div>
                    </div>
                    <div class="chat">
                        <div class="user">
                            <p class="img"><img src="" alt="icon"></p>
                            <p class="time">11:30</p>
                        </div>
                        <div class="text">
                            <div class="user_name">ユーザー名</div>
                            <p>いいね！やりましょう</p>
                        </div>
                    </div>
                    <div class="chat">
                        <div class="user">
                            <p class="img"><img src="" alt="icon"></p>
                            <p class="time">11:30</p>
                        </div>
                        <div class="text">
                            <div class="user_name">ユーザー名</div>
                            <p>スケジュールリクエスト<br>
                                ・タイトル<br>
                                「第一回ネタ会議」<br>
                                ・対象期間<br>
                                「2022/01/03~2022/01/10」<br>
                                ・説明<br>
                                「そろそろ、ネタ決めしたいのですが、全員対面で会える日決めませんか？」
                                </p>
                        </div>
                    </div>
                    <div class="chat you">
                        <div class="user">
                            <p class="time">11:30</p>
                        </div>
                        <div class="text">
                            <p>お疲れ。<br>
                                リクエスト確認しました。<br>
                                リマインド作成しておきます。</p>
                        </div>
                    </div>
                    <div class="chat">
                        <div class="user">
                            <p class="img"><img src="" alt="icon"></p>
                            <p class="time">11:30</p>
                        </div>
                        <div class="text">
                            <div class="user_name">ユーザー名</div>
                            <p>おつー。<br>
                            そろそろネタ決めしたいよね？<br>
                            どっか教室借りてやらない？</p>
                            <p>明日とかどう？</p>
                        </div>
                    </div>
                    <div class="chat">
                        <div class="user">
                            <p class="img"><img src="" alt="icon"></p>
                            <p class="time">11:30</p>
                        </div>
                        <div class="text">
                            <div class="user_name">ユーザー名</div>
                            <p>いいね！やりましょう</p>
                        </div>
                    </div>
                    <div class="chat">
                        <div class="user">
                            <p class="img"><img src="" alt="icon"></p>
                            <p class="time">11:30</p>
                        </div>
                        <div class="text">
                            <div class="user_name">ユーザー名</div>
                            <p>スケジュールリクエスト<br>
                                ・タイトル<br>
                                「第一回ネタ会議」<br>
                                ・対象期間<br>
                                「2022/01/03~2022/01/10」<br>
                                ・説明<br>
                                「そろそろ、ネタ決めしたいのですが、全員対面で会える日決めませんか？」
                                </p>
                        </div>
                    </div>
                    <div class="chat you">
                        <div class="user">
                            <p class="time">11:30</p>
                        </div>
                        <div class="text">
                            <p>お疲れ。<br>
                                リクエスト確認しました。<br>
                                リマインド作成しておきます。</p>
                        </div>
                    </div>

                    <div class="send_chat">
                        <textarea name="chat" id="" cols="30" rows="2"></textarea>
                        <div class="tools">
                            <button><span class="material-icons-outlined">send</span></button>
                            <button class="btn_grey"><span class="material-icons-outlined">event</span></button>
                        </div>
                    </div>
                </div>
            </section>
        </section>
        <section id="right_column_contents">
            <section>
                <div class="top_navis">
                    <button class="active"><span class="material-icons-outlined">person</span></button>
                    <button><span class="material-icons-outlined">groups</span></button>
                    <button><span class="material-icons-outlined">info</span></button>
                </div>
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
</body>
</html>