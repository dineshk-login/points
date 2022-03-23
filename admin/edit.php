<?php
include_once("../db/connection.php");
if(isset($_POST['name'])) 
{	
	$name = $_POST['name'];
	$password = $_POST['password'];
	$color = $_POST['color'];
	$address = $_POST['address'];
	$result = mysqli_query($mysqli, "UPDATE validate SET name='".$name."',password='".$password."',color='".$color."',address='".$address."' WHERE name='".$name."'");
	header("Location: dashboard.php");
}
?>
<?php
	$name = $_GET['name'];
	include_once("../db/connection.php");
    //echo "=====".$name."".'lath'."";
	$result = mysqli_query($mysqli, "SELECT * FROM validate WHERE name='".$name."' ");
while($res = mysqli_fetch_assoc($result))
{
	$a = $res['name'];
	$b = $res['password'];
	$c = $res['color'];
	$d = $res['address'];
}
?>
<html>
<head>	
<title>Edit Data</title>
</head>
<body>
<form name="form1" method="post" action="">
<table border="0">
<tr> 
<td>Name</td>
<td><input type="text" name="name"  value="<?php echo $a;?>"></td>
</tr>
<tr > 
<td>password</td>
<td><input type="text" name="password"  value="<?php echo $b;?>"></td>
</tr>
<tr > 
<td>color</td>
<td><input type="text" name="color"  value="<?php echo $c;?>"></td>
</tr>
<td>address</td>
<td><input type="text" name="address"  value="<?php echo $d;?>"></td>
<td><input type="submit" name="submit" value="submit"></td>
</tr>
</table>
</form>
</body>
</html>