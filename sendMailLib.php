<?php

//Phải bật php_openssl trong php.ini

//Tải về thư viện PHPMailler tại địa chỉ http://code.google.com/a/apache-extras.org/p/phpmailer/
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	require_once "PHPMailer/src/PHPMailer.php";
	require_once "PHPMailer/src/SMTP.php";
	require_once "PHPMailer/src/Exception.php";
function sendGMail($username, $password, $name, $addresses, $replyTos, $subject, $content)
{

	$mail = new PHPMailer(true);
	$mail->IsSMTP(); //Thiet lap mailer de su dung SMTP
	$mail->SMTPDebug = 0;
	$mail->SMTPAuth = true; // Bat chung thuc SMTP 
	$mail->SMTPSecure = "ssl";
	$mail->Host = "smtp.gmail.com"; // Chi dinh Server chinh va Server phu
	$mail->Port = "465"; // Thiet lap cong de su dung
	$mail->Username = $username; // username (Dia chi mail) cua nguoi gui 
	$mail->Password = $password;// Password cua nguoi gui
	foreach($addresses as $address){
		$mail->AddAddress($address[0], $address[1]);
	} // Dia chi nguoi nhan - Tao mot mang nhieu nguwoi nhan
	foreach($replyTos as $replyTo){
		$mail->AddReplyTo($replyTo[0], $replyTo[1]);
	} // mail duoc Reply cho ai - Tao mot mang nhieu nguoi duoc reply
	$mail->SetFrom($username, $name); // Tu nguoi gui, ten nguoi gui
	$mail->Subject = $subject; // chu de thu
	$mail->MsgHTML($content); // noi dung thu
	$mail->CharSet = 'UTF-8';
	$mail->Send();
}



?>

