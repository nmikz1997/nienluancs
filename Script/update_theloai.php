<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
</head>
<body>
	<?php 
	require('../connect/connect.php');

		$update_theloai="update theloai 
						set
							tenloai	='".$_POST['tenloai']."'
						  where maloai='".$_POST['maloai']."'
							";

		if($conn->query($update_theloai)) {
			header("location:../admin/ds_theloai.php");
		}else{
			echo "error".$conn->error;
		}	
		
	
	?>
</body>
</html>