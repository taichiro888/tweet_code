<?php
/*
* ログインページ
*/

require_once '/xampp/tweet_inc/conf/const.php';
require_once '/xampp/tweet_inc/model/function.php';

session_start();

if (isset($_SESSION['user_id']) === TRUE) {

	header('Location: http://localhost/tweet_home.php');
	exit;
}

if (isset($_SESSION['login_err_flag']) === TRUE) {

	//ログインエラーフラグ取得
	$login_err_flag = $_SESSION['login_err_flag'];

	$_SESSION['login_err_flag'] = FALSE;
} else {
	$login_err_flag = FALSE;
}

if (isset($_COOKIE['email']) === TRUE) {
	$email = $_COOKIE['email'];
} else {
	$email = '';
}

$email = entity_str($email);

include_once '/xampp/tweet_inc/view/tweet_top.php';