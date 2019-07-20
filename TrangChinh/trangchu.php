<?php
	session_start();
?>

<?php
	if(isset($_GET['action']) && $_GET['action']= 'them'){
		if(isset($_GET['matruyen']) && $_GET['tinhtrang']){
	    if (isset($_COOKIE['giohang'])){
	      $cookie_data = stripslashes($_COOKIE['giohang']);
	      $cart_data = json_decode($cookie_data, true);
	    }else{
	      $cart_data = array();
	    }
	    $item_id_list = array_column($cart_data, 0);
	    $item_status_list = array_column($cart_data, 1);
	    if (in_array($_GET['matruyen'], $item_id_list) && in_array($_GET['tinhtrang'], $item_status_list))
	    {
	      foreach ($cart_data as $key => $value)
	      {

	        if( ($cart_data[$key][0] == $_GET['matruyen']) && ($cart_data[$key][1] == $_GET['tinhtrang']) )
	        {
	          $cart_data[$key][2] = $cart_data[$key][2] + 1;
	          if ($cart_data[$key][2] > 10)
	          {
	            $cart_data[$key][2]= 10;
	          }
	        }
	      }
	    }else{
	      $item_array= array($_GET['matruyen'],$_GET['tinhtrang'],1);
	      $cart_data[]= $item_array;
	    }

	    $item_data = json_encode($cart_data);
	    setcookie('giohang', $item_data, time() + (86400*7));
	    echo "<script>alert('Đã thêm vào giỏ hàng')</script>";
	    header("location:trangchu.php");
	  }else{
	    header("location:trangchu.php");
	  }
	}
?>

<!doctype html>
<html>
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <style type="text/css">
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
  	<title>Trang chủ</title>
  </head>
<body>
<!--MENU!-->
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
		      <input type="hidden" value="new" name="tinhtrang">
		      <button class="btn btn-outline-success my-2 my-sm-0" type="submit" value="timtruyen">Tìm truyện mới</button>
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

<!--Slide!-->
<?php
	include_once('slide.php');
?>
<!--End Silde!--> 
<!--Hiển thị sản phẩm!-->

<?php
	require_once('../connect/connect.php');
	$select="SELECT truyen.matruyen,tentruyen,bia,gia,soluong 
				from chitiettruyen
					join truyen on chitiettruyen.matruyen=truyen.matruyen
				where soluong > 0 and tinhtrang='new'
				limit 8";

	$hienthi=mysqli_query($conn,$select);

?>

</div>
<div class="container">
	<div class="row mt-5">
		<h3 class="list-product-title">Truyện mới</h3>
		<div class="product-group">
			<div class="row">
				<?php
					while ($row = mysqli_fetch_assoc($hienthi)) {
						echo" 
						<div class='col-md-3 col-sm-6 col-12'>
							<div class='card card-product mb-3'>
							<div class='card-header border-0'>
							  <img class='card-img-top' src=../Database/New/".$row["bia"]." height=240px width=200px alt='Card image cap'>
							</div>  
							  <div class='card-body'>
							    <h6 class='card-title'>".$row["tentruyen"]."</h6>
							    <h6 class='card-text'>".number_format($row["gia"],0,',','.')." VNĐ</h6>
							    <a href='chitietTruyen.php?matruyen=".$row['matruyen']."&tinhtrang=new' class='btn btn-primary'>Xem chi tiết</a>
							    <a href='trangchu.php?action=them&matruyen=".$row['matruyen']."&tinhtrang=new' class='btn btn-success'>Chọn mua</a>
							  </div>
							</div>
						</div>
						";
					}
				?>
			</div>
		</div>
	</div>
</div>


<!--Kết thúc hiển thị sản phẩm!-->
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