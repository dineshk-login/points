<style type="text/css">
  h1 {
  font-family: "Lucida Console", "Courier New", monospace;
}
table 
{
font-family: arial, sans-serif;
border-collapse: collapse;
width: 100%;
}
td, th 
{
border: 1px solid #dddddd;
text-align: left;
padding: 8px;
}
 .user {
  display: inline-block;
  width: 150px;
  height: 150px;
  border-radius: 50%;

  background-repeat: no-repeat;
  background-position: center center;
  background-size: cover;
   position: absolute;
        top: 50px;
        right: 40px;
}
</style>
<?php
session_start();
include_once("../db/connection.php");
$fname = $_SESSION["name"];
if ( $fname == "")
{
  header("Location:login.php");	
}else
{
  $result = mysqli_query($mysqli, "SELECT * FROM validate  WHERE id='".$_SESSION["id"]."'"); 
while($res = mysqli_fetch_assoc($result))
{
  $a = $res['description'];
  "<br>";
  $color_code = $res['color'];
  $points = $res['creditpoints'];
  $pic=$res['profilepicture'];
  $pic1="../common/profile/".$pic;
}
}
$a= $_SESSION['id'];
$result = mysqli_query($mysqli, "SELECT * FROM validate  where id='$a'"); 
$res = mysqli_fetch_assoc($result);
$points=$res['creditpoints'];
switch (true) 
{
case ($points >=1 && $points<=400):
  $img = "../common/image/silver.jpg";
  $des = "You won a Silver trophy with ".$points."points";
break;
case ($points >=201 && $points<=400):
  $img = "../common/image/gold.jpg";
 $des = "You won a Gold trophy with ".$points."points";
 break;
case ($points >=401 && $points<=600):
  $img = "../common/image/plattinum.jpg";
 $des = "You won a Platinum trophy with ".$points."points";
 break;
case ($points >=601):
  $img = "../common/image/diamond.jpg";
 $des = "You won a Diamond trophy with ".$points."points";
 break;
}
?>
 <!-- <body  bgcolor="<?=$color_code;?>"> -->
  <body>
  <div><?php  include("../common/header1.php");?></div>
  <center><div><h1><?= "Welcome ".$fname?></h1></div></center>
  <div><center><img class="user" src="<?php echo $pic1; ?>"></center></div>
  <form action="../admin/update.php" method="post">
  choose the name:	<select name="name">
  <option>--select--</option>
<?php 
  $result = mysqli_query($mysqli, "SELECT validate.id,validate.name,friends.sender,friends.receiver from validate left join friends on validate.id=friends.receiver where friends.sender='".$_SESSION["id"]."' AND friends.status = 1"); 
while($res = mysqli_fetch_assoc($result)) 
{ 	
  echo "<option value=".$res['id'].">".$res['name']."</option>";
}
?>
</select>
<?php 
  $result = mysqli_query($mysqli, "SELECT * FROM validate WHERE name='".$fname."'");
  $res = mysqli_fetch_assoc($result);
  $pnt = $res['creditpoints'] ; 
  $_SESSION["pntss"] = $res['creditpoints'];
if($pnt == 0){
  echo "you have no points";
}else
{?>
  Select the points:<select name="point">
<?php
for ($i=50; $i <= $pnt; $i+=50) 
{ 
 echo "<option value=".$i.">".$i."</option>";
}
}
?>
  </select><button style="background-color: lightskyblue;" value="update" name="addpoints">Send</button>
  <center><div><?php if($pnt>0){?> <img src="<?php echo $img; ?>"> </div></center>
  <center><div><b><?php echo $des; ?><?php } ?></b></div></center>
  </form>	
  <form action="friendrequest.php" method="post">
  choose name for send friendrequest:	<select name="receiver">
  <option>--select--</option>
<?php
include_once("../db/connection.php"); 
  $result = mysqli_query($mysqli, "SELECT * FROM validate  where designation!='admin' AND name!='$fname'"); 
while($res = mysqli_fetch_assoc($result)) 
{ 	
  echo "<option value=".$res['id'].">".$res['name']."</option>";
}
?>
  </select>
  <input type="submit" value="send friend request" name="">
  </form> 
<?php  
  $ressult = mysqli_query($mysqli, "SELECT validate.id,validate.name,friends.id,friends.sender,friends.receiver from validate left join friends on validate.id=friends.sender where friends.receiver='".$_SESSION["id"]."'AND friends.status = 0");
while($ress = mysqli_fetch_assoc($ressult)) 
{  
 ?>
  <table><form action="acceptfriendrequest.php" method="post">
  <tr><td><?php echo $ress['name'] ."sends you a friendrequest" ?></td><td> <a href='acceptfriendrequest.php?sender=<?= $ress['sender']?>&value=1'>accept</a></td><td> <a href='acceptfriendrequest.php?sender=<?= $ress['sender']?>&value=2'>reject</a></td></form>  </tr></table>
<?php
}
?>
<?php
$search="";
$match = "";
if(isset($_POST["search"])){
  $search=$_POST["search"];
}
$a= $_SESSION['id'];
//echo $a;
$b=$_SESSION["name"];
?><center>
<form action="" method="post">
Search friend:<input type="text" name="search" value="<?=$search;?>"><?if($_post){ echo $match;}?>
<input type="submit" value="submit" name="">
</form></center>
<table>
<?php
$sql = mysqli_query($mysqli, "SELECT *,id as uid FROM validate  WHERE  name='".$search."' AND name!= '".$b."'");
  $i=0;
while($res = mysqli_fetch_assoc($sql)){
   $i=$i+1;
  if($i % 2 == 0){
    $color = " #D3D3D3";
  }else{
    $color = " #87CEEB";
  }
?>
<tr bgcolor="<?= $color;?>"><td><?= $i;?></td><td><?= $res['name'];?></td>
<td><a href='profile.php?user_id=<?= $res['uid']?>'>view profile</a></td></tr>
<?php  }?>
</table>
<div><?php  include("../common/footer.php");?></div>
</body>
</html>