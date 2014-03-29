<?php

$host = 'ec2-54-197-250-52.compute-1.amazonaws.com';
$port = '5432';
$database = 'd9vfikchth34i3';
$user = 'xwzwzygfxaymeb';
$password = 'PKBe8L60kc5ESY-xD_vBut3Z_N';

$connectString = "host='$host' port='$port' dbname='$database' user='$user' password='$password'";

$link = pg_connect ($connectString);
if (!$link)
{
	die('Error: Could not connect: ' . pg_last_error());
}


//mysql_select_db($db);
?>



