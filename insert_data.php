<?php

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "Admin";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$json = file_get_contents('php://input');

	$obj = json_decode($json,true);


	$full_name = $obj['name'];
	$email = $obj['email'];
	$password = $obj['password'];
	
 	$sql = "INSERT INTO `registration`(`id`, `email`, `password`, `reg_date`) VALUES ('$full_name','$email','$password')";
 
	 if(mysqli_query($con,$Sql_Query)){
	 
			 // If the record inserted successfully then show the message as response. 
			$MSG = 'Product Successfully Inserted into MySQL Database' ;
			 
			// Converting the message into JSON format.
			$json = json_encode($MSG);
			 
			// Echo the message on screen.
			// We would also show this message on our app.
			 echo $json ;
	 
	 }
	 else{
	 
			echo 'Something Went Wrong';
	 
	 }
	mysqli_close($con);
	
?>
