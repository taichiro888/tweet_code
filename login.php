<?php

require_once '/xampp/tweet_inc/conf/const.php';
require_once '/xampp/tweet_inc/model/function.php';

session_start();

if (isset($_SESSION['user_id']) === TRUE) {

	header('Location: http://localhost/tweet_camp/home.php');
	exit;
}

if (isset($_COOKIE['email']) === TRUE) {
	$email = $_COOKIE['email'];
} else {
	$email = '';
}

$email = entity_str($email);

include_once '/xampp/tweet_inc/view/login.php';