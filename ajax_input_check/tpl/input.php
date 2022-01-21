<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>入力</title>
</head>
<body>
<form>
    <h5 class="mb-4">非同期通信でリアルタイムに入力値のチェック</h5>
    <div class="row">
        <div class="col">
            <label for="formGroupExampleInput" class="form-label">名前</label>
            <input type="text" name="name" class="form-control" id="form_name" autocomplete="off">
            <div id="name_vld_feedback" class="invalid-feedback"></div>
        </div>
    </div>

    <div class="row">
        <p class="mb-1">生年月日</p>
        <div class="col-6">
            <label for="form_year" class="form-label">年</label>
            <input type="text" name="birth_year" class="form-control" id="form_year" autocomplete="off" placeholder="YYYY 01990とか困る">
            <div id="year_vld_feedback" class="invalid-feedback"></div>
        </div>
        <div class="col-3">
            <label for="form_month" class="form-label">月</label>
            <input type="text" name="birth_month" class="form-control" id="form_month" autocomplete="off" placeholder="MM">
            <div id="month_vld_feedback" class="invalid-feedback"></div>
        </div>
        <div class="col-3">
            <label for="form_day" class="form-label">日</label>
            <input type="text" name="birth_day" class="form-control" id="form_day" autocomplete="off" placeholder="DD">
            <div id="day_vld_feedback" class="invalid-feedback"></div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <label for="form_email" class="form-label">メールアドレス</label>
            <input type="text" name="email" class="form-control" id="form_email" autocomplete="off" placeholder="example@sample.com">
            <div id="email_vld_feedback" class="invalid-feedback"></div>
        </div>
    </div>
</form>

<script src="script.js"></script>
</body>
</html>