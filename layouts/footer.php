<footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h4>GIỚI THIỆU</h4>
                    <ul>
                        <li>LIÊN HỆ CÔNG TY CỔ PHẦN ZICZAC GROUP</li>
                        <li><i class="bi bi-mailbox2"></i>: duyngo090801@gmail.com</li>
                        <li><i class="bi bi-phone"></i>: 0342517826</li>
                        <li>Chúng tôi luôn tiên phong trong lĩnh vực xậy dựng website cho các doanh nghiệp và của hàng. Chúng tôi luôn nỗ lực để tạo ra sản phẩm có chất lượng tốt nhất cho khách hàng.</li>
                    </ul>
                </div>

                <div class="col-md-4">
                    <h4>SẢN PHẨM MỚI</h4>
                    <ul>
                        <li>QUẦN KHAKI NAM</li>
                        <li>ÁO SƠ MI NAM DÀI TAY KẺ CARO</li>
                        <li>ÁO POLO NAM</li>
                        <li>QUẦN SHORTS NAM</li>
                        <li>ÁO PHÔNG NAM IN TO</li>
                    </ul>
                </div>

                <div class="col-md-4">
                    <h4>TIN TỨC MỚI NHẤT</h4>
                    <ul>
                        <li>QUẦN KHAKI NAM</li>
                        <li>ÁO SƠ MI NAM DÀI TAY KẺ CARO</li>
                        <li>ÁO POLO NAM</li>
                        <li>QUẦN SHORTS NAM</li>
                        <li>ÁO PHÔNG NAM IN TO</li>
                    </ul>
                </div>
            </div>
        </div>
        <div style="background-color: #3f9609; padding: 10px">
            <p style="margin: 0; text-align: center; font-weight: 500; font-size: 15px">copy right 3D1H</p>
        </div>
    </footer>

    <?php
        if(!isset($_SESSION['cart'])){
            $_SESSION['cart'] = [];
        }
        // var_dump($_SESSION['cart']);
        $count = 0;
        foreach($_SESSION['cart'] as $item){
            $count += $item['num'];
        }
    ?>
    <script>
        function addCart(productId, num) {
		$.post('api/ajax_request.php', {
			'action': 'cart',
			'id': productId,
			'num': num
		}, function(data) {
			location.reload()
		})
	}
    </script>
    <!-- Cart start -->
        <span class="cart_icon">
            <a href="cart.php">
                <img src="https://gokisoft.com/img/cart.png" alt="">
            </a>
            <span class="cart_count"><?=$count?></span>
        </span>
    <!-- Cart stop -->
</body>
</html>