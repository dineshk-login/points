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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
/*$(document).ready(function(){
  $("#friend").click(function(){
    alert("hai");
  
   // $.get("unfriend.php?sender="<?php echo  $_SESSION['id'];?>"&receiver="<?php echo $sender;?>"",
    
     function(data,status){
      
      alert("Data: " + data + "\nStatus: " + status);
      //$("#result").text("result is " + data);
      
    };
    });
    });
*/

        $(document).ready(function () {
      
     $('#unfriend').click(function(){
      
      $.get('unfriend.php',   // url
         { sender:'<?php echo $_SESSION['id']?>',receiver:'<?php echo $_GET['user_id'] ?>',value:'3' } ,// data to be submit
         function(data, status ) {// success callback
            $('p').append('status: ' + status + ', data: ' + data);
            alert(data);
            alert(status);
        });
      });
    });
         $(document).ready(function () {
      
     $('#sendfriend').click(function(){
      
      $.get('friendrequest.php',   // url
         { receiver:'<?php echo $_GET['user_id'] ?>' } ,// data to be submit
         function(data, status ) {// success callback
            $('p').append('status: ' + status + ', data: ' + data);
            alert(data);
            alert(status);
        });
      });
    });
    </script>
</script>

<style>

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
        right: 0px;
}
.flex {
   width: 150px;
  height: 150px;
    display: block;
    margin: 0 auto;
    border-radius:  50%;

}
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
float: right;
}
}
</style>
</head>
<body bgcolor="grey">

<?php
include_once("../common/header1.php");

//echo "SELECT *  from  friends where friends.sender='".$_SESSION["id"]."' AND friends.status = 1 AND friends.receiver='".$sender."'";
//die();
/*$link="";
if( empty($res1) ){
  $link="<a href='profile.php?sender=". $_SESSION['id']."&receiver=". $sender."'>sendfriendrequest</a>";
}else{
  $link="<a href=''>unfriend</a>";
}*/
$sennder=$_GET['user_id'];
$result = mysqli_query($mysqli, "SELECT * FROM validate where id='$sennder' "); 
$res1=mysqli_fetch_assoc($result);
$pic=$res1['profilepicture'];
$points= $res1['creditpoints'];
switch (true) 
{
case ($points >=1 && $points<=400):
  $img = "../common/image/silver.jpg";
break;
case ($points >=201 && $points<=400):
  $img = "../common/image/gold.jpg";
 break;
case ($points >=401 && $points<=600):
  $img = "../common/image/plattinum.jpg";
 break;
case ($points >=601):
  $img = "../common/image/diamond.jpg";
 break;
}
$result = mysqli_query($mysqli, "SELECT * FROM validate where id='$sennder' "); 
while($res = mysqli_fetch_assoc($result)){
?>
    <center><h2>PROFILE</h2></center>
    <div class="flex"><img class="user" src="<?= $pic;?>"></div><br><br><br><br><br><br><br>
    <div class="row"></div>
    <div class="container-fluid" style="background-color:grey">
    <div class="row" style="justify-content: space-around;">
    <div class="col-md-4"><b>Description:</b><br><?= $res['description'];?><br></div>
    <div class="col-md-4"><?php if($points > 0) {?><img width="100%" height="300px"  src="<?php echo $img; ?>"><?php }?></div>
    <div class="col-md-4 "><b>Name:</b><?= $res['name'];?><br><br><b>Address:</b><?= $res['address'];?><br><br>
    <b>Color:</b><?= $res['color'];?><br><br><b>Designation:</b><?= $res['designation'];?><br><br><b>Facebook:</b><?= $res['facebook'];?><br><br><b>Twitter:</b><?= $res['twitter'];?><br></div>
    </div>

    </div><br>
      <?php

$result1 = mysqli_query($mysqli, "SELECT *  from  friends where friends.sender='".$_SESSION["id"]."' AND friends.status = 1 AND friends.receiver='".$sennder."'"); 
//echo "SELECT *  from  friends where friends.sender='".$_SESSION["id"]."' AND friends.receiver='".$sennder."' AND friends.status = 1";
$ress1=mysqli_fetch_assoc($result1);
if( empty($ress1)){ ?>
        <center><div id="sendfriend"><a href="">sendfriendrequest</a>
        </div></center><?php } else{?>
              <center><div id="unfriend"> <a href=""> unfriend</a> 
            </div></center>
         <?php } }  ?>
    <br>
  <div><?php include_once("../common/footer.php")?></div>
</body>