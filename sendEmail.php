<?php
require 'PHPMailer-master/PHPMailerAutoload.php';
$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPSecure = 'ssl';
$mail->SMTPAuth = true;
$mail->Host = 'smtp.gmail.com';
$mail->Port = 465;
$mail->Username = 'textbookgemachtouro@gmail.com';
$mail->Password = 'textbook';
$mail->setFrom('textbookgemachtouro@gmail.com');
$mail->addAddress('textbookgemachtouro@gmail.com');
$mail->Subject = 'Hello from PHPMailer!';
$mail->Body = $_POST['content'];
//send the message, check for errors
if (!$mail->send()) {
    echo "ERROR: " . $mail->ErrorInfo;
} else {
    die(header("location:confirmEmail.php?error=false&reason=sent"));
    echo "SUCCESS";
}

?>