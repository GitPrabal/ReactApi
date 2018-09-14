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


$sql = "SELECT * FROM registration";

$result = $conn->query($sql);

$result1 =  array();

while($row = $result->fetch_assoc()) {
	$result1 = $row;
}



$final_result =  json_encode($result1);

echo  $final_result;







?>
