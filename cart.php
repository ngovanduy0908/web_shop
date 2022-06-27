<?php
    require_once('layouts/header.php');
?>
<!-- Banner end -->
    <div class="container">
        <div class="row">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Thumbnail</th>
                        <th>Title</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Tổng giá</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(!isset($_SESSION['cart'])){
                            $_SESSION['cart'] = [];
                        }
                        $index = 0;
                        foreach($_SESSION['cart'] as $item){
                            echo '
                            <tr>
                                <td>'.++$index.'</td>
                                <td>
                                    <img src="'.$item['thumbnail'].'" alt="" style="height: 130px">                              
                                </td>
                                <td>'.$item['title'].'</td>
                                <td style="display: flex">
                                    <button onclick="addMoreCart('.$item['id'].',-1)" class="btn btn-light" style="border: 1px solid #ccc">-</button>
                                    <input onchange="fixCartNum('.$item['id'].')" type="number" id="num_'.$item['id'].'" value="'.$item['num'].'" class="form-control" style="width: 60px">   
                                    <button onclick="addMoreCart('.$item['id'].',1)" class="btn btn-light" style="border: 1px solid #ccc">+</button>
                                </td>
                                <td>'.number_format($item['discount']).'</td>
                                <td>'.number_format(($item['discount']) * $item['num']).'</td>
                                <td>
                                    <button onclick="updateCart('.$item['id'].',0)" class="btn btn-danger">Xóa</button>                            
                                </td>
                            </tr>
                            ';
                        }
                    ?>
                </tbody>
            </table>
            <a href="checkout.php">
                <button class="btn btn-danger" style="margin-bottom: 15px">Tiếp Tục Thanh Toán</button>
            </a>
        </div>
    </div>
    <script>
        function addMoreCart(id,delta){
            num = parseInt($('#num_' + id).val());
            num += delta;
            $('#num_' + id).val(num)
            updateCart(id, num)
        }
        function fixCartNum(id){
            $('#num_' + id).val(Math.abs($('#num_' + id).val()));
            updateCart(id, num)
            
        }


        function updateCart(productId, num) {
		$.post('api/ajax_request.php', {
			'action': 'update_cart',
			'id': productId,
			'num': num
		}, function(data) {
			location.reload()
		})
	}
    </script>
<?php
    require_once('layouts/footer.php');
?>