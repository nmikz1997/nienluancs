<?php
	//xóa giỏ hàng
	//xóa 1 hàng trong giỏ
	//tăng số lượng +1
	//giảm số lượng -1
	if (isset($_COOKIE['giohang'])) {
		switch ($_GET['action']) {
			case 'clearall':
				setcookie("giohang", "", time() - (86400*30));
				break;
			
			case 'delete':
				$key=$_GET['key'];
				$cookie_data = stripslashes($_COOKIE['giohang']);
  				$cart_data = json_decode($cookie_data, true);
  				unset($cart_data[$key]);
				$item_data = json_encode($cart_data);
    			setcookie('giohang', $item_data, time() + (86400*30));

				break;

			case 'add':
				$key=$_GET['key'];
				$cookie_data = stripslashes($_COOKIE['giohang']);
  				$cart_data = json_decode($cookie_data, true);

  				if($cart_data[$key][2] < 10){
  					$cart_data[$key][2] = $cart_data[$key][2] + 1;
  					$item_data = json_encode($cart_data);
  					setcookie('giohang', $item_data, time() + (86400*30));
  				}
				break;

			case 'sub':
				$key=$_GET['key'];
				$cookie_data = stripslashes($_COOKIE['giohang']);
  				$cart_data = json_decode($cookie_data, true);
  				if($cart_data[$key][2] > 1){
  					$cart_data[$key][2] = $cart_data[$key][2] - 1;
  					$item_data = json_encode($cart_data);
  					setcookie('giohang', $item_data, time() + (86400*30));
  				}
				break;

			default:
				header("location:viewcart.php");
				break;
		}
		header("location:viewcart.php");
	}
	header("location:viewcart.php");
	
?>