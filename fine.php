<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php
$db_hostname = "127.0.0.1";
$db_username = "root";
$db_password = "";
$db_name = "info";

$c = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);
if (!$c) {
    echo "ERROR" . mysqli_connect_error();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dueDate = $_POST["due_date"]; 
    $amt=$_POST["fine"];

$currentDate = date($dueDate);
$targetDate = $dueDate ;

// Define an array of table names
$tableNames = ['_2011084', '_2011048','_2011029']; // Add more table names as needed
$count=0;
foreach ($tableNames as $tableName) {
    // Check if the current date matches the target date
    if ($currentDate == $targetDate) {
        // Perform the insertion
        $insertQuery = "INSERT INTO $tableName (description,fees) VALUES ('Fine amount',$amt)";
        if (mysqli_query($c, $insertQuery)) {
           $count++;
        } else {
            echo "Error inserting row into $tableName: " . mysqli_error($c);
        }
    } else {
        echo " <div style='display:flex;justify-content:center;position:relative;top:30%;'><h4 style='display:flex;justify-content:center;align-items:center;font-size:40px'><i class='fa fa-times-circle' style='font-size:60px;color:red'> </i>&nbsp Target date has not yet reached.</h4></div>";
    }
}
if($count!=0){
    echo " <div style='display:flex;justify-content:center;position:relative;top:30%;'><h4 style='display:flex;justify-content:center;align-items:center;font-size:40px'><i class='fa fa-check-circle' style='font-size:60px;color:green'> </i>&nbsp Fine amount added successfully.</h4></div>";
}
}
mysqli_close($c); 
?>
