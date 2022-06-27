<?php
    require_once('layouts/header.php');
    $sql = "select product.*, category.name as category_name from product, category where product.category_id = category.id and product.deleted = 0 order by product.updated_at desc limit 0,8";
    $lastestItem = executeResult($sql);
?>
    <!-- Banner start -->
    <div id="demo" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ul class="carousel-indicators">
            <li data-target="#demo" data-slide-to="0" class="active"></li>
            <li data-target="#demo" data-slide-to="1"></li>
            <li data-target="#demo" data-slide-to="2"></li>
        </ul>

        <!-- The slideshow -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://t004.gokisoft.com/uploads/2021/07/1-s-1634-banner-web.jpg" alt="Los Angeles">
            </div>
            <div class="carousel-item">
                <img src="https://t004.gokisoft.com/uploads/2021/07/2-s-1634-banner-web.jpg" alt="Chicago">
            </div>
            <div class="carousel-item">
                <img src="https://t004.gokisoft.com/uploads/2021/07/3-s-1634-banner-web.jpg" alt="New York">
            </div>
        </div>

        <!-- Left and right controls -->
        <a class="carousel-control-prev" href="#demo" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#demo" data-slide="next">
            <span class="carousel-control-next-icon"></span>
        </a>

    </div>
<!-- Banner end -->
    <div class="container">
        <h1 style="text-align: center; margin: 20px 0">Sản Phẩm Mới Nhất</h1>
        <div class="row">
            <?php
                foreach($lastestItem as $item){
                    echo '
                        <div class="col-md-3 col-6 product-item">
                            <a href="detail.php?id='.$item['id'].'">                          
                                <img src="'.$item['thumbnail'].'" alt="" style="width: 100%">
                            </a>

                            <p style="font-weight: bold">'.$item['category_name'].'</p>
                            <a href="detail.php?id='.$item['id'].'">                          
                                <p>'.$item['title'].'</p>
                            </a>
                            
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
        <!-- Hiển thị sản phẩm theo danh từng danh mục -->
    <?php
    $count = 0;
        foreach($menuItem as $item){
            $sql = "select product.*, category.name as category_name from product, category where product.category_id = category.id and product.deleted = 0 and product.category_id = ".$item['id']." order by product.updated_at desc limit 0,4";
            $items = executeResult($sql);
            if($items == null || count($items) < 4){
                continue;
            }
    ?>
    <div style="background-color: <?=($count++ % 2 == 0)? '#f5f6f7' : ''?>">
        <div class="container">
            <h1 style="text-align: center; margin: 20px 0"><?=$item['name']?></h1>
            <div class="row">
                <?php
                    foreach($items as $pItem){
                        echo '
                            <div class="col-md-3 col-6 product-item">
                                <a href="detail.php?id='.$item['id'].'">                          
                                    <img src="'.$pItem['thumbnail'].'" alt="" style="width: 100%">
                                </a>
                                <p style="font-weight: bold">'.$pItem['category_name'].'</p>
                                <p>'.$pItem['title'].'</p>
                                <p style="color: red">'.number_format($pItem['discount']).' VNĐ</p>
                                <p>
                                    <button class="btn btn-success btn-sm" onclick="addCart('.$item['id'].', 1)">Thêm Vào Giỏ Hàng</button>                           
                                </p>
                            </div>               
                        ';
                    }
                ?>
            </div>
        </div>
    </div>
    <?php
        }
    ?>
    
<?php
    require_once('layouts/footer.php');
?>