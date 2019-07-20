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

<script LANGUAGE="JavaScript">
      function logOut() {
        return confirm("Bạn có muốn thoát?")
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
            	"lengthMenu": [[5, 10, 15, 20, 25, 30, -1], [5, 10, 15, 20, 25, 30, "Tất cả"]]
   			} );
    	new $.fn.dataTable.FixedHeader( table );
		} );
</script>
    
<!DOCTYPE html>
<html>
<head>
	<title>Danh sách truyện mới</title>
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
		    <a class="dropdown-toggle" data-toggle="dropdown" href="ds_truyen.php">Danh sách truyện
	        <span class="caret"></span></a>
	        <ul class="dropdown-menu">
	          <li><a href="ds_truyenmoi.php">Danh sách truyện mới</a></li>
	          <li><a href="ds_truyencu.php">Danh sách truyện cũ</a></li>
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
	<a class='btn btn-primary' href="them_sp.php">Thêm truyện</a>
	<?php
		require_once('../connect/connect.php');

		$select="SELECT truyen.matruyen,tentruyen,tennxb,ngayxb,noidung
		   	from truyen
		   		join nhaxuatban on nhaxuatban.manxb=truyen.manxb";

		$ds_truyen	= mysqli_query($conn,$select);

		$dsTruyenTonTai = mysqli_query($conn,"SELECT matruyen,tinhtrang from chitiettruyen");
			while ($rs = mysqli_fetch_row($dsTruyenTonTai)) {
				$list[]=$rs;
			}

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

		function hienthitacgia($matruyen) {
	    	require('../connect/connect.php');
			$select_tacgia="SELECT tacgia_truyen.matg,tentg
							from truyen
								inner join tacgia_truyen on truyen.matruyen=tacgia_truyen.matruyen 
								inner join tacgia on tacgia.matg=tacgia_truyen.matg where truyen.matruyen=".$matruyen;

			$result_tacgia	= mysqli_query($conn,$select_tacgia);

			$tacgiaa= "";

			while($row = mysqli_fetch_assoc($result_tacgia)){
				$tacgiaa= $tacgiaa.$row['tentg'].", ";
				}

	   		return $tacgiaa;
		}

		function day($matruyen){
			require('../connect/connect.php');
			$select_ngay="
							SELECT ngayxb
							from truyen
							where matruyen =".$matruyen;
			$day_old="";
			$day_new="";
			$result_ngay=mysqli_query($conn,$select_ngay);
			while ($rows= mysqli_fetch_array($result_ngay)){
						$day_old=$rows['ngayxb'];
						$day_new = date("d-m-Y", strtotime($day_old));
			}				
				return $day_new;
		}
		mysqli_close($conn);
		?>
		<table class="table table-bordered" id='tabledulieu' name='tabledulieu'>
		<caption><h2>Danh Sách Truyện</h2></caption>

		<thead>
			<tr>
				<th>Mã</th>
				<th>Tên Truyện</th>
				<th>Thể loại</th>
				<th>Tác giả</th>
				<th>NXB</th>
				<th>Ngày XB</th>
				<th width="130px">Thêm</th>
				<th>Sửa</th>
				<th>Xóa</th> 
			</tr>
			</thead>
			<tbody>
		<?php
			while($row = mysqli_fetch_assoc($ds_truyen)){
				$ds_loai=hienthiloai($row["matruyen"]);
				$ds_tg=hienthitacgia($row["matruyen"]);
				$day=day($row["matruyen"]);
		?>		
				<tr>
					<td><?php echo $row["matruyen"];	?></td>
					<td><?php echo $row["tentruyen"];	?></td>
					<td><?php echo $ds_loai;	?></td>
					<td><?php echo $ds_tg;	?></td>
					<td><?php echo $row["tennxb"]; ?></td>
					<td><?php echo $day; ?> </td>
					<td>
					<?php 
						if(in_array([$row["matruyen"],'new'], $list) && in_array([$row["matruyen"],'old'], $list)){
							echo 'Đã có';
						}else if(in_array([$row["matruyen"],'new'], $list)){
							echo '<a href="them_chitiettruyencu.php?matruyen='.$row['matruyen'].'">+ Cũ</a>';
						}else if(in_array([$row["matruyen"],'old'], $list)){
							echo '<a href="them_chitiettruyen.php?matruyen='.$row['matruyen'].'">+ Mới</a>';
						}else{
							echo '<a href="them_chitiettruyen.php?matruyen='.$row['matruyen'].'">+ Mới</a> | <a href="them_chitiettruyencu.php?matruyen='.$row['matruyen'].'">+ Cũ</a>';
						}
					?>
					</td>
					<td><a class='btn btn-primary' href='sua_truyen.php?matruyen=<?php echo $row["matruyen"]; ?>'>Sửa</td>
					<td><a class='btn btn-warning' href='delete_truyen.php?matruyen=<?php echo $row["matruyen"]; ?>' onclick='return confirmAction()'>Xóa</a></td>
				</tr>
		<?php		
			}
			//echo '<br>';
			//var_dump($list);
		?>	
		</tbody>
		</table>

	</div>

</body>
</html>