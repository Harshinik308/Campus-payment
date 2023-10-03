<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<title>Confirmation Page</title>
<?php 
session_start();
$db_hostname="127.0.0.1";
$db_username="root";
$db_password="";
$db_name="info";
$c=mysqli_connect($db_hostname,$db_username,$db_password,$db_name);
if(!$c)
echo "ERROR".mysqli_connect_error();
$user_id = $_POST['user_id'];
$check = "SELECT * FROM payment WHERE user_id='$user_id'";
$result = mysqli_query($c, $check);
$count = mysqli_num_rows($result); // Use num_rows to get the count of matching rows
$row=mysqli_fetch_assoc($result);
if($count>0)
{   
    $hint=$row['hint'];
    $s="DELETE from $hint";
    $query=mysqli_query($c,$s);
    $alter="ALTER TABLE $hint AUTO_INCREMENT = 1";
    $a=mysqli_query($c,$alter);
    if($query){
       echo "<div style='display:flex;justify-content:center;position:relative;top:30%;'><h4 style='display:flex;justify-content:center;align-items:center;font-size:40px'><i class='fa fa-check-circle' style='font-size:60px;color:red'> </i>&nbsp Deleted successfully</h4></div>";
    }
    else{
        echo mysqli_error();
    }
}
mysqli_close($c);
?>