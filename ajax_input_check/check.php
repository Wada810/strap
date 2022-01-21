<?php
//特殊文字変換
function sp($str){
    return  htmlspecialchars($str,ENT_QUOTES | ENT_HTML5);
}

$response = [];


//名前の入力チェック
if(isset($_POST["name"])){
    if($_POST["name"] == ""){
        $response[0] = "入力してください";
        $response[1] = false;
    }else{
        $response[0] = "ok";
        $response[1] = true;
    }
    header("Content-Type: application/json; charset=utf-8");
    echo json_encode($response);
    exit;
}

//年の入力チェック
if(isset($_POST["birth_year"])){
    $year = mb_convert_kana($_POST["birth_year"],"n");
    if(!is_numeric($year)){
        $response[0] = "数値を入力してください";
        $response[1] = false;
    }else{
        $present = date("Y");
        if(1900 > $year || $year > $present){
            $response[0] = "有効な値を入力してください";
            $response[1] = false;
        }else{
            $response[0] = "ok";
            $response[1] = true;
        }
    }
    header("Content-Type: application/json; charset=utf-8");
    echo json_encode($response);
    exit;
}

//月の入力チェック
if(isset($_POST["birth_month"])){
    $month = mb_convert_kana($_POST["birth_month"],"n");
    if(!is_numeric($month)){
        $response[0] = "数値を入力してください";
        $response[1] = false;
    }else{
        if(1 > $month || $month > 12){
            $response[0] = "有効な値を入力してください";
            $response[1] = false;
        }else{
            $response[0] = "ok";
            $response[1] = true;
        }
    }
    header("Content-Type: application/json; charset=utf-8");
    echo json_encode($response);
    exit;
}
//日の入力チェック
if(isset($_POST["birth_day"])){
    $day = mb_convert_kana($_POST["birth_day"],"n");
    if(!is_numeric($day)){
        $response[0] = "数値を入力してください";
        $response[1] = false;
    }else{
        if(1 > $day || $day > 31){
            $response[0] = "有効な値を入力してください";
            $response[1] = false;
        }else{
            $response[0] = "ok";
            $response[1] = true;
        }
    }
    header("Content-Type: application/json; charset=utf-8");
    echo json_encode($response);
    exit;
}

//メールアドレスのチェック
//inputのtype="email"の仕様に基づく　参照　https://html.spec.whatwg.org/multipage/input.html#valid-e-mail-address
//正確にはRFC準拠でない（"'などが使えない.等についても考慮しない）
if(isset($_POST["email"])){
    $reg_email = "/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/";
    if(!preg_match($reg_email,$_POST["email"])){
        $response[0] = "有効なメールアドレスを入力してください";
        $response[1] = false;
    }else{
        $response[0] = "ok";
        $response[1] = true;
    }
    header("Content-Type: application/json; charset=utf-8");
    echo json_encode($response);
    exit;
}
?>