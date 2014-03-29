<?php include_once("home.html"); 

include 'includes/connection.php';

$link = pg_connect ($connectString);
if (!$link)
{
	die('Error: Could not connect: ' . pg_last_error());
}

/*$host = 'ec2-54-225-101-199.compute-1.amazonaws.com';
$port = '5432';
$database = 'd7ib8s1h3k247g';
$user = 'wswbacuozevqpy';
$password = 'tqPpoGFbms2xvDLhoVfw2bVHT1';

$connectString = 'host=' . $host . ' port=' . $port . ' dbname=' . $database . 
	' user=' . $user . ' password=' . $password;


$link = pg_connect ($connectString);
if (!$link)
{
	die('Error: Could not connect: ' . pg_last_error());
}*/


$query = 'select * from "TeeShirts" ';

$result = pg_query($link,$query);

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

echo '</table></body></html>';
?>

<h1>List a Teeshirt</h1>
<form action = "create.php" method = "post">
	Color<input type="text" name="inputColor" value="" /><br />
	Size<input type="text" name="inputSize" value="" /><br />
	<br />
	<input type="submit" name="submit">
</form>

<h1>Delete a Teeshirt</h1>
<form action = "delete.php" method = "post">
	Color<input type="text" name="inputColor" value="" /><br />
	<br />
	<input type="submit" name="submit">
</form>



<!--<?php include_once("home.html"); 

$host = 'ec2-54-225-101-199.compute-1.amazonaws.com';
$port = '5432';
$database = 'd7ib8s1h3k247g';
$user = 'wswbacuozevqpy';
$password = 'tqPpoGFbms2xvDLhoVfw2bVHT1';

$connectString = 'host=' . $host . ' port=' . $port . ' dbname=' . $database . 
	' user=' . $user . ' password=' . $password;


$link = pg_connect ($connectString);
if (!$link)
{
	die('Error: Could not connect: ' . pg_last_error());
}
	
	
	$query = 'SELECT * FROM "TeeShirts"';
	
	$result = pg_query($query);
	
	//$str = 'apple';
	//$md5 = md5($str);

	while($color = pg_fetch_array($result)) {
		echo "<h3>" . $color['color'] . "<h3>";
		echo "<p>" 	. $color['size']  . "<p>";
	}
	
	//echo "<h1>" . $md5 . "<h3>"
?>
<h1>List a Teeshirt</h1>
<form action = "create.php" method = "post">
	Color<input type="text" name="inputColor" value="" /><br />
	Size<input type="text" name="inputSize" value="" /><br />
	<br />
	<input type="submit" name="submit">
</form>

<h1>Delete a Teeshirt</h1>
<form action = "delete.php" method = "post">
	Color<input type="text" name="inputColor" value="" /><br />
	<br />
	<input type="submit" name="submit">
</form>



<!--<?php include_once("home.html"); 

	
// make our connection
$connection = pg_connect("host=ec2-54-225-101-199.compute-1.amazonaws.com dbname=d7ib8s1h3k247g user=wswbacuozevqpy password= tqPpoGFbms2xvDLhoVfw2bVHT1");
	
// let me know if the connection fails
if (!$connection) {
    print("Connection Failed.");
    exit;
}

// declare my query and execute
$myresult = pg_exec($connection, "SELECT color FROM TeeShirts WHERE size = 'Medium' ");

// process results
$myvalue = pg_result($myresult);

// print results
print("My Value: $myvalue<br />\n");
?>-->





<!-- <?php
	include "includes/connection.php";
	
	$query = "SELECT * FROM teeshirt";
	
	$result = pg_exec($connection, "SELECT FROM WHERE =1");
	
	//$str = 'apple';
	//$md5 = md5($str);
	
	while($color = mysql_fetch_array($result)) {
		echo "<h3>" . $color['Color'] . "<h3>";
		echo "<p>" 	. $color['Size']  . "<p>";
	}
	
	//echo "<h1>" . $md5 . "<h3>"
?>
<h1>List a Teeshirt</h1>
<form action = "create.php" method = "post">
	Color<input type="text" name="inputColor" value="" /><br />
	Size<input type="text" name="inputSize" value="" /><br />
	<br />
	<input type="submit" name="submit">
</form>

<h1>Delete a Teeshirt</h1>
<form action = "delete.php" method = "post">
	Color<input type="text" name="inputColor" value="" /><br />
	<br />
	<input type="submit" name="submit">
</form> -->

