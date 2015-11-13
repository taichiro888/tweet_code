<?php 

require_once '/xampp/tweet_inc/model/function.php';
require_once '/xampp/tweet_inc/conf/const.php';


session_start();

$email = get_post_method('email');
$passwd = get_post_method('passwd');

setcookie('email' ,$email,time() + 60 * 60 * 24 * 365);

$link = get_db_connect();

$sql = 'SELECT user_id FROM user_table
		WHERE email=\'' . $email . '\' AND user_passwd = \'' . $user_passwd . '\'';

$data = get_as_array($link,$sql);

close_db_connect();

if (isset($data[0]['user_id'])) {

	$_SESSION['user_id'] = $data[0]['user_id'];

	header('Location: http://localhost/tweet_camp/home.php');
	exit;
} else {
	$_SESSION['login_err_flag'] = TRUE;
	header('Location: http://localhost/tweet_camp/login.php');
	exit;
}