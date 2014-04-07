<?php

session_start();
if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
	header("Location: login.php");
}

include_once ("upload.html");
include "includes/connection.php";

$poster_id = $_SESSION['user_id'];

$selected_radio = $_POST['gender'];
$age_string = str_replace(' ', '',$_POST['input_age']);



if (!$_POST['submit']) {
	echo "please fill out all of the form";
	header('Location: upload.html');
}


/* do some age checking here and make mens womens boys girls accordingly */
if ($selected_radio == 'male') {

	$gender = "M";

} else if ($selected_radio == 'female') {

	$gender = "F";

}

$allowedExts = array("gif", "jpeg", "jpg", "png");
$file_size = 40000;
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
$type = strtolower($_FILES["file"]["type"]);
$image_id = md5($poster_id . $_FILES["file"]["name"]);

if($_FILES["file"]["size"] > $file_size){
	echo "File size too big";
	header('Location: upload.php');	
}

/******* File upload size is 20kb ********/
if ((($type == "image/gif") || ($type == "image/jpeg") || ($type == "image/jpg") 
|| ($type == "image/pjpeg") || ($type == "image/x-png") || ($type == "image/png")) 
&& ($_FILES["file"]["size"] < $file_size) && in_array($extension, $allowedExts)) {
	if ($_FILES["file"]["error"] > 0) {
		echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
	} else {
		echo "Upload: " . $_FILES["file"]["name"] . "<br>";
		echo "Type: " . $_FILES["file"]["type"] . "<br>";
		echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
		echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

		if (file_exists("bundle_images/" . $_FILES["file"]["name"])) {
			echo $_FILES["file"]["name"] . " already exists. ";
		} else {
			move_uploaded_file($_FILES["file"]["tmp_name"], "bundle_images/" . $image_id);
			echo "Stored in: " . "bundle_images/" . $image_id;
		}
	}
} else {
	
	header('Location: upload.php');	
}



$ages = explode("-", $age_string);
if($ages[1] != null){
	pg_query("INSERT INTO bundle (gender,age_min,age_max,image_id,poster_id)
					   VALUES('$gender','$age[0]','$age[1]','$image_id','$poster_id')") or die('Error: ' . pg_last_error());
} else{
	pg_query("INSERT INTO bundle (gender,age_min,image_id,poster_id)
					   VALUES('$gender','$age[0]','$image_id','$poster_id')") or die('Error: ' . pg_last_error());
}




header('Location: closet.php');
?>