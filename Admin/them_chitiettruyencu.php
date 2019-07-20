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
	<title>Thêm thông tin chi tiết truyện mới</title>
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
<?php 
	require_once('../connect/connect.php');
	//giá truyện mới
	if(isset($_POST['btnThemChiTiet']))
	{
		$matruyen	=$_POST['matruyen']	;
		$anh 		=$_FILES['imgname']	;
		$tinhtrang	=$_POST['tinhtrang'];
		$gia		=$_POST['gia']		;
		$soluong	=$_POST['soluong']	;

		$select_matruyen="SELECT matruyen from truyen where matruyen=".$_POST['matruyen'];
		$result_matruyen=$conn->query($select_matruyen);

		//giá truyện mới
		$select_gia = "SELECT gia from chitiettruyen where matruyen = $matruyen and tinhtrang = 'new'";
		$rs_gia = $conn->query($select_gia);
		if(mysqli_num_rows($rs_gia) > 0){
			$giaMax = $rs_gia->fetch_assoc();
		}

		$row= $result_matruyen->fetch_assoc();
		if(isset($row))
		{
			$select_matruyen="SELECT matruyen from chitiettruyen where matruyen= $matruyen and tinhtrang='old'";
			$result_matruyen=$conn->query($select_matruyen);
			$row_matruyen= $result_matruyen->fetch_assoc();
			if(!isset($row_matruyen)){
				if(isset($giaMax['gia']) && (int)$gia > ((int)$giaMax['gia'])*0.8){
					echo 'Giá truyện cũ không được vượt quá '.(int)$giaMax['gia']*0.8.' (80% giá gốc)';
				}else{

				if($anh['type'] =="image/jpg" || $anh['type'] =="image/jpeg" || $anh['type'] =="image/png" || $anh['type'] =="image/gif")
				{
					if($anh['size'] <= 614400)
					{
						$tenanh =$matruyen.$tinhtrang."_".$anh['name'];
						#thêm chi tiết truyện cũ
							$insert_truyencu= "insert into chitiettruyen
												values ('".$_POST['matruyen']	."',
														'".$_POST['tinhtrang']	."',
														CURDATE(),
														'".$tenanh				."',
														'".$_POST["gia"]		."',
														'".$_POST["soluong"]	."
														')";
							if($conn->query($insert_truyencu) === TRUE)
							{	
								copy($anh['tmp_name'],"../Database/Old/".$tenanh);
								echo "Đã thêm truyện cũ";
							}
							else
							{
								echo "Lỗi: Thêm truyện cũ thất bại";
								
							}			
						}else{
							echo "Lỗi: Hình ảnh có kích thước quá lớn";
						}
				}
				else{
					echo "Lỗi: Ảnh không đúng định dạng" . "<br>" . $conn->error;
					}
				}

			}else{
				echo "chi tiết truyện cũ đã tồn tại Không thể thêm!";
			}

		}else{
			echo "Mã truyện chưa tồn tại. Bạn muốn thêm thông tin truyện?";
			echo "<a class='btn btn-primary' href=them_sp.php?matruyen=".$matruyen.">Có</a>"." ";
			echo "<a class='btn btn-primary' href=''=".$matruyen.">Không</a>";
		}

	}
?>



<div>
	<form enctype ="multipart/form-data" action="" method ="POST">
		<div class="container">
		<caption><h3>Xin mời nhập chi tiết Truyện Cũ</h3></caption>
			<div class="form-group">
				<label>Mã truyện</label>
				<input type="text" class = "form-control" name="matruyen" value="<?php if(isset($_GET['matruyen'])){echo $_GET['matruyen'];}?>" required readonly>
			</div>
			<div class="form-group">
				<label>Tình trạng</label>
				<select class="form-control" name="tinhtrang" readonly>
					<option value="old">Cũ</option>
				</select>
			</div>
			<div class="form-group">
				<label>Số lượng</label>
				<input type="number" class = "form-control" name="soluong" min="0" value="<?php if(isset($soluong)){echo $soluong;}?>" required>
			</div>
			<div class="form-group">
				<label>Giá</label>
				<input type="number" class = "form-control" name="gia" min="1000" value="<?php if(isset($gia)){echo $gia;}?>" required>
			</div>
			<div class="form-group">
				<label>Bìa Truyện</label>
				<input type="file" class = "form-control" name="imgname" required>
			</div>
			<div class="form-group">
			<button type="submit" class="btn btn-default" name="btnThemChiTiet">Thêm chi tiết</button>
			<a href="ds_truyen.php" class="btn btn-default">Trở về</a>
		</div>
	</form>
</div>
</body>
</html>