<?php
//セッションを有効化
session_start();
//定数の呼び出し
require_once './const.php';
require_once './function/error/c_error.php';
//関数の呼び出し
require_once './function/error/f_error.php';
require_once './function/f_database.php';
require_once './function/my_functions.php';
require_once './function/f_pager.php';
require_once './function/f_login.php';
require_once './function/f_image_edit.php';
require_once './function/func_wada.php';
//ヘッダー部処理の呼び出し
/* require_once './header.php'; */
?>