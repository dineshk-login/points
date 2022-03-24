<?php
session_start();
include_once("../db/connection.php");
if ($_SESSION["name"] =="") {
	header("Location: login.php"); 
}
	$receiver= $_GET['receiver'];
	$id=$_SESSION["id"];
	$value=$_GET['value'];
	//echo $receiver;
//echo "UPDATE friends SET status=$value WHERE sender = $id && receiver = $receiver";
	//die();
if($value==3)
{ 
	//echo "UPDATE friends SET status=$value WHERE sender = $id && receiver = $receiver";
	//die();
	
	$status=3;
	$result = mysqli_query($mysqli, "UPDATE friends SET status=$value WHERE sender = $id && receiver = $receiver");

	header("Location:friendsdetails.php");
}
?>