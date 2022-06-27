<?php
    require_once('layouts/header.php');
?>
<!-- Banner end -->
    <div class="container">
        <div class="row" style="margin: 20px 0">
            <div class="col-md-6">

                <form method="post" onsubmit="return completeCheckout();">
					<div class="form-group">
					  <label for="usr">Họ & Tên:</label>
					  <input required="true" type="text" class="form-control" id="usr" name="fullname">
					</div>

					<div class="form-group">
					  <label for="email">Email:</label>
					  <input required="true" type="email" class="form-control" id="email" name="email">
					</div>

					<div class="form-group">
					  <label for="phone_number">Số ĐIện Thoại:</label>
					  <input required="true" type="tel" class="form-control" id="phone_number" name="phone_number">
					</div>

                    <div class="form-group">
					  <label for="address">Địa Chỉ:</label>
					  <input required="true" type="text" class="form-control" id="address" name="address">
					</div>

                    <div class="form-group">
					  <label for="">Nội Dung Ghi Chú:</label>
					  <textarea name="" id="" cols="30" rows="3" class="form-control"></textarea>
					</div>

				
				</form>
            </div>

            <div class="col-md-6" style="margin-top: 25px">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Title</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>Tổng giá</th>
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
                                   
                                    <td>'.$item['title'].'</td>
                                    <td>
                                        '.$item['num'].'     
                                    </td>
                                    <td>'.number_format($item['discount']).' VNĐ</td>
                                    <td>'.number_format(($item['discount']) * $item['num']).' VNĐ</td>
                                </tr>
                                ';
                            }
                        ?>
                    </tbody>
                </table>
                <a href="checkout.php">
                    <button class="btn btn-success" style="margin-bottom: 15px; width: 100%">Thanh Toán</button>
                </a>
            </div>
            
        </div>
    </div>

    <script>
        function completeCheckout(){
            $.post('api/ajax_request.php', {
                'action': 'checkout',
                'fullname': $('[name=fullname]').val();
                'email': $('[name=email]').val();
                'address': $('[name=address]').val();
                'phone_number': $('[name=phone_number]').val();
                'note': $('[name=note]').val();


            },function(){
                window.open('complete.php', '_self');
            })
            return false;
        }
    </script>
<?php
    require_once('layouts/footer.php');
?>