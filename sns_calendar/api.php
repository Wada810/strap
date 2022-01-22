<?php

//作業完了のダイアログを管理するセッションを確認次第けす。
if(isset($_POST["dialog"]) && $_POST["dialog"] == "close"){
    session_start();
    unset($_SESSION["dialog"]);
    exit;
}
