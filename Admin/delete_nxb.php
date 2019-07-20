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
	<title>Xóa truyện</title>
	<meta charset="utf-8"/>
</head>
<body>
<div>
	<div class="container-fluid" style="text-align: right; margin-bottom: 5px; margin-top: 5px;">
		<a type="button" class="btn btn-danger" href="logout.php" onclick='return logOut()'>Đăng xuất</a>	
	</div>
</div>
	<?php
		require_once('../connect/connect.php');
		$ds_xoa=$_GET["manxb"];
		$xoa_nxb="delete from nhaxuatban where manxb='$ds_xoa'";
		mysqli_query($conn,$xoa_nxb);
		header("location:../admin/ds_nxb.php");
	?>
</body>
</html>