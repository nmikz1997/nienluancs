<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
</head>
<body>
	<?php 
	require('../connect/connect.php');

		$insert_theloai="insert into theloai 
						value(
							'".$_POST['maloai']."',
							'".$_POST['tenloai']."'
							)";

		if($conn->query($insert_theloai)) {
			header("location:../admin/ds_theloai.php");
		}else{
			echo "error".$conn->error;
		}	
	?>
</body>
</html>