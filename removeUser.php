<?php

header('Access-Control-Allow-Origin: *'); 

include 'config.php';

$user_id    = base64_decode($_GET['id']); 
$sql    = "DELETE  FROM user_token where user_id='$user_id' ";
$result = mysqli_query($con,$sql);


if($result){
    $response =  array("msg"=>"user removed","status"=>"200");
    $response = json_encode($response);
    echo $response;
}
else{
    $response =  array("msg"=>"Unable to delete user","status"=>"400");
    $response = json_encode($response);
    echo  $response;
}

mysqli_close($con);

	
?>
