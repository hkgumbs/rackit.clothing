<?php

session_start();
if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
	header ("Location: login.php");
}


include_once ("listing.html");

include "includes/connection.php";

$person_id = $_SESSION['user_id'];

$bundle_id = $_GET['id'];

$racked_count = 0;

$num_result = pg_query("SELECT * FROM person_bundle WHERE bundle_id = '$bundle_id'");
if (!$num_result) {
	echo "Problem with query " . $query . "<br/>";
	echo pg_last_error();
	exit();
}

while ($row = pg_fetch_assoc($num_result)){
	if($row['racker_id'] = $person_id){
		header('Location: racked_listing.php?id='.$bundle_id.'');
	}	
	$racked_count++;
}

$result = pg_query("SELECT * FROM bundle WHERE bundle_id = '$bundle_id'");
if (!$result) {
	echo "Problem with query " . $query . "<br/>";
	echo pg_last_error();
	exit();
}

$mybundle = pg_fetch_assoc($result);

echo '<div class="modal">';
echo '<div class= "modal_container">';
echo '<h1 class="modal_title">' . $mybundle['gender']. ', Age ' . $mybundle['age_range'] . '</h1>';
echo '<div class="full_container">';
echo '<img class="full" src="./bundle_images/' . $mybundle['image_id'] . '" alt="image could not be loaded :(">';
echo '</div>';
echo '<div class="distance_time">';
echo '<h2 class="distance">2.4 miles away</h2>';
echo '<h3 class="time">6 minutes</h3>';
echo '</div>';
echo '<div class="button_container">';
echo ' <a class="button" id="rackit" href="rackit.php?id='.$bundle_id.'" id="'.$bundle_id.'">RackIt</a>';
echo '</div>';
/** put count into bundle tbale instead**/
echo '<p>'.$racked_count.' others have Racked it.</p>';
echo '</div>';
echo '</div>';


?>