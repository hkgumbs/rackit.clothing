<?php

include "includes/connection.php";
include "include/sendgrid-php/sendgrid-php.php";

/* Make all emails lowercase so they compare alright */
/* eg DAVID@gmail.com should = david@gmail.com */
$email = strtolower(htmlspecialchars($_POST['input_new_email']));
/* $person_name = $_POST['input_name_first']; */
$password = trim(htmlspecialchars($_POST['input_password']));
$pLength = strlen($password);
$password = md5($password);
$password_confirm = trim(md5($_POST['input_password_confirm']));
$street_address = $_POST['input_street_address'];
$city = $_POST['input_city'];
$state = $_POST['input_state'];
$zip = $_POST['input_zip'];

/*
 $sendgrid = new SendGrid('davidlim14', 'doublehappiness14');
 $email    = new SendGrid\Email();
 $email->addTo($email)->
 setFrom('rackit@gmail.com')->
 setSubject('Account Confirmation!')->
 setHtml('<strong>Welcome! Please confirm your email by clicking the link below</strong><p><a href="http://rackit.clothing/verify.php?email=' . urlencode($email) . '&v=' . md5("yay" . $email) . '"></a></p>');

 $sendgrid->send($email);*/



if ($pLength >= 6 && $pLength <= 16) {
	$errorMessage = "";
} else {
	$errorMessage = $errorMessage . "Password must be between 6 and 16 characters" . "<BR>";
}

if (!$_POST['submit']) {
	echo "please fill out all of the form";
	header('Location: signup.php');
} else if ($password != $password_confirm) {
	echo "passwords don't match";
	header('Location: signup.php');
} else {
	pg_query("INSERT INTO person (email, password, address_street, address_city, address_state, address_zipcode)
					VALUES ('$email', '$password', '$street_address', '$city', '$state', '$zip')") or die('Error: ' . pg_last_error());

	echo "person has been added!";

	session_start();
	$_SESSION['login'] = "1";
	header('Location: help.html');
}
?>

