<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP; 
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer\src\Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer\src\SMTP.php';
try{
$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = '2011084@nec.edu.in';
$mail->Password = 'Harshini003';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;
$arr=['2011084@nec.edu.in','2011048@nec.edu.in','2011029@nec.edu.in'];
$mail->setFrom('2011084@nec.edu.in', 'Campus Payment System');
for($i=0;$i<3;$i++){
$mail->addAddress($arr[$i]);}

$mail->Subject = 'Fees Due Date Alert';
$mail->Body = 'Tomorrow is the last date for paying your fees';

if ($mail->send()) {
    echo 'Email sent successfully.';
} else {
    echo 'Email could not be sent. Error: ' . $mail->ErrorInfo;
}

   // Set the target date and time for the alert
   $targetDateTime = strtotime('2023-09-10 20:39:00');
   $currentDateTime = time();
   $timeDifference = $targetDateTime - $currentDateTime;

   // If the target time is in the future
   if ($timeDifference > 0) {
       // Sleep for the remaining time
       sleep($timeDifference);

       // Send the email
       $mail->send();
       echo 'Alert email sent successfully!';
   } else {
       echo 'Target time has already passed.';
   }
} catch (Exception $e) {
   echo 'Email sending failed: ' . $mail->ErrorInfo;
}
?>

