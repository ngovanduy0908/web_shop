<?php
    require_once('layouts/header.php');
    if(!empty($_POST)){
        $firstname = getPost('firstname');
        $lastname = getPost('lastname');
        $email = getPost('email');
        $phone_number = getPost('phone_number');
        $subject_name = getPost('subject_name');
        $note = getPost('note');
        $created_at = $updated_at = date('Y-m-d H:i:s');
        // $sql = "insert into FeedBack(firstname, lastname, email, phone_number, subject_name, note, status, created_at, updated_at) values('$first_name', '$last_name', '$email', '$phone_number', '$subject_name', '$note', 0, '$created_at', '$updated_at')";
        $sql = "insert into feedback (firstname, lastname, email, phone_number, subject_name, note, created_at, updated_at, status) values ('$firstname', '$lastname', '$email', '$phone_number', '$subject_name', '$note', '$created_at', '$updated_at', 0)";
        execute($sql);
    }
?>
<!-- Banner end -->
    <div class="container">
        <div class="row" style="margin: 20px 0">
            <div class="col-md-6">
                <form method="post">
					<div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="usr">Nhập tên:</label>
                                <input required="true" type="text" class="form-control" id="usr" name="firstname">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lastname">Nhập họ:</label>
                                <input required="true" type="text" class="form-control" id="lastname" name="lastname">
                            </div>
                        </div>
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
					  <label for="subject_name">Chủ Đề:</label>
					  <input required="true" type="text" class="form-control" id="subject_name" name="subject_name">
					</div>

                    <div class="form-group">
					  <label for="">Nội Dung Ghi Chú:</label>
					  <textarea name="note" id="note" cols="30" rows="3" class="form-control"></textarea>
					</div>
                    <a href="checkout.php">
                        <button class="btn btn-success" style="margin-bottom: 15px; width: 100%">Gửi Phản Hồi</button>
                    </a>
				</form>
            </div> 
            
            <div class="col-md-6">
                <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d251637.95196238213!2d105.6189045!3d9.779349!3m2!1i1024!2i768!4f13.1!5e0!3m2!1svi!2s!4v1636558277567!5m2!1svi!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
            
        </div>
    </div>

<?php
    require_once('layouts/footer.php');
?>