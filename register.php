<?php
require_once '/xampp/tweet_inc/conf/const.php';
require_once '/xampp/tweet_inc/model/function.php';


$post_err = '';
$err_msg  = '';
$data = array();

if(get_request_method() === 'POST'){

session_start();

$_SESSION['err_msg'] = array();

	$user_name = get_post_method('user_name');
	if (empty($user_name)) {
		$_SESSION['err_msg'][] = '名前の入力されていません。';
	}

	$email = get_post_method('email');
	if(empty($email)) {
		$_SESSION['err_msg'][] = 'メールアドレスが入力されていません。';
	}

	$user_passwd = get_post_method('user_passwd');
	if(empty($user_passwd)){
		 $_SESSION['err_msg'][] = 'パスワードが入力されていません。';
	}

	$err_count = count($_SESSION['err_msg']);

	if($err_count > 0) {
		header('Location: http://localhost/tweet_camp/register_top.php');
		exit;
	}

	$link = get_db_connect();

	$sql = 'SELECT user_id FROM user_table WHERE email= \'' . $email . '\' ';
	$data = get_as_array($link,$sql);
	if(count($data) > 0){
		$_SESSION['err_msg'][] = 'メールアドレスがすでに使われております。';
		header('Location: http://localhost/tweet_camp/register_top.php');
		exit;

	} else {

		        $sql = 'INSERT INTO user_table(user_name,email,user_passwd) VALUES (\'' . $user_name . '\' , \'' . $email . '\' , \'' . $user_passwd . '\')';
				//INSERT実行
				if (insert_db($link,$sql) === FALSE){
					   $_SESSION['err_msg'] = 'INSERT失敗：';
					   header('Location: http://localhost/tweet_camp/register_top.php');
					   exit;
				}

					$sql = 'SELECT user_id FROM user_table WHERE email =\'' . $email . '\' AND user_passwd =\'' . $user_passwd . '\'' ;
					$data = get_as_array($link,$sql);
					close_db_connect($link);

				//SESSION変数にuser_idを代入
				if (empty($data[0]['user_id']) !== TRUE){

					$_SESSION['user_id'] = $data[0]['user_id'];
					header('Location: http://localhost/tweet_camp/home.php');
					exit;

				}

			}

} 






