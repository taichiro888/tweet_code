<?php 

require_once '/xampp/tweet_inc/conf/const.php';
require_once '/xampp/tweet_inc/model/function.php';

if (get_request_method() !== 'POST') {

	header('Location: http://localhost/tweet_top');
	exit;

}

	session_start();

	$email  = get_post_data('email');
	$passwd = get_post_data('passwd');

	setcookie('email',$email,time() + 60 * 60 * 24 * 365);


	$link = get_db_connect();

		$sql = 'SELECT user_id FROM user_table WHERE email=\'' . $email . '\' . AND passwd = \'' . $passwd . '\'';
		$data = get_as_array($link,$sql);

	close_db_conncet($link);

		if(isset($data[0]['user_id'])) {

			$_SESSION['user_id'] = $data[0]['user_id'];
			header('Location: http://localhost/tweet_home.php ');
			exit;
		} else {

			$_SESSION['login_err_flag'] = TRUE;
			header('Location: http://localhost/tweet_top.php');
			exit;
		}
	

 
 function get_as_array($link,$sql){

 	$data = array();

 	if($result = mysqli_query($link,$sql)){

 		if(mysqli_num_rows($result) > 0){

 			while($row = mysqli_fetch($result)){

 				$data[] = $row;
 			}

 		}	
 	}

 	return $data;
 }