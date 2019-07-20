<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
</head>
<body>
	<?php 
	require('../connect/connect.php');

		$update_nxb="update nhaxuatban 
						set
							tennxb	='".$_POST['tennxb']."'
						  where manxb='".$_POST['manxb']."'
							";

		if($conn->query($update_nxb)) {
			header("location:../admin/ds_nxb.php");
		}else{
			echo "error".$conn->error;
		}	
		
	?>
</body>
</html>