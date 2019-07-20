<!DOCTYPE html>
<html>
<head>
	<title>Xóa truyện</title>
	<meta charset="utf-8"/>
</head>
<body>
	<?php
		require('../connect/connect.php');
		$ds_xoa=$_POST["ds_xoa"];
		if(is_array($ds_xoa)){
			foreach ($ds_xoa as $key => $value) {
				$xoa_theloai="delete from nhaxuatban where manxb='$value'";
				mysqli_query($conn,$xoa_theloai);
			}
		}
		header("location:../admin/ds_nxb.php");
	?>
</body>
</html>