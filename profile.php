<?php

session_start();
if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
	header("Location: login.php");
}

include_once ("profile.html");

include "includes/connection.php";

$user_id = $_SESSION['my_id'];

/***** Displaying Posted *****/

$query = "SELECT * FROM bundle WHERE poster_id = '$user_id'";

$result = pg_query($query);
if (!$result) {
	echo "Problem with query " . $query . "<br/>";
	echo pg_last_error();
	exit();
}

echo '<div class="item_grid" id="listed_grid">';
echo '<h1>Listed</h1>';

$to_echo = '';

while ($row = pg_fetch_assoc($result)) {

	$to_echo .= '<a class="item" href="listing.php?id=' . $row['bundle_id'] . '" id="' . $row['bundle_id'] . '">';
	$to_echo .= '<div class="thumb_container">';
	$to_echo .= '<img class="thumb" src="./bundle_images/' . $row['image_id'] . '" alt="image could not be loaded :(">';
	$to_echo .= "<div>";

	/** Gender **/
	$to_echo .= '<p class="item_description">';
	if ($row['age_min'] < 8) {
		if ($row['gender'] == 'M') {
			$to_echo .= 'Boys';
		} else {
			$to_echo .= 'Girls';
		}
	} else {
		if ($row['gender'] == 'M') {
			$to_echo .= 'Mens';
		} else {
			$to_echo .= 'Womens';
		}
	}
	/** Age **/
	if ($row['age_max'] == null) {
		$to_echo .= ', Age ' . $row['age_min'] . '</p>';
	} else {
		$to_echo .= ', Ages ' . $row['age_min'] . '-' . $row['age_max'] . '</p>';
	}

	$to_echo .= "</div>";
	$to_echo .= "</div>";
	$to_echo .= "</a>";
	$to_echo .= " ";

}
echo $to_echo;

echo '</div> ';

/***** Displaying Racked *****/

$query = "SELECT * FROM person_bundle WHERE person_id = '$user_id'";

$result = pg_query($query);
if (!$result) {
	echo "Problem with query " . $query . "<br/>";
	echo pg_last_error();
	exit();
}

echo '<div class="item_grid" id="listed_grid">';
echo '<h1>Listed</h1>';

$to_echo = '';

while ($bundle = pg_fetch_assoc($result)) {

	$curr_bundle_id = $bundle['bundle_id'];
	$bundle_query = "SELECT * FROM bundle WHERE bundle_id = '$curr_bundle_id'";

	$bundle_result = pg_query($query);
	if (!$result) {
		echo "Problem with query " . $query . "<br/>";
		echo pg_last_error();
		exit();
	}
	$row = pg_fetch_assoc($bundle_result);

	$to_echo .= '<a class="item" href="listing.php?id=' . $row['bundle_id'] . '" id="' . $row['bundle_id'] . '">';
	$to_echo .= '<div class="thumb_container">';
	$to_echo .= '<img class="thumb" src="./bundle_images/' . $row['image_id'] . '" alt="image could not be loaded :(">';
	$to_echo .= "<div>";

	/** Gender **/
	$to_echo .= '<p class="item_description">';
	if ($row['age_min'] < 8) {
		if ($row['gender'] == 'M') {
			$to_echo .= 'Boys';
		} else {
			$to_echo .= 'Girls';
		}
	} else {
		if ($row['gender'] == 'M') {
			$to_echo .= 'Mens';
		} else {
			$to_echo .= 'Womens';
		}
	}
	/** Age **/
	if ($row['age_max'] == null) {
		$to_echo .= ', Age ' . $row['age_min'] . '</p>';
	} else {
		$to_echo .= ', Ages ' . $row['age_min'] . '-' . $row['age_max'] . '</p>';
	}

	$to_echo .= "</div>";
	$to_echo .= "</div>";
	$to_echo .= "</a>";
	$to_echo .= " ";

}
echo $to_echo;

echo '</div> ';
?>
