<?php
	$mahd = $_GET['mahd'];
	require_once('../connect/connect.php');
	$result=mysqli_query($conn,"UPDATE hoadon
								set
									giaohang=1
								where mahd='$mahd'");
	if($conn->query($result)){
		echo "Đã duyệt hóa đơn";
	}
	
?>