<html lang="ko">
<title>Smart Secretary</title>
<head>
<meta charset="UTF-8">
</head>

<body bgcolor=white>

<?php
// Author: Hyunjoon Lim
// Title: Weather Crawler from openweathermap.org
// Date: May-06-2018
// Description: This webpage is to display weather and user schedule

// My configuration
$city_name="Seoul";
$app_id="ef6c6db0a20159abbbfe878e24dd8541";


// ---------- Do not modify from now on ----------------------------------------------
$url = "http://api.openweathermap.org/data/2.5/weather?q=$city_name&APPID=$app_id";

// Use json format to get the weather information
$contents = file_get_contents($url);
$climate=json_decode($contents);

// Get Temperature, Weather, and city name
$temp_max=$climate->main->temp_max;
$temp_min=$climate->main->temp_min;
$weather_text=$climate->weather[0]->main;
$weather_icon=$climate->weather[0]->icon.".png";
//how get today date time PHP :P
$today = date("F j, Y, g:i a");
$cityname = $climate->name;

echo "City Name: " . $cityname . "<br>";
echo "Time: " .$today . "<br>";
echo "Temp Max: " . $temp_max ."&deg;C<br>";
echo "Temp Min: " . $temp_min ."&deg;C<br>";
echo "Current: " . $weather_text . "<br>";
echo "<br>";
echo "<img src='http://openweathermap.org/img/w/" . $weather_icon ."'/ >";

?>

<h2>
<a href="https://hjoon0510.github.io/user1/" target="myframe">user1</a>
<a href="https://hjoon0510.github.io/user2/" target="myframe">user2</a>
<a href="https://hjoon0510.github.io/user3/" target="myframe">user3</a>
</h2>
<br>

<iframe name="myframe" style="width:50%; height: 330px ; background: #FFFFFF;"></iframe>

</body>
</html>
