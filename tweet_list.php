<?php 
//設定ファイル読み込み
require_once '/xampp/tweet_inc/conf/const.php';
//関数ファイル読み込み
require_once '/xampp/tweet_inc/model/function.php';

$err_msg = array();

$tweet_list = array();


if (($link = get_db_connect()) === FALSE){
	$err_msg[] = 'コネクト失敗';
}

$tweet_list = get_tweet_table_list($link);

close_db_connect($link);

$tweet_list = entity_assoc_array($tweet_list);



//商品テンプレート読み込み
include_once '/xampp/tweet_inc/view/tweet_list.php';