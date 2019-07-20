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
	<title>Sửa truyện</title>

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
	      <li class="active"><a href="sua_truyen.php">Sửa thể loại</a></li>
	    </ul>
	  </div>
	</nav>
	<?php
		require('../connect/connect.php');

		$maloai= $_GET['maloai'];
		$select_loai="SELECT tenloai from theloai where maloai= '$maloai'";
		$result = mysqli_query($conn,$select_loai);
		$row=mysqli_fetch_assoc($result);
		$tenloai=$row['tenloai'];

		if(isset($_POST['btnSua'])){

			$update_theloai="update theloai 
						set
							maloai ='".$_POST['maloai']."',
							tenloai	='".$_POST['tenloai']."'
						  where maloai='".$maloai."'
							";

			if($conn->query($update_theloai)) {
				$maloai=$_POST['maloai'];
				echo "Đã sửa Thể Loại";
				echo '<meta http-equiv="refresh" content="1;URL=sua_theloai.php?maloai='.$maloai.'">';
			}else{
				echo "error".$conn->error;
			}
		}

	?>
	<div class="container">
		<caption><h2>Sửa thể loại</h2></caption>
		<form enctype ="multipart/form-data" action="" method ="POST">

		<div class="form-group">
				<label>Mã loại</label>
				<input type="text" class = "form-control" name="maloai" value="<?php echo $maloai; ?>"/>
			</div>
			<div class="form-group">
				<label>Tên loại</label>
				<input type="text" class = "form-control" name="tenloai" value= "<?php echo $tenloai; ?>" required/>
			</div>
			<button type="submit" class="btn btn-default" name="btnSua">Sửa</button>
		</div>
	</form>

	</div>
</body>
</html>