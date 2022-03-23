<style type="text/css">
.active
{
  font-weight:bold; text-decoration:none;
}
</style>
<?php
require ("..\db\connection.php");
  $name = $_SESSION["header"];
  $sql="SELECT * FROM validate WHERE name='$name'";
  $result=mysqli_query($mysqli,$sql);
  $row=mysqli_fetch_assoc($result);
  $current = basename($_SERVER['PHP_SELF'], ".php");
  $cls="class='active'";
if( !empty($row) && $row['designation'] == 'admin')
{
 ?><div  style="background-color: tan; font-size: 18px; min-height:50px ; text-align: center;">
  <a <?php if($current == 'add') { echo $cls;} ?> href="add.php"> add a new member</a>
  |
  <a <?php if($current == 'dashboard') {echo $cls;} ?> href="dashboard.php"> dashboard</a>
  |
  <a style="text-decoration: none;" href="../user/logout.php">Logout</a></div>
<?php   
}
else if( !empty($row) && $row['designation'] == 'user' )
{
?>
  <div style="background-color: tan; font-size: 18px;">
  <a <?php if($current == 'friendsdetails') { echo $cls;} ?> href="friendsdetails.php">friendsdetails</a>
  |
  <a <?php if($current == 'dashboard') {echo $cls;} ?> href="dashboard.php"> dashboard</a>
  |
  <a href="../user/logout.php">Logout</a></div>
<?php
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title></title>
</head>
<body>
<div><!-- <img src="https://wallpaperaccess.com/full/170249.jpg" height="200px" width="1500px">-->
</div>
</body>
</html>



