<?php 

session_start(); 
 
if (isset($_SESSION['taikhoan'])){
    unset($_SESSION['taikhoan']);
    header("location:".$_SERVER['HTTP_REFERER']."");
}else{
	header("location:trangchu.php");
}

?>