<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
</head>
<body>
	<?php 
		require('../connect/connect.php');

		$insert_nxb="insert into nhaxuatban 
						value(
							'".$_POST['manxb']."',
							'".$_POST['tennxb']."'
							)";

		if($conn->query($insert_nxb)) {
			header("location:../admin/ds_nxb.php");
		}else{
			echo "error".$conn->error;
		}	
	?>
</body>
</html>