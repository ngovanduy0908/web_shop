<?php
	$title = 'Quản Lý Đơn Hàng';
	$baseUrl = '../';
	require_once('../layouts/header.php');

	// $sql = "select User.*, Role.name as role_name from User left join Role on User.role_id = Role.id where User.deleted = 0";
	$sql = "select * from orders order by status asc ";
	$data = executeResult($sql);
?>

<div class="row" style="margin-top: 20px;">
	<div class="col-md-12 table-responsive">
		<h3>Quản Lý Đơn Hàng</h3>

		<table class="table table-bordered table-hover" style="margin-top: 20px;">
			<thead>
				<tr>
					<th>STT</th>
					<th>Họ và tên</th>
					<th>SĐT</th>
					<th>Email</th>
					<th>Địa Chỉ</th>
					<th>Nội dung</th>
					<th>Ngày Tạo</th>  
					<th>Tổng Tiền</th>
					<th width = 120px></th>
					<th width = 110px></th>

					<!-- <th width = 120px></th> -->

				</tr>
			</thead>
			<tbody>
<?php
	$index = 0;
	foreach($data as $item) {
		echo '<tr>
					<th>'.(++$index).'</th>
					<td>'.$item['fullname'].'</td>
					<td>'.$item['phone_number'].'</td>
					<td>'.$item['email'].'</td>
					<td>'.$item['address'].'</td>
					<td>'.$item['note'].'</td>
					<td>'.$item['order_date'].'</td>
					<td>'.$item['total_money'].'</td>


					<td>';
					if($item['status'] == 0){
						echo '
						<button onclick="changeStatus('.$item['id'].', 1)" class="btn btn-success btn-sm" style="margin-bottom: 5px">Approve</button>
						<button onclick="changeStatus('.$item['id'].', 2)" class="btn btn-danger btn-sm">Cancel</button>					
						';
					}
					else if($item['status'] == 1){
						echo '
							<label class="badge badge-success">Approved</label>
						';
					}
					else{
							echo '
							<label class="badge badge-danger">Cancel</label>
						';
					}
					
					echo '
					</td>
					<td><a href="detail.php?id='.$item['id'].'"><button class="btn btn-sm btn-warning">Chi Tiết</button></a></td>

				</tr>';
	} 
?>
			</tbody>
		</table>
	</div>
</div>

<script>
	function changeStatus(id, status){
		// console.log(id);
		$.post('form_api.php', {
			'id': id,
			'status': status,
			'action': 'update_status',
		}, function(data){
			location.reload();
		})
	}
</script>

<script>
	function deleteFeedback(id){
		option = confirm("Bạn có chắc muốn xóa phản hồi này không?");
		if(!option){
			return;
		}
		// console.log(id);
		$.post('form_api.php', {
			'id': id,
			'action': 'delete',
		}, function(data){
			location.reload();
		})
	}
</script>
<?php
	require_once('../layouts/footer.php');
?>