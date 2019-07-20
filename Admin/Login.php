<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Đăng nhập</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<?php
	require_once('../connect/connect.php');
	session_start();
	if(isset($_POST['btnDangNhap'])){
		$taikhoan=mysqli_real_escape_string($conn,$_POST['taikhoan']);
		$matkhau=md5($_POST['matkhau']);

		$result = mysqli_query($conn,"SELECT * from user where user='$taikhoan' and pass='$matkhau' and quyen = 1") or die (mysqli_connect($conn));
		if(mysqli_num_rows($result) == 1){
			$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
			$_SESSION['taikhoan']=$taikhoan;
			$_SESSION['quyen']=$row['quyen'];
			echo "<script>alert('Đăng nhập thành công')</script>";
            echo "<meta http-equiv='refresh' content='0;URL=ds_truyen.php'/>";
		}else{
			echo "<script>alert('Tài khoản hoặc mật khẩu không đúng')</script>";
		}
	}
?>

<div>
	<form enctype ="multipart/form-data" action="" method ="POST">
		<div class="container">
		<caption><h3>Đăng nhập</h3></caption>
			<div class="form-group">
				<label>Tài khoản</label>
				<input type="text" class = "form-control" name="taikhoan" required>
			</div>
			<div class="form-group">
				<label>Mật khẩu</label>
				<input type="password" class = "form-control" name="matkhau" required>
			</div>
			<button type="submit" class="btn btn-default" name="btnDangNhap">Đăng nhập</button>
		</div>
	</form>
</div>

</body>
</html>