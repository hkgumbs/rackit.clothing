<?php

session_start();
if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
	header ("Location: login.php");
}
include "includes/connection.php";

$person_id = $_SESSION['my_id'];

$bundle_id = $_GET['id'];

pg_query("INSERT INTO person_bundle (bundle_id, racker_id)
					VALUES ('$bundle_id', '$person_id')") or die('Error: ' . pg_last_error());



?>