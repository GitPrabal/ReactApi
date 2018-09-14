<?php
 
	// Importing DBConfig.php file.
	include 'config.php';
	 
	// Creating connection.
	 $con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
	 
	 // Getting the received JSON into $json variable.
	 $json = file_get_contents('php://input');
	 
	 // decoding the received JSON and store into $obj variable.
	 $obj = json_decode($json,true);

         echo  '<pre>';print_r($obj);
         die; 

	 
	 // Populate product name from JSON $obj array and store into $product_name.
	$product_name = $obj['product_name'];
	 
	// Populate product number from JSON $obj array and store into $product_number.
	$product_number = $obj['product_number'];
	 
	// Populate product details from JSON $obj array and store into $product_details.
	$product_details = $obj['product_details'];
	 
	 // Creating SQL query and insert the record into MySQL database table.
	$Sql_Query = "insert into Products_Table (product_name,product_number,product_details) values ('$product_name','$product_number','$product_details')";
	 
 
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
