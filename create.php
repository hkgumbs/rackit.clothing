<?php //include_once("home.html");

    include "includes/connection.php";

    $email = $_POST['input_email'];
	$name_first = $_POST['input_name_first'];
	$name_last = $_POST['input_name_last'];

	if(!$_POST['submit']) {
		echo "please fill out the form";
		header('Location: index.php');
		
	}
	else{
		pg_query("INSERT INTO users_db (email, name_last, name_first)
					   VALUES('$email','$name_last','$name_first')") or die('Error: ' . pg_last_error());
		echo "User has been added!";
		header('Location: index.php');
	}

?>

