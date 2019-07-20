<?php
	$servername = 'localhost';
	$user ='root';
	$pass='';
	$db='nienluancs';
	$conn= mysqli_connect($servername,$user,$pass,$db);
	mysqli_set_charset($conn, 'UTF8');
 	if($conn-> connect_error){
		die("ket noi that bai!");
	}
?>