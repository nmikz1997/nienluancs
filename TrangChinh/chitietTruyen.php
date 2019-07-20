<!-- bổ sung giao diện-->
<?php
  session_start();
  if(empty($_GET['matruyen']) || empty($_GET['tinhtrang']) ){header("location:trangchu.php");};
?>

<?php
  if(isset($_POST['btnAddToCart'])){
    if (isset($_COOKIE['giohang'])){
      $cookie_data = stripslashes($_COOKIE['giohang']);
      $cart_data = json_decode($cookie_data, true);
    }else{
      $cart_data = array();
    }

    $item_id_list = array_column($cart_data, 0);
    $item_status_list = array_column($cart_data, 1);

    if (in_array($_POST['matruyen'], $item_id_list) && in_array($_POST['tinhtrang'], $item_status_list))
    {
      foreach ($cart_data as $key => $value)
      {

        if( ($cart_data[$key][0] == $_POST['matruyen']) && ($cart_data[$key][1] == $_POST['tinhtrang']) )
        {
          $cart_data[$key][2] = $cart_data[$key][2] + $_POST['soluong'];
          if ($cart_data[$key][2] > 10)
          {
            $cart_data[$key][2]= 10;
          }
        }
      }
    }else{
      $item_array= array($_POST['matruyen'],$_POST['tinhtrang'],$_POST['soluong']);
      $cart_data[]= $item_array;
    }

    $item_data = json_encode($cart_data);
    
    setcookie('giohang', $item_data, time() + (86400*7));
    echo "<script>alert('Đã thêm vào giỏ hàng')</script>";
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Chi tiết truyện</title>
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
              if($_GET['tinhtrang'] == 'old'){
                echo "<button class='btn btn-outline-success my-2 my-sm-0' type='submit' value='timtruyen'>Tìm truyện cũ</button>";
              }else{
                echo "<button class='btn btn-outline-success my-2 my-sm-0' type='submit' value='timtruyen'>Tìm truyện mới</button>";
              }
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
 
<?php
  require_once('../connect/connect.php');
  $matruyen=$_GET['matruyen'];
  $tinhtrang=$_GET['tinhtrang'];
  $select_chitiettruyen="SELECT truyen.matruyen,tentruyen,tennxb,ngayxb,gia,noidung,bia
                                from chitiettruyen
                                  join truyen on truyen.matruyen=chitiettruyen.matruyen
                                  join nhaxuatban on nhaxuatban.manxb=truyen.manxb
                                where chitiettruyen.matruyen='$matruyen' and tinhtrang='$tinhtrang'";
  $result_truyen  = mysqli_query($conn,$select_chitiettruyen);
  $row = mysqli_fetch_assoc($result_truyen);

  $select_moicu="SELECT matruyen from chitiettruyen where matruyen='$matruyen' and tinhtrang not in ('$tinhtrang')";
  $result_moicu=mysqli_query($conn,$select_moicu);
  $tontai = mysqli_fetch_assoc($result_moicu);

  function hienthiTheLoai($matruyen){
    require('../connect/connect.php');
    $select_loai="SELECT loai_truyen.maloai,tenloai
                        from truyen
                            inner join loai_truyen on truyen.matruyen=loai_truyen.matruyen 
                            inner join theloai on theloai.maloai=loai_truyen.maloai where truyen.matruyen=".$matruyen;

    $result_loai    = mysqli_query($conn,$select_loai);
    while($row = mysqli_fetch_assoc($result_loai)){
      $maloai=$row['maloai'];
      echo "<a href='truyentheoloai.php?maloai=$maloai' style='margin-left: 5px;' class='badge badge-primary'>".$row['tenloai']."</a>";
    }
   }
    function hienthiTacGia($matruyen){
    require('../connect/connect.php');
    $select_tacgia="SELECT tacgia_truyen.matg,tentg
                        from truyen
                            inner join tacgia_truyen on truyen.matruyen=tacgia_truyen.matruyen 
                            inner join tacgia on tacgia.matg=tacgia_truyen.matg where truyen.matruyen=".$matruyen;

    $result_tacgia    = mysqli_query($conn,$select_tacgia);
            
	    while($row = mysqli_fetch_assoc($result_tacgia)){
	    	echo "<a href='#' style='margin-left: 5px;' class='badge badge-primary'>".$row['tentg']."</a>";

	    } 
    }

?>

<div class="container">
  <div class="card-deck">
    <div class="col-sm-4">
      <div class="card-body text-center">
        <?php echo "<img class='img-responsive center-block anh' src=../Database/$tinhtrang/".$row["bia"]." width=230px height=310px/>"; ?>
      </div>
    </div>
    <div class="card card-product">
      <div class="card-body text-left">
        <!-- Hiển thị thông tin truyện -->
        <h3><?php echo "{$row['tentruyen']}"; ?></h3>
        <h5>Thể loại:<?php echo hienthiTheLoai($matruyen); ?></h5>
        <h5>Tác giả:<?php echo hienthiTacGia($matruyen); ?></h5>
        <h5>Nhà xuất bản:<?php echo "{$row['tennxb']}"; ?></h5>
        <h3 style="margin-top:5px; color: red">Giá: <?php echo number_format($row["gia"],0,',','.'); ?> VNĐ</h3>
        <!-- END Hiển thị thông tin truyện -->

        <!-- GET thông tin vào giỏ hàng bao gồm mã truyện,tên truyện, ảnh, số lượng(được phép nhập)-->
        <form enctype ="" action='' method='POST'>
        <input type="hidden" name="matruyen" value="<?php echo $matruyen; ?>"/>
        <input type="hidden" name="tinhtrang" value="<?php echo $tinhtrang; ?>"/>
        <div style="padding-bottom:20px; margin-top:5px;">
            <h4><small>Số lượng</small></h4>
                <div>
                    <input type="number" name="soluong" min="1" max="10" value="1"/>
                </div>
        </div>
          <div style="padding-bottom:20px;">
            <button type="submit" class="btn btn-default" name="btnAddToCart">Thêm vào giỏ hàng</button>
          </div>                            
        </form> 
      </div>
    </div>
  </div>
    <div>
      <?php
      if ($tontai !== NULL) {
        if ($tinhtrang == 'new') {
              echo "<a href='chitietTruyen.php?matruyen=".$matruyen."&tinhtrang=old' target='_blank'>Xem truyện cũ</a>";
          }else{
              echo "<a href='chitietTruyen.php?matruyen=".$matruyen."&tinhtrang=new' target='_blank'>Xem truyện mới</a>";
          }
      }
      ?>
    </div>
    <div>
      <h3>Sơ lược nội dung</h3>
      <p><?php echo "{$row['noidung']}" ?></p>
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
