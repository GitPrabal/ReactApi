<?php

header('Access-Control-Allow-Origin: *'); 

include 'config.php';

$user_id    = base64_decode($_GET['user_id']); 


$sql    = "SELECT * FROM user_details where user_id='$user_id' ";

$result = mysqli_query($con,$sql);

$result = mysqli_fetch_assoc($result);

$result =   json_encode($result);

$result = "[".$result."]";

echo  $result;

///echo  $r = base64_encode($result);

//die;

mysqli_close($con);
	
?>
