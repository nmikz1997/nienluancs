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
<script LANGUAGE="JavaScript">
      function confirmAction() {
        return confirm("Bạn có muốn xóa?")
      }
      function logOut() {
        return confirm("Bạn có muốn đăng xuất?")
      }
 
</script>
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
                "emptyTable": "Chưa có dữ liệu nào",
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
	<title>Danh sách truyện</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

 	<style type="text/css">
 		tr:hover {background-color:#f5f5f5;}

 		th
 		{
 			padding-top: 12px;
			padding-bottom: 12px;
			text-align: left;
			background-color:#006bb3;
			color: white;
		}
 	</style>
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
	      <a class="navbar-brand" href="#">Quản lí</a>
	    </div>
	    <ul class="nav navbar-nav">
	      <li><a href="ds_truyen.php">Danh sách truyện</a></li>
	      <li><a href="ds_tacgia.php">Danh sách tác giả</a></li>
	      <li><a href="ds_theloai.php">Danh sách thể loại</a></li>
	      <li class="active"><a href="ds_nxb.php">Danh sách NXB</a></li>
	      <li><a href="ds_hoadon.php">Danh sách hóa đơn</a></li>
	      <!-- <li><a href="#">Thống kê</a></li> -->
	    </ul>
	  </div>
	</nav>

	<div class="container-fluid">
	<a class='btn btn-primary' href="them_nxb.php">Thêm Nhà Xuất Bản</a>
	<?php
		require_once('../connect/connect.php');

		$select="SELECT * from nhaxuatban";

		$ds_nxb	= mysqli_query($conn,$select);
	?>
		<table id='tabledulieu' name='tabledulieu' class="table table-bordered">
		<caption><h2>Danh Sách Nhà Xuất Bản</h2></caption>

		<thead>
			<tr>
				<th>Mã NXB</th>
				<th>Tên NXB</th>
				<th>Sửa</th>
				<th>Xóa</th>
			</tr>
			</thead>
			<tbody>
			<?php
			while($row = mysqli_fetch_assoc($ds_nxb)){
				echo "
				<tr>
				<td>{$row["manxb"]}	</td>
				<td>{$row["tennxb"]}	</td>
				<td><a class='btn btn-primary' href=sua_nxb.php?manxb=".$row["manxb"].">Sửa</td>
				<td><a class='btn btn-warning' href=delete_nxb.php?manxb=".$row["manxb"]." onclick='return confirmAction()'>Xóa</a></td>
				";
			}
			?>
			</tbody>

		</table>
		</form>
		</div>
</body>
</html>