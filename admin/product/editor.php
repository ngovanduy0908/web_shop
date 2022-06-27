<?php
	$title = 'Thêm/Sửa Sản Phẩm';
	$baseUrl = '../';
	require_once('../layouts/header.php');
    $id = $title = $thumbnail = $price = $discount = $category_id = $description = '';
    require_once('form_save.php');
	$id = getGet('id');
	if($id != '' && $id > 0){
		$sql = "select * from product where id = $id and deleted = 0";
		$productItem = executeResult($sql, true);
		if($productItem != null){
			$title = $productItem['title'];
			$thumbnail = $productItem['thumbnail'];
			$price = $productItem['price'];
			// $price = number_format($price);
			$category_id = $productItem['category_id'];
			$description = $productItem['description'];
			$discount = $productItem['discount'];
			// $discount = number_format($discount);
			// var_dump($discount);
			// var_dump($price);

		}
		else{
			$id = 0;
		}
	}else{
		$id = 0;
	}
    $sql = "select * from category";
    $categoryItem = executeResult($sql);

?>

<div class="row" style="margin-top: 20px;">
	<div class="col-md-12 table-responsive">
		<h3>Thêm/Sửa Sản Phẩm</h3>

        <div class="panel panel-primary">
		
			<div class="panel-body">
				<form method="post">
					<div class="row">
						<div class="col-md-9 col-12">
							<div class="form-group">
								<label for="usr">Tên Sản Phẩm:</label>
								<input required="true" type="text" class="form-control" id="usr" name="title" value="<?=$title?>">
								<input type="text" name = "id" value="<?=$id?>">
							</div>
							<div class="form-group">
								<label for="pwd">Nội Dung:</label>
								<textarea class="form-control" name="description" id="description" cols="30" rows="5"><?=$description?></textarea>
							</div>

							<button class="btn btn-success">Lưu Sản Phẩm</button>

						</div>
						<div class="col-md-3 col-12">
							
							<div class="form-group">
								<label for="thumbnail">Thumbnail:</label>
								<input required="true" type="text" class="form-control" id="thumbnail" name="thumbnail" value="<?=$thumbnail?>" onchange="updateThumbnail()">
								<img id="thumbnail_img" src="<?=$thumbnail?>" alt="" style="max-height: 150px; margin-top: 10px" >
							</div>
							<div class="form-group">
								<label for="usr">Danh Mục Sản Phẩm:</label>
								<select name="category_id" id="category_id" required="true" class="form-control">
									<option value="">-- Chọn --</option>
									<?php
											foreach($categoryItem as $item){
												if($item['id'] == $category_id){
													echo '
														<option selected value="'.$item['id'].'">'.$item['name'].'</option>
												
												';
												}
												else{
													echo '
														<option value="'.$item['id'].'">'.$item['name'].'</option>
													
													';
												}
											}
									?>
								</select>

							</div>

							<div class="form-group">
								<label for="price">Giá:</label>
								<input required="true" type="number" class="form-control" id="price" name="price" value="<?=$price?>">
							</div>
							<div class="form-group">
								<label for="discount">Giảm Giá:</label>
								<input required="true"  type="number" class="form-control" id="discount" name="discount" value="<?=$discount?>">
							</div>
									
						</div>
					</div>
					
				</form>
			</div>
		</div>

	</div>
</div>
<script>
	function updateThumbnail(){
		$('#thumbnail_img').attr('src', $('#thumbnail').val());
	}
</script>

<script>
      $('#description').summernote({
        placeholder: 'Hello stand alone ui',
        tabsize: 2,
        height: 320,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
      });
    </script>
<?php
	require_once('../layouts/footer.php');
?>