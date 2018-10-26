<?php 
header("Content-type: text/xml");
// Start XML file, create parent node
$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);
// Opens a connection to a mySQL server
$connection=new mysqli("url", "username", "password", "database");
if (mysqli_connect_errno()) {
  die("Not connected : " . mysqli_connect_error());
}
// Search the rows in the markers table
// Iterate through the rows, adding XML nodes for each
if ($result = $connection->query("SELECT lat, lng, title FROM markers;")) {
  while ($row = $result->fetch_row()) {
    $node = $dom->createElement("marker");
    $newnode = $parnode->appendChild($node);
    $newnode->setAttribute("lat", $row[0]);
    $newnode->setAttribute("lng", $row[1]);
    $newnode->setAttribute("title", $row[2]);
  }
  $result->close();
}
else die("A horrible death. Query has Problem.");
$connection->close();
echo $dom->saveXML();
?>
