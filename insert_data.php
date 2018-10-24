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

	$count  = checkUserAvailable($con,$email);	

	if($count > 0){
		$result =array("msg"=>"Email id already in use","status"=>"300");
		$json = json_encode($result);
		echo $json ;
		return;
	}

	$salt_string  =  md5($email);
	$salt_string1 =  md5($password);
	$salt_string  = $salt_string."$".$salt_string1;


	$Sql_Query =  "INSERT INTO `registration`(`user_id`,`fullname`, `email`, `password`,`salt_string`) 
	VALUES ('$user_id','$full_name','$email','$password','$salt_string')";

	$Sql_Query1 = "INSERT INTO `user_details`(`user_id`,`address`,`phone_no`,`profile_pic`) VALUES 
	('".$user_id."','','','')";

 
	 if(mysqli_query($con,$Sql_Query) &&  mysqli_query($con,$Sql_Query1) )
	 {
		$result =array("msg"=>"Account Created Succesfully","status"=>"200");
		$json = json_encode($result);
		mysqli_close($con);
		echo $json ;
	 }
	 else{

		echo "Inside Else Block";
		 $result =array("msg"=>"Someting wents wrong","status"=>"400");
		 $json = json_encode($result);
		 echo $json ;
		 mysqli_close($con);
	 }

	


}


else{
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
