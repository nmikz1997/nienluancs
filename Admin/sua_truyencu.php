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
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Sửa thông tin truyện</title>

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
	      <li class="active"><a href="sua_truyen.php">Sửa truyện</a></li>
	    </ul>
	  </div>
	</nav>
	<?php
		require_once('../connect/connect.php');

		$matruyen= $_GET['matruyen'];
		$select_truyen="SELECT truyen.matruyen,tentruyen,gia,soluong,tinhtrang,bia
		from chitiettruyen
				join truyen on truyen.matruyen= chitiettruyen.matruyen
				where truyen.matruyen='$matruyen' AND tinhtrang='old'";

		$result = mysqli_query($conn,$select_truyen);

		while ($row=mysqli_fetch_assoc($result)) {
			$matruyen	=$row['matruyen'];
			$tentruyen	=$row['tentruyen'];
			$gia		=$row['gia'];
			$soluong	=$row['soluong'];
			$bia		=$row['bia'];
		}
		if(isset($_POST['btnSua'])){
			$anh= $_FILES['imgname']	;
			if($anh['type'] =="image/jpg" || $anh['type'] =="image/jpeg" || $anh['type'] =="image/png" || $anh['type'] =="image/gif")
			{
				if($anh['size'] <= 614400)
				{
					$tenanh =$matruyen."old_".$anh['name'];
					$update_truyencu= "update chitiettruyen 
										set
											gia			='".$_POST['gia']		."',
											soluong		='".$_POST['soluong']	."',
											bia			='".$tenanh				."'
										where matruyen	='".$_POST['matruyen']	."' and tinhtrang = 'old'
										";
					if($conn->query($update_truyencu))
					{
						unlink("../Database/Old/".$bia);
						copy($anh['tmp_name'],"../Database/Old/".$tenanh);
						echo "Đã Sửa truyện cũ";
						echo '<meta http-equiv="refresh" content="1;URL=sua_truyencu.php?matruyen='.$matruyen.'">';
					}
					else{
						echo "Lỗi: Sửa truyện cũ thất bại";					
					}			
				}else{
					echo "Lỗi: Hình ảnh có kích thước quá lớn";
				}
			}elseif (strlen($anh["name"]) == 0 ) {
				$update_truyencu= "update chitiettruyen 
									set
										gia			='".$_POST['gia']		."',
										soluong		='".$_POST['soluong']	."'
										where matruyen	='".$_POST['matruyen']."' and tinhtrang = 'old'
										";
				if($conn->query($update_truyencu))
				{
					echo "Đã Sửa truyện cũ";
					echo '<meta http-equiv="refresh" content="1;URL=sua_truyencu.php?matruyen='.$matruyen.'">';
				}
				else{
					echo "Lỗi: Sửa truyện cũ thất bại";					
				}
			}else{
				echo "Lỗi: Ảnh không đúng định dạng" . "<br>" . $conn->error;
			}	
		}


	?>
	<div class="container">
		<caption><h2>Sửa truyện Cũ</h2></caption>
		<form enctype ="multipart/form-data" action="" method ="POST">

		<div class="form-group">
				<label>Mã truyện</label>
				<input type="text" class = "form-control" name="matruyen" value="<?php echo $matruyen ?>" readonly>
			</div>
			<div class="form-group">
				<label>Tên truyện</label>
				<input type="text" class = "form-control" name="tentruyen" value= "<?php echo $tentruyen ?>" readonly>
			</div>
			<div class="form-group">
				<label>Đơn giá</label>
				<input type="number" class = "form-control" name="gia" value="<?php echo $gia ?>" required>
			</div>
			<div class="form-group">
				<label>Số lượng</label>
				<input type="number" class = "form-control" name="soluong" min="0" value="<?php echo $soluong ?>" required>
			</div>
			<div class="form-group">
				<label>Bìa Truyện</label>
				<input type="file" class = "form-control" name="imgname">
			</div>
			<button type="submit" class="btn btn-default" name="btnSua">Sửa</button>
		</div>
	</form>

	</div>
</body>
</html>