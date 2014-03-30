<?php

include "includes/connection.php";

$email = $_POST['input_email'];
/* $user_name = $_POST['input_name_first']; */
$password = md5($_POST['input_password']);

/**** CHECK FOR PASSWORD LENGTH ***/
if (!$_POST['submit']) {
	echo "please fill out all of the form";
	header('Location: login.php');
} else {

	$result = pg_query("SELECT password FROM users_db WHERE email == '$email'");

	if (!$result) {
		echo "E-mail not found" . $query . "<br/>";
		header('Location: login.php');
	} else if ($password != $result) {
		echo "E-mail not found" . $query . "<br/>";
		header('Location: login.php');
	} else {
		/* go to listings page */
		header('Location: index.php');
	}

}
?>


