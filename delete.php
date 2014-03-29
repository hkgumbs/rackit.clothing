<?php //include_once("home.html");

	include 'includes/connection.php';

$link = pg_connect ($connectString);
if (!$link)
{
	die('Error: Could not connect: ' . pg_last_error());
}

	$color = $_POST['inputColor'];


	if(!$_POST['submit']) {
		echo "please fill out the form";
		header('Location: index.php');
		
	}
	else{
		pg_query($link,"DELETE FROM TeeShirts WHERE color='$color'") or die('Error: ' . pg_last_error());
		echo "Teeshirt has been deleted!";
		header('Location: index.php');
	}
	
?>