<?php
session_start();
require_once 'dbconfig/config.php';
$link1=$_SESSION['imagelink'];

// file name
$filename = $_FILES['file']['name'];

// Location
$location = 'uploads/'.$filename;

// file extension
$file_extension = pathinfo($location, PATHINFO_EXTENSION);
$file_extension = strtolower($file_extension);

// Valid image extensions
$image_ext = array("jpg","png","jpeg","gif");

$response = 0;
if(in_array($file_extension,$image_ext)){
  // Upload file
    if(file_exists($link1))
    {
        unlink($link1);
    }
  if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
    $response = $location;
      $_SESSION['imagelink']=$location;
      $id=$_SESSION['tid'];
      $query="update teachertable set imglink='$location' where id=$id";
      if(mysqli_query($con,$query))
                {
                    echo $response;
                }
                 else
                {
                    echo mysqli_error($con);
                }
  }
}
?>