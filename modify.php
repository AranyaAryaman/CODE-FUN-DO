<?php
// Gets data from URL parameters.
$lat = $_GET['lat'];
$lng = $_GET['lng'];
$title = $_GET['title'];

// Opens a connection to a MySQL server.
$connection=new mysqli("url", "username", "password", "database");
if (mysqli_connect_errno()) {
  die("Not connected : " . mysqli_connect_error());
}
// Inserts new row with place data.
$query = sprintf("INSERT INTO markers " .
         " (lat, lng, title, time ) " .
         " VALUES (%s, %s, '%s', NOW());",
          $connection->real_escape_string($lat),
          $connection->real_escape_string($lng),
          $connection->real_escape_string($title));
if (!($result = $connection->query($query))) {
  die('Invalid query: '.$connection->error);
}

?>
