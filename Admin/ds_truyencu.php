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
	<title>Danh sách truyện cũ</title>
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
	<nav class="navbar navbar-default">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand" href="#">Quản lí</a>
	    </div>
	    <ul class="nav navbar-nav">
	      <li class="dropdown">
		    <a class="dropdown-toggle" data-toggle="dropdown" href="ds_truyencu.php">Danh sách truyện cũ
	        <span class="caret"></span></a>
	        <ul class="dropdown-menu">
	          <li><a href="ds_truyen.php">Danh sách truyện</a></li>
	          <li><a href="ds_truyenmoi.php">Danh sách truyện mới</a></li>
	        </ul>
	      </li>
	      <li><a href="ds_tacgia.php">Danh sách tác giả</a></li>
	      <li><a href="ds_theloai.php">Danh sách thể loại</a></li>
	      <li><a href="ds_nxb.php">Danh sách NXB</a></li>
	      <li><a href="ds_hoadon.php">Danh sách hóa đơn</a></li>
	      <!-- <li><a href="#">Thống kê</a></li> -->
	    </ul>
	  </div>
	</nav>

	<div class="container-fluid">
	<!-- <a class='btn btn-primary' href="them_chitiettruyencu.php">Thêm truyện Cũ</a> -->
	<?php
		require('../connect/connect.php');

		$select="SELECT chitiettruyen.matruyen,tentruyen,ngaynhap,soluong,gia,bia
		   	from chitiettruyen
		   		join truyen  on truyen.matruyen=chitiettruyen.matruyen
					where tinhtrang= 'old'";

		$ds_truyen	= mysqli_query($conn,$select);

		function hienthiloai($matruyen) {
    		require('../connect/connect.php');
			$select_loai="SELECT loai_truyen.maloai,tenloai
						from truyen
							inner join loai_truyen on truyen.matruyen=loai_truyen.matruyen 
							inner join theloai on theloai.maloai=loai_truyen.maloai where truyen.matruyen=".$matruyen;

			$result_loai	= mysqli_query($conn,$select_loai);

			$loaii= "";

			while($row = mysqli_fetch_assoc($result_loai)){
				$loaii= $loaii.$row['tenloai'].", ";
			}

   			return $loaii;
			}
		mysqli_close($conn);
		?>
		<form action='../script/delete_truyencu.php' method='POST' onsubmit='return confirmAction()'>
		<table id="tabledulieu" class= "table table-bordered">
		<caption><h2>Danh Sách Truyện Cũ</h2></caption>

		<thead>
			<tr>
				<th>Mã</th>
				<th style='width:200px'>Tên truyện</th>
				<th style='width:93px'>Ngày Nhập</th>
				<th>SL</th>
				<th>Giá</th>
				<th style='width=200px'>Ảnh Bìa</th>
				<th style='width:40px'>Sửa</th>
				<th style='width:40px'><button type="submit" class="btn btn-warring">Xóa</button></th>
			</tr>
		</thead>
		<tbody>
		<?php 	
			while($row = mysqli_fetch_assoc($ds_truyen)){
				$ds_loai=hienthiloai($row["matruyen"]);
			?>
				<tr>
					<td><?php echo $row["matruyen"]; ?>	</td>
					<td><?php echo $row["tentruyen"]; ?>	</td>
					<td><?php echo $row["ngaynhap"]; ?>	</td>
					<td><?php echo $row["soluong"]; ?>	</td>
					<td><?php echo $row["gia"]; ?>		</td>
					<td style='width=200px'> <img src='../Database/Old/<?php echo $row["bia"]; ?>' height=200px width=200px></td>
					<td><a class='btn btn-primary' href='sua_truyencu.php?matruyen=<?php echo $row["matruyen"];?>'>Sửa</td>
					<td><input type='checkbox' name='ds_xoa[]'  value='<?php echo $row['matruyen'];?>' ></input></td>
				</tr>
		<?php		
			}
		?>	
		
		</tbody>
		</table>
		
		</form>
	</div>

</body>
</html>