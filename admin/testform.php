<?php
include("../common/classadding.php");
$result1="";
$result2="";
$result3="";
$result4="";
$a1="";
$a2="";
$a3="";
$a4="";


if ($_POST){
if(isset($_POST['calculate1'])) {  $a1=$_POST['calculate1'];}
if(isset($_POST['calculate2'])) {  $a2=$_POST['calculate2'];}
if(isset($_POST['calculate3'])) {  $a3=$_POST['calculate3'];}
if(isset($_POST['calculate4'])) {  $a4=$_POST['calculate4'];}



$a= $_POST['a'];
$b= $_POST['b'];
if($a1=="addition"){
  $obj= new adding();
  $result1= "The addition is" . $obj->add($a,$b);
}if ($a2=="subtraction") {
  $obj= new subtraction();
  $result2=  "The subtraction is" . $obj->sub($a,$b);
}if ($a3=="multiplication") {
  $obj= new multiplication();
  $result3=  "The multiplication is" .$obj->mul($a,$b);
}if ($a4=="division") {
  $obj= new division();
  $result4=  "The division is" .$obj->div($a,$b);
}

}
// if (isset($_POST['a']) && $_POST['calculate']=="addition") echo "checked";

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title></title>
</head>
<body>
<center><table border=" 20px " cellpadding="20px">
<form action="" method="POST">
<tr><td>Enter the value of a:<input type="text" name="a" value="<?php if(isset($_POST['a'])) {
echo $_POST['a'];} ?>"><br><br>
Enter the value of b:<input type="text" name="b" value="<?php if(isset($_POST['b'])) {
echo $_POST['b'];} ?>"></td><br>
<tr><td>choose the  arithmatic operartion:<br>
<input type="checkbox"  name="calculate1" <?php if (isset($_POST['calculate1']) && $_POST['calculate1'] =="addition"){ echo "checked";}?> value="addition">
<label for="addition">addition</label><br>
<input type="checkbox"  name="calculate2" <?php if (isset ($_POST['calculate2']) && $_POST['calculate2']=="subtraction"){ echo "checked";}?> value="subtraction">
<label for="subtraction">subtraction</label><br>
<input type="checkbox"  name="calculate3" <?php if (isset($_POST['calculate3']) && $_POST['calculate3']=="multiplication"){ echo "checked";}?> value="multiplication">
<label for="multiplication">multiplication</label><br>
<input type="checkbox"  name="calculate4" <?php if (isset($_POST['calculate4']) && $_POST['calculate4']=="division"){ echo "checked";}?> value="division">
<label for="division">division</label></td></tr><br>
<tr><td>
<input type="submit" value="submit" name=""><br></td></tr>
<tr><td> <?php echo  $result1;?></td> </center></tr>
<tr><td> <?php echo  $result2;?></td> </center></tr>
<tr><td> <?php echo  $result3;?></td> </center></tr>
<tr><td> <?php echo  $result4;?></td> </center></tr>
</
form></table></center>

</body>
</html>


