"use strict";

//idで指定した要素をPOSTで非同期通信しチェックする
//引数(チェックする要素のiｄ,チェックする要素のname属性の値,メッセージが入る要素のid)
function input_check (target,name,feedback){
    var req = new XMLHttpRequest();
    req.onreadystatechange = function (){
        var result = document.getElementById(feedback);
        if(req.readyState == 4){//通信の完了時
            if(req.status == 200){//通信の成功時
                console.log(req.response);
                let json_response = JSON.parse(req.response);
                result.innerHTML = json_response[0];//feedbackを表示する
                //クラスの切り替え
                if(json_response[1]){
                    document.getElementById(target).classList.remove("is-invalid");
                    document.getElementById(target).classList.add("is-valid");
                }else{
                    document.getElementById(target).classList.remove("is-valid");
                    document.getElementById(target).classList.add("is-invalid");
                }
            }
        }else{
            req.innerHTML = "通信中...";
        }
    }
    req.open("POST","check.php",true);
    req.setRequestHeader('content-type',
    'application/x-www-form-urlencoded;charset=UTF-8');
    req.send(name + "=" + encodeURIComponent(document.getElementById(target).value));
}

//form_nameに入力されたら非同期通信を随時行い入力値をチェックする
//リクエストの量を減らすために
//文字入力後一定時間が経過したら非同期通信を開始する
let wait = 500;//ミリ秒後に送信する
let timeid_name;
document.getElementById("form_name").addEventListener("keyup",() => {
    clearTimeout(timeid_name);
    timeid_name = setTimeout(() => {
        input_check("form_name","name","name_vld_feedback");
    },wait);
})

//年に入力された
let timeid_year;
document.getElementById("form_year").addEventListener("keyup",() => {
    clearTimeout(timeid_year);
    timeid_year = setTimeout(() => {
        input_check("form_year","birth_year","year_vld_feedback");
    },wait);
})

//月に入力された
let timeid_month;
document.getElementById("form_month").addEventListener("keyup",() => {
    clearTimeout(timeid_month);
    timeid_month = setTimeout(() => {
        input_check("form_month","birth_month","month_vld_feedback");
    },wait);
})

//日に入力された
let timeid_day;
document.getElementById("form_day").addEventListener("keyup",() => {
    clearTimeout(timeid_day);
    timeid_day = setTimeout(() => {
        input_check("form_day","birth_day","day_vld_feedback");
    },wait);
})

//メールアドレスが入力された
let timeid_email;
document.getElementById("form_email").addEventListener("keyup",() => {
    clearTimeout(timeid_email);
    timeid_email = setTimeout(() => {
        input_check("form_email","email","email_vld_feedback");
    },wait);
})