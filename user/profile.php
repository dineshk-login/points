<?php
session_start();
include("../db/connection.php"); 
if ($_SESSION["name"] =="") {
  header("Location: login.php");
}
?>
<head>
<title>Bootstrap Example</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
body
{
font-family: Arial, Helvetica, sans-serif;
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
.flex{
display: flex;
justify-content: center;

}
}
</style>
<body bgcolor="grey">
<?php
include_once("../common/header1.php");
$sender=$_GET['user_id'];
$result1 = mysqli_query($mysqli, "SELECT *  from  friends where friends.receiver='".$_SESSION["id"]."' AND friends.status = 1 AND friends.sender='$sender'"); 
$res1=mysqli_fetch_assoc($result1);
$link="";
if( empty($res1) ){
  $link="<a href='friendrequest.php?sender=". $_SESSION['id']."&receiver=". $sender."'>sendfriendrequest</a>";
}else{
  $link="<a href='unfriend.php?sender=". $res1['sender']."&value=3'>unfriend</a>";
}
$result = mysqli_query($mysqli, "SELECT * FROM validate where id='$sender' "); 
while($res = mysqli_fetch_assoc($result)){
?>
    <center><h2>PROFILE</h2></center>
    <div class="container-fluid" style="background-color:grey">
    <div class="row">
    <div class="col-md-4"><b>Description:</b><br><?= $res['description'];?><br></div>
    <div class="col-md-4"><center><img width="100%" height="200px" src="<?= $res['profilepicture'];?>"></center></div>
    <div class="col-md-4 "><b>Name:</b><?= $res['name'];?><br><br><b>Address:</b><?= $res['address'];?><br><br>
    <b>Color:</b><?= $res['color'];?><br><br><b>Designation:</b><?= $res['designation'];?><br><br><b>Facebook:</b><?= $res['facebook'];?><br><br><b>Twitter:</b><?= $res['twitter'];?><br></div>
    </div>
    </div>
    <br>
    <div class="flex"><?php echo $link; ?></div>
<?php  }  ?>
<div><?php include_once("../common/footer.php")?></div>
</body>