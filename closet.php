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

echo'<div class="item_grid" id="mydiv">';

while ($row = mysql_fetch_assoc($result)) {
	
	
	$result = '';
	$result .= '<a class="item" href="listing.html">';
	$result .= '<div class="thumb_container">';
	$result .= '<img class="thumb" src="bundle_images/' . $row['image_id'] . '" alt="image could not be loaded :(">';
	$result .= "<div>";
	$result .= '<p class="item_description">[' . $row['gender'] . '][' . $row[age_rang] . ']</p>';
	$result .= "</a>";
	$result .= " ";
	
	echo $result;
}

echo '</div> ';


?>


<!--<div class="item_grid" id="mydiv"><?php echo $result; ?></div> -->

