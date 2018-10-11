<?php
header('Access-Control-Allow-Origin: *'); 

include 'config.php';

$user_id    = $_GET['user_id'];




$sql    = "SELECT * FROM user_details where user_id='$user_id' "; 
$result = mysqli_query($con,$sql);
$result = mysqli_fetch_assoc($result);

echo  json_encode($result);
die;







mysqli_close($con);
	
?>
