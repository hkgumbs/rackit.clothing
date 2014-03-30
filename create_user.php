<?php

include "includes/connection.php";

$email = $_POST['input_new_email'];
/* $user_name = $_POST['input_name_first']; */
$password = md5($_POST['input_password']);
$password_confirm = md5($_POST['input_password_confirm']);
$street_address = ($_POST['street_address']);
$city = ($_POST['city']);
$state = ($_POST['input_state']);
$zip = ($_POST['input_zip']);

/**** CHECK FOR PASSWORD LENGTH ***/
if (!$_POST['submit']) {
	echo "please fill out all of the form";
	header('Location: create_user.php');
} else if ($password != $password_confirm) {
	echo "passwords don't match";
	header('Location: create_user.php');
} else {
	pg_query("INSERT INTO users_db (email, password, address_street, address_city, address_state, address_zipcode)
					   VALUES('$email','$password', '$street_address', '$city', '$state', '$zip')") or die('Error: ' . pg_last_error());
	echo "User has been added!";
	header('Location: login.php');
}
?>

