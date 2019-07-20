<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<?php
		require_once('../connect/connect.php');
		if(isset($_POST['btnDangNhap'])){
			$taikhoan=mysqli_real_escape_string($conn,$_POST['taikhoan']);
			$matkhau=md5($_POST['matkhau']);

			$result = mysqli_query($conn,"SELECT * from user where user='$taikhoan' and pass='$matkhau'") or die (mysqli_connect($conn));
			if(mysqli_num_rows($result) == 1){
				$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
				$_SESSION['taikhoan']=$taikhoan;
                $_SESSION['quyen']=$row['quyen'];
				echo "<script>alert('Đăng nhập thành công')</script>";
	            echo "<meta http-equiv='refresh' content='0;URL='".$_SERVER['HTTP_REFERER']."'/>";
			}else{
				echo "<script>alert('Tài khoản hoặc mật khẩu không đúng')</script>";
			}
		}
	?>

	    <div>
	    	<ul class="nav navbar-nav flex-row justify-content-between ml-auto">
                <li class="nav-item order-2 order-md-1"><a href="#" class="nav-link" title="settings"><i class="fa fa-cog fa-fw fa-lg"></i></a></li>
                <li class="dropdown order-1">
                    <button type="button" id="dropdownMenu1" data-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle">Đăng nhập <span class="caret"></span></button>
                    <ul class="dropdown-menu dropdown-menu-right mt-1">
                      <li class="p-3">
                            <form class="form" role="form" method="POST" style="width: 200px">
                                <div class="form-group">
                                    <input type="text" placeholder="SĐT" class="form-control form-control-sm" name="taikhoan" required/>
                                </div>
                                <div class="form-group">
                                    <input id="passwordInput" placeholder="Password" class="form-control form-control-sm" name="matkhau" type="password" required/>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block" name="btnDangNhap">Đăng nhập</button>
                                </div>
                                <div class="form-group text-xs-center">
                                    <small><a href="dangky.php">Đăng ký</a></small>
                                </div>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
	    </div>
</body>
</html>