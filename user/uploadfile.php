<?php
include("../db/connection.php");

if(isset($_POST['submit'])){
 
  $name = $_FILES['file']['name'];
  $target_dir = "../common/image";
  $target_file = $target_dir . basename($_FILES["file"]["name"]);

  // Select file type
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // Valid file extensions
  $extensions_arr = array("jpg","jpeg","png","gif");

  // Check extension
  if( in_array($imageFileType,$extensions_arr) ){
     // Upload file
     if(move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name)){
        // Insert record
       echo $name;
      echo "INSERT INTO `validate`(`profilepicture`) VALUES('$name')";
       die();
        $result = mysqli_query($mysqli, "INSERT INTO `validate`(`profilepicture`) VALUES('$name')");
        //mysqli_query($con,$query);
     }

  }
 
}
?>

<form method="post" action="" enctype='multipart/form-data'>
  <input type='file' name='file' />
  <input type='submit' value='submit' name='submit'>
</form>