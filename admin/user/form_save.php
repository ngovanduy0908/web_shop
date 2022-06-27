<?php
    $msg = $fullname = $email = $phone_number = $address = $role_id = '';
    if(!empty($_POST)){
        $id = getPost('id');
        $fullname = getPost('fullname');
        $email = getPost('email');
        $password = getPost('password');
        if($password != ''){
            $password = getSecurityMD5($password);
        }
        $address = getPost('address');
        $role_id = getPost('role_id');
        $phone_number = getPost('phone_number');
        $created_at = $updated_at = date('Y-m-d H:i:s');
        
        if($id > 0){
            $sql = "select * from user where email = '$email' and id <> $id";
            $userItem = executeResult($sql, true);
            // update
            if($userItem != null){
                $msg = 'Email này đã tồn tại trong tài khoản khác, vui lòng kiểm tra lại';
            }
            else{
                if($password != ''){
                    $sql = "update user set fullname = '$fullname', email = '$email', phone_number = '$phone_number', address = '$address', password = '$password', created_at = '$created_at', role_id = $role_id where id = $id";
                }
                else{
                    $sql = "update user set fullname = '$fullname', email = '$email', phone_number = '$phone_number', address = '$address', created_at = '$created_at', role_id = $role_id where id = $id";
                }
                execute($sql);
                header('Location: index.php');
                die();
            }
        }
        else{
            $sql = "select * from user where email = '$email'";
            $userItem = executeResult($sql, true);
            if($userItem == null){
                $sql = "insert into user (fullname, email, phone_number, address, password, role_id, created_at, updated_at, deleted) values ('$fullname', '$email', '$phone_number', '$address', '$password', '$role_id', '$created_at', '$updated_at', 0)";
                // $sql = "insert into User (fullname, email, phone_number, address, password, role_id, created_at, updated_at, deleted) values ('$fullname', '$email', '$phone_number', '$address', '$password', '$role_id', '$created_at', '$updated_at', 0)";
                execute($sql);
                header('Location: index.php');
                die();
            }
            else{
                $msg = 'Email đã được đăng ký. Vui lòng kiểm tra lại';
            }
        }
    }