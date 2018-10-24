<?php

header('Access-Control-Allow-Origin: *'); 

$time    = microtime(); 
$time2   = time();  
$result  =  ceil(str_replace('.','',$time));
$user_id = $result + $time2;

include 'config.php';

	$json = json_decode(file_get_contents("php://input"));


    $full_name = $json->fullname;
    $email = $json->email;
	$password = $json->pass;
	
	if( !empty($full_name) && !empty($email) && !empty($password) &&  $full_name!=='' && $email!=='' && $password!=='')
	{

	$count  = checkUserAvailable($email);	

	if($count > 0){
		$result =array("msg"=>"Email id already in use","status"=>"300");
		$json = json_encode($result);
		echo $json ;
		return;
	}

	$salt_string  =  md5($email);
	$salt_string1 =  md5($password);
	$salt_string  = $salt_string."$".$salt_string1;


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $conn->beginTransaction();


	$conn->exec("INSERT INTO `registration`(`user_id`,`fullname`, `email`, `password`,`salt_string`) 
	VALUES ('$user_id','$full_name','$email','$password','$salt_string')");

	$conn->exec("INSERT INTO `user_details`(`user_id`,`address`,`phone_no`,`profile_pic`) VALUES 
	('".$user_id."','','','')");

	$conn->commit();
	$result =array("msg"=>"Account Created Succesfully","status"=>"200");
	$json = json_encode($result);
    }
catch(PDOException $e)
    {
    // roll back the transaction if something failed
    $conn->rollback();
    $result =array("msg"=>"Someting wents wrong","status"=>"400");
	$json = json_encode($result);
	echo $json ;
    }
}


else{
	     $result =array("msg"=>"Parameter mismatched","status"=>"400");
		 $json = json_encode($result);
		 echo $json ;
}

function checkUserAvailable($email){

	// $userExist_Query =  "Select count(*) as count from `registration` where email='$email'";
	// $result = mysqli_query($con,$userExist_Query);
	// $result = mysqli_fetch_assoc($result);
	// $count  = $result['count'];
	// return $count;


	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $conn->prepare($userExist_Query); 
		$stmt->execute();
	
		// set the resulting array to associative
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
		$count  = $result['count'];
	    return $count;
	}
	catch(PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
}

?>
