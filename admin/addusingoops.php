<?php
include("../common/classadding.php");
$result="";
if ($_POST){
  $a1=$_POST['calculate'];
  $a= $_POST['a'];
  $b= $_POST['b'];
  if($a1=="addition"){
    $obj= new adding();
    $result= "The addition is" . $obj->add($a,$b);
  }elseif ($a1=="subtraction") {
    $obj= new subtraction();
    $result=  "The subtraction is" . $obj->sub($a,$b);
  }elseif ($a1=="multiplication") {
    $obj= new multiplication();
    $result=  "The multiplication is" .$obj->mul($a,$b);
  }elseif ($a1=="division") {
    $obj= new division();
    $result=  "The division is" .$obj->div($a,$b);
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
<input type="radio"  name="calculate" <?php if (isset($_POST['calculate']) && $_POST['calculate'] =="addition"){ echo "checked";}?> value="addition">
<label for="addition">addition</label><br>
<input type="radio"  name="calculate" <?php if (isset ($_POST['calculate']) && $_POST['calculate']=="subtraction"){ echo "checked";}?> value="subtraction">
<label for="subtraction">subtraction</label><br>
<input type="radio"  name="calculate" <?php if (isset($_POST['calculate']) && $_POST['calculate']=="multiplication"){ echo "checked";}?> value="multiplication">
<label for="multiplication">multiplication</label><br>
<input type="radio"  name="calculate" <?php if (isset($_POST['calculate']) && $_POST['calculate']=="division"){ echo "checked";}?> value="division">
<label for="division">division</label></td></tr><br>
<tr><td>
<input type="submit" value="submit" name=""><br></td></tr>
<td> <?php echo  $result;?></td> </center></tr>
</form></table></center>

</body>
</html>


