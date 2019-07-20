<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
</head>
<body>
	<?php 

	require_once('../connect/connect.php');
	$anh 		=$_FILES['imgname']	;
	if($anh['type'] =="image/jpg" || $anh['type'] =="image/jpeg" || $anh['type'] =="image/png" || $anh['type'] =="image/gif")
	{
		if($anh['size'] <= 614400)
		{
			$tenanh =$matruyen.$tinhtrang."_".$anh['name'];
			copy($anh['tmp_name'],"../Database/Old/".$tenanh);
			$update_truyencu= "update chitiettruyen 
								set
									gia			='".$_POST['gia']		."',
									soluong		='".$_POST['soluong']	."',
									bia			='".$tenanh				."'
								where matruyen	='".$_POST['matruyen']	."'
								";
			if($conn->query($update_truyencu))
			{
				echo "Đã thêm truyện cũ";
			}
			else{
				echo "Lỗi: Thêm truyện cũ thất bại";					
			}			
		}else{
			echo "Lỗi: Hình ảnh có kích thước quá lớn";
		}
	}elseif (strlen($anh["name"]) == 0 ) {
		$update_truyencu= "update chitiettruyen 
							set
								gia			='".$_POST['gia']		."',
								soluong		='".$_POST['soluong']	."'
								where matruyen	='".$_POST['matruyen']	."'
								";
		if($conn->query($update_truyencu))
		{
			echo "Đã thêm truyện cũ";
		}
		else{
			echo "Lỗi: Thêm truyện cũ thất bại";					
		}
	}else{
		echo "Lỗi: Ảnh không đúng định dạng" . "<br>" . $conn->error;
	}	
	
	//header("location:../admin/ds_truyen.php");
	?>
</body>
</html>