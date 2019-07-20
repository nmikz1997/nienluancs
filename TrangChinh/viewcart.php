<?php
	session_start();
	require_once('../connect/connect.php');
?>

<?php
	$dsTruyenKhongDu = [];
	if(isset($_POST['btnNhapDC'])){
		//tạo cookie chứa địa chỉ
    	setcookie('diachi', $_POST['diachi'], time() + (86400*7));
    	header("location:viewcart.php");
	}

	if(isset($_POST['btnDoiDC'])){
		setcookie('diachi', $_POST['diachi'], time() - (86400*7));
		header("location:viewcart.php");
	}

	if (isset($_GET['action']) && $_GET['action'] === 'ketthuc' && isset($_COOKIE['giohang'])){

		$sdtkh	=$_SESSION['hoadon'][0]['sdt'];
		$tenkh	=$_SESSION['hoadon'][0]['ten'];
		$emailkh=$_SESSION['hoadon'][0]['email'];
		$address_data = stripslashes($_COOKIE['diachi']);

		$tonggt	=$_SESSION['hoadon'][0]['tonggt'];

		//var_dump($_COOKIE['giohang']);
		$cookie_data = stripslashes($_COOKIE['giohang']);
  		$cart_data = json_decode($cookie_data, true);

  		// var_dump($cart_data);
  		// var_dump($cart_data[0][0]);

		// $sql_hoadon="insert into hoadon (sdtkh,diachi,tonggt,ngaylap)
  // 										values ('".$sdtkh."',
  // 												'".$address_data."',
  // 												'".$tonggt."',
  // 												curdate()
  // 												)";
		// if (mysqli_query($conn,$sql_hoadon)){
		// 	$last_id = mysqli_insert_id($conn);
			$kiemtra = 1;
			$stt = 0;
			foreach ($cart_data as $key => $value) {
				$stt+=1;
				$kiemtra_slkho = "SELECT soluong from chitiettruyen
											where soluong > '".$cart_data[$key][2]."'-1
											and matruyen  = '".$cart_data[$key][0]."'
											and tinhtrang = '".$cart_data[$key][1]."'
								";
				$result_kiemtra = mysqli_query($conn,$kiemtra_slkho);
				if( mysqli_num_rows($result_kiemtra) == 0){
					$dsTruyenKhongDu[] = $stt;
					$kiemtra = 0;
				}

				//check số lượng trong kho
				//if(đủ) thành công
				//else(không đủ) thông báo không đủ số lượng => xóa hóa đơn
				//cập nhật số lượng trong Kho

			}
			if($kiemtra == 0){
				//header("location:viewcart.php?message=thatbai");
			}else{
				$sql_hoadon="insert into hoadon (sdtkh,diachi,tonggt,ngaylap)
  										values ('".$sdtkh."',
  												'".$address_data."',
  												'".$tonggt."',
  												curdate()
  												)";

  				if (mysqli_query($conn,$sql_hoadon)){
					$last_id = mysqli_insert_id($conn);
					foreach ($cart_data as $key => $value) {
						$sql_cthoadon="INSERT into cthoadon (mahd,matruyen,tinhtrang,soluong)
													value(
															'".$last_id."',
															'".$cart_data[$key][0]."',
															'".$cart_data[$key][1]."',
															'".$cart_data[$key][2]."'
															)";
						$sl= $cart_data[$key][2];
						$update_sl =" UPDATE chitiettruyen
										set
											soluong = soluong - $sl
										where
											matruyen  ='".$cart_data[$key][0]."' and
											tinhtrang ='".$cart_data[$key][1]."'
									";
						mysqli_query($conn,$sql_cthoadon);
						mysqli_query($conn,$update_sl);
					}
					setcookie("giohang", "", time() - (86400*30));
					header("location:viewcart.php?message=thanhcong");
			}
			
		}
	}
	if (isset($_GET['message']) && $_GET['message'] === 'thanhcong') {
		$tenkh	=$_SESSION['hoadon'][0]['ten'];
		$emailkh=$_SESSION['hoadon'][0]['email'];
		echo '
		<div class="alert alert-success" role="alert">
			Đã gửi yêu cầu đặt hàng. Bạn có muốn <a href="trangchu.php" class="alert-link">Tiếp tục mua hàng</a>. 
		</div>
		';

		// include_once('../sendMailLib.php');
		// $guiboi = 'Chủ cửa hàng truyện';
		// $subject = 'Đặt hàng thành công';
		// $content = 'Xin chào, "'.$tenkh.'" Cảm ơn bạn đã đặt hàng';
		// $ten = 'Trịnh Thế Nguyễn';
		// sendGMail('nguyentestmail1997@gmail.com','w3schools.com',$guiboi, array(array($emailkh, 'Trịnh Thế Nguyễn')), array(array('nguyentestmail1997@gmail.com',$guiboi)),$subject,$content);

	}

	if (isset($_GET['action']) && $_GET['action'] === 'ketthuc'){
		echo '
		<div class="alert alert-danger" role="alert">
			Không đủ số lượng yêu cầu.
		</div>
		';
	}

	if(isset($_COOKIE['giohang']) && strlen($_COOKIE['giohang']) <3){
		setcookie("giohang", "", time() - (86400*30));
		header("location:viewcart.php");
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
		div.sticky {
		    position: -webkit-sticky;
		    position: sticky;
		    top: 0;
		    background-color: yellow;
		    padding: 50px;
		    font-size: 20px;
		}
		*{
		margin: 0;
		padding: 0;
		}
		/*list product*/
		.list-product-title{
			width: 100%;
			text-transform: uppercase;
			margin-left: 5px;
			margin-right: 5px;

		}
		.list-product-subtitle{
			width: 100%;
			margin-left: 5px;
			margin-right: 5px;
		}

		/*product card*/
		.card-product{
			width: 100%;
			margin-left: 5px;
			margin-right: 5px;
			overflow: hidden;	
		}
		/*dropdown*/
		.dropdown-menu.columns-2 {
			min-width: 400px;
		}

		.dropdown-menu li a {
			padding: 5px 15px;
			font-weight: 300;
		}
		.multi-column-dropdown {
			list-style: none;
			margin: 0px;
			padding: 0px;
		}
		.multi-column-dropdown li a {
			display: block;
			clear: both;
			line-height: 1.428571429;
			color: #333;
			white-space: normal;
		}
		.multi-column-dropdown li a:hover {
			text-decoration: none;
			color: #262626;
			background-color: #999;
		}
			 
		@media (max-width: 767px) {
			.dropdown-menu.multi-column {
				min-width: 240px !important;
				overflow-x: hidden;
			}
	}
	</style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<div class="container">
	  <a class="navbar-brand" href="trangchu.php">Home</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	    <ul class="navbar-nav mr-auto">
	      	<li class="nav-item dropdown">
	            <a href="#" class="nav-link" data-toggle="dropdown">Thể loại</a>
	            <ul class="dropdown-menu multi-column columns-2">
		            <div class="row">
			            <div class="col-sm-6">
				            <ul class="multi-column-dropdown">
				            	<?php 
				            		require('../connect/connect.php');

	        						$select_loai="SELECT * from theloai order by tenloai";
	        						$result_loai= mysqli_query($conn,$select_loai);

	        						$num_rows=mysqli_num_rows($result_loai);
	        						$max_rows=round($num_rows/2);

	        						$select_loai1="SELECT * from theloai order by tenloai limit $max_rows ";
	        						$result_loai1= mysqli_query($conn,$select_loai1);

						        	while ($row=mysqli_fetch_assoc($result_loai1)) {
						        		echo "<li><a class='dropdown-item' href='truyentheoloai.php?maloai=".$row['maloai']."'> {$row['tenloai']} </a></li>";
						        	}
				            	?>
				            </ul>
			            </div>
			            <div class="col-sm-6">
				            <ul class="multi-column-dropdown">
					            <?php 
					            	$select_loai2="SELECT * from theloai order by tenloai limit $max_rows offset $max_rows"  ;
	        						$result_loai2= mysqli_query($conn,$select_loai2);

					            	while ($row=mysqli_fetch_assoc($result_loai2)) {
						        		echo "<li><a class='dropdown-item' href='truyentheoloai.php?maloai=".$row['maloai']."'> {$row['tenloai']} </a></li>";
						        	}
					            ?>
				            </ul>
			            </div>
		            </div>
	            </ul>
	      	</li>
	      	<li class="nav-item active">
	       		<a class="nav-link" href="truyencu.php">Truyện cũ<span class="sr-only">(current)</span></a>
	    	</li>
	      	<li class="nav-item active">
	       		<a class="nav-link" href="viewcart.php">Giỏ hàng<span class="sr-only">(current)</span></a>
	    	</li>
	    </ul>
	    <div>
		    <form class="form-inline my-2 my-lg-0" action="tim_truyen.php" method="GET">
		      <input class="form-control mr-sm-2" type="search" name="tentruyen" placeholder="Nhập tên truyện" aria-label="search">
		      <input type="hidden" value="<?php echo $_GET['tinhtrang']; ?>" name="tinhtrang">
		      <?php
		      		echo "<button class='btn btn-outline-success my-2 my-sm-0' type='submit' value='timtruyen'>Tìm truyện mới</button>";
		      ?>
		      
		    </form>
	    </div>
	   	<div style="text-align: right; margin-left: 5px;">
	    	<?php
				if(!isset($_SESSION['taikhoan'])){
					include_once('login.php');
				}else{
					echo "<a type='button' class='btn btn-danger' href='logout.php' onclick='return logOut()'>Thoát</a>";
					if($_SESSION['quyen'] == '1'){
						echo "<a type='button' style='margin-left:5px;' class='btn btn-danger' href='../Admin/ds_nxb.php'>Quản lý</a>";
					}
				}
			?>
	    </div>
	  </div>
	</div>
</nav>
<!--End Menu!-->
<div class="container">
<h3>Giỏ hàng</h3>
  <div class="card-deck">
    <div class="col-sm-8">
      <div class="card-body">
      	<div align="right"><a href="action_cart.php?action=clearall">Xóa giỏ hàng</a></div>
        <table class="table table-hover">
        	<thead>
        		<tr>
		      		<th width="120px">Truyện mới</th>
			        <th width="150px">Ảnh bìa</th>
			        <th>Tên truyện</th>
			        <th>Đơn giá</th>
			        <th width="120px">Số lượng</th>
			        <th></th>
		      	</tr>
        	</thead>
        	<tbody>

        		<?php
        			if(isset($_COOKIE['giohang']))
        			{
						$total = 0;
				    	$cookie_data = stripslashes($_COOKIE['giohang']);
				    	$cart_data = json_decode($cookie_data, true);
				    	$i=0;
	        			
				    	foreach($cart_data as $key => $value){
				    		$i+=1;
				    		$matruyen=$value[0];
				    		$tinhtrang=$value[1];
				    		$result=mysqli_query($conn,"SELECT tentruyen,gia,bia from chitiettruyen
															join truyen on chitiettruyen.matruyen=truyen.matruyen
														where chitiettruyen.matruyen= '$matruyen' and tinhtrang= '$tinhtrang'");
				    		$row = mysqli_fetch_assoc($result);
				    		$total = $total + ($value[2] * $row["gia"]);
        		?>
	        	<tr <?php if(in_array($i, $dsTruyenKhongDu) && isset($dsTruyenKhongDu)) echo 'bgcolor="#FF9999"'; ?>>
			      	<td><?php if($tinhtrang === 'new'){echo "<p>&#9989</p>"; }; ?></td>
			        <td><?php echo "<img class='img-responsive center-block anh' src=../Database/".$tinhtrang."/".$row['bia']." width=150px height=150px/>"; ?></td>
			        <td><?php echo $row['tentruyen']; ?></td>
			        <td><?php echo number_format($row["gia"],0,',','.'); ?></td>
			        
			        <td>
			        	<a href="action_cart.php?action=sub&key=<?php echo $key ?>" class="btn btn-primary btn-sm">-</a>
			        	<input style="width:23px; height:23px" type="text" value="<?php echo $value[2]; ?>" readonly/>
			        	<a href="action_cart.php?action=add&key=<?php echo $key ?>" class="btn btn-primary btn-sm">+</a>
			        </td>
			        <td><a href="action_cart.php?action=delete&key=<?php echo $key ?>" class="btn btn-warning">Xóa</a></td>  
			    </tr>

			<?php      
						}
						if (strlen($_COOKIE['giohang']) <3)
						{
							echo "<tr><td colspan='5' align='center'>Không có sản phẩm</td></tr>";
						}

					}else{
						echo "<tr><td colspan='5' align='center'>Không có sản phẩm</td></tr>";
					}
					
			?>
        	</tbody>
        </table>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="card-body">
        <div class="card-text">
        	<div>
        	<h4>
        		<span>Thành tiền:</span>
        		<span><?php if(isset($total) && $total > 0){echo number_format($total,0,',','.')." VNĐ"; }?></span>
        	</h4>
    <?php
		//require_once('../connect/connect.php');
    if (empty($_COOKIE['giohang'])) {
    	
    }else{
    	
		$cookie_data = stripslashes($_COOKIE['giohang']);
  		$cart_data = json_decode($cookie_data, true);
  		if(isset($_SESSION['taikhoan'])){
  			$sdtkh=$_SESSION['taikhoan'];
  			$result=mysqli_query($conn,"SELECT * from khachhang where sdtkh='$sdtkh'");
  			$row_info=mysqli_fetch_assoc($result);

  			$hoadon = array(
  				'sdt'		=> $sdtkh,
  				'ten' 		=> $row_info['tenkh'],
  				'email'		=> $row_info['emailkh'],
  				'tonggt'	=> $total
  			);

  			$_SESSION['hoadon'][0] = $hoadon;

  			//if (strlen($_COOKIE['giohang']) <3 ){echo "<meta http-equiv='refresh' content='0;URL='viewcart.php'' /> '"; };

  			// có địa chỉ trong cookie hiện lên
  			if(isset($_COOKIE['diachi'])){
  				$address_data = stripslashes($_COOKIE['diachi']);
  	?>
  			<form method="POST">
  				<input type="text"  class="form-control" aria-label="Default" value="<?php echo $address_data; ?>" required readonly />
  				<button style="margin-top: 5px" type="submit" name="btnDoiDC" class="btn btn-warning">Đây không phải địa chỉ của tôi</button>
  			</form>
  				<div align="center" style="margin-top: 10px"><a href="viewcart.php?action=ketthuc" class="btn-primary btn">Đặt hàng</a></div>
  	<?php	}else{
  			// yêu cầu nhập địa chỉ giao hàng khi chưa có


  	?>
  			<form method="POST">
  				<input type="text" class="form-control" aria-label="Default" name="diachi" placeholder="3/2 Xuân Khánh,Ninh Kiều,Cần Thơ" required />
  				<button style="margin-top: 5px" type="submit" name="btnNhapDC" class="btn btn-primary">Xác nhận địa chỉ</button>
  			</form>
  	<?php

  			}
  			// tạo hóa đơn trong bảng hoadon total = 0
  			// lấy id hóa đơn tạo chitiethoadon
  			// insert cookie_data vao bang chitiethoadon
  			// tinh thanh tien chitiethoadon
  			// cap nhat bang hoadon (update table hoadon)


  		}else{
	?>
		<h4>Cần đăng nhập để thanh toán</h4>
	<?php
		}
	}	
	?>
        	<div>
        	
        </div>
      </div>
    </div>
  </div>
</div>		

<!--Script!-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script>
    	function logOut() {
        return confirm("Bạn có muốn đăng xuất?")
      }
    </script>
</body>
</html>