<?php 
session_start();
$db_hostname="127.0.0.1";
$db_username="root";
$db_password="";
$db_name="info";
$c=mysqli_connect($db_hostname,$db_username,$db_password,$db_name);
if(!$c)
echo "ERROR".mysqli_connect_error();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
</head>
<body>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td></td>
      <td>Otto</td>
    </tr>
  </tbody>
</table>
    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th>Fees Amount</th>
            </tr>
        </thead>
        <tbody>
               <tr>
                   <th>
                   <?php 
                   echo $data1;
                   ?>
                   </th>
                   <th>
                   <?php
                   echo $data2
                    ?>
                    </th>
               </tr>
        </tbody>

    </table>
</body>
</html>
