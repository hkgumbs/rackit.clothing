<?php
include_once ("home.html");

include "includes/connection.php";

$query = "SELECT * FROM users_db";

$result = pg_query($query);
if (!$result) {
	echo "Problem with query " . $query . "<br/>";
	echo pg_last_error();
	exit();
}


$i = 0;
echo '<html><br /><br /><br /><br /><br /><br /><body><table><tr>';
while ($i < pg_num_fields($result))
{
	$fieldName = pg_field_name($result, $i);
	echo '<td>' . $fieldName . '</td>';
	$i = $i + 1;
}
echo '</tr>';
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

<h1>Create Account</h1>
<form action = "create.php" method = "post">
	E-mail
	<input type="text" name="input_email" value="" />
	<br />
	Password
	<input type="text" name="password" value="" />
	<br />
	<br />
	<input type="submit" name="submit">
</form>

<h1>Delete Account</h1>
<form action = "delete.php" method = "post">
	E-mail
	<input type="text" name="input_email" value="" />
	<br />
	<br />
	<input type="submit" name="submit">
</form>

<!-- $i = 0;
echo '<html><br /><br /><br /><br /><br /><br /><body><table><tr>';
while ($i < pg_num_fields($result)) {
	$fieldName = pg_field_name($result, $i);
	echo '<td>' . $fieldName . '</td>';
	$i = $i + 1;
}
echo '</tr>';
$i = 0;

while ($row = pg_fetch_row($result)) {
	echo '<tr>';
	$count = count($row);
	$y = 0;
	while ($y < $count) {
		$c_row = current($row);
		echo '<td>' . $c_row . '</td>';
		next($row);
		$y = $y + 1;
	}
	echo '</tr>';
	$i = $i + 1;
}
pg_free_result($result);

echo '</table></body></html>'; -->
