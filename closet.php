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

while ($row = mysql_fetch_array($result)) {
	
	
	$result = '';
	$result .= '<a class="item" href="listing.html">';
	$result .= '<div class="thumb_container">';
	$result .= '<img class="thumb" src="bundle_images/' . $row['image_id'] . '" alt="image could not be loaded :(">';
	$result .= "<div>";
	$result .= '<p class="item_description">[' . $row['gender'] . '][' . $row[age_range] . ']</p>';
	$result .= "</a>";
	$result .= " ";
	
	echo $result;
}


echo '</div>' . " ";

$query = "SELECT * FROM bundles";

$result = pg_query($query);
if (!$result) {
	echo "Problem with query " . $query . "<br/>";
	echo pg_last_error();
	exit();
}


$i = 0;
echo '<html><br /><br /><br /><br /><br /><br /><body><table><tr>';
while ($i < pg_num_fields($result))
{
	$fieldName = pg_field_name($result, $i);
	echo '<td>' . $fieldName . '</td>';
	$i = $i + 1;
}
echo '</tr>';
$i = 0;

while ($row = pg_fetch_row($result)) 
{
	echo '<tr>';
	$count = count($row);
	$y = 0;
	while ($y < $count)
	{
		$c_row = current($row);
		echo '<td>' . $c_row . '</td>';
		next($row);
		$y = $y + 1;
	}
	echo '</tr>';
	$i = $i + 1;
}
pg_free_result($result);


?>


<!--<div class="item_grid" id="mydiv"><?php echo $result; ?></div> -->

