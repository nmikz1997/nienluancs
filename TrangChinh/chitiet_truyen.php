<?php
    //xác định truyện lần sau sẽ làm biến truyền vào phương thức GET
    require_once('../connect/connect.php');
    $matruyen= $_GET['matruyen'];

    $select="SELECT truyen.matruyen,tentruyen,tacgia,tennxb,
            ngayxb,gia,noidung,bia
                from truyen
                    left join loai_truyen on truyen.matruyen=loai_truyen.matruyen
                    left join nhaxuatban on nhaxuatban.manxb=truyen.manxb
                           where truyen.matruyen=".$matruyen;

    $ds_truyen  = mysqli_query($conn,$select);
    
    $row = mysqli_fetch_assoc($ds_truyen);
        
    function hienthiTheLoai($matruyen){
            require_once('../connect/connect.php');
            $select_loai="SELECT loai_truyen.maloai,tenloai
                        from truyen
                            inner join loai_truyen on truyen.matruyen=loai_truyen.matruyen 
                            inner join theloai on theloai.maloai=loai_truyen.maloai where truyen.matruyen=".$matruyen;

            $result_loai    = mysqli_query($conn,$select_loai);
            
            while($row = mysqli_fetch_assoc($result_loai)){
                echo $row['tenloai'].",";
            }
    }
    
?>

<!DOCTYPE html>
<html>
<head>
    <title>Chi tiết truyện</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style type="text/css">
        
        .khoi{
            height: 300px;
            width: 50%;

        }
        .anh{
            margin-top: 20px;
        }

    </style>
</head>
<body>
        <div class="container">
            <div class="row">

                <!-- begin Ảnh sản phẩm -->
               <div class="col-sm-6 khoi">
                    <?php echo "<img class='img-responsive center-block anh' src=../script/viewimg.php?matruyen="  .$row["matruyen"]."  width=300em/>"; ?>
                </div>
                 <!-- begin Ảnh sản phẩm -->


                <div class="col-sm-6 khoi" style="border-left :1px solid silver; background-color:#F0F8FF;">
                    
	                <!-- Hiển thị thông tin truyện -->
	                <h3><?php echo "{$row['tentruyen']}"; ?></h3>
	                <h5>Thể loại: <?php echo hienthiTheLoai($matruyen); ?></h5>
	                <h5>Tác giả:<?php echo "{$row['tacgia']}"; ?></h5>
	                <h5>Nhà xuất bản:<?php echo "{$row['tennxb']}"; ?></h5>
	                <h3 style="margin-top:5px; color: red">Giá: <?php echo "{$row['gia']}"; ?> VNĐ</h3>
	 				<!-- END Hiển thị thông tin truyện -->

	   				<!-- GET thông tin vào giỏ hàng bao gồm mã truyện,tên truyện, ảnh, số lượng(được phép nhập)-->
	   				<form enctype ="multipart/form-data" action='giohang.php' method='POST'>
	   					<input type="hidden" name="matruyen" value="<?php echo $matruyen; ?>">

	                    <div style="padding-bottom:20px; margin-top:5px;">
	                        <h4><small>Số lượng</small></h4>                    
	                        <div>
	                            <input type="number" name="soluong" min="1" value="1"/>
	                        </div>
	                    </div>
	                    
	                    <div style="padding-bottom:20px;">
	                        <button type="submit" class="btn btn-default">Thêm vào giỏ hàng</button>
	                    </div>
                    </form>	
                    <!-- END GET-->	
 
                                                           
                </div>                              
                </div>
                <!-- begin thông tin khác về sản phẩm!-->
                <div class="row" style="margin-top: 10px">
                <div class="col-xs-12" style="width:100%;border-top:1px solid silver">
                    <div >
                        <p style="padding:20px; text-align: justify;">
                            <small>
                            <?php 
                                echo "{$row['noidung']}<br>";
                            ?>
                            </small>
                        </p>
                    </div>
                </div>
                <!-- end thông tin khác về sản phẩm!-->    
                </div>      
            </div>
        </div> 
</body>
</html>