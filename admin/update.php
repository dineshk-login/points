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
$t=time();
$date=date("d-m-y");
$rslt= mysqli_query($mysqli, "SELECT * FROM validate  WHERE id='$name'");
$res= mysqli_fetch_assoc($rslt);
$receivername=$res['name'];
echo $point;
$result = mysqli_query($mysqli, "INSERT INTO `transactiondetails`(`senderid`,`sendername`,`receiverid`,`receivername`,`transactionpoints`,`date`,`time`) VALUES('".$_SESSION["id"]."','$fname','$name','$receivername','$point','$date','$t')");
$result = mysqli_query($mysqli, "UPDATE validate SET creditpoints = $point + creditpoints WHERE id='$name'");
$point = mysqli_query($mysqli, "UPDATE validate SET creditpoints =  creditpoints - $point WHERE id='".$_SESSION["id"]."'");
header("Location:../user/dashboard.php");	
}
?>

