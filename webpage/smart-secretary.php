<?php
// Author: Hyunjoon Lim
// Title: Weather Crawler from openweathermap.org
// Date: May-06-2018
//
// Description: This webpage is to display weather and user schedule
// The below statements do not make a PHP debug message to show parse errors.
// In case of PHP7/Ubuntu 16.04, the only way to show those errors is to
// modify "/etc/php/7.0/apache2/php.ini" file with "display_errors = On"
error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
?>
<html lang="ko">
<title>Smart Secretary</title>
<head>
<meta charset="UTF-8">
<meta http-equiv="refresh" content="60">

<style>
/* Container holding the image and the text */
.container {
    position: relative;
    text-align: center;
    color: blue;
}

/* Bottom left text */
.bottom-left {
    position: absolute;
    bottom: 8px;
    left: 16px;
}

/* Top left text */
.top-left {
    position: absolute;
    top: 8px;
    left: 16px;
}

/* Top right text */
.top-right {
    position: absolute;
    top: 8px;
    right: 16px;
}

/* Bottom right text */
.bottom-right {
    position: absolute;
    bottom: 8px;
    right: 16px;
}

/* Centered text */
.centered {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
</style>
</head>

<body bgcolor=white>

<?php

// ---------- Configuration-----------------------------------------------------------
$city_name="Seoul";
$app_id_key="f53e9bb210db8d3957b2dba44dd7f55c";


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
?>

<b> <center> <font color=blue> Smart Secretary </font></center></b>
<table border=0>
<tr width=100%>
<!-- 1st column table //-->
<td width=300>

<table border=0>
<tr>
<td>
<div class=container>
<a href="https://calendar.google.com/calendar/embed?src=ls0vdmel6gu1olrkrv3mlbpgh0%40group.calendar.google.com&ctz=Asia%2FSeoul" target="myframe">
<img src=./image/people.png width=60 height=60 alt=user1 /></a>
<div class=bottom-left>&nbsp;&nbsp;&nbsp;<b>1</b></div>
</div>
</td>

<td>
<div class=container>
<a href="https://calendar.google.com/calendar/embed?src=f78l3l60epju4ocul483fkp4nc%40group.calendar.google.com&ctz=Asia%2FSeoul" target="myframe">
<img src=./image/people.png width=60 height=60 alt=user2 /></a>
<div class=bottom-left>&nbsp;&nbsp;&nbsp;<b>2</b></div>
</div>
</td>

<td>
<div class=container>
<a href="https://calendar.google.com/calendar/embed?src=t89qfg8kbbbj6vrofhggd5df1s%40group.calendar.google.com&ctz=Asia%2FSeoul" target="myframe">
<img src=./image/people.png width=60 height=60 alt=user3 /></a>
<div class=bottom-left>&nbsp;&nbsp;&nbsp;<b>3</b></div>
</div>
</td>
</tr>
</table>

</td>

<?php
// 2nd column table
echo "<td width=200>";
//display more good icons instead of icons of openweathermap.org
// https://github.com/erikflowers/weather-icons
if ($weather_text == "Haze")
    echo "<img width=150 height=100 src='./svg/wi-day-haze.svg'/>";
else if($weather_text =="Rain" || $weather_text == "Light rain")
    echo "<img width=150 height=100 src='./image/umbrella.gif'/>";

else if($weather_text == "Wind")
    echo "<img width=150 height=100 src='./svg/wi-day-windy.svg'/>";
else
    echo "<img width=150 height=100 src='http://openweathermap.org/img/w/" . $weather_icon ."'/ >";

if($weather_text =="Rain" || $weather_text == "Light rain")
    echo "<center>Current: <b><font color=red>" . $weather_text . "</font></b></center><br>";
else
    echo "<center>Current: <b><font color=black>" . $weather_text . "</font></b></center><br>";

echo "</td>";

//3rd column table

echo "<td align = left>";
echo "City: " . $cityname . "<br>";
echo "Time: " .$today . "<br>";
echo "Temp Max: " . $temp_max ."&deg;C<br>";
echo "Temp Min: " . $temp_min ."&deg;C<br>";
echo "</td>";
echo "</tr>";
echo "</table>";
echo "</td>";
?>

<iframe name="myframe" src="./schedule.php"  style="width:95%; height: 60% ; background: #FFFFFF;"></iframe>

</body>
</html>
