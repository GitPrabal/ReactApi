<?php

	include 'config.php';
	$json = json_decode(file_get_contents("php://input"));

    $full_name = $json->fullname;
    $email = $json->email;
	$password = $json->pass;
	
	if(!$full_name && !$email || !$password)

	$Sql_Query =  "INSERT INTO `registration`(`fullname`, `email`, `password`) VALUES ('$full_name','$email','$password')";
 
	 if(mysqli_query($con,$Sql_Query)){
		$result =array("msg"=>"Account Created Succesfully","status"=>"200");
		$json = json_encode($result);
		echo $json ;
	 }
	 else{
		 $result =array("msg"=>"Someting wents wrong","status"=>"400");
		 $json = json_encode($result);
		 echo $json ;
	 }
	mysqli_close($con);
	
?>
