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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!DOCTYPE html>
<html>
<head>
	<title>chi tiết hóa đơn</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<style type="text/css">
 		tr:hover {background-color:#f5f5f5;}

 		th {padding-top: 12px;
			padding-bottom: 12px;
			text-align: left;
			background-color:#006bb3;
			color: white;}

 	</style>
</head>
<body>
<?php
	require_once('../connect/connect.php');
	$mahd=$_GET['mahd'];
	$result=mysqli_query($conn,"SELECT cthoadon.matruyen,tentruyen,cthoadon.tinhtrang,cthoadon.soluong,gia from cthoadon
									join truyen on truyen.matruyen = cthoadon.matruyen
									join chitiettruyen on cthoadon.matruyen=chitiettruyen.matruyen and cthoadon.tinhtrang=chitiettruyen.tinhtrang
								where mahd='".$_GET['mahd']."'
								order by cthoadon.matruyen");

?>
<div class="container-fluid" style="margin-top: 20px">
	<table id='tabledulieu' class="table table-bordered">
		<thead>
			<tr>
				<th>Mã truyện 	</th>
				<th>Tên truyện 	</th>
				<th>Truyện mới 	</th>
				<th>Số lượng 	</th>
				<th>Đơn giá 	</th>
				<th>Thành tiền 	</th>
			</tr>
		</thead>

		<tbody>
			<?php
				$total=0;
				$duyet=1;

				if(isset($_GET['action']) && $_GET['action']=='duyet')
				{
						
					if(isset($_GET['mahd'])){
						$mahd = $_GET['mahd'];
						settype($mahd, "int");
						$duyet="UPDATE hoadon
									set
										giaohang=1
									where mahd=$mahd";
					if($conn->query($duyet)){
						//echo '<div class="alert alert-success" role="alert">Đã duyệt hóa đơn!</div>';
						echo '
							<div class="alert alert-success alert-dismissible">
							  <a href="cthoadon.php?mahd='.$mahd.'" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							  <strong>Đã duyệt hóa đơn!</strong>
							</div>
						';
						//echo '<div class="alert alert-success" role="alert">Đã cập nhật số lượng tồn kho!</div>';			
					}else{
						echo "LỖI";
						}
					}
				}

				$update = 0;

				while($row = mysqli_fetch_assoc($result))
				{
					$total=$total+$row['gia']*$row['soluong'];
					$matruyen	= $row['matruyen'];
					$tinhtrang	= $row['tinhtrang'];
					$select_hangton="SELECT soluong from chitiettruyen where matruyen='$matruyen' and tinhtrang='$tinhtrang'";	
					$result_hangton=mysqli_query($conn,$select_hangton);
					$row_hangton=mysqli_fetch_assoc($result_hangton);

			?>
			<tr>
				<td><?php echo $row['matruyen']; 	?></td>
				<td><?php echo $row['tentruyen']; 	?></td>
				<td><?php if($row['tinhtrang']== 'new'){echo "<p>&#9989</p>";}; ?></td> 
				<td><?php echo $row['soluong']; 	?></td>
				
				<td align="right"><?php echo number_format($row['gia']);?></td>
				<td align="right"><?php echo number_format($row['gia']*$row['soluong']);?></td>
			</tr>
			<?php
					if(isset($_GET['action']) && $_GET['action'] == 'huy' && isset($_GET['mahd'])){
						//update so luong
						$sl = (int)$row["soluong"];
						$matruyen = $row["matruyen"];
						$ttrang = $row["tinhtrang"];
						$updateSL = "
									UPDATE chitiettruyen
										SET
											soluong=soluong + $sl
										WHERE
											matruyen  = '$matruyen' AND
											tinhtrang = '$ttrang' ;
									";
						if(mysqli_query($conn,$updateSL)){
							$update = 1;
						}else{
							$update = 0;
						}

					}
				}

				if($update == 1) {
					$xoa_hoadon="DELETE from hoadon where mahd=".$_GET['mahd']."";
				  	if(mysqli_query($conn,$xoa_hoadon)){
				  		header("location:ds_hoadon.php?message=daxoa");
				  	}
				}
			?>
			<tr>
				<td colspan="5" align="right">Tổng</td>
				<td align="right"><?php echo number_format($total); ?></td>
			</tr>
		</tbody>
	</table>
	<?php
		$result_giaohang=mysqli_query($conn,"SELECT giaohang from hoadon where giaohang=0 and mahd=$mahd");
			if(mysqli_num_rows($result_giaohang) == 1){
				if($duyet == 1){
				echo '<a href="cthoadon.php?action=duyet&mahd='.$mahd.'">Duyệt hóa đơn này</a>';
				//thực hiện duyệt hóa đơn
				echo '<a href="cthoadon.php?action=huy&mahd='.$mahd.'" class= "btn btn-primary" style="float:right;">Hủy đơn hàng</a>';
				}
			}else{
				echo 'Hóa đơn này đã thanh toán';
			}

	?>
</div>	
</body>
</html>