<?php

require_once '/xampp/tweet_inc/conf/const.php';
require_once '/xampp/tweet_inc/model/function.php';

$user_name = 'toriko';
$email     = 'nimoi@gmail.com';
$user_passwd    = 'god';
$err_msg   =  array();


	$link = get_db_connect();
	$sql = 'SELECT user_id FROM user_table WHERE email= \'' . $email . '\' ';
	$data = get_as_array($link,$sql);
			if(count($data) > 0){
				$err_msg[] = 'メールアドレスがすでに使われております。';
			} else {

					$sql = 'INSERT INTO user_table(user_name,email,user_passwd) VALUES (\'' . $user_name . '\' , \'' . $email . '\' , \'' . $user_passwd . '\')';
					if (insert_db($link,$sql) !== TRUE){
						$err_msg[] = 'INSERT失敗：';
					} else {
						$err_msg[] = 'INSERT成功：';
					}

					$sql = 'SELECT user_id FROM user_table WHERE email =\'' . $email . '\' AND user_passwd =\'' . $user_passwd . '\'' ;
					$data = get_as_array($link,$sql);
					close_db_connect($link);

					

				}
			

foreach($err_msg as $value) {

	print $value;
}




