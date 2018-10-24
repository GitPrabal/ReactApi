<?php

header('Access-Control-Allow-Origin: *'); 

include 'config.php';

$price    = base64_decode($_GET['price']);
$date     = base64_decode($_GET['date']);
$desc_exp = base64_decode($_GET['desc']);
$user_id  = base64_decode($_GET['user_id']);


if( !empty($price) && !empty($date))
{

	$Sql_Query =  "INSERT INTO `expenses`(`user_id`,`date`, `price`, `desc_exp`) VALUES ('$user_id','$date','$price','$desc_exp')";

	if(  mysqli_query($con,$Sql_Query) )
	{
        $result =array("msg"=>"Expenses has been added","status"=>"200");
		$json = json_encode($result);
		echo $json ;
		return;
	}

}

else{
	     $result =array("msg"=>"Unable to add expenses","status"=>"400");
		 $json = json_encode($result);
		 echo $json ;
}


?>
