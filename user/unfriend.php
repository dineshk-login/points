<?php
session_start();
include_once("../db/connection.php");
if ($_SESSION["name"] =="") {
	header("Location: login.php"); 
}
	$sender= $_GET['sender'];
	$id=$_SESSION["id"];
	$value=$_GET['value'];
if($value==3)
{
	$status=3;
	$result = mysqli_query($mysqli, "UPDATE friends SET status=$value WHERE receiver = $id && sender = $sender");
	header("Location:friendsdetails.php");
}
?>