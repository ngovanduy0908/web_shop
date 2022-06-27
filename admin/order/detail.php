<?php
	$title = 'Thông Tin Chi Tiết Đơn Hàng';
	$baseUrl = '../';
	require_once('../layouts/header.php');
    $orderId = getGet('id');

	// $sql = "select User.*, Role.name as role_name from User left join Role on User.role_id = Role.id where User.deleted = 0";
	$sql = "select order_details.*, product.title, product.thumbnail from order_details, product where product.id = order_details.product_id and order_details.order_id = $orderId";
	$data = executeResult($sql);

    $sql = "select * from orders where id = $orderId";
    $orderItem = executeResult($sql, true);
    
?>

<div class="row" style="margin-top: 20px;">
    <div class="col-md-12">
        <h3>Chi Tiết Đơn Hàng</h3>
    </div>
	<div class="col-md-7 table-responsive">

		<table class="table table-bordered table-hover" style="margin-top: 20px;">
			<thead>
				<tr>
					<th>STT</th>
					<th>Thumbnail</th>
					<th>Tên Sản Phẩm</th>
					<th>Giá</th>
					<th>Số Lượng</th>
					<th>Tổng Giá</th> 
				</tr>
			</thead>
			<tbody>
<?php
	$index = 0;
	foreach($data as $item) {
		echo '<tr>
					<td>'.(++$index).'</td>
					<td>
                        <img src="'.$item['thumbnail'].'" alt="" style="height: 120px">
                    </td>
					<td>'.$item['title'].'</td>
					<td>'.number_format($item['price']).' VNĐ</td>
					<td>'.$item['num'].'</td>
					<td>'.number_format($item['total_money']).' VNĐ</td>

				</tr>';
	}
?>
            <tr>
                <td>Tổng tiền</td>
                <td><?=number_format( $orderItem['total_money'])?> VNĐ</td>
            </tr>
			</tbody>
		</table>

	</div>
    <div class="col-md-5">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Họ Và Tên</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Số Điện Thoại</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?=$orderItem['fullname']?></td>
                    <td><?=$orderItem['email']?></td>
                    <td><?=$orderItem['address']?></td>
                    <td><?=$orderItem['phone_number']?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php
	require_once('../layouts/footer.php');
?>