<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
</head>
<body>
	<?php 

	require_once('../connect/connect.php');

		$update_truyen="update truyen 
						set
							matruyen	='".$_POST['matruyen']	."',
							tentruyen	='".$_POST['tentruyen']	."',
							manxb		='".$_POST['manxb']		."',
							tacgia		='".$_POST['tacgia']	."',
							ngayxb		='".$_POST['ngayxb']	."',
							noidung		='".$_POST['noidung']	."'
						where matruyen	='".$_POST['matruyen']	."'
							";

		if($conn->query($update_truyen)) {
		$delete ="delete from loai_truyen where matruyen='".$_POST["matruyen"]."'";
			if(mysqli_query($conn,$delete)){
				$chon=$_POST['$theloai'];
				foreach($chon as $key => $value){
					$insert_return="INSERT into loai_truyen values (
								'".$_POST["matruyen"]."',
								'".$value."')";
					if(mysqli_query($conn,$insert_return))
						echo "Sửa truyện thành công";
					else
						echo "error".$conn->error;
					}
				}else echo "error".$conn->error;

		}			

			
	?>
</body>
</html>