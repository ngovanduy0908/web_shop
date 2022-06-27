<?php
    require_once('layouts/header.php');
    $productId = getGet('id');
    $sql = "select Product.*, Category.name as category_name from Product left join Category on Product.category_id = Category.id where Product.id = $productId";
    // $sql = "select product.*, category.name as category_name from product, category where product.category_id = category.id and product.deleted = 0 and product.id = $product_id";
    $product = executeResult($sql, true);

    $category_id = $product['category_id'];
    $sql = "select Product.*, Category.name as category_name from Product left join Category on Product.category_id = Category.id where Product.category_id = $category_id order by Product.updated_at desc limit 0,4";
    // $sql = "select product.*, category.name as category_name from product, category where product.category_id = category.id and product.deleted = 0 and product.category_id = $category_id  order by product.updated_at desc limit 0,4";
    $lastestItem = executeResult($sql);
?>
<!-- Banner end -->
<style>
    li{
        margin: 0 5px;
    }
    .rating i{
        color: orange;
    }
</style>
    <div class="container">
        <div class="row">
            <div class="col-md-6" style="margin: 15px 0">
                <img src="<?=$product['thumbnail']?>" alt="" style="width: 100%">
            </div>
            <div class="col-md-6">
                <ul style="display:flex">
                    <li><a href="index.php">Trang chủ</a></li>
                    <li><a href="category.php?id=<?=$category_id?>"><?=$product['category_name']?></a></li>
                    <li><?=$product['title']?></li>
                </ul>
                <p class="rating">
                    <span style="color: orange">5.0</span>
                    <span>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    </span>
                </p>
                <p style="font-size: 25px; color: red; display: inline-block">
                    <?=number_format($product['discount'])?> VNĐ
                </p>

                <p style="font-size: 20px; text-decoration-line: line-through; display: inline-block">
                    <?=number_format($product['price'])?> VNĐ
                </p>

                <!-- Tăng giảm số lượng -->
                <div style="display: flex">
                    <button onclick="addMoreCart(-1)" class="btn btn-light" style="border: 1px solid #ccc">-</button>
                    <input onchange="fixCartNum()" type="number" name="num" class="form-control" step="1" value="1" style="max-width: 80px">
                    <button onclick="addMoreCart(1)" class="btn btn-light" style="border: 1px solid #ccc">+</button>
                </div>

        
                <button class="btn btn-success" style="margin-top: 15px; width: 100%; font-size: 25px" onclick="addCart(<?=$product['id']?>, $('[name=num]').val())"><i class="bi bi-cart-plus" style="margin-right: 3px"></i>Thêm Vào Giỏ Hàng</button>
                <button class="btn" style="margin-top: 15px; width: 100%; font-size: 25px; background: #ccc"><i class="bi bi-bookmark-heart" style="margin-right: 3px"></i>Yêu Thích</button>
            </div>
            <div class="col-md-12" style="margin-top: 20px">
                <h3>Chi Tiết Sản Phẩm</h3>
                <?=$product['description']?>
            </div>
        </div>
    </div>
    <div class="container">
        <h1 style="text-align: center; margin: 20px 0">Sản Phẩm Liên Quan</h1>

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
    <script>
        function addMoreCart(delta){
            num = parseInt($('[name=num]').val());
            num += delta;
            if(num < 1){
                num = 1;
            }
            $('[name=num]').val(num)
        }
        function fixCartNum(){
            $('[name=num]').val(Math.abs($('[name=num]').val()));
        }
    </script>
<?php
    require_once('layouts/footer.php');
?>