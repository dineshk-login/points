<script type="text/javascript">
	 	//alert("hai");
	 	//console.log("inside");
             
        function checkfile() {
            filename = document.querySelector('#file1').value;
            //alert(filename);
            extension = filename.split('.').pop();
            alert(extension);
            //document.querySelector('.output').textContent = extension;
            if(extension != 'gif' && extension != 'jpg' && extension != 'png'){
            	alert("This type of files are not allowed");
            	return false;
            }
            else{
            	document.form1.submit();
            	 
            }
        }
    </script>
           
<?php 
session_start();
include_once("../db/connection.php");
	$cls0="";
	$cls1="";
	$cls2="";
	$cls3="";
	$cls4="";
	$cls5="";
	$cls6="";
	$cls7="";
	$warning="";

if(isset($_POST['btnsubmit'])){
 
  $imagename = $_FILES['file']['name'];
  $target_dir = "../common/profile/";
  $target_file = $target_dir . basename($_FILES["file"]["name"]);

  // Select file type
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // Valid file extensions
  $extensions_arr = array("jpg","jpeg","png","gif");

  // Check extension
  if( in_array($imageFileType,$extensions_arr) ){
     // Upload file
     if(move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$imagename)){
        // Insert record
       echo $imagename;
      //echo "INSERT INTO `validate`(`profilepicture`) VALUES('$imagename')";
      // die();
        //$result = mysqli_query($mysqli, "INSERT INTO `validate`(`profilepicture`) VALUES('$imagename')");
        //mysqli_query($con,$query);
     }

  }
 
}
if($_SESSION["superadmin"] =="")
{
	header("Location: ../user/login.php");
}

if(isset($_POST['name']) && (($_POST['name']) == "")) 
{
	$cls0="class='clss'";
} 
if(isset($_POST['password']) && (($_POST['password']) == "")) 
{
	$cls1="class='clss'";
} 
if(isset($_POST['color']) && (($_POST['color']) == "")) 
{
	$cls2="class='clss'";
} 
if(isset($_POST['address'])&&(($_POST['address']) == "")) 
{
	$cls3="class='clss'";
} 
if(isset($_POST['description'])&&(($_POST['description']) == "")) 
{
	$cls4="class='clss'";
} 
if(isset($_POST['creditpoints'])&&(($_POST['creditpoints']) == "")) 
{
	$cls5="class='clss'";
} 
if(isset($_POST['twitter'])&&(($_POST['twitter']) == "")) 
{
	$cls6="class='clss'";
} 
if(isset($_POST['facebook'])&&(($_POST['facebook']) == "")) 
{
	$cls7="class='clss'";
}  
if($_POST)
{
if($_POST['name']=="" || $_POST['password']=="" || $_POST['color']=="" ||$_POST['address']=="" || $_POST['description']==""  || $_POST['creditpoints']==""|| $_POST['twitter']==""||$_POST['facebook']=="")
{
	$warning = "* all fields are mandatory";
}
else
{
	$name = $_POST['name'];
	$password = $_POST['password'];
	$color = $_POST['color'];
	$address = $_POST['address'];
	$description = $_POST['description'];
	$creditpoints = $_POST['creditpoints'];
	$file = $_POST['file'];
	$twitter = $_POST['twitter'];
    $facebook = $_POST['facebook'];
	$result = mysqli_query($mysqli, "INSERT INTO `validate`(`name`,`password`,`color`,`address`,`description`,`creditpoints`,`profilepicture`,`twitter`,`facebook`) VALUES('$name','$password','$color','$address','$description','$creditpoints','$imagename','$twitter','$facebook')");
	header("Location:dashboard.php");
}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title></title>
<style type="text/css">
.clss
{
	border-style: solid;
	border-color: red;
	width:70%;
}
</style>
</head>
<body>
<div><?php include("../common/header1.php");?></div> 
<body>
<form name="form1"  id="form1" method="post" action="" enctype='multipart/form-data'>
	<table border="0">
	<tr > 
	<td> Enter Name</td>
	<td><input <?php echo $cls0; ?> type="text" name="name"  value="<?php if(isset($_POST['name'])) {
		echo $_POST['name'];} ?>"></td><td style="color: red;"><?php echo $warning;?></td>
	</tr>
	<tr > 
	<td> Enter password</td>
	<td><input <?php echo $cls1; ?> type="password" name="password"  value="<?php if(isset($_POST['password'])) {
		echo $_POST['password'];} ?>"></td>
	</tr>
	<tr> 
	<td>Enter color</td>
	<td><input <?php echo $cls2; ?> type="text" name="color"  value="<?php if(isset($_POST['color'])) { echo $_POST['color'];} ?>">
	</td>
	</tr>
	<tr> 
	<td>Enter description</td>
	<td><input <?php echo $cls4; ?> type="text" name="description"  value="<?php if(isset($_POST['description'])) {
		echo $_POST['description'];} ?>"></td>
	</tr>
	<tr> 
	<td>Enter creditpoint</td>
	<td><input <?php echo $cls5; ?> type="text" name="creditpoints"  value="<?php if(isset($_POST['creditpoints'])) {
		echo $_POST['creditpoints'];} ?>"></td>
	</tr>
	<tr> 
	<td>Enter address</td>
	<td><input <?php echo $cls3; ?> type="text" name="address"  value="<?php if(isset($_POST['address'])) { echo $_POST['address'];} ?>"></td>
	</tr>
	<tr> 
	<td>twitter</td>
	<td><input <?php echo $cls6; ?> type="text" name="twitter"  value="<?php if(isset($_POST['twitter'])) { echo $_POST['twitter'];} ?>"></td>
	</tr>
	<tr> 
	<td>facebook</td>
	<td><input <?php echo $cls7; ?> type="text" name="facebook"  value="<?php if(isset($_POST['facebook'])) { echo $_POST['facebook'];} ?>"></td>
	</tr>
	<tr><tr>
		<td> Choose photo:</td><td> <input type='file' name='file' id="file1" ></td>
	</tr>
	<td><input type="button" name="btnsubmit" value="submit" onclick="checkfile()"></td>
	</tr> 
	</table>
</form>


<div><?php include("../common/footer.php");?></div> 
</body>
</html>