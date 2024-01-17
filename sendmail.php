<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php'; 

$mail = new PHPMailer(true);
$mail->CharSet = 'UTF-8';
$mail->setLanguage('uk', 'phpmailer/language/');
$mail->IsHTML(true);

$mail->setFrom('web_resume@cv.com', 'Oleh Semenets');
$mail->addAddress('oleg.min.vin@gmail.com'); 
$mail->Subject = 'New message from web resume';

$body = '<h1>New message from web resume</h1>';

if (!empty($_POST['name'])) { 
    $body .= '<p><strong>Name:</strong> ' . $_POST['name'] . '</p>';
}

if (!empty($_POST['email'])) {
    $body .= '<p><strong>Email:</strong> ' . $_POST['email'] . '</p>';
}

if (!empty($_POST['content'])) {
    $body .= '<p><strong>Text:</strong> ' . $_POST['content'] . '</p>';
}

$mail->Body = $body;

try {
    $mail->send();
    $message = "Data sent!";
} catch (Exception $e) {
    $message = 'Error: ' . $mail->ErrorInfo;
}

$response = ['message' => $message];

header('Content-type: application/json');
echo json_encode($response);
?>
