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
	<title>Xóa tác giả</title>
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
		$ds_xoa=$_GET["matg"];
		$select_tacgia="select imgtg from tacgia";
		$result_tacgia=mysqli_query($conn,$select_tacgia);
		$row=mysqli_fetch_assoc($result_tacgia);
		$xoa_tacgia="delete from tacgia where matg='$ds_xoa'";
		mysqli_query($conn,$xoa_tacgia);

		if (file_exists("../Database/imgtg/".$row['imgtg'])){
			unlink("../Database/imgtg/".$row['imgtg']);
		}
		header("location:../admin/ds_tacgia.php");
	?>
</body>
</html>