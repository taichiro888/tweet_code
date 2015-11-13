<?php

require_once '/xampp/tweet_inc/conf/const.php';
require_once '/xampp/tweet_inc/model/function.php';

$err_msg = array();

session_start();

if(isset($_SESSION['err_msg']) === TRUE){
	$err_msg[] = $_SESSION['err_msg'];
}




include '/xampp/tweet_inc/view/register_top.php';