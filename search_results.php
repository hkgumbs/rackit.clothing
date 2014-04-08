<?php

session_start();
if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
	header("Location: login.php");
}

include_once ("closet.html");
include "includes/connection.php";

$user_id = $_SESSION['my_id'];

$selected_radio = $_POST['gender'];
$age_string = str_replace(" ", "", $_POST['input_age']);
$ages = explode("-", $age_string);

if ($selected_radio == 'male') {
	$query = "SELECT * FROM bundle WHERE gender = 'M'";
} else{
	$query = "SELECT * FROM bundle WHERE gender = 'F'";
}


$result = pg_query($query);
if (!$result) {
	echo "Problem with query " . $query . "<br/>";
	echo pg_last_error();
	exit();
}

echo '<div class="item_grid" id="mydiv">';

$to_echo = '';

while ($row = pg_fetch_assoc($result)) {
	if($row['age_min']<$ages[0] || ($ages[1]!=null && $row['age_min']>$ages[1]) || ($ages[1] != null && $row['age_max'] != null && $row['age_max']>$ages[1])){
		continue;
	}

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

