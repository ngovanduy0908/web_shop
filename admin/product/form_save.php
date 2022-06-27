<?php
if(!empty($_POST)){
    $id = getPost('id');
    $title = getPost('title');
    $price = getPost('price');
    $discount = getPost('discount');
    $description = getPost('description');
    $thumbnail = getPost('thumbnail');
    $category_id = getPost('category_id');
    $created_at = $updated_at = date('Y-d-m H:i:s');

    if($id > 0){
        $sql = "update product set thumbnail = '$thumbnail', title = '$title', price = '$price', discount = '$discount', category_id = '$category_id', description = '$description', updated_at = '$updated_at' where id = $id";
        execute($sql);
        header('Location: index.php');
        die();
    }
    else{
        $sql = "insert into product (thumbnail, title, price, discount, description, category_id, created_at, updated_at, deleted)
         values ('$thumbnail', '$title', '$price', '$discount', '$description', '$category_id', '$created_at', '$updated_at', 0)";
         execute($sql);
         header('Location: index.php');
         die();
    }
}