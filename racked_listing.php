<?php

session_start();
if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
	header ("Location: login.php");
}

include_once ("listing.html");

include "includes/connection.php";

$user_id = $_SESSION['user_id'];

$bundle_id = $_GET['id'];

/** Gettting User Address **/
$person_result = pg_query("SELECT * FROM person WHERE person_id = '$user_id'");
if (!$person_result) {
	echo "Problem with query " . $query . "<br/>";
	echo pg_last_error();
	exit();
}

$myperson = pg_fetch_assoc($person_result);
$person_address = $myperson['address_street'] . ' ' . $myperson['address_city'] . ' ' . $myperson['address_state'] . ' ' . $myperson['address_zipcode'];

/** Getting Bundle Infor (Including Poster ID **/
$result = pg_query("SELECT * FROM bundle WHERE bundle_id = '$bundle_id'");
if (!$result) {
	echo "Problem with query " . $query . "<br/>";
	echo pg_last_error();
	exit();
}

$mybundle = pg_fetch_assoc($result);

/** Getting Poster Address **/
$poster_id = $mybundle['poster_id'];
$poster_result = pg_query("SELECT * FROM person WHERE person_id = '$poster_id'");
if (!$poster_result) {
	echo "Problem with query " . $query . "<br/>";
	echo pg_last_error();
	exit();
}

$myposter = pg_fetch_assoc($poster_result);
$poster_address = $myposter['address_street'] . ' ' . $myposter['address_city'] . ' ' . $myposter['address_state'] . ' ' . $myposter['address_zipcode'];

/** Echoing everything **/
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

echo '<form action="http://maps.google.com/maps" method="get" target="_blank">';
echo '<input type="hidden" name="saddr" value="'.$person_address.'" />';
echo '<input type="hidden" name="daddr" value="'.$poster_address.'" />';
echo '<input class="button" type="submit" id="login" name="submit" value="Get Directions" />	';					
echo '</form>';

echo '</div>';
echo '<p>2 others have Racked it.</p>';
echo '</div>';
echo '</div>';


?>