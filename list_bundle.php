<?php
include_once ("upload.html");

include "includes/connection.php";

$selected_radio = $_POST['gender'];
$age = $_POST['input_age'];

if (!$_POST['submit']) {
	echo "please fill out all of the form";
	header('Location: upload.html');
}

if ($selected_radio == 'male') {

$gender = "M";
	
} else if ($selected_radio == 'female') {

$gender = "F";

}



$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 20000)
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }
  else
    {
    echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    echo "Type: " . $_FILES["file"]["type"] . "<br>";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

    if (file_exists("./bundle_images/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "./bundle_images/" . $_FILES["file"]["name"]);
      echo "Stored in: " . "./bundle_images/" . $_FILES["file"]["name"];
      }
    }
  }
else
  {
  echo "Invalid file";
  }
  
header('Location: closet.php');



pg_query("INSERT INTO bundles (gender,age_rang,image_id)
					   VALUES('$gender','$age','$temp')") or die('Error: ' . pg_last_error());

?>