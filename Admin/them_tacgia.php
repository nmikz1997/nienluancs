<?php
	session_start();
	if(isset($_SESSION['taikhoan']) && isset($_SESSION['quyen']) ){
		$quyen=$_SESSION['quyen'];
		if($quyen !== '1'){
			header('location:../trangchinh/trangchu.php');
			exit();
		}
	}else{
		header('location:login.php');
	}
?>
<?php 
	require_once('../connect/connect.php');
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Form Thể Loại</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>
<div>
	<div class="container-fluid" style="text-align: right; margin-bottom: 5px; margin-top: 5px;">
		<a type="button" class="btn btn-danger" href="logout.php" onclick='return logOut()'>Đăng xuất</a>	
	</div>
</div>
	<nav class="navbar navbar-default">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand" href="ds_truyen.php">Quản lí</a>
	    </div>
	    <ul class="nav navbar-nav">
	      <li><a href="ds_truyen.php">Danh sách truyện</a></li>
	      <li><a href="ds_theloai.php">Danh sách thể loại</a></li>
	      <li><a href="ds_nxb.php">Danh sách NXB</a></li>
	      <li><a href="ds_hoadon.php">Danh sách hóa đơn</a></li>
	      <!-- <li><a href="#">Thống kê</a></li> -->
	      <li class="active"><a href="them_tacgia.php">Thêm tác giả</a></li>
	    </ul>
	  </div>
	</nav>

<?php 
	require_once('../connect/connect.php');
	if(isset($_POST['btnThem'])){
		if(!isset($row_matg))
		{
			$matg		=$_POST['matg']		;
			$tentg		=$_POST['tentg']	;
			$anh 		=$_FILES['imgtg']	;
			$info		=$_POST['info']		;
			if($anh['type'] =="image/jpg" || $anh['type'] =="image/jpeg" || $anh['type'] =="image/png" || $anh['type'] =="image/gif")
			{
				if($anh['size'] <= 614400){
					$tenanh =$matg."_".$anh['name'];
					$insert_nxb="INSERT into tacgia 
						value(
							'".$_POST['matg']	."',
							'".$_POST['tentg']	."',
							'".$tenanh			."',
							'".$_POST['info']	."'
							)";

					if($conn->query($insert_nxb)) {
						copy($anh['tmp_name'],"../Database/imgtg/".$tenanh);
						echo "Thêm thành công";
					}else{
						echo "Thêm thất bại";
					}

				}else{
					echo "Lỗi: Hình ảnh có kích thước quá lớn";
				}
			}else{

			}
		}else{

		}		
		
	}
?>

<div>
	<form enctype ="multipart/form-data" action="" method ="POST">
		<div class="container">
		<caption><h3>Thêm tác giả</h3></caption>
			<div class="form-group">
				<label>Mã tác giả</label>
				<input type="text" class = "form-control" name="matg" value="<?php if(isset($matg)){echo $matg;}?>" required>
			</div>
			<div class="form-group">
				<label>Tên tác giả</label>
				<input type="text" class = "form-control" name="tentg" value="<?php if(isset($tentg)){echo $tentg;}?>" required>
			</div>
			<div class="form-group">
				<label>Ảnh tác giả</label>
				<input type="file" class = "form-control" name="imgtg" required>
			</div>
			<div class="form-group">
				<label>Mô tả tác giả</label>
				<textarea class="form-control" rows="5" name="info" required><?php if(isset($info)){echo $info;}?></textarea>
			</div>
			<button type="submit" class="btn btn-default" name="btnThem">Thêm</button>
		</div>
	</form>
</div>

</body>
</html>