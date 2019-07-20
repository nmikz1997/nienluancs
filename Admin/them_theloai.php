<?php
	session_start();
	if(isset($_SESSION['taikhoan']) && isset($_SESSION['quyen']) ){
		$quyen=$_SESSION['quyen'];
		if($quyen !== '1'){
			header('location:../trangchinh/trangchu.php');
			exit();
		}
	}else{
		header('location:login.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Form Thể Loại</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>
<div>
	<div class="container-fluid" style="text-align: right; margin-bottom: 5px; margin-top: 5px;">
		<a type="button" class="btn btn-danger" href="logout.php" onclick='return logOut()'>Đăng xuất</a>	
	</div>
</div>
	<nav class="navbar navbar-default">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand" href="ds_truyen.php">Quản lí</a>
	    </div>
	    <ul class="nav navbar-nav">
	      <li><a href="ds_truyen.php">Danh sách truyện</a></li>
	      <li><a href="ds_theloai.php">Danh sách thể loại</a></li>
	      <li><a href="ds_nxb.php">Danh sách NXB</a></li>
	      <li><a href="ds_hoadon.php">Danh sách hóa đơn</a></li>
	      <!-- <li><a href="#">Thống kê</a></li> -->
	      <li class="active"><a href="them_theloai.php">Thêm thể loại</a></li>
	    </ul>
	  </div>
	</nav>

<?php 
	require_once('../connect/connect.php');
	if(isset($_POST['btnThem'])){
		$insert_theloai="INSERT into theloai 
						value(
							'".$_POST['maloai']."',
							'".$_POST['tenloai']."'
							)";

		if($conn->query($insert_theloai)) {
			echo"Thêm thành công";
		}else{
			echo "Thêm thất bại";
		}
	}
?>

<div>
	<form enctype ="multipart/form-data" action="" method ="POST">
		<div class="container">
		<caption><h3>Thêm thể loại</h3></caption>
			<div class="form-group">
				<label>Mã thể loại</label>
				<input type="text" class = "form-control" name="maloai" required>
			</div>
			<div class="form-group">
				<label>Tên thể loại</label>
				<input type="text" class = "form-control" name="tenloai" required>
			</div>
			<button type="submit" class="btn btn-default" name="btnThem">Thêm</button>
		</div>
	</form>
</div>

</body>
</html>