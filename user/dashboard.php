<style type="text/css">
  .user {
  display: inline-block;
  width: 150px;
  height: 150px;
  border-radius: 50%;

  background-repeat: no-repeat;
  background-position: center center;
  background-size: cover;
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
  $result = mysqli_query($mysqli, "SELECT * FROM validate  WHERE name='$fname'"); 
  echo "welcome".$fname;
while($res = mysqli_fetch_assoc($result))
{
  $a = $res['description'];
  "<br>";
  $color_code = $res['color'];
  echo "$a";
  $points = $res['creditpoints'];
  $pic=$res['profilepicture'];
  $pic1="../common/profile/".$pic;
  echo $pic1;
  //die();
}
}
$a= $_SESSION['id'];
$result = mysqli_query($mysqli, "SELECT * FROM validate  where id='$a'"); 
$res = mysqli_fetch_assoc($result);
  $img=$res['profilepicture'];
switch (true) 
{
case ($points >=1 && $points<=400):
  $img = "../common/image/silver.jpg";
  $des = "You are a silver trophy holder";
break;
case ($points >=201 && $points<=400):
  $img = "../common/image/gold.jpg";
  $des = "You are a gold trophy holder";
break;
case ($points >=401 && $points<=600):
  $img = "../common/image/plattinum.jpg";
  $des = "You are a platinum trophy holder";
break;
case ($points >=601):
  $img = "../common/image/diamond.jpg";
  $des = "You are a diamond trophy holder";
break;
}
?>
 <!-- <body  bgcolor="<?=$color_code;?>"> -->
  <body>
  <div><?php  include("../common/header1.php");?></div>
  <div><center><img class="user" src="<?php echo $pic1; ?>"></center></div>
  <form action="../admin/update.php" method="post">
  choose the name:	<select name="name">
  <option>--select--</option>
<?php 
  $result = mysqli_query($mysqli, "SELECT validate.id,validate.name,friends.id,friends.sender,friends.receiver from validate left join friends on validate.id=friends.sender where friends.receiver='".$_SESSION["id"]."' AND friends.status = 1"); 
while($res = mysqli_fetch_assoc($result)) 
{ 	
  echo "<option value=".$res['name'].">".$res['name']."</option>";
}
?>
</select>
<?php 
include_once("../db/connection.php");
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
  </select><button style="background-color: lightskyblue;" value="update" name="addpoints">update</button>
  <center><div><?php if($pnt>0){?> <img src="<?php echo $img; ?>"> <?php echo $des; ?><?php } ?></div></center>
  </form>	
  <form action="friendrequest.php" method="post">
  choose name for send friendrequest:	<select name="receiver">
  <option>--select--</option>
<?php
include_once("../db/connection.php"); 
  $result = mysqli_query($mysqli, "SELECT * FROM validate  where designation!='admin'"); 
while($res = mysqli_fetch_assoc($result)) 
{ 	
  echo "<option value=".$res['id'].">".$res['name']."</option>";
}
?>
  </select>
  <input type="submit" value="send friend request" name="">
  </form> 
  <form action="friendsdetails.php" >
  <input type="submit" name="" value="see your friends">
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
  <div><?php  include("../common/footer.php");?></div>
  </body>
  </html>