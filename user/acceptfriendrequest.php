<?php
session_start();
include_once("../db/connection.php");
	$sender= $_GET['sender'];
	$value= $_GET['value'];
	$id=$_SESSION["id"];
if($value==1)
{
	//$status=1;
	$result = mysqli_query($mysqli, "UPDATE friends SET status=$value WHERE receiver = $id && sender = $sender");
}

else if($value==2){
	//$status= 2;
	$result = mysqli_query($mysqli, "UPDATE friends SET status=$value WHERE receiver = $id && sender = $sender");
}
	header("Location:dashboard.php");
?>