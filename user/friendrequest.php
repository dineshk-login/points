<?php
session_start();
include_once("../db/connection.php");
if($_REQUEST)
{
   $a= $_SESSION['id'];
   $b = $_REQUEST['receiver'];
   $result = mysqli_query($mysqli, "SELECT * FROM validate WHERE id= '$a'"); 
   $res = mysqli_fetch_assoc($result);
if($b==$a)
{
   echo "you are not allowed to send friendrequst to yourself";
   die();
}
   $rslt = mysqli_query($mysqli, "SELECT * FROM friends WHERE receiver='$b'AND sender='$a'");
   $rees = mysqli_fetch_assoc($rslt) ;
   if(empty($rees)){
      $result = mysqli_query($mysqli, "INSERT INTO `friends`(`sender`,`receiver`) VALUES('$a','$b')");  
     header("Location:../user/dashboard.php");
   }else if($rees['status'] == 3 || $rees['status'] == 2){
      $result = mysqli_query($mysqli, " UPDATE friends SET status=0 WHERE id='".$rees['id']."'");
    header("Location:../user/dashboard.php");
   }else{
      echo "you already send friend request";
      die();
   }
   ?>