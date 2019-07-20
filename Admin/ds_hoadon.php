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
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>
<script>
        $(document).ready(function() {
    		var table = $("#tabledulieu").DataTable( {
        	responsive: true,
        		"language":{
                "infoEmpty": "Dữ liệu rỗng",
                "emptyTable": "Chưa có hóa đơn nào",
                "processing": "Đang xử lý...",
                "search": "Tìm kiếm:",
                "loadingRecords": "Đang load dữ liệu...",
                "zeroRecords": "không tìm thấy dữ liệu",
                "infoFiltered": "(Được từ tổng số MAX dòng dữ liệu)",
                "paginate": {
                    "first": "|<",
                    "last": ">|",
                    "next": ">>",
                    "previous": "<<"
                }
            	},
            	"lengthMenu": [[10, 15, 20, 25, 30, -1], [10, 15, 20, 25, 30, "Tất cả"]]
   			} );
    	new $.fn.dataTable.FixedHeader( table );
		} );
</script>
<!DOCTYPE html>
<html>
<head>
	<title>Danh sách hóa đơn</title>
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
<div>
	<div class="container-fluid" style="text-align: right; margin-bottom: 5px; margin-top: 5px;">
		<a type="button" class="btn btn-danger" href="logout.php" onclick='return logOut()'>Đăng xuất</a>	
	</div>
</div>
<div>
	<nav class="navbar navbar-default">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand" href="#">Quản lí</a>
	    </div>
	    <ul class="nav navbar-nav">
	      <li><a href="ds_truyen.php">Danh sách truyện</a></li>
	      <li><a href="ds_tacgia.php">Danh sách tác giả</a></li>
	      <li><a href="ds_theloai.php">Danh sách thể loại</a></li>
	      <li><a href="ds_nxb.php">Danh sách NXB</a></li>
	      <li class="active"><a href="ds_hoadon.php">Danh sách hóa đơn</a></li>
	      <!-- <li><a href="#">Thống kê</a></li> -->
	    </ul>
	  </div>
	</nav>
</div>

<div class="container-fluid">
<?php
	require_once('../connect/connect.php');

	if(isset($_GET['action']) && $_GET['action']=='dagiao'){
		$result=mysqli_query($conn,"SELECT mahd,hoadon.sdtkh,diachi,tonggt,ngaylap,tenkh,emailkh,giaohang from hoadon 
		join khachhang on khachhang.sdtkh=hoadon.sdtkh
		where giaohang = 1");
		echo '<a href="ds_hoadon.php" class="btn btn-primary" style="margin-bottom: 10px">Xem danh sách chờ giao hàng</a>';

	}else{
		$result=mysqli_query($conn,"SELECT mahd,hoadon.sdtkh,diachi,tonggt,ngaylap,tenkh,emailkh,giaohang from hoadon 
		join khachhang on khachhang.sdtkh=hoadon.sdtkh
		where giaohang = 0");
		echo '<a href="ds_hoadon.php?action=dagiao" class="btn btn-primary" style="margin-bottom: 10px">Xem danh sách đã giao hàng</a>';
	}

	if(isset($_GET['message']) && $_GET['message']=='daxoa'){
		echo '
			<div class="alert alert-success" role="alert">
				Đã hủy đơn hàng. 
			</div>
		';
	}

?>

<table id='tabledulieu' class="table table-bordered">
<?php 
	if(isset($_GET['action']) && $_GET['action']=='dagiao'){
		echo '<caption><h2>Danh sách hóa đơn đã giao hàng</h2></caption>';
	}else{
		echo '<caption><h2>Danh sách hóa đơn chờ giao hàng</h2></caption>';
	}; 
?>
	<thead>
		<tr>
			<th>Số HĐ</th>
			<th>SĐT</th>
			<th>Họ tên</th>
			<th>Email</th>
			<th>Địa chỉ</th>
			<th>Tổng giá trị</th>
			<th>Ngày lập</th>
			<th>Xem</th>
<!-- 			<?php //if(!isset($_GET['action'])) echo '<th>Action</th>'; ?>
 -->	</tr>
	</thead>

	<tbody>
	<?php
		$tongDoanhThu = 0;
		while($row = mysqli_fetch_assoc($result)){
			$tongDoanhThu = $tongDoanhThu + $row['tonggt'];
	?>
		<tr>
			<td><?php echo $row['mahd'] 	?></td>
			<td><?php echo $row['sdtkh'] 	?></td>
			<td><?php echo $row['tenkh'] 	?></td>
			<td><?php echo $row['emailkh'] 	?></td>
			<td><?php echo $row['diachi'] 	?></td>
			<td><?php echo number_format($row['tonggt']) 	?></td>
			<td><?php echo $row['ngaylap'] 	?></td>
			<td><a href="cthoadon.php?mahd=<?php echo $row['mahd']?>" class="btn btn-primary" target="_blank">Chi tiết</a></td>
<!-- 			<?php //if(!isset($_GET['action'])) echo '<td><a href="ds_hoadon.php?mahd='.$row["mahd"].'" class="btn btn-primary">Xóa</a></td>'; ?>
 -->	</tr>
	<?php
		}
		if(isset($_GET['action']) && $_GET['action']=='dagiao') echo '<h4 align="right">Tổng doanh thu: '.number_format($tongDoanhThu).' </h4>';
	?>
	</tbody>
</table>
</div>
</body>
</html>