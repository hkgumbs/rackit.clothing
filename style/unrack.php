<?php

session_start();
if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
	header ("Location: login.php");
}
include "includes/connection.php";

$person_id = $_SESSION['user_id'];

$bundle_id = $_GET['id'];

pg_query("DELETE FROM person_bundle WHERE bundle_id = '$bundle_id' AND racker_id = '$person_id'") or die('Error: ' . pg_last_error());
					
					
					
/** SHOULD INCREMENT NUM_RACKED HERE **/





/** Should change to rackings page **/
header('Location: racked_listing.php?id='.$bundle_id.'');

?>