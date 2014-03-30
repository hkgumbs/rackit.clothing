<?php


include "includes/connection.php";

$email = $_POST['input_email'];
/* $user_name = $_POST['input_name_first']; */
$password = md5($_POST['input_password']);

echo '<td>' . "HELLLLOOO". '</td>';

/**** CHECK FOR PASSWORD LENGTH ***/
if (!$_POST['submit']) {
	echo "please fill out all of the form";
	header('Location: create_user.php');
} else {
	pg_query("SELECT count(1) FROM users_db WHERE password = '$password'");
	header('Location: login.php');
}
?>

