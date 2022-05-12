<?php
// Connect to database
$mysqli = new mysqli("bofuu3qpmnf3esgbplbn-mysql.services.clever-cloud.com","unrfazw50hmazg3l","pQid24GhE0IHOZW5rhcu","bofuu3qpmnf3esgbplbn");
if ($mysqli -> connect_error) {
echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
exit();
}
include('getapi.php');
// Execute SQL query
$sql = "SELECT *
FROM weather
WHERE city = '{$_GET['city']}'
AND weather_datetimes >= DATE_SUB(NOW(), INTERVAL 10 HOUR)
ORDER BY weather_datetimes DESC limit 1";
$result = $mysqli -> query($sql);


$result = $mysqli -> query($sql);
// Get data, convert to JSON and print
$row = $result -> fetch_assoc();
print json_encode($row);
// Free result set and close connection
$result -> free_result();
$mysqli -> close();
?>