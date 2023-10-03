    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="bootstrap.min.css">
    <script src="bootstrap.js"></script>
    <script src="bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Fees Portal</title>
    <style>
        .table{
            background-color: #fff;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            border-radius: 5px;
        }
    </style>
<form action="logout.php" method="post" style="display:flex;justify-content:flex-end;position:relative;right:50px;top:25px">
<button class="btn btn-secondary shadow"><i class='fa fa-user'>&nbsp</i>Logout</button>
</form>
    <?php
session_start();
$db_hostname="127.0.0.1";
$db_username="root";
$db_password="";
$db_name="info";
$c=mysqli_connect($db_hostname,$db_username,$db_password,$db_name);
if(!$c)
echo "ERROR".mysqli_connect_error();
$user_id=$_POST['user_id'];
$password=$_POST['password'];
//getting info from payment
$sql="SELECT * from payment where user_id='$user_id'";
//connecting with query and database
$result=mysqli_query($c,$sql);
$row=mysqli_fetch_assoc($result);

if($row['password']===$password && $row['user_id']===$user_id){
    $_SESSION['name']=$row['name'];
    $_SESSION['mail_id']=$row['mail_id'];
    $_SESSION['hint'] = $row['hint']; //we can use this in another page
    $name=$row['name'];
    $hint=$row['hint'];
    $sel="SELECT * from $hint";
    $res=mysqli_query($c,$sel);
    $r=mysqli_fetch_assoc($res);
    echo "<center><b>Welcome, $name</b></center>";
    echo "</br>";
    echo "<center><img class='shadow' src='https://img.myloview.com/posters/default-avatar-profile-icon-vector-social-media-user-400-202768327.jpg' width='100px' height='100px'/></center>";
    echo "</br>";
}
else if($row['password']!=$password){
    echo "<script>alert('password not exists')</script>";
}
else if($row['user-id']!=$user_id){
    echo "<script>alert('Email is not registered with us')</script>";
}
mysqli_close($c);
?>

<?php
$db_hostname = "127.0.0.1";
$db_username = "root";
$db_password = "";
$db_name = "info";

// Create a database connection
$c = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);
if (!$c) {
    echo "ERROR" . mysqli_connect_error();
}

// SELECT query to retrieve all rows from a table named 'your_table_name'
$query = "SELECT * FROM $hint";
$result = mysqli_query($c, $query);

if ($result) {
    echo "<table class='table table-bordered table-light table'>";
    echo "<thead class='thead-dark'>";
    echo "<tr>
    <th scope='col'>ID</th>
    <th scope='col'>Description</th>
    <th scope='col'>Fees</th>
    <th scope='col'>Payable amount</th>
    <th scope='col'>Select</th>
    </tr>";
    echo '</thead>'; // Replace with your column names

    // Fetch and display each row
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>"; // Replace with your column names
        echo "<td>" . $row['description'] . "</td>";
        echo "<td>" . $row['fees'] . "</td>";
        echo "<td contenteditable='true' class='amount'> " . $row['fees'] . "</td>";
        echo "<td><input type='checkbox' class='edit-checkbox'/></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Query failed: " . mysqli_error($c);
}

// Close the database connection
mysqli_close($c);
?>
<br><br>
<div>
<h6>&nbsp Amount is:</h6>
</div>
<div id='space' style='position:absolute;left:50px;font-weight:bold'class='space' >
</div>
<input type="hidden" id="totalAmount" name="totalAmount" value="">
<div style="display:flex;justify-content:flex-end;position:relative;right:10px">
<button type='submit' name='payAmount' class='btn btn-success shadow' id='payButton'><i class='fa fa-inr'>&nbsp</i>Pay</button>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const checkboxes = document.querySelectorAll('.edit-checkbox');
    const space = document.getElementById('space');
    const totalAmountField = document.getElementById('totalAmount');
    const amounts = [];
    const selectedIndices = [];

    checkboxes.forEach((checkbox, index) => {
        checkbox.addEventListener('change', () => {
            const amountCell = document.querySelectorAll('.amount')[index];
            const amount = parseInt(amountCell.innerText);

            if (checkbox.checked) {
                amounts.push(amount);
                selectedIndices.push(index);
            } else {
                const indexToRemove = amounts.indexOf(amount);
                if (indexToRemove !== -1) {
                    amounts.splice(indexToRemove, 1);
                }
            }

            const totalAmount = amounts.reduce((total, currentAmount) => total + currentAmount, 0);
            space.innerHTML = totalAmount;
            totalAmountField.value = totalAmount;
        });
    });

    function showAlert() {
        alert(space.innerText);
    }

    document.getElementById('payButton').addEventListener('click', function () {
        const totalAmountField = document.getElementById('totalAmount'); // Get the input field
        const totalAmount = parseInt(totalAmountField.value);
        if (totalAmount > 0) {
            // Redirect to the payment page
            const selectedIndicesString = selectedIndices.join(','); // Convert array to comma-separated string
            window.location.href = `payment_page.php?amount=${totalAmount}&selectedIndices=${selectedIndicesString}`;
        } else {
            alert('Please select items to pay for.');
        }
    });
});


document.getElementById('payButton').addEventListener('click', function () {
    const totalAmountField = document.getElementById('totalAmount');
    const totalAmount = parseInt(totalAmountField.value);
    
    if (totalAmount > 0) {
        // Get the IDs of selected rows
        const selectedIds = [];
        checkboxes.forEach((checkbox, index) => {
            if (checkbox.checked) {
                selectedIds.push(index + 1); // Assuming IDs start from 1
            }
        });

        if (selectedIds.length > 0) {
            // Redirect to the payment page with selected IDs
            window.location.href = 'payment_page.php?amount=' + totalAmount + '&selectedIds=' + selectedIds.join(',');
        } else {
            alert('Please select items to pay for.');
        }
    } else {
        alert('Please select items to pay for.');
    }
});

</script>




