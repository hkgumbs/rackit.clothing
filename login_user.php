<?php

include "includes/connection.php";

$email = strtolower(htmlspecialchars($_POST['input_email']));
echo $email;
/* $person_name = $_POST['input_name_first']; */
$password = trim(md5(htmlspecialchars($_POST['input_password'])));
echo $password . "<br/>";

if (!$_POST['submit']) {
	echo "please fill out all of the form";
	header('Location: login.php');
} else {
	
	$result = pg_query("SELECT password FROM person WHERE email = '$email'");
	$myperson = pg_fetch_assoc($result);

	if (!$result) {
		echo "E-mail not found" . $query . "<br/>";
		header('Location: login.php');
	} else if ($password != trim($myperson['password'])) {
		session_start();
		$_SESSION['login'] = "";
		header('Location: login.php');
	} else {
		
		session_start();
		$_SESSION['login'] = "1";
		header('Location: closet.php');
	}

}
?>

<!--

-->