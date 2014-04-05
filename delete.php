<?php //include_once("home.html");

	include "includes/connection.php";


	$email = $_POST['input_email'];


	if(!$_POST['submit']) {
		echo "please fill out the form";
		header('Location: index.php');
		
	}
	else{
		pg_query("DELETE FROM User WHERE email='$email'") or die('Error: ' . pg_last_error());
		echo "User has been deleted!";
		header('Location: index.php');
	}
	
?>
