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
	<title>Thêm thông tin truyện</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">


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
	      <li class="active"><a href="them_sp.php">Thêm truyện</a></li>
	    </ul>
	  </div>
	</nav>

<?php 
	require_once('../connect/connect.php');
	if(isset($_POST['btnThem'])){
		$matruyen	=$_POST['matruyen']	;
		$tentruyen	=$_POST['tentruyen'];
		$manxb		=$_POST['manxb']	;
		$ngayxb		=$_POST['ngayxb']	;
		$noidung	=$_POST['noidung']	;

		$select_matruyen="SELECT matruyen from truyen where matruyen='$matruyen'";
		$result_matruyen=$conn->query($select_matruyen);
		//$row_tontai= $result_matruyen->fetch_assoc();

		if(mysqli_num_rows($result_matruyen) > 0){
			echo "mã truyện ".$_POST['matruyen']." đã tồn tại. ";
			// echo "Bạn có muốn thêm chi tiết truyện ?";
			// echo "<a class='btn btn-primary' href=them_chitietsp.php?matruyen=".$matruyen.">Có</a>"." ";
			// echo "<a class='btn btn-primary' href=''>Không</a>";
		}else{
			if(isset($_POST['theloai'])){
				$theloai 	=$_POST['theloai'];
				
				if(isset($_POST['tacgia'])){
					$tacgia		=$_POST['tacgia'];
					$insert_truyen = "insert into truyen 
						values ('".$_POST["matruyen"]	."',
								'".$_POST["tentruyen"]	."',
								'".$_POST["manxb"]		."',
								'".$_POST["ngayxb"]		."',
								'".$_POST["noidung"]	."
								')";
					if ($conn->query($insert_truyen))
					{
						foreach ($theloai as $key => $value)
						{
							$insert_loaitruyen = "insert into loai_truyen 
									values ('".$_POST["matruyen"]."',
											'".$value."')";
							$conn->query($insert_loaitruyen);
						}
						foreach ($tacgia as $key => $matg)
						{
							$insert_tacgia = "INSERT into tacgia_truyen values (
											'".$matg."',
											'".$_POST["matruyen"]."')";
							$conn->query($insert_tacgia);
						}
						echo "Bạn có muốn thêm chi tiết truyện ?";
						echo "<a class='btn btn-primary' href=them_chitietsp.php?matruyen=".$matruyen.">Có</a>"." ";
						echo "<a class='btn btn-primary' href='them_sp.php'>Không</a>";
					}


				}else{
						echo "Lỗi: Vui lòng chọn tác giả<br>";
				}
			}else{
				echo "Lỗi: Vui lòng chọn thể loại<br>";
			}	
		}
			
	}
?>

<span></span>

<div>
	<form enctype ="multipart/form-data" action="" method ="POST">
		<div class="container">
		<caption><h3>Thêm thông tin truyện</h3></caption>
			<div class="form-group">
				<label>Mã truyện</label>
				<input type="text" class = "form-control" id="matruyen" name="matruyen" value="<?php if(isset($matruyen)){echo $matruyen;}?>" placeholder="0101" required pattern="[0-9]{1,10}" >
			</div>
			<div class="form-group">
				<label>Tên truyện</label>
				<input type="text" class = "form-control" id="tentruyen" name="tentruyen" value="<?php if(isset($tentruyen)){echo $tentruyen;}?>" required>
			</div>
			<div class="form-group">
				<label>Thể loại</label>
				<br>
				<?php 

					$select_theloai="select * from theloai";
					$ds_theloai =$conn->query($select_theloai);
					if(!isset($theloai)){
						while ($row= $ds_theloai->fetch_assoc()){
						echo"<label class=".'"checkbox-inline"'.">";
						echo "<input type=".'"checkbox"'.'name='.'"theloai[]"'."value=".$row['maloai'] .">".$row['tenloai'];
						echo"</label>";
						}
					}else{
						while ($row= $ds_theloai->fetch_assoc()){
							if(in_array($row['maloai'], $theloai)){
								echo"<label class=".'"checkbox-inline"'.">";
								echo "<input type='checkbox' name=".'theloai[]'." checked value=".$row['maloai'] .">".$row['tenloai']."";
								echo"</label>";
							}else{
								echo"<label class=".'"checkbox-inline"'.">";
								echo "<input type='checkbox' name=".'theloai[]'." value=".$row['maloai'] .">".$row['tenloai']."";
								echo"</label>";
							}
						}
					}
					
				?>

			</div>
			
			<div class="form-group">
				<label>Tác giả</label>
				<br>
				<?php 

					$select_tacgia="select * from tacgia";
					$ds_tacgia =$conn->query($select_tacgia);
					if(!isset($tacgia)){
						while ($row= $ds_tacgia->fetch_assoc()){
						echo"<label class=".'"checkbox-inline"'.">";
						echo "<input type=".'"checkbox"'.'name='.'"tacgia[]"'."value=".$row['matg'] .">".$row['tentg'];
						echo"</label>";
						}
					}else{
						while ($row= $ds_tacgia->fetch_assoc()){
							if(in_array($row['matg'], $tacgia)){
								echo"<label class=".'"checkbox-inline"'.">";
								echo "<input type='checkbox' name=".'tacgia[]'." checked value=".$row['matg'] .">".$row['tentg']."";
								echo"</label>";
							}else{
								echo"<label class=".'"checkbox-inline"'.">";
								echo "<input type='checkbox' name=".'tacgia[]'." value=".$row['matg'] .">".$row['tentg']."";
								echo"</label>";
							}
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

						while ($row= $ds_nxb->fetch_assoc()) {
							echo "<option value=".$row['manxb'].">".$row['tennxb']."</option>";
						}
							
					?>
				</select>
			</div>
			<div class="form-group">
				<label>Ngày xuất bản</label>
				<input type="date" class = "form-control" id="ngayxb" name="ngayxb" min="1980-01-01" max="<?php echo date("Y-m-d"); ?>" value="<?php if(isset($ngayxb)){echo $ngayxb;}?>" required>
			</div>
			<div class="form-group">
				<label>Sơ lược nội dung</label>
				<textarea class="form-control" rows="5" id="noidung" name="noidung" required><?php if(isset($noidung)){echo $noidung;}?></textarea>
			</div>
			<div class="form-group">
			<button type="submit" class="btn btn-default" name="btnThem">Thêm</button>
		</div>
	</form>
</div>

</body>
</html>