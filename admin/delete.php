<?php
if($_GET)
{
    include_once("../db/connection.php");
    $name= $_GET['name'];
    $result = mysqli_query($mysqli, "DELETE  FROM validate WHERE name='$name'" );
    header("Location:dashboard.php");
}else
{
    header("Location:..\user\login.php");
}
?>
