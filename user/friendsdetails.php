<?php
session_start();
include("../db/connection.php");
if ($_SESSION["name"] =="") {
	header("Location: login.php"); 
} 
$search="";
if(isset($_POST["search"])){
	$search=$_POST["search"];
}
$a= $_SESSION['id'];
echo $a;
?>
<style>
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
</style>
<div>	
<?php 
include("../common/header1.php");?></div>
<center>
<form action="" method="post">
Search:<input type="text" name="search" value="<?=$search;?>">
<input type="submit" value="submit" name="">
</form></center>

<table >
<?php
if($_POST){
	$sql = "SELECT *,id as uid FROM validate  WHERE  name='".$search."'";
}else{
	$sql="SELECT validate.id as uid,validate.name,friends.id,friends.sender,friends.receiver from validate left join friends on validate.id=friends.sender where friends.receiver='".$_SESSION["id"]."'AND friends.status = 1  LIMIT 5";
}
	$result = mysqli_query($mysqli,$sql); 
	$i=0;
while($res = mysqli_fetch_assoc($result) ){

	$i=$i+1;
	if($i % 2 == 0){
		$color = " #D3D3D3";
	}else{
		$color = " #87CEEB";
	}
?>
<tr bgcolor="<?= $color;?>"><td><?= $i;?></td><td><?= $res['name'];?></td>
<td><a href='profile.php?user_id=<?= $res['uid']?>'>view profile</a></td></tr>
<?php  } ?>
</table>
<div><?php include("../common/footer.php");?></div> 




