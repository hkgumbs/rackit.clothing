<?php

include "includes/connection.php";

$email = strtolower($_POST['input_email']);
echo $email;
/* $user_name = $_POST['input_name_first']; */
$password = md5($_POST['input_password']);
echo $_POST['input_password']; "<br/>";


$result = pg_query("SELECT password FROM users_db WHERE email = '$email'");
echo pg_fetch_row($result);

$i = 0;

while ($row = pg_fetch_row($result)) 
{
	echo '<tr>';
	$count = count($row);
	$y = 0;
	while ($y < $count)
	{
		$c_row = current($row);
		echo '<td>' . $c_row . '</td>';
		next($row);
		$y = $y + 1;
	}
	echo '</tr>';
	$i = $i + 1;
}
pg_free_result($result);


?>

<!--
	if (!$_POST['submit']) {
	echo "please fill out all of the form";
	header('Location: login.php');
} else {

	$result = pg_query("SELECT password FROM users_db WHERE email = '$email'");


	if (!$result) {
		echo '<td>' . pg_fetch_row($result) . '</td>';
		echo "E-mail not found" . $query . "<br/>";
		/*header('Location: login.php');*/
	} else if ($password != pg_fetch_row($result)) {
		echo "Incorrect Password" . $query . "<br/>";
		echo '<td>' . pg_fetch_row($result) . '</td>';
		/*header('Location: login.php');*/
	} else {
		/* go to listings page */
		/*header('Location: index.php');*/

		echo "All GOOD!!" . $query . "<br/>";
	}

}

-->