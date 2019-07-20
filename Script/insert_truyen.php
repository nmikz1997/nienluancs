<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
</head>
<body>
<?php
	require('../connect/connect.php');
	if($_FILES['imgname']['tmp_name']&& $_FILES['imgname']['error'] ==0 && isset($_POST['theloai'])) 
	{
		$tmpName = $_FILES['imgname']['tmp_name'];
		$fp = fopen($tmpName, 'rb');
		$bia = fread($fp, filesize($tmpName));
		fclose($fp);

		$insert_truyen = "insert into truyen 
					values ('".$_POST["matruyen"]	."',
							'".$_POST["tentruyen"]	."',
							'".$_POST["manxb"]		."',
							'".$_POST["tacgia"]		."',
							'".$_POST["ngayxb"]		."',
							'".$_POST["noidung"]	."
							')";

		$conn->query($insert_truyen);
			$theloai= $_POST['theloai'];
			if (is_array($theloai))
			{
				foreach ($theloai as $key => $value)
				{
					$insert_loaitruyen = "insert into loai_truyen 
						values ('".$_POST["matruyen"]."',
								'".$value."')";
					$conn->query($insert_loaitruyen);
				}
			}

			if ($_POST['tinhtrang'] == '100%'){
				#thêm chi tiết truyện mới
				$insert_truyenmoi= "insert into chitiettruyen
									values ('".$_POST['matruyen'] 	."',
											'".$_POST['tinhtrang']	."',
											CURDATE(),
											'".mysqli_real_escape_string($conn,$bia)."',
											'".$_POST["gia"]		."',
											'".$_POST["soluong"]	."
											')";
				
				if($conn->query($insert_truyenmoi) === TRUE){
					echo "Đã thêm truyện mới";
					header("location:../admin/them_sp.php");
					mysqli_close($conn);
				}
				else{
					echo'<script>alert("Thêm truyện mới thất bại")</script>';
					echo "<meta http-equiv='refresh' content='0;URL=../admin/them_sp.php'";
					mysqli_close($conn);
				}
			}
			else
			{
				#thêm chi tiết truyện cũ
				$insert_truyencu= "insert into chitiettruyen
									values ('".$_POST['matruyen'] 	."',
											'".$_POST['tinhtrang']	."',
											CURDATE(),
											'".mysqli_real_escape_string($conn,$bia)."',
											'".$_POST["gia"]		."',
											'".$_POST["soluong"]	."
											')";
				if($conn->query($insert_truyencu) === TRUE)
				{
					echo "Đã thêm truyện cũ";
					header("location:../admin/them_sp.php");
					mysqli_close($conn);
				}
				else
				{
					echo "Thêm truyện cũ thất bại";
					mysqli_close($conn);
				}
			}

	}
	else
	{
		echo "Lỗi: " . "<br>" . $conn->error;
		mysqli_close($conn);
	}
	
?>
</body>
</html>