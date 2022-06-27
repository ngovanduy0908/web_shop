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
            deleteCategory();
            # code...
            break;
        
    }
}

function deleteCategory(){
    $id = getPost('id');
    $sql = "select count(*) as total from product where category_id = $id and deleted = 0";
    $data = executeResult($sql, true);
    $total = $data['total'];
    if($total > 0){
        echo 'Danh mục đang chứa các sản phẩm, không được xóa';
        die();
    }
    $sql = "delete from category where id = $id"; 
    execute($sql);
}