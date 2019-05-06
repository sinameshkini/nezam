<?php
require_once('class.phpmailer.php');
$mail = new PHPMailer();
$mail->addAddress('masinam7@gmail.com');
$mail->setFrom('abcdefghijk2@gmail.com', 'Abbass Moqaddam');
$mail->addReplyTo("abcdef@gmail2.com");
$mail->Subject    = 'Test PHPMailer Class';
$mail->Body = "<h1>This is a test mail</h1><h2>This is a test mail</h2>";
$mail->isHTML(true);
if ($mail->send()) {
    $status = '<h2>Message sent!</h2>';
} else {
    $status = '<h2>Error!</h2>';
}
echo $status;