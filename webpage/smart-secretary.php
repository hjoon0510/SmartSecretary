<html lang="ko">
<title>Smart Secretary</title>
<head>
<meta charset="UTF-8">
<meta http-equiv="refresh" content="60">
</head>

<body bgcolor=white>

<?php
// Author: Hyunjoon Lim
// Title: Weather Crawler from openweathermap.org
// Date: May-06-2018
// Description: This webpage is to display weather and user schedule

// My configuration
$city_name="Seoul";
$app_id_key="ef6c6db0a20159abbbfe878e24dd8541";


// ---------- Do not modify from now on ----------------------------------------------
$url = "http://api.openweathermap.org/data/2.5/weather?q=$city_name&APPID=$app_id_key";

// Use json format to get the weather information
$contents = file_get_contents($url);
$climate=json_decode($contents);

// Get Temperature, Weather, and city name
$balance = 273.15;
// Not that we have to subtrace 273.15
// because temperature is kelvin by default.
$temp_max=$climate->main->temp_max - $balance;
$temp_min=$climate->main->temp_min - $balance;
$weather_text=$climate->weather[0]->main;
$weather_icon=$climate->weather[0]->icon.".png";
//how get today date time PHP :P
$today = date("F j, Y, g:i a");
$cityname = $climate->name;

echo "<b> <center> Smart Secretary </center></b>";
echo "<table border=0>";
echo "<tr width=100%>";

echo "<td width=640>";
echo "City: " . $cityname . "<br>";
echo "Time: " .$today . "<br>";
echo "Temp Max: " . $temp_max ."&deg;C<br>";
echo "Temp Min: " . $temp_min ."&deg;C<br>";
echo "</td>";
echo "<td align=right>";

// display more good icons instead of icons of openweathermap.org
// https://github.com/erikflowers/weather-icons
//echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
if ($weather_text == "Haze")
    echo "<img src='./svg/wi-day-haze.svg'/>";

else if($weather_text =="Rain")
    echo "<img src='./svg/wi-rain.svg'/>";

else if($weather_text == "Light rain")
    echo "<img src='./svg/wi-day-rain.svg'/>";

else if($weather_text == "Wind")
    echo "<img src='./svg/wi-day-windy.svg'/>";
else
    echo "<img src='http://openweathermap.org/img/w/" . $weather_icon ."'/ >";

echo "<br>";
echo "Current: <b><font color=red>" . $weather_text . "</font></b><br>";
echo "</td>";

echo "</tr>";
echo "</table>";

?>


<a href="https://calendar.google.com/calendar/embed?src=ls0vdmel6gu1olrkrv3mlbpgh0%40group.calendar.google.com&ctz=Asia%2FSeoul" target="myframe">user1</a>
<a href="https://calendar.google.com/calendar/embed?src=f78l3l60epju4ocul483fkp4nc%40group.calendar.google.com&ctz=Asia%2FSeoul" target="myframe">user2</a>
<a href="https://calendar.google.com/calendar/embed?src=t89qfg8kbbbj6vrofhggd5df1s%40group.calendar.google.com&ctz=Asia%2FSeoul" target="myframe">user3</a>
<iframe name="myframe" src="./schedule.php"  style="width:95%; height: 60% ; background: #FFFFFF;"></iframe>

</body>
</html>
