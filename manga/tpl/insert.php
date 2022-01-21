<!DOCTYPE html>
<html lang="ja" theme="<?php print $theme;?>">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/destyle.css">
    <link rel="stylesheet" href="css/style_insert.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>新規追加</title>
</head>
<body>
    <section id="add_new_data">
        <div class="image">
            <h1>単行本情報登録</h1>
            <form method="post" enctype="multipart/form-data">
                <div class="input_box">
                    <label for="title">タイトル</label>
                    <input type="text" name="title" id="title" autocomplete="off" class="<?php print $vld["title"];?>" value="<?php print $value["title"];?>">
                    <div class="error_msg" id="title_vld_feedback"><?php print $err_msg["title"];?></div>
                </div>
                <div class="wrapper">
                    <div class="input_box">
                        <label for="volume">巻数</label>
                        <input type="text" name="volume" id="volume" autocomplete="off" class="<?php print $vld["volume"];?>" value="<?php print $value["volume"];?>"><span class="unit">巻</span>
                        <div class="error_msg" id="volume_vld_feedback"><?php print $err_msg["volume"];?></div>
                    </div>
                    <div class="input_box">
                        <label for="price">価格</label>
                        <input type="text" name="price" id="price" autocomplete="off" class="<?php print $vld["price"];?>" value="<?php print $value["price"];?>"><span class="unit">円</span>
                        <div class="error_msg" id="price_vld_feedback"><?php print $err_msg["price"];?></div>
                    </div>
                </div>
                <div class="wrapper">
                    <div class="input_box">
                            <label for="release_date">発売日</label>
                            <input type="text" name="release_date" id="release_date" placeholder="YYYYMMDD" autocomplete="off" class="<?php print $vld["release_date"];?>" value="<?php print $value["release_date"];?>">
                            <div class="error_msg" id="release_date_vld_feedback"><?php print $err_msg["release_date"];?></div>
                    </div>
                    <div class="input_box">
                            <label for="purchase_date">購入日（任意）</label>
                            <input type="text" name="purchase_date" id="purchase_date" placeholder="YYYYMMDD" autocomplete="off" class="<?php print $vld["purchase_date"];?>" value="<?php print $value["purchase_date"];?>">
                            <div class="error_msg" id="purchase_date_vld_feedback"><?php print $err_msg["purchase_date"];?></div>
                    </div>
                </div>
                <div class="file">
                        <label for="cover_img">表紙画像（任意）</label>
                        <label id="alt_area">
                            <img id="preview" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==">
                            <div id="drug_drop">
                                <span class="material-icons">image</span>
                                <p>ファイルをドラッグ＆ドロップ</p>
                                <p class="accept">JPG, PNG, GIF</p>
                            </div>
                            <input type="file" name="cover_img" id="cover_img" placeholder="YYYYMMDD" autocomplete="off" class="<?php print $vld["cover_img"];?>" value="<?php print $value["cover_img"];?>">
                        </label>
                        <label for="cover_img"><span id="select_img">画像を選択する</span></label>
                        <div class="error_msg" id="cover_img_vld_feedback"><?php print $err_msg["cover_img"];?></div>
                </div>
                <div class="button_box">
                    <button class="cancel" name="btn_state" value="cancel">キャンセル</button>
                    <button class="submit" name="btn_state" value="submit">登録する</button>
                </div>
            </form>
        </div>
    </section>
    <script src="js/script_insert.js"></script>
</body>
</html>