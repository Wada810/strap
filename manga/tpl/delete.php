<!DOCTYPE html>
<html lang="ja" theme="<?php print $theme;?>">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/destyle.css">
    <link rel="stylesheet" href="css/style_delete.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>削除</title>
</head>
<body>
<section>
    <div class="center"><span class="material-icons">delete_forever</span></div>
    <h1>データの削除</h1>
    <p>以下のデータを削除します。本当によろしいですか？</p>
    <div class="data">
        <img src="<?php print $src; if($src !== "data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==") print '?' . filemtime($src);?>">
        <div>
            <h2>タイトル</h2>
            <div><?php print $value["title"];?></div>
        </div>
        <div>
            <h2>巻数</h2>
            <div><?php print $value["volume"];?>巻</div>
        </div>
        <div>
            <h2>価格</h2>
            <div><?php print $value["price"];?>円</div>
        </div>
        <div>
            <h2>発売日</h2>
            <div><?php print conv_date_jp($value["release_date"]);?></div>
        </div>
        <div>
            <h2>購入日</h2>
            <div class="pd"><?php  print  ($value["purchase_date"] !== NULL)? conv_date_jp($value["purchase_date"]): "&ndash;";?></div>
        </div>
    </div>
    <form method="post" action="delete.php">
        <div>
            <input type="hidden" name="id" value="<?php print $id;?>">
            <button class="cancel" name="btn_state" value="cancel">中止する</button>
            <button class="delete" name="btn_state" value="delete">削除する</button>
        </div>
    </form>
</section>
</body>
</html>