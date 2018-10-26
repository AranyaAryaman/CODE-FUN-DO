<?php
// Gets data from URL parameters.
$lat = $_GET['lat'];
$lng = $_GET['lng'];
$title = $_GET['title'];
$action = $_GET['action'];
// Opens a connection to a MySQL server.
$connection=new mysqli("approdhan.mysql.database.azure.com:3306", "avneet@approdhan", "Enter Your P4SSW0RD Here", "mapdb");
if (mysqli_connect_errno()) {
	die("Not connected : " . mysqli_connect_error());
}
$lat=$connection->real_escape_string($lat);
$lng=$connection->real_escape_string($lng);
$title=$connection->real_escape_string($title);
if(strcmp($action,"add")==0)
$query = sprintf("INSERT INTO markers " .
				" (lat, lng, title, time ) " .
	 			" VALUES (%f, %f, '%s', NOW());",
				round(floatval($lat),6),
				round(floatval($lng),6),
				$title);
else if(strcmp($action,"remove")==0)
$query = sprintf("DELETE FROM markers " .
				"WHERE lat = %f AND lng = %f;",
				round(floatval($lat),6),
				round(floatval($lng),6));
else die('Invalid args: '.$connection->error);
$result = $connection->query($query);
if (!$result) {
	die('Invalid query: '.$connection->error);
}
$connection->close();
?>
