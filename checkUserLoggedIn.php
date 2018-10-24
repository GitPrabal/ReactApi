<?php

header('Access-Control-Allow-Origin: *'); 

include 'config.php';


$email    = base64_decode($_GET['e']);
$password = base64_decode($_GET['p']);

$salt_string  =  md5($email);
$salt_string1 =  md5($password);
$salt_string  = $salt_string."$".$salt_string1;

$sql    = "SELECT *,count(*) as count FROM registration where email='$email' and password='$password' and salt_string='$salt_string' "; 
$result = mysqli_query($con,$sql);

$result = mysqli_fetch_assoc($result);

$count     = $result['count'];
$email     = $result['email'];
$fullname  = $result['fullname'];
$user_id   = $result['user_id'];
$reg_date  = $result['reg_date'];
$reg_date  = explode(' ', $reg_date);
$reg_date  = $reg_date[0];
$reg_date = date("M jS, Y", strtotime($reg_date));

if($count > 0){
	$result =array("user_id"=>$user_id,"email"=>$email, "msg"=>"Logged In Successfully","status"=>"200","flag"=>true,'fullname'=>$fullname,'reg_date'=>$reg_date);
	$json = json_encode($result);
	echo $json ;
}else{
	$result =array("msg"=>"Invalid Credentials","status"=>"404","flag"=>false);
	$json = json_encode($result);
	echo $json ;
}


mysqli_close($con);
	
?>
