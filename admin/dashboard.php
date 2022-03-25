<?php
session_start();
include_once("../db/connection.php");
if($_SESSION["superadmin"] =="")
{
  header("Location: ../user/login.php");
}
$a= $_SESSION['id'];
$result = mysqli_query($mysqli, "SELECT * FROM validate  where id='$a'"); 
$res = mysqli_fetch_assoc($result);
  $img=$res['profilepicture'];
?>
<html>
<head>
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
<title>Edit Data</title>
</head>
<body>
<div>	<?php
include("../common/header1.php");?></div>
<center><img src="<?=$img;?>"width=200px height=100px></center>
<table>
<tr><td>name</td><td>creditpoints</td><td>color</td><td>address</td><td>delete</td><td>action</td></tr>
<?php
$result = mysqli_query($mysqli, "SELECT * FROM validate ORDER BY designation ASC , id DESC");
$i=0;
while($res = mysqli_fetch_assoc($result))
{
	$i=$i+1;
if($i % 2 == 0)
{
	$color = " #D3D3D3";
}else
{
	$color = " #87CEEB";
}
 
$x=$res['name'];
if($res['designation'] == 'admin')
{
	$delete="";
	}else
{
	$delete = "<a href='delete.php?name=".$x."'>Delete</a>";
}?>
<tr bgcolor="<?= $color;?>" ><td><?= $res['name'];?></td><td><?= $res['creditpoints'];?></td><td><?= $res['color'];?></td><td><?= $res['address'];?></td>
<td><?= $delete;?></td><td><a href='edit.php?name=<?= $res['name'];?>
	'>Edit/<a href='view.php?name=<?= $res['name'];?>'>view</a></a></a></td></tr>
<?php  }  ?>
</table>
<div><?php include("../common/footer.php");?> </div>
</body>
</html>
