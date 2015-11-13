<?php

require_once '/xampp/tweet_inc/conf/const.php';
require_once '/xampp/tweet_inc/model/function.php';


$name    = '';
$tweet   = '';

$err_msg = array();

$request_method = get_request_method();



if($request_method === 'POST'){

	$name  = get_post_method('name');
	$tweet = get_post_method('tweet');
	
	$link = get_db_connect();

	if (insert_tweet_table($link,$name,$tweet) !== TRUE ){
				$err_msg[] = 'INSERT失敗';
		}

	close_db_connect($link);
	$name  = entity_str($name);
	$tweet = entity_str($tweet);

	if (count($err_msg) === 0){
		include_once '../htdocs/tweet_list.php';
		exit;
	}

	

} 

	

	


include_once '/xampp/tweet_inc/view/tweet_insert.php';

