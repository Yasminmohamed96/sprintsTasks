<?php
//require_once('../config.php');
use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\Exception;

require_once ('mail/Exception.php');
require_once ('mail/PHPMailer.php');
require_once ('mail/SMTP.php');
function sent_mail($request){
$mail = new PHPMailer;
$mail->isSMTP(); 
$mail->SMTPDebug = 1; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
$mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
$mail->Port = 587; // TLS only
$mail->SMTPSecure = 'tls'; // ssl is deprecated
$mail->SMTPAuth = true;
$mail->Username = 'blogyasmin1@gmail.com'; // email
$mail->Password = '123456789yasmin/'; // password
$mail->addAddress('blogyasmin1@gmail.com', 'yasmin blog contact us'); // From email and name

$mail->setFrom($request['email'], $request['name']); // to email and name
$mail->Subject = $request['subject'];
$mail->msgHTML($request['message']); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
$mail->AltBody = 'HTML messaging not supported'; // If html emails is not supported by the receiver, show this body
// $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file

if(!$mail->send()){
    echo "Mailer Error: " . $mail->ErrorInfo;
}else{
    echo "Message sent!";
}
}
?>