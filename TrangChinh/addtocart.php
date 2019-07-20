<?php
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
	    header("location:".$_SERVER['HTTP_REFERER']."");
	}else{
		header("location:trangchu.php");
	}
?>