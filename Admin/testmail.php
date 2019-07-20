<meta charset="utf-8">
<?php 
	include('../sendMailLib.php');
	$guiboi = 'Chủ cửa hàng truyện';
	$subject = 'Đăng ký thành công';
	$content = 'bạn đã đăng ký tại trang....';
	$emailNhan = 'nguyenb1507129@student.ctu.edu.vn';
	$ten = 'Trịnh Thế Nguyễn';
	sendGMail('nguyentestmail1997@gmail.com','w3schools.com',$guiboi, array(array($emailNhan, 'Trịnh Thế Nguyễn')), array(array('nguyentestmail1997@gmail.com',$guiboi)),$subject,$content);

?>