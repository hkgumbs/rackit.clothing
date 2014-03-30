<?php
include_once ("listing.html");

include "includes/connection.php";

$user_id = $_SESSION['my_id'];

$id = $_GET['id'];

$result = pg_query("SELECT password FROM bundles WHERE bundle_id = '$id'");

$result = pg_query($query);

$mybundle = pg_fetch_assoc($result);

echo '<div class="modal">';
echo '<div class= "modal_container">';
echo '<h1 class="modal_title">' . $mybundle['gender']. ', Age' . $mybundle['gender'] . '</h1>';
echo '<div class="full_container">';
echo '<img class="full" src="./bundle_images/' . $mybundle['image_id'] . '" alt="image could not be loaded :(">';
echo '</div>';
echo '<div class="distance_time">';
echo '<h2 class="distance">2.4 miles away</h2>';
echo '<h3 class="time">6 minutes</h3>';
echo '</div>';
echo '<div class="button_container">';
echo ' <a class="button" id="rackit" >RackIt</a>';
echo '</div>';
echo '<p>2 others have Racked it.</p>';
echo '</div>';
echo '</div>';
?>