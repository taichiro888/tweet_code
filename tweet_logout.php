<?php

/*
* 	ログアウト処理
*
*/

require_once '/xampp/tweet_inc/conf/const.php';
require_once '/xampp/tweet_inc/model/function.php';

session_start();

$session_name = session_name();

$_SESSION = array();

if (isset($_COOKIE['$session_name'])) {
	setcookie($session_name, '', time() - 42000);
}

session_destroy();

header('Location: http://localhost/tweet_camp/login.php');
exit;