<?php
session_start();
include_once("../db/connection.php");
if($_REQUEST)
{
   $a= $_SESSION['id'];
   $b = $_REQUEST['receiver'];
   $result = mysqli_query($mysqli, "SELECT * FROM validate WHERE id= '$a'"); 
   $res = mysqli_fetch_assoc($result);
   //$c=$res['id'];
if($b==$a)
{
   echo "you are not allowed to send friendrequst to yourself";
   die();
}
   $rslt = mysqli_query($mysqli, "SELECT * FROM friends WHERE receiver='$b'AND sender='$a'");
   $rees = mysqli_fetch_assoc($rslt) ;
   //if(!empty($rees))
   //$b1=$rees['receiver'];
   //$a1=$rees['sender'];
  /* if(empty($rees)){
      //insert 
     
   }else{
      if ($rees['status'] == 3 || $rees['status'] == 2)) {
         // update
      }else{
         echo "you already send friend request";
         die();
      }
   }*/
   if(empty($rees)){
      $result = mysqli_query($mysqli, "INSERT INTO `friends`(`sender`,`receiver`) VALUES('$a','$b')");   
   }else if($rees['status'] == 3 || $rees['status'] == 2){
      $result = mysqli_query($mysqli, " UPDATE friends SET status=0 WHERE id='".$rees['id']."'");
   }else{
      echo "you already send friend request";
      die();
   }
   
/*if(!empty($rees))
{
      echo "you already send friend request";
      die();
   }else{
      $result = mysqli_query($mysqli, " UPDATE friends SET status=0 WHERE id='".$rees['id']."'");
      header("Location:../user/dashboard.php");
   }
}*/
   
  // $result = mysqli_query($mysqli, "INSERT INTO `friends`(`sender`,`receiver`) VALUES('$a','$b')");
   //header("Location:../user/dashboard.php");
}	
/*if($_GET)
{
   $sender=$_GET['sender'];
   $receiver=$_GET['receiver'];
   $sql= "SELECT * FROM friends WHERE receiver='$receiver'AND sender='$sender' ";
   $rslt = mysqli_query($mysqli,$sql);
   $rees = mysqli_fetch_assoc($rslt) ;
   $b1=$rees['sender'];
   $a1=$rees['receiver'];
if($sender == $b1 && $receiver == $a1)
{
if($rees['status']==1 ||$rees['status'] ==0 )
{
   echo "you already send friend request";
   die();
}
else
{
   $result = mysqli_query($mysqli, " UPDATE friends SET status=0 WHERE id='".$rees['id']."'");
}
   $sender=$_GET['sender'];
   $receiver=$_GET['receiver'];
   $result = mysqli_query($mysqli, "INSERT INTO `friends`(`sender`,`receiver`) VALUES('$sender','$receiver')");
   header("Location:../user/dashboard.php");
}  }*/
?>