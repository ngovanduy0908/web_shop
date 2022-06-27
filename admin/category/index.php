<?php
	$title = 'Quản Lý Danh Mục';
	$baseUrl = '../';
	require_once('../layouts/header.php');
	require_once('form_save.php');
	$id = $name = '';
	if(isset($_GET['id'])){
		$id = getGet('id');
		$sql = "select * from category where id = $id";
		$data = executeResult($sql, true);
		if($data != null){
			$name = $data['name'];
		}
	}
	$sql = "select * from category";
	$data = executeResult($sql);
?>

<div class="row" style="margin-top: 20px;">
	<div class="col-md-12">
		<h3>Quản Lý Danh Mục</h3>
	</div>

	<div class="col-md-6" style="margin-top: 20px">
		<form action="index.php" method="post">
			<div class="form-group">
				<label for="name" style="font-weight: bold">Tên Danh Mục:</label>
				<input required="true" type="text" class="form-control" id="name" name="name" value="<?=$name?>">
				<input type="text" name = "id" value="<?=$id?>" hidden>
			</div>

			<button class="btn btn-success">Lưu</button>
		</form>
	</div>
	<div class="col-md-6 table-responsive" style="margin-top: 20px">
		<table class="table table-bordered table-hover" style="margin-top: 20px;">
			<thead>
				<tr>
					<th>STT</th>
					<th>Tên Danh Mục</th>
					<th style="width: 50px"></th>
					<th style="width: 50px"></th>
				</tr>
			</thead>
			<tbody>
<?php
	$index = 0;
	foreach($data as $item) {
		echo '<tr>
					<th>'.(++$index).'</th>
					<td>'.$item['name'].'</td>
					<td style="width: 50px">
						<a href="?id='.$item['id'].'"><button class="btn btn-warning">Sửa</button></a>
					</td>
					<td style="width: 50px">						
						<button onclick="deleteCategory('.$item['id'].')" class="btn btn-danger">Xoá</button>
					</td>
				</tr>';
	}
?>
			</tbody>
		</table>
	</div>
</div>

<script>
	function deleteCategory(id){
		// console.log(id);
		option = confirm('Bạn có chắc chắn muốn xóa danh mục này không?');
		if(!option){
			return;
		}
		$.post('form_api.php', {
			'id': id,
			'action': 'delete'
		}, function(data){
			if(data != null || data != ''){
				alert(data);
				return;
			}
			location.reload();
		})
	}
</script>
<?php
	require_once('../layouts/footer.php');
?>