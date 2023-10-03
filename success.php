
<?php
session_start();

// Check if the 'mail_id' session variable is set
if (isset($_SESSION['mail_id'])) {
    $mail_id = $_SESSION['mail_id'];

} else {
    // Handle the case where 'mail_id' is not set, maybe show an error message or redirect
    echo "Mail ID not found in the session.";
}



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP; 
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer\src\Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer\src\SMTP.php';

$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = '2011084@nec.edu.in';
$mail->Password = 'Harshini003';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;

$mail->setFrom('2011084@nec.edu.in', 'Campus Payment System');
$mail->addAddress( $mail_id);

$mail->Subject = 'Successfull payment';
$mail->Body = 'Your last payment was successfull';

if ($mail->send()) {
    echo "<script>alert('Email sent successfully')</script>";
} else {
    echo "<script>alert('Email could not be sent. Error:'. $mail->ErrorInfo</script>";
} 

?>
<?php

    // Check if the 'selectedIndicesString' session variable is set
    if (isset($_SESSION['selectedIndicesString']) && isset($_SESSION['hint'])) {
        $selectedIndicesString = $_SESSION['selectedIndicesString'];
        $tab=$_SESSION['hint'];
        // Convert the selected indices from a comma-separated string to an array
        $selectedIndices = explode(',', $selectedIndicesString);

        // Establish a database connection (replace with your database credentials)
        $servername = "127.0.0.1";
        $username = "root";
        $password = "";
        $database = "info";

        // Create a connection
        $conn = new mysqli($servername, $username, $password, $database);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        foreach ($selectedIndices as $selectedIndex) {
            // Ensure $selectedIndex is an integer
            $selectedIndex = intval($selectedIndex);
        
            // Check if $selectedIndex is a valid integer
          
                $selectedIndex++;
                $sql = "DELETE FROM $tab WHERE id = $selectedIndex";
        
                if ($conn->query($sql) === TRUE) {
                    echo "<script>console.log('User with ID $selectedIndex deleted successfully.')<br></script>";
                } else {
                    echo "Error deleting user with ID $selectedIndex: " . $conn->error . "<br>";
                }
          
        }
       
    } 
    
// Fetch all the remaining rows from the table
$sql = "SELECT id FROM $tab";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $newId = 1; // Initialize the new ID

    while ($row = $result->fetch_assoc()) {
        // Update the id for each row in ascending order
        $currentId = $row['id'];
        $updateSql = "UPDATE $tab SET id = $newId WHERE id = $currentId";
        
        if ($conn->query($updateSql) === TRUE) {
            echo "<script>console.log('ID $currentId updated to $newId')</script><br>";
        } else {
            echo "Error updating ID $currentId: " . $conn->error . "<br>";
        }

        $newId++; // Increment the new ID
    }
}

// Close the database connection
$conn->close();  

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fee Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            border-radius: 5px;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        .receipt {
            border: 1px solid #ccc;
            padding: 20px;
            margin-top: 20px;
            background-color: #fff;
            border-radius: 5px;
        }
        .print-button {
            text-align: center;
            margin-top: 20px;
        }
        button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .error {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Thank you for payment</h1>
        <h3>Fee Receipt</h3>
        <div class="receipt">
            <p><strong>Name: </strong><?php 
            if (isset($_SESSION['name'])) {
               echo $_SESSION['name'];
            
            }
            ?></p>
            <p><strong>Fees: </strong><?php 
            if (isset($_SESSION['fees'])) {
                echo $_SESSION['fees'];
            } else {
                echo "Fees not found in session.";
            }
            ?></p>
            <p><strong>Payment_id: </strong>
            <?php
            if (isset($_SESSION['enc_id'])) {
                echo $_SESSION['enc_id'];
            } else {
                echo "Fees not found in session.";
            } 
            ?>
            </p>
        </div>
        <div class="print-button">
            <button onclick="printReceipt()">Print Receipt</button>
        </div>
        <a href="logout.php">click to go back</a>
    </div>

    <script>
        function printReceipt() {
            var printWindow = window.open('', '', 'width=600,height=400');
            var receiptContent = document.querySelector('.receipt').innerHTML;
            printWindow.document.open();
            printWindow.document.write('<html><head><title>Fee Receipt</title></head><body>');
            printWindow.document.write('<h1>Fee Receipt</h1>');
            printWindow.document.write(receiptContent);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
            printWindow.close();
        }
    </script>
</body>
</html>
