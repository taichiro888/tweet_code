<?php

require_once '/xampp/tweet_inc/conf/const.php';
require_once '/xampp/tweet_inc/model/function.php';

session_start();

if (isset($_SESSION['user_id']) === TRUE){
	$user_id = $_SESSION['user_id'];
} else {
	header('Location: http://localhost/tweet_camp/tweet_login.php');
	exit;
}

$link = get_db_connect();


$sql = 'SELECT user_name FROM user_table WHERE user_id = \'' . $user_id . '\' ';

$data = get_as_array($link,$sql);

$sql = 'SELECT tweet FROM tweet_table';
$tweet_list = get_tweet_table_list($link);

close_db_connect($link);

if (isset($data[0]['user_name']) === TRUE){

	$user_name = $data[0]['user_name'];
} else {
	$err_msg[] = 'アカウントが見つからないため、もう一度ログインしなおしてください。';
}

include_once '/xampp/tweet_inc/view/home.php';