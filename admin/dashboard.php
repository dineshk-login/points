<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  
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
.flex-container {
    height: 55;
    padding: 0;
    margin: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}
td, th 
{
   border: 1px solid #dddddd;
   text-align: left;
   padding: 8px;
}
.active,  {
  background-color: #666;
  color: white;
}
</style>
<title>Edit Data</title>
</head>
<body>
<div>	<?php
include("../common/header1.php");?></div>
<center><img src="<?=$img;?>"width=200px height=100px></center>
<table>
<tr><td>name</td><td>Creditpoints</td><td>Color</td><td>Address</td><td>Facebook</td><td>Twitter</td><td>Email</td><td>Delete</td><td>Action</td></tr>
<?php
$limit = 5;  
if (isset($_GET["page"])) {
	$page  = $_GET["page"]; 
	} 
	else{ 
	$page=1;
	};  
$start_from = ($page-1) * $limit; 
$result = mysqli_query($mysqli, "SELECT * FROM validate ORDER BY designation ASC , id DESC LIMIT $start_from, $limit");
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
<tr bgcolor="<?= $color;?>" ><td><?= $res['name'];?></td><td><?= $res['creditpoints'];?></td><td><?= $res['color'];?></td><td><?= $res['address'];?></td><td><a href="<?= $res['facebook'];?>"><?= $res['facebook'];?></a></td><td><a href="<?= $res['twitter'];?>"><?= $res['twitter'];?></a></td><td><?= $res['email'];?></td>
<td><?= $delete;?></td><td><a href='edit.php'>Edit/<a href='view.php?name=<?= $res['name'];?>'>view</a></a></a></td></tr>
<?php  }  ?>

</table>
<?php  

$result_db = mysqli_query($mysqli,"SELECT * FROM validate"); 
$row_db = mysqli_num_rows($result_db);
$total_records =$row_db ; 
//echo "$total_records";
//die(); 
$total_pages = ceil($total_records / $limit); 
/* echo  $total_pages; */
$pagLink = "<ul class='pagination'>";  
for ($i=1; $i<=$total_pages; $i++) {
             $pagLink .= "<li class='active'><a class='page-link' href='dashboard.php?page=".$i."'>".$i."</a></li>";	
}?>
<div class="flex-container"><?= $pagLink;?>  </ul> </div>

<div><?php include("../common/footer.php");?> </div>
</body>
</html>
