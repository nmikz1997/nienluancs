<?php session_start(); ?>
<?php
	if(isset($_POST['btnNhapDC'])){
		//tạo cookie chứa địa chỉ
    	setcookie('diachi', $_POST['diachi'], time() + (86400*7));
    	header("location:thanhtoan.php");
	}

	if(isset($_POST['btnDoiDC'])){
		setcookie('diachi', $_POST['diachi'], time() - (86400*7));
		header("location:thanhtoan.php");
	}

	if (isset($_GET['action']) && $_GET['action'] === 'ketthuc'){
		//tiến hành thanh toán
			// tạo hóa đơn trong bảng hoadon total = 0
		$address_data = stripslashes($_COOKIE['diachi']);
		$total
		$create_hoadon=mysqli_query($conn,"insert into hoadon
  										values (,
  												)
  												");	
		//thanh toán thành công thì
		header("location:thanhtoan.php");
		//thanh toán thất bại thì
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Thanh toán</title>
	<meta charset="utf-8">
</head>
<body>
	<?php
		//require_once('../connect/connect.php');
		$cookie_data = stripslashes($_COOKIE['giohang']);
  		$cart_data = json_decode($cookie_data, true);
  		if(isset($_SESSION['taikhoan'])){
  			$sdtkh=$_SESSION['taikhoan'];
  			$result=mysqli_query($conn,"SELECT * from khachhang where sdtkh='$sdtkh'");
  			$row_info=mysqli_fetch_assoc($result);
  			
  			var_dump($row_info);

  			// có địa chỉ trong cookie hiện lên
  			if(isset($_COOKIE['diachi'])){
  				$address_data = stripslashes($_COOKIE['diachi']);
  	?>
  			<form method="POST">
  				<input type="text" value="<?php echo $address_data; ?>" required />
  				<button type="submit" name="btnDoiDC">Đây không phải địa chỉ của tôi</button>
  			</form>
  			<a href="thanhtoan.php?action=ketthuc" type="btn btn-primary">Giao hàng tại đây</a>
  	<?php	}else{
  			// yêu cầu nhập địa chỉ giao hàng khi chưa có


  	?>
  			<form method="POST">
  				<input style="width: 400px" type="text" name="diachi" placeholder="Mạc Thiên Tích, 3/2 Xuân Khánh, Ninh Kiều, Cần Thơ" required />
  				<button type="submit" name="btnNhapDC" >Nhập</button>
  			</form>
  	<?php

  			}
  	

  			// tạo hóa đơn trong bảng hoadon total = 0
  			// lấy id hóa đơn tạo chitiethoadon
  			// insert cookie_data vao bang chitiethoadon
  			// tinh thanh tien chitiethoadon
  			// cap nhat bang hoadon (update table hoadon)


  		}else{
	?>
		<h2>Nhập thông tin khách hàng</h2>
	<?php
		} 
	?>
</body>
</html>