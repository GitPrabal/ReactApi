<?php

	include 'config.php';
	$json = json_decode(file_get_contents("php://input"));

    $full_name = $json->fullname;
    $email = $json->email;
	$password = $json->pass;
	
	if( !empty($full_name) && !empty($email) && !empty($password) &&  $full_name!=='' && $email!=='' && $password!==''){

		/* Check Wheather  */

	$count  = checkUserAvailable($con,$email);	

	if($count > 0){
		$result =array("msg"=>"Email id already in use","status"=>"300");
		$json = json_encode($result);
		echo $json ;
		return;
	}

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
}else{
	     $result =array("msg"=>"Parameter mismatched","status"=>"400");
		 $json = json_encode($result);
		 echo $json ;
}

function checkUserAvailable($con,$email){

	$userExist_Query =  "Select count(*) as count from `registration` where email='$email'";
	$result = mysqli_query($con,$userExist_Query);
	$result = mysqli_fetch_assoc($result);
	$count  = $result['count'];
	return $count;

}

?>
