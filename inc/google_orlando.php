<?php

require("db_connect.php");

// Start XML file, create parent node

$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);


// Select all the rows in the markers table

$query = "SELECT * FROM markers_orlando WHERE 1";
$result = $mysqli->query($query);
if (!$result) {
  die('Invalid query: ' . $mysqli->error);
}

header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each

while ($row = @mysqli_fetch_assoc($result)){
  // ADD TO XML DOCUMENT NODE
  $node = $dom->createElement("marker");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("user_picture",$row['user_picture']);
  $newnode->setAttribute("name",$row['name']);
  $newnode->setAttribute("tweet", $row['tweet']);
  $newnode->setAttribute("lat", $row['lat']);
  $newnode->setAttribute("lng", $row['lng']);
  $newnode->setAttribute("type", $row['type']);
}

echo $dom->saveXML();

?>