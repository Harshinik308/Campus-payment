<!-- due date !>
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP; 
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer\src\Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer\src\SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dueDate = $_POST["due_date"]; 
$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = '2011084@nec.edu.in';
$mail->Password = '********';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;

$mail->setFrom('2011084@nec.edu.in', 'Campus Payment System');
$address=['2011084@nec.edu.in','2011048@nec.edu.in','2011029@nec.edu.in'];
foreach($address as $i){
$mail->addAddress($i);
}

$mail->Subject = 'Fees Due Date Alert';
$mail->Body = 'Tomorrow is the last date for paying your fees';

if ($mail->send()) {
    echo "<script>console.log('Email sent successfully.')</script>";
    ob_flush(); 
} else {
    echo 'Email could not be sent. Error: ' . $mail->ErrorInfo;
}
}


?>

