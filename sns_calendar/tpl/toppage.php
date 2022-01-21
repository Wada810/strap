<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/destyle.css"><!-- destyle -->
    <link rel="stylesheet" href="css/style.css"><!-- 共通css -->
    <link rel="stylesheet" href="css/style.css"><!-- 各ページの固有css -->
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
            <section id="account">
                <div class="account_box">
                    <img src="" alt="アカウントアイコン">
                    <div class="profs">
                        <div>
                            <p class="name">沖　美奈子</p>
                            <p class="id"><span>id:</span>oki_it_1201</p>
                        </div>
                        <p id="logout">ログアウト</p>
                    </div>
                </div>
            </section>
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
        </section>
        <section id="right_column_contents">
            <section>
                <button class="btn btn-green icon_in" id="add_schedule_btn">Add Schedule<span class="material-icons-outlined">add_box</span></button>
                <div id="schedule_board">
                    <div class="day_col"></div>
                    <div class="day_col">1/17<div>(Mon)</div>
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
                    <div class="day_col">1/18<div>(Tue)</div>
                        <div class="schedule" style="top: 195px; height: 390px;">
                            <div class="title">IH12</div>
                            <div class="time">12:00~1:30</div>
                        </div>
                    </div>
                    <div class="day_col">1/19<div>(Wed)</div>
                    </div>
                    <div class="day_col">1/20<div>(Thu)</div>
                        <div class="schedule red" style="top: 390px; height: 150px;">
                            <div class="title">IH12</div>
                            <div class="time">12:00~1:30</div>
                        </div>
                    </div>
                    <div class="day_col">1/21<div>(Fri)</div>
                    </div>
                    <div class="day_col">1/22<div>(Sat)</div>
                    </div>
                    <div class="day_col">1/23<div>(Sun)</div>
                    </div>

                    <div class="hour_bg">
                        <div class="hour_row top"></div>
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