<?php session_start(); 
 
if (isset($_SESSION['taikhoan'])){
    unset($_SESSION['taikhoan']);
    header("location:login.php");
}else{
	header("location:login.php");
}

?>