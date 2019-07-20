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
	<title>Sửa thông tin tác giả</title>

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
	      <li><a href="ds_tacgia.php">Danh sách tác giả</a></li>
	      <li><a href="ds_theloai.php">Danh sách thể loại</a></li>
	      <li><a href="ds_nxb.php">Danh sách NXB</a></li>
	      <li><a href="ds_hoadon.php">Danh sách hóa đơn</a></li>
	      <!-- <li><a href="#">Thống kê</a></li> -->
	      <li class="active"><a href="sua_tacgia.php">Sửa tác giả</a></li>
	    </ul>
	  </div>
	</nav>
	<?php
		require_once('../connect/connect.php');

		$matg= $_GET['matg'];
		$select_tacgia="SELECT *
						from tacgia
						where matg='$matg'";

		$result = mysqli_query($conn,$select_tacgia);

		while ($row=mysqli_fetch_assoc($result)) {
			$tentg		=$row['tentg'];
			$info		=$row['info'];
		}
		if(isset($_POST['btnSua'])){
			$anh= $_FILES['imgname'];
			if($anh['type'] =="image/jpg" || $anh['type'] =="image/jpeg" || $anh['type'] =="image/png" || $anh['type'] =="image/gif")
			{
				if($anh['size'] <= 614400)
				{
					$tenanh =$matg."_".$anh['name'];
					$update_tacgia= "update tacgia 
										set
											tentg		='".$_POST['tentg']		."',
											info		='".$_POST['info']		."',
											imgtg		='".$tenanh				."'
										where matg		='".$_POST['matg']."'
									";
					if($conn->query($update_tacgia))
					{
						copy($anh['tmp_name'],"../Database/imgtg/".$tenanh);
						echo "Đã sửa tác giả";
						echo '<meta http-equiv="refresh" content="1;URL=sua_tacgia.php?matg='.$matg.'">';
					}
					else{
						echo "Lỗi: sửa tác giả thất bại";			
					}			
				}else{
					echo "Lỗi: Hình ảnh có kích thước quá lớn";
				}
			}elseif (strlen($anh["name"]) == 0 ) {
				$update_tacgia= 	"update tacgia 
										set
											tentg		='".$_POST['tentg']	."',
											info		='".$_POST['info']	."'
										where matg		='".$_POST['matg']	."'
									";
				if($conn->query($update_tacgia))
				{
					echo "Đã thêm tác giả";
					echo '<meta http-equiv="refresh" content="1;URL=sua_tacgia.php?matg='.$matg.'">';
				}
				else{
					echo "Lỗi: sửa tác giả thất bại";
				}
			}else{
				echo "Lỗi: Ảnh không đúng định dạng" . "<br>" . $conn->error;
			}	
		}


	?>
	<div class="container">
		<caption><h2>Sửa Tác Giả</h2></caption>
		<form enctype ="multipart/form-data" action="" method ="POST">

		<div class="form-group">
				<label>Mã tác giả</label>
				<input type="text" class = "form-control" name="matg" value="<?php echo $matg ?>" readonly>
			</div>
			<div class="form-group">
				<label>Tên tác giả</label>
				<input type="text" class = "form-control" name="tentg" value= "<?php echo $tentg ?>" required>
			</div>
			<div class="form-group">
				<label>Thông tin tác giả</label>
				<textarea class="form-control" rows="5" name="info" required><?php echo $info ?></textarea>
			</div>
			<div class="form-group">
				<label>Ảnh</label>
				<input type="file" class = "form-control" name="imgname">
			</div>
			<button type="submit" class="btn btn-default" name="btnSua">Sửa</button>
			<a class='btn btn-primary' href='ds_tacgia.php' style="margin-left: 20px">Trở về</a>
		</div>
	</form>

	</div>
</body>
</html>