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
        case 'mark':
            markRead();
            # code...
            break;
        case 'delete':
            deleteFeedback();
            # code...
            break;
            
    }
}

function markRead(){
    $id = getPost('id');
    $updated_at = date('Y-m-d H:i:s');
    $sql = "update feedback set status = 1, updated_at = '$updated_at' where id = $id";
    execute($sql);
}

function deleteFeedback(){
    $id = getPost('id');
    $sql = "delete from feedback where id = $id";
    execute($sql);
}