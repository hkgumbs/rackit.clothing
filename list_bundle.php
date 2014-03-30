<?php
include_once ("upload.html");

include "includes/connection.php";

$selected_radio = $_POST['gender'];
$age = $_POST['input_age'];
$file_name = md5($_POST['file']);
$male = "M";
$female = "F";

if (!$_POST['submit']) {
	echo "please fill out all of the form";
	header('Location: upload.html');
}

if ($selected_radio == 'male') {

	pg_query("INSERT INTO bundles (gender)
					   VALUES('$male')") or die('Error: ' . pg_last_error());
} else if ($selected_radio == 'female') {

	pg_query("INSERT INTO bundles (gender)
					   VALUES('$female')") or die('Error: ' . pg_last_error());

}
pg_query("INSERT INTO bundles (age_rang)
					   VALUES('$age')") or die('Error: ' . pg_last_error());

pg_query("INSERT INTO bundles (image_id)
					   VALUES('$file_name')") or die('Error: ' . pg_last_error());


if ($_FILES["file"]["error"] > 0)
  {
  echo "Error: " . $_FILES["file"]["error"] . "<br>";
  }
else
  {
  echo "Upload: " . $_FILES["file"]["name"] . "<br>";
  echo "Type: " . $_FILES["file"]["type"] . "<br>";
  echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
  echo "Stored in: " . $_FILES["$file_name"]["./bundle_images"];
  }
  
  
header('Location: closet.php');
?>