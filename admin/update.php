<?php
session_start();
include_once("../db/connection.php");
if($_SESSION["name"]=="")
{
	header("Location: ../user/login.php");	
}
?>
<?php 

if($_POST)
{
$point = $_POST['point']; 
if($point > $_SESSION["pntss"])
{
 	echo "You dont have that much of points. so you are not allowed to send the points";
 	die();
}
$fname = $_SESSION["name"];
$name = $_POST['name'];
$point = $_POST['point'];
include_once("../db/connection.php");
$result = mysqli_query($mysqli, "UPDATE validate SET creditpoints = $point + creditpoints WHERE name='$name'");
$point = mysqli_query($mysqli, "UPDATE validate SET creditpoints =  creditpoints - $point WHERE name='$fname'");
header("Location:../user/dashboard.php");	
}
?>

