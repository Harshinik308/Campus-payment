<link rel="stylesheet" href="bootstrap.css">
<link rel="stylesheet" href="bootstrap.min.css">
<script src="bootstrap.js"></script>
<script src="bootstrap.min.js"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bitter&family=Bricolage+Grotesque:opsz@10..48&family=IBM+Plex+Sans:wght@300&family=Overpass:wght@500&family=Quicksand:wght@300&family=Roboto+Slab&family=Titillium+Web:wght@300&display=swap" rel="stylesheet">

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <!-- Include your CSS and any necessary scripts here -->
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color:;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            border-radius: 5px;
        }
        h1 {
            text-align: center;
            font-family: Bitter, sans-serif;
            color: #333;
        }
        
        p{
 
    font-family:'Lucida Grande', 'Lucida Sans', Arial, sans-serif
        }
        .button {
            padding: 15px 30px;
            font-size: 18px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<?php
session_start();

// Process selected indices and total amount if they are provided in the URL
if (isset($_GET['amount']) && isset($_GET['selectedIndices'])) {
    $totalAmount = $_GET['amount'];
    $selectedIndicesString = $_GET['selectedIndices'];


    // Convert the selected indices from a comma-separated string to an array
    $selectedIndices = explode(',', $selectedIndicesString);
    $_SESSION['selectedIndicesString']= $selectedIndicesString ;
} else {
    echo "Invalid URL parameters.";
}

$amount = isset($_GET['amount']) ? $_GET['amount'] : 0;
$_SESSION['fees'] = $amount;
$_SESSION['enc_id'] = sha1($amount);
?>

    <div class="container">
    <div style="text-align: center;">
        <h1 style="font-family:Bitter">Payment Details</h1>
        <p>Total Amount to Pay: <?php echo $amount; ?></p>
        <form action="process_payment.php" method="POST">
            <input type="hidden" name="amount" value="<?php echo $amount; ?>">
            <button type="button" class="buy_now btn btn-secondary button" data-amount="<?php echo $amount; ?>" data-id="your_product_id">Make Payment</button>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.buy_now').addEventListener('click', function() {
                var totalAmount = this.getAttribute('data-amount');
                var product_id = this.getAttribute('data-id');

                var options = {
                    "key": "rzp_test_wrFQpGgUErjm3z",
                    "amount": <?php echo $amount * 100; ?>, // Convert amount to paise
                    "name": "Campus payment and management system",
                    "description": "Payment",
                    "image": "",
                    "handler": function (response) {
                        // Handle successful payment
                        var razorpay_payment_id = response.razorpay_payment_id;

                        // Send payment details to the server for processing
                        var xhr = new XMLHttpRequest();
                        xhr.open('POST', 'payment_process.php', true);
                        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === 4 && xhr.status === 200) {
                                // Payment was successfully processed
                                window.location.href = 'success.php';
                            } else if (xhr.readyState === 4 && xhr.status !== 200) {
                                // Handle errors or failed payments
                                // You can provide user-friendly error messages here
                            }
                        };
                        xhr.send('razorpay_payment_id=' + razorpay_payment_id + '&totalAmount=' + totalAmount + '&product_id=' + product_id);
                    },
                    "theme": {
                        "color": "#528FF0"
                    }
                };

                var rzp1 = new Razorpay(options);
                rzp1.open();
            });
        });
    </script>
</body>
</html>
