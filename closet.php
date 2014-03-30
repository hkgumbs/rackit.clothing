<?php
include_once ("closet.html");

include "includes/connection.php";

$user_id = $_SESSION['my_id'];

$query = "SELECT * FROM bundles";

$result = pg_query($query);
if (!$result) {
	echo "Problem with query " . $query . "<br/>";
	echo pg_last_error();
	exit();
}

$result = '';

while ($row = mysql_fetch_array($result)) {

	$result .= '<a class="item" href="listing.html">';
	$result .= '<div class="thumb_container">';
	$result .= '<img class="thumb" src="' . $row['image_id'] . '" alt="image could not be loaded :(">';
	$result .= "<div>";
	if ($row[age_high]) {
		$result .= '<p class="item_description">[' . $row['gender'] . '][' . $row[age_low] . '-' . $row[age_high] . ']</p>';
	} else {
		$result .= '<p class="item_description">[' . $row['gender'] . '][' . $row[age_low] . ']</p>';
	}
	$result .= "</a>";
	$result .= " ";
}

echo'<div class="item_grid" id="mydiv">';


$result .= '<a class="item" href="listing.html">';
$result .= '<div class="thumb_container">';
$result .= '<img class="thumb" src="style/photo_default.png" alt="image could not be loaded :(">';
$result .= '</div>';
$result .= '<p class="item_description">[gender][age]</p>';
$result .= '</a>';

echo $result;


echo '</div>' . " ";


?>


<!--<div class="item_grid" id="mydiv"><?php echo $result; ?></div> -->

