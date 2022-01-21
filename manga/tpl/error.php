<!DOCTYPE html>
<html lang="ja" theme="<?php print $theme;?>">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/destyle.css">
    <link rel="stylesheet" href="css/style_error.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Error</title>
</head>
<body>
<section>
    <span class="material-icons">error</span>
    <h1>ERROR!</h1>
    <img src="img/shadow.png" alt="sonic">
    <p><?php @print $err;?>
    </p>
    <form method="post">
        <button class="link">やり直す</button>
    </form>
    <a href="list.php" class="link">一覧へ戻る</a>
</section>
</body>
</html>