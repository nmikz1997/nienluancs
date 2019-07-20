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
	<title>Sửa nhà xuất bản</title>

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
	      <li class="active"><a href="sua_truyen.php">Sửa nhà xuất bản</a></li>
	    </ul>
	  </div>
	</nav>
	<?php
		require('../connect/connect.php');

		$manxb= $_GET['manxb'];
		$select_nxb="SELECT tennxb from nhaxuatban where manxb= '$manxb'";
		$result = mysqli_query($conn,$select_nxb);
		$row=mysqli_fetch_assoc($result);
		$tennxb=$row['tennxb'];

		if(isset($_POST['btnSua'])){
			$update_nxb="update nhaxuatban 
						set
							tennxb	='".$_POST['tennxb']."'
						  where manxb='".$_POST['manxb']."'
							";

			if($conn->query($update_nxb)) {
				echo "Đã sửa Nhà xuất bản";
				echo '<meta http-equiv="refresh" content="1;URL=sua_nxb.php">';
			}else{
				echo "error".$conn->error;
			}
		}

	?>
	<div class="container">
		<caption><h2>Sửa nhà xuất bản</h2></caption>
		<form enctype ="multipart/form-data" action="" method ="POST">

		<div class="form-group">
				<label>Mã loại</label>
				<input type="text" class = "form-control" name="manxb" value="<?php echo $manxb; ?>" readonly>
			</div>
			<div class="form-group">
				<label>Tên loại</label>
				<input type="text" class = "form-control" name="tennxb" value= "<?php echo $tennxb; ?>" required>
			</div>
			<button type="submit" class="btn btn-default" name="btnSua">Sửa</button>
		</div>
	</form>

	</div>
</body>
</html>