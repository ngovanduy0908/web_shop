<?php
  session_start();
  require_once('../../utils/utility.php');
  require_once('../../database/dbhelper.php');

$user = getUserTokens();
if($user == null){
  die();
}

if(!empty($_POST)){
   
    $action = getPost('action');
    switch ($action) {
        case 'delete':
            deleteUser();
            # code...
            break;
        
    }
}

function deleteUser(){
    $id = getPost('id');
    $updated_at = date('Y-m-d H:i:s');
    $sql = "update user set deleted = 1, updated_at = '$updated_at' where id = $id";
    echo $sql;
    execute($sql);
}