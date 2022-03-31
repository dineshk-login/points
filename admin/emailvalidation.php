<?php	
if($_POST){
include_once("../db/connection.php");
$email=$_POST['email'];
$check_email="SELECT email FROM validate WHERE email= '".$email."'";
	//echo $check_email;
	$result=mysqli_query($mysqli,$check_email);
	$count=mysqli_num_rows($result);
	//echo "count is >>" . $count;
	if ($count > 0) {
		echo "email id already exist";
	}
	}
	?>