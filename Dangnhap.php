<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="Dangnhap.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

<?php
include_once ("dbconnect.php");
session_start();
?>
        <div class="col-md-6 col-md-offset-3" style="border: 1px solid #d0d32e;background-color:#f9fff6 ">
                <h4 class="h_dn"><span class="fas fa-user-alt"></span> Đăng nhập</h4>
                <form name = "frmDangnhap" method="post" action="">
                    <div class="form-group" >
                        <label><span class="fas fa-user"></span> Tên đăng nhập</label>
                        <input type="text" name="txtTenDangNhap"  class="form-control" id="txtTenDangNhap" placeholder="Nhập tên đăng nhập">
                    </div>
                    <?php
                    if(isset($_POST['btn_DangNhap'])){
                        $tendangnhap=$_POST['txtTenDangNhap'];
                        if($tendangnhap == "") {
                            echo "<div style=\"color: #FF0000;margin-top: -12px\">Vui lòng nhập tên đăng nhập!</div>";
                        }
                    }
                    ?>
                    <div class="form-group">
                        <label for="psw"><span class="fas fa-key"></span> Mật khẩu</label>
                        <input type="password"  name="txtMatKhau"  class="form-control" id="txtMatKhau" placeholder="Nhập mật khẩu">
                    </div>
                    <?php
                    if(isset($_POST['btn_DangNhap'])) {
                        $matkhau = $_POST['txtMatKhau'];
                        if ($matkhau == "") {
                            echo "<div style=\"color: #FF0000;margin-top: -12px;padding-bottom: 10px\">Vui lòng nhập mật khẩu!</div>";
                        }
                    }
                    ?>
                    <?php
                    if(isset($_POST['btn_DangNhap'])){
                        if($tendangnhap != "" && $matkhau!= ""){
                          $tendangnhap = mysqli_real_escape_string($conn,$tendangnhap);
                            $matkhau = md5($matkhau);
                            $result = mysqli_query($conn,"SELECT * FROM khachang WHERE kh_tdn = '$tendangnhap' and kh_mk ='$matkhau'") or die(mysqli_error($conn));
                            if(mysqli_num_rows($result) == 1) {
                                $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
                                 $_SESSION['tendangnhap'] =  $tendangnhap;
                                 $_SESSION['quantri'] = $row['kh_quantri'];
                                echo "<script>alert('Đăng nhập thành công')</script>";
                               echo"<meta http-equiv='refresh' content='0;URL=index.php'/>";
                                
                            }
                            else
                                echo "<div style=\"color: #FF0000;margin-top: -12px;padding-bottom: 10px\">Tên đăng nhập hoặc mật khẩu không đúng!</div>";
                        }
                    }
                    ?>
                    <div class="form-group">
                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-warning" name="btn_DangNhap"><span class="fas fa-power-off"></span> Đăng nhập</button>
                        </div>
                        <div class="col-sm-5 checkbox">
                            <label style="margin-left: -15px"><input  type="checkbox" value="0" checked>Ghi nhớ đăng nhập</label>
                        </div>
                    </div>
                    <div>
                        <div class="col-sm-8" style="padding-bottom: 20px">
                            <a href="#">Quên mật khẩu?</a>
                        </div>
                    </div>
                </form>
        </div>
