<?php

include "includes/connection.php";

$email = strtolower($_POST['input_email']);
echo $email;
/* $user_name = $_POST['input_name_first']; */
$password = trim(md5($_POST['input_password']));
echo $password . "<br/>";


if (!$_POST['submit']) {
	echo "please fill out all of the form";
	header('Location: login.php');
} else {

	$result = pg_query("SELECT password FROM users_db WHERE email = '$email'");
	$myuser = pg_fetch_assoc($result);

	if (!$result) {
		echo '<td>' . pg_fetch_row($result) . '</td>';
		echo "E-mail not found" . $query . "<br/>";
		/*header('Location: login.php');*/
	} else if ($password != $myuser['password']) {
		echo $myuser['password'];
		echo "Incorrect Password" . $query . "<br/>";
		echo '<td>' . pg_fetch_row($result) . '</td>';
		/*header('Location: login.php');*/
	} else {
		/* go to listings page */
		/*header('Location: index.php');*/

		echo "All GOOD!!" . $query . "<br/>";
	}

}



?>

<!--
	

-->