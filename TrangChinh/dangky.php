<!DOCTYPE html>
<html>
<head>
	<title>Đăng ký thông tin khách hàng</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>

<?php
	$severName = $_SERVER['SERVER_NAME']; 
	require_once('../connect/connect.php');
	if(isset($_POST['btnDangKy'])){
		$mk=md5($_POST['pass']);
		$insert_khachhang="insert into khachhang 
						value(
							'".$_POST['sdt']."',
							'".$_POST['hoten']."',
							'".$_POST['email']."'
							)";

		if($conn->query($insert_khachhang)){
			$create_user="insert into user
						value(
							'".$_POST['sdt']."',
							'".$mk."',
							0
						)";
			if($conn->query($create_user)){
				include_once('../sendMailLib.php');
				$guiboi = 'Chủ cửa hàng truyện';
				$subject = 'Đăng ký thành công';
				$content = 'Xin chào, "'.$_POST['hoten'].'" Cảm ơn bạn đã quan tâm, tài khoản của bạn là"'.$_POST['sdt'].'". Hãy ghé thăm <a href="'.$severName.'/nienluancs/TrangChinh/trangchu.php">Kho truyện</a> của tôi';
				$emailNhan = $_POST['email'];
				$ten = 'Trịnh Thế Nguyễn';
				sendGMail('nguyentestmail1997@gmail.com','w3schools.com',$guiboi, array(array($emailNhan, 'Trịnh Thế Nguyễn')), array(array('nguyentestmail1997@gmail.com',$guiboi)),$subject,$content);
				echo "Đăng ký thành công";
			}else{
				echo "tạo tài khoản thất bại";
			}	
		}else{
			echo "Đăng Ký thất bại";
		}
	}
?>

<div>
	<form enctype ="multipart/form-data" action="" method ="POST">
		<div class="container">
		<caption><h3>Đăng ký thông tin khách hàng</h3></caption>
			<div class="form-group">
				<label>Số điện thoại</label>
				<input type="text" class = "form-control" name="sdt" placeholder="0999888777" required pattern="[0-9]{10}"/>
			</div>
			<div class="form-group">
				<label>Họ tên</label>
				<input type="text" class = "form-control" placeholder="Nguyễn Văn A" name="hoten" required/>
			</div>
			<div class="form-group">
				<label>Email</label>
				<input type="email" class = "form-control" name="email" placeholder="nguyenvana@gmail.com" required/>
			</div>
			<div class="form-group">
				<label>Mật khẩu</label>
				<input type="password" class = "form-control" name="pass" required/>
			</div>
			<button type="submit" class="btn btn-default" name="btnDangKy">Thêm</button>
		</div>
	</form>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>