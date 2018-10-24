<?php

header('Access-Control-Allow-Origin: *'); 
include 'config.php';

$user_id    = base64_decode($_GET['user_id']); 







$sql    = "SELECT count(*) as count ,date,sum(price) as price from expenses where user_id='$user_id' GROUP by date";

$result = mysqli_query($con,$sql);

$data = array();

while( $result1 = mysqli_fetch_assoc($result) )
{
    $data[]       =  $result1;
}

$sum =  0;
for ($i = 0;$i < count($data); $i++){
  $sum =   $sum + $data[$i]['price'];
}

$sum = array("Total"=>"$sum");

array_unshift($data, $sum);

$data =  json_encode($data);

echo  $data;

///echo  $r = base64_encode($result);

//die;

mysqli_close($con);
	
?>
