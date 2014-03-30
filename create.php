<?php 

    include "includes/connection.php";

    $email = $_POST['input_email'];
	 /* $user_name = $_POST['input_name_first']; */
	$password = md5($_POST['input_password']);

	if(!$_POST['button_submit']) {
		echo "please fill out the form";
		header('Location: index.php');
		
	}
	else{
		pg_query("INSERT INTO users_db (email, password)
					   VALUES('$email','$password')") or die('Error: ' . pg_last_error());
		echo "User has been added!";
		header('Location: login.php');
	}

?>

