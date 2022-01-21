<!DOCTYPE html>
<html lang = "ja">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="./../css/common.css">
   <link rel="stylesheet" href="./../css/input_form.css">
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css2?family=RocknRoll+One&display=swap" rel="stylesheet">
   <title>エラーが発生しました</title>
</head>
<body>
<?php if($_GET['code'] == '001'): ?>
    <h1>ERROR:DB接続に失敗しました</h1>
<?php elseif($_GET['code'] == '002'): ?>
    <h1>ERROR:SQLの実行に失敗しました</h1>
    <p>SQL文：<?php echo $_GET['sql']; ?></p>
<?php endif; ?>

</body>