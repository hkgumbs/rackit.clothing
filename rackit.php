<?php

session_start();
if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
	header ("Location: login.php");
}
include "includes/connection.php";

$person_id = $_SESSION['user_id'];

$bundle_id = $_GET['id'];

pg_query("INSERT INTO person_bundle (bundle_id, racker_id)
					VALUES ($bundle_id, $person_id)") or die('Error: ' . pg_last_error());
					
					
					

/** SHOULD INCREMENT NUM_RACKED HERE **/





/** Should change to rackings page **/
header('Location: racked_listing.php');

?>