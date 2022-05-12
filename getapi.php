<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
// Select weather data for given parameters
$sql = "SELECT *
FROM weather
WHERE city = '{$_GET['city']}'
AND weather_datetimes >= DATE_SUB(NOW(), INTERVAL 10 HOUR)
ORDER BY weather_datetimes DESC limit 1";
$result = $mysqli -> query($sql);
// If 0 record found
if ($result->num_rows == 0) {
$url = 'https://api.openweathermap.org/data/2.5/weather?q='.$_GET['city'].'&appid=6a00de52d2f9cb1e8999cf77f597a89a&units=metric';
// Get data from openweathermap and store in JSON object
$data = file_get_contents($url);
$json = json_decode($data, true);
// Fetch required fields
$weather_condition = $json['weather'][0]['description'];
$temperature = $json['main']['temp'];
$wind_speed = $json['wind']['speed'];
$weather_datetimes = date("Y-m-d H:i:s"); // now
$city = $json['name'];
$humidity=$json['main']['humidity'];
$pressure = $json['main']['pressure'];

// Build INSERT SQL statement
$sql = "INSERT INTO  weather (weather_condition, temperature, wind_speed, weather_datetimes, city, humidity, pressure)
VALUES('{$weather_condition}', '{$temperature}', '{$wind_speed}', '{$weather_datetimes}', '{$city}', '{$humidity}', '{$pressure}')";
// Run SQL statement and report errors
if (!$mysqli -> query($sql)) {
echo("<h4>SQL error description: " . $mysqli -> error . "</h4>");
}
}
?>