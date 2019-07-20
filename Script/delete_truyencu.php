<!DOCTYPE html>
<html>
<head>
	<title>Xóa truyện</title>
	<meta charset="utf-8"/>
</head>
<body>
	<?php
		require_once('../connect/connect.php');
		$ds_xoa=$_POST["ds_xoa"];
		if(is_array($ds_xoa)){
			foreach ($ds_xoa as $key => $value) {
				$select_truyen="select bia from chitiettruyen where matruyen='$value' and tinhtrang='old'";
				$result_truyen=mysqli_query($conn,$select_truyen);
				$row=mysqli_fetch_assoc($result_truyen);
				$xoa_truyen="delete from chitiettruyen where matruyen='$value' and tinhtrang='old'";
				mysqli_query($conn,$xoa_truyen);
				if (file_exists("../Database/Old/".$row['bia'])){
					 unlink("../Database/Old/".$row['bia']);
				}
			}
			echo 'Đã xóa';
		}
		header("location:../admin/ds_truyencu.php");
	?>
</body>
</html>