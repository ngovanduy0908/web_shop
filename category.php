<?php
    require_once('layouts/header.php');
    $category_id = getGet('id');
    if($category_id == null || $category_id == ''){
        $sql = "select product.*, category.name as category_name from product, category where product.category_id = category.id and product.deleted = 0  order by product.updated_at desc limit 0,8";
    }
    else{
        $sql = "select product.*, category.name as category_name from product, category where product.category_id = category.id and product.deleted = 0 and product.category_id = $category_id  order by product.updated_at desc limit 0,8";
    }
    $lastestItem = executeResult($sql);
?>
<!-- Banner end -->
    <div class="container">
        <div class="row">
            <?php
                foreach($lastestItem as $item){
                    echo '
                        <div class="col-md-3 col-6 product-item">
                            <a href="detail.php?id='.$item['id'].'">                          
                                <img src="'.$item['thumbnail'].'" alt="" style="width: 100%">
                            </a>
                            <p style="font-weight: bold">'.$item['category_name'].'</p>
                            <p>'.$item['title'].'</p>
                            <p style="color: red">'.number_format($item['discount']).' VNĐ</p>
                            <p>
                                <button class="btn btn-success btn-sm" onclick="addCart('.$item['id'].', 1)">Thêm Vào Giỏ Hàng</button>                           
                            </p>
                        </div>               
                    ';
                }
            ?>
        </div>
    </div>
    
<?php
    require_once('layouts/footer.php');
?>