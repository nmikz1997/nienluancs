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
		$select_truyen="SELECT *
						from truyen
								inner join loai_truyen on truyen.matruyen=loai_truyen.matruyen
								inner join nhaxuatban on nhaxuatban.manxb=truyen.manxb where truyen.matruyen='$matruyen'";

		$result = mysqli_query($conn,$select_truyen);

		$select_loaitruyen="SELECT maloai
							from loai_truyen where matruyen='$matruyen'
							";
		$result_loaitruyen=mysqli_query($conn,$select_loaitruyen);

		$select_tg_truyen="SELECT matg
							from tacgia_truyen where matruyen='$matruyen'
							";
		$result_tg_truyen=mysqli_query($conn,$select_tg_truyen);

		while($row=mysqli_fetch_assoc($result)) {
			$matruyen	=$row['matruyen'];
			$tentruyen	=$row['tentruyen'];
			$nhaxb 		=$row['manxb'];
			$ngayxb		=$row['ngayxb'];
			$noidung	=$row['noidung'];
		}
		//echo $nhaxb;

		while($row=mysqli_fetch_assoc($result_loaitruyen)){
			$theloai[]	=$row['maloai'];
		}
		while($row=mysqli_fetch_assoc($result_tg_truyen)){
			$tacgia[]	=$row['matg'];
		}

		if(isset($_POST['btnSua'])){
			$update_truyen="update truyen 
						set
							matruyen	='".$_POST['matruyen']	."',
							tentruyen	='".$_POST['tentruyen']	."',
							manxb		='".$_POST['manxb']		."',
							ngayxb		='".$_POST['ngayxb']	."',
							noidung		='".$_POST['noidung']	."'
						where matruyen	='".$_POST['matruyen']	."'
							";

			if($conn->query($update_truyen)) 
			{
				$delete ="DELETE from loai_truyen where matruyen='".$_POST["matruyen"]."'";
					if(mysqli_query($conn,$delete)){
						$chon=$_POST['$theloai'];
						foreach($chon as $key => $value){
							$insert_return="INSERT into loai_truyen values (
										'".$_POST["matruyen"]."',
										'".$value."')";
							mysqli_query($conn,$insert_return);
						}
					}else echo "error".$conn->error;

				$delete_tg ="DELETE from tacgia_truyen where matruyen='".$_POST["matruyen"]."'";
					if(mysqli_query($conn,$delete_tg)){
						$chon_tg=$_POST['$tacgia'];
						foreach($chon_tg as $key => $matg){
							$insert_tg="INSERT into tacgia_truyen values (
										'".$matg."',
										'".$_POST["matruyen"]."')";
							mysqli_query($conn,$insert_tg);
						}
					}else echo "error".$conn->error;
				echo "Sửa truyện thành công";
				echo '<meta http-equiv="refresh" content="1;URL=sua_truyen.php?matruyen='.$matruyen.'">';
			}
		}

	?>
	<div class="container">
		<caption><h2>Sửa truyện</h2></caption>
		<form enctype ="multipart/form-data" action="" method ="POST">
			<div class="form-group">
				<label>Mã truyện</label>
				<input type="text" class = "form-control" name="matruyen" value="<?php echo $matruyen ?>" readonly>
			</div>
			<div class="form-group">
				<label>Tên truyện</label>
				<input type="text" class = "form-control" name="tentruyen" value= "<?php echo $tentruyen ?>" required>
			</div>
			<div class="form-group">
				<label>Thể loại</label>
				<br>
				<?php 

					$select_theloai="select * from theloai";
					$ds_theloai =mysqli_query($conn,$select_theloai);
					
					while ($row= $ds_theloai->fetch_assoc()){
						if(in_array($row['maloai'], $theloai)){
							echo"<label class=".'"checkbox-inline"'.">";
							echo "<input type='checkbox' name=".'$theloai[]'." checked value=".$row['maloai'] .">".$row['tenloai']."";
							echo"</label>";
						}else{
							echo"<label class=".'"checkbox-inline"'.">";
							echo "<input type='checkbox' name=".'$theloai[]'." value=".$row['maloai'] .">".$row['tenloai']."";
							echo"</label>";
						}
					}	

				?>

			</div>
			
			<div class="form-group">
				<label>Tác giả</label><br>
				<?php 

					$select_tacgia="select * from tacgia";
					$ds_tacgia =mysqli_query($conn,$select_tacgia);
					
					while ($row= $ds_tacgia->fetch_assoc()){
						if(in_array($row['matg'], $tacgia)){
							echo"<label class=".'"checkbox-inline"'.">";
							echo "<input type='checkbox' name=".'$tacgia[]'." checked value=".$row['matg'] .">".$row['tentg']."";
							echo"</label>";
						}else{
							echo"<label class=".'"checkbox-inline"'.">";
							echo "<input type='checkbox' name=".'$tacgia[]'." value=".$row['matg'] .">".$row['tentg']."";
							echo"</label>";
						}
					}	

				?>
			</div>
			<div class="form-group">
				<label>Nhà xuất bản</label>
				<select class="form-control" name="manxb">
					<?php

						$select_nxb="select * from nhaxuatban";
						$ds_nxb=$conn->query($select_nxb);

						#lay du lieu
						while ($row= $ds_nxb->fetch_assoc()) {
							if($nhaxb==$row['manxb']){
								echo "<option value={$row['manxb']} selected>{$row['tennxb']}</option>";
							}else{
								echo "<option value={$row['manxb']}>{$row['tennxb']}</option>";
							}
							

						}

							
					?>
		      </select>
			</div>
			<div class="form-group">
				<label>Ngày xuất bản</label>
				<input type="date" class = "form-control" name="ngayxb" min="1980-01-01" max="<?php echo date("Y-m-d"); ?>" value="<?php echo $ngayxb ?>" required>
			</div>
			<div class="form-group">
				<label>Sơ lược nội dung</label>
				<textarea class="form-control" rows="5" name="noidung" required><?php echo $noidung ?></textarea>
			</div>
			<button type="submit" class="btn btn-default" name="btnSua">Sửa</button>
		</div>
	</form>

	</div>
</body>
</html>