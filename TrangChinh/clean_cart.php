<?php
	session_start(); 
 
	if (isset($_SESSION['giohang'])){
	    unset($_SESSION['giohang']);
	    header("location:giohang.php");
	}else{
		header("location:giohang.php");
	}
?>