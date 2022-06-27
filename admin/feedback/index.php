<?php
	$title = 'Quản Lý Phản Hồi';
	$baseUrl = '../';
	require_once('../layouts/header.php');

	// $sql = "select User.*, Role.name as role_name from User left join Role on User.role_id = Role.id where User.deleted = 0";
	$sql = "select * from feedback order by status asc, updated_at desc";
	$data = executeResult($sql);
?>

<div class="row" style="margin-top: 20px;">
	<div class="col-md-12 table-responsive">
		<h3>Quản Lý Phản Hồi</h3>

		<table class="table table-bordered table-hover" style="margin-top: 20px;">
			<thead>
				<tr>
					<th>STT</th>
					<th>Tên</th>
					<th>Họ</th>
					<th>SĐT</th>
					<th>Email</th>
					<th>Chủ đề</th>
					<th>Nội dung</th>
					<th>Ngày Tạo</th>  
					<th width = 120px></th>
					<!-- <th width = 120px></th> -->

				</tr>
			</thead>
			<tbody>
<?php
	$index = 0;
	foreach($data as $item) {
		echo '<tr>
					<th>'.(++$index).'</th>
					<td>'.$item['firstname'].'</td>
					<td>'.$item['lastname'].'</td>
					<td>'.$item['phone_number'].'</td>
					<td>'.$item['email'].'</td>
					<td>'.$item['subject_name'].'</td>
					<td>'.$item['note'].'</td>
					<td>'.$item['created_at'].'</td>

					<td>
					
					</tr>';
					if($item['status'] == 0){
						echo '
						<button onclick="markRead('.$item['id'].')" class="btn btn-warning">Đã đọc</button>
						</td>
						';
					}
					if($item['status'] != 0){
						echo '
						<button onclick="deleteFeedback('.$item['id'].')" class="btn btn-danger">Xóa</button>
						</td>
						';
					}
					
					echo '
				</tr>';
	}
?>
			</tbody>
		</table>
	</div>
</div>

<script>
	function markRead(id){
		// console.log(id);
		$.post('form_api.php', {
			'id': id,
			'action': 'mark',
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