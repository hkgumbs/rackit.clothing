
<?php 

    include "includes/connection.php";

    $email = $_POST['input_email'];
	 /* $user_name = $_POST['input_name_first']; */
	$password = md5($_POST['input_password']);

	if(!$_POST['submit']) {
		echo "please fill out the form";
		header('Location: login.php');
		
	}
	else{
		pg_query("INSERT INTO User (email, password)
					   VALUES('$email','$password')") or die('Error: ' . pg_last_error());
		echo "User has been added!";
		header('Location: login.php');
	}

?>

