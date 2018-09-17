<?php

include 'config.php';
sleep(3);
$email    = $_GET['email'];
$password = $_GET['password'];


$sql    = "SELECT count(*) as count FROM registration where email='$email' and password='$password' "; 
$result = mysqli_query($con,$sql);

$result = mysqli_fetch_assoc($result);

$count  = $result['count'];


if($count > 0){
	$result =array("msg"=>"Logged In Successfully","status"=>"200","flag"=>true);
	$json = json_encode($result);
	echo $json ;
}else{
	$result =array("msg"=>"Invalid Credentials","status"=>"404","flag"=>false);
	$json = json_encode($result);
	echo $json ;
}


mysqli_close($con);
	
?>
