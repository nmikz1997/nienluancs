<?php
	$lifetime= 60*60*24;
  	session_set_cookie_params($lifetime, '/');
  	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Giỏ hàng</title>
	<meta charset="utf-8">
</head>
<body>
<h2>Giỏ hàng</h2>
<?php
	require_once('../connect/connect.php');

	if(isset($_SESSION['giohang'])){
		var_dump($_SESSION['giohang']);
		$item_array_id = array_column($_SESSION['giohang'],'matruyen');
		$item_array_status = array_column($_SESSION['giohang'],'tinhtrang');
		echo "<br>----------------------------------------------------------";
		// if ($item_array_id && $item_array_status){

		// }
		$count = count($item_array_id); 
		echo "<br/>----------------------------<br/> so phan tu: ";
		var_dump($count);

		//var_dump($item_array_id);


		foreach ($_SESSION['giohang'] as $key => $value) {
			// echo "STT: " .$key."<br/>";
			// echo "{$value['matruyen']}<br/>";
			// echo "---------------------<br/>";

			// $matruyen=$value['matruyen'];
			// $tinhtrang=$value['tinhtrang'];

			// $select_cart="SELECT * from chitiettruyen
			// 				join truyen on chitiettruyen.matruyen=truyen.matruyen
			// 					where chitiettruyen.matruyen= '$matruyen' and tinhtrang= '$tinhtrang'";
			// $result_cart=mysqli_query($conn,$select_cart);
			// $row_product=mysqli_fetch_assoc($result_cart);

			// echo $row_product['tentruyen']."<br/>";
			// echo $row_product['gia']."</br>";

		}
		echo "<a href='clean_cart.php'>Hủy giỏ hàng</a>";
	}else{
		echo "<h3>Rỗng</h3>";
	}

	
	
?>
</body>
</html>