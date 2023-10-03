<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<title>Confirmation Page</title>
<?php
session_start();
$db_hostname = "127.0.0.1";
$db_username = "root";
$db_password = "";
$db_name = "info";
$c = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);
if (!$c) {
    echo "ERROR" . mysqli_connect_error();
}

$user_id = $_POST['user_id'];
$desc = $_POST['Description'];
$fees = $_POST['Fees'];

$check = "SELECT * FROM payment WHERE user_id='$user_id'";
$result = mysqli_query($c, $check);
$count = mysqli_num_rows($result); // Use num_rows to get the count of matching rows
$row=mysqli_fetch_assoc($result);
$table=$row['hint'];
if ($count > 0) {
    // Update the existing row for the user
    $sql = "UPDATE $table SET description='$desc', fees='$fees'";
    $l = mysqli_query($c, $sql);
    if (!$l) {
        echo mysqli_error($c);
    } else {
        echo "<div style='display:flex;justify-content:center;position:relative;top:30%;'><h4 style='display:flex;justify-content:center;align-items:center;font-size:40px'><i class='fa fa-check-circle' style='font-size:60px;color:green'> </i>&nbsp Updated successfully</h4></div>";
    }
} else {
    echo "<div style='display:flex;justify-content:center;position:relative;top:30%;'><h4 style='display:flex;justify-content:center;align-items:center;font-size:40px'><i class='fa fa-times-circle' style='font-size:60px;color:red'> </i>&nbsp Updation failed</h4></div>";
}
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP; 
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer\src\Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer\src\SMTP.php';
if($count>0){
$to_mail=$row['mail_id'];
$to_name=$row['name'];
$to_amount=$row['fees'];
$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = '2011084@nec.edu.in';
$mail->Password = 'Harshini003';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;

$mail->setFrom('2011084@nec.edu.in', 'Campus Payment System');
$mail->addAddress($to_mail, $to_name);

$mail->Subject = 'Fees Updation';
$mail->Body = 'This is an automatic mail indicating updation of fees in the portal.The fee amount is : '.$fees;

if ($mail->send()) {
    echo "<script>alert('Email sent successfully')</script>";
} else {
    echo "<script>alert('Email could not be sent. Error:'. $mail->ErrorInfo</script>";
} 
}
else{
    echo "<script>alert('Email could not be sent')</script>"; 
}
mysqli_close($c);
?>
   <!-- $sql = "UPDATE payment SET description='$desc', fees='$fees' WHERE user_id='$user_id'"; !>