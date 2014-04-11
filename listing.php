<?php

session_start();
if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
	header ("Location: login.php");
}


include_once ("listing.html");

include "includes/connection.php";

$person_id = $_SESSION['user_id'];

$bundle_id = $_GET['id'];

/********************************* Getting Num Racked **************************/
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

/** Description **/
$to_echo = '';
/** Gender **/
	$to_echo .= '<h1 class="modal_title">';
	if($mybundle['age_min'] < 8){
		if($mybundle['gender'] == 'M'){
			$to_echo .= 'Boys';
		} else {
			$to_echo .= 'Girls';
		}
	} else{
		if($mybundle['gender'] == 'M'){
			$to_echo .= 'Mens';
		} else {
			$to_echo .= 'Womens';
		}
	}
	/** Age **/
	if($mybundle['age_max'] == null){
		$to_echo .= ', Age ' . $mybundle['age_min'] . '</h1>';
	} else{
		$to_echo .= ', Ages ' . $mybundle['age_min'] . '-' . $mybundle['age_max'] . '</h1>';
	}	

echo $to_echo;

echo '<div class="full_container">';
echo '<img class="full" src="./bundle_images/' . $mybundle['image_id'] . '" alt="image could not be loaded :(">';
echo '</div>';
echo '<div class="distance_time">';

echo '</div>';
echo '<div class="button_container">';
echo ' <a class="button" id="rackit" href="rackit.php?id='.$bundle_id.'" id="'.$bundle_id.'">RackIt</a>';
echo '</div>';
/** put count into bundle tbale instead**/
echo '<p>'.$racked_count.' others have Racked it.</p>';
echo '</div>';
echo '</div>';


?>