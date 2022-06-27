<?php
    // $fullname = $email = $pwd = $msg = '';
    // if(!empty($_POST)){
    //     $fullname = getPost('fullname');
    //     $email = getPost('email');
    //     $pwd = getPost('password');

    //     // validate
    //     if(empty($fullname) || empty($email) || empty($pwd) || strlen($pwd) < 6){

    //     }
    //     else{
    //         $userExist = executeResult("select * from user where email = '$email'", true);
    //         // kiểm tra xem email đã được đăng ký chưa
    //         if($userExist != null){
    //             $msg = 'Email đã được đăng ký trên hệ thống';
    //         }
    //         // nesu chưa thì thực hiện insert
    //         else{
    //             $created_at = $updated_at = date('Y:m:d H:i:s');
    //             // Sử dụng mã hóa 1 chiều md5
    //             $pwd = getSecurityMD5($pwd);
    //             // $sql = "insert into user (fullname, email, password, role_id, created_at, updated_at, deleted) values ('$fullname', '$email', '$pwd', 2, '$created_at', '$updated_at', 0)";
    //             $sql = "insert into User (fullname, email, password, role_id, created_at, updated_at, deleted) values ('$fullname', '$email', '$pwd', 2, '$created_at', '$updated_at', 0)";
    //              execute($sql); 
    //              header('Location: login.php');
    //              die();
    //         }
    //     }
    // }

    // <?php

$fullname = $email = $msg = '';

if(!empty($_POST)) {
	$fullname = getPost('fullname');
	$email = getPost('email');
	$pwd = getPost('password');

	//validate
	if(empty($fullname) || empty($email) || empty($pwd) || strlen($pwd) < 6) {
	} else {
		//Validate thanh cong
		$userExist = executeResult("select * from User where email = '$email'", true);
		if($userExist != null) {
			$msg = 'Email đã được đăng ký trên hệ thống';
		} else {
			$created_at = $updated_at = date('Y-m-d H:i:s');
			//Su dung ma hoa 1 chieu -> md5 -> hack
			$pwd = getSecurityMD5($pwd);

			$sql = "insert into User (fullname, email, password, role_id, created_at, updated_at, deleted) values ('$fullname', '$email', '$pwd', 2, '$created_at', '$updated_at', 0)";
			execute($sql);
			header('Location: login.php');
			die();
		}
	}
}
