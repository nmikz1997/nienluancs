<?php
	require('../connect/connect.php');
	$sql = "SELECT bia FROM chitiettruyen WHERE matruyen='" . $_GET["matruyen"] . "'";
	$result = mysqli_query($conn,$sql)
		or die("Could not do query");
	$row = mysqli_fetch_assoc($result);
	echo $row["bia"];
	mysqli_close($conn);
?>
