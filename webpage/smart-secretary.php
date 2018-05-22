<?php
// Author: Hyunjoon Lim
// Title: Weather Crawler from openweathermap.org
// Date: May-06-2018
//
// Description: This webpage is to display weather and user schedule
// The below statements do not make a PHP debug message to show parse errors.
// In case of PHP7/Ubuntu 16.04, the only way to show those errors is to

// Modify "/etc/php/7.0/apache2/php.ini" file with "display_errors = On" for debugging.
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
$receiver_email="hjoon0510@gmail.com";

// ---------- Do not modify from now on ----------------------------------------------
$url = "http://api.openweathermap.org/data/2.5/weather?q=$city_name&APPID=$app_id_key";

// Specify weather conditions to send email in case of below situation.
// -----[ Weather Condition Table] -------------------------
// 1 = rain
// 2 = temperature cold (< 05)
// 3 = temperature vhot  (> 28)
// 4 = dust
// ---------------------------------------------------------

// TODO: This line is bug. The default value ia 0. we have create a file (e.g. rain_prev.txt)
$w_rain_prev=999;
$w_rain_curr=999;
$w_cold_prev=999;
$w_cold_curr=999;
$w_vhot_prev=999;
$w_vhot_curr=999;
$w_dust_prev=999;
$w_dust_curr=999;

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
$cityname = $climate->name;

// set the default timezone to use. Available since PHP 5.1
// how get currentdate time
date_default_timezone_set('Asia/Seoul');
$today = date("F-j-Y g:i A");

if ($weather_text == "Rain"){
    $w_rain_curr=1;
}
else if ($temp_min < 5){
    $w_cold_curr=2;
    $W_vhot_curr=0;
}
else if ($temp_max > 28){
    $w_vhot_curr=3;
    $w_cold_curr=0;
}
// TODO: We hav to get dust value from https://www.data.go.kr/dataset/15000581/openapi.do
else if (9999){
    $w_dust_curr=4;
}
else{
    $w_vhot_curr=0;
    $w_cold_curr=0;
    echo "[DEBUG] There are not any weather conditions.";
}
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
<a href="https://calendar.google.com/calendar/embed?mode=AGENDA&amp;height=600&amp;wkst=2&amp;hl=ko&amp;bgcolor=%23FFFFFF&amp;src=ls0vdmel6gu1olrkrv3mlbpgh0%40group.calendar.google.com&amp;color=%232952A3&amp;ctz=Asia%2FSeoul" target="myframe">
<img src=./image/people.png width=60 height=60 alt=user1 /></a>
<div class=bottom-left>&nbsp;&nbsp;&nbsp;<b>1</b></div>
</div>
</td>

<td>
<div class=container>
<a href="https://calendar.google.com/calendar/embed?mode=AGENDA&amp;height=600&amp;wkst=2&amp;hl=ko&amp;bgcolor=%23FFFFFF&amp;src=f78l3l60epju4ocul483fkp4nc%40group.calendar.google.com&amp;color=%23AB8B00&amp;ctz=Asia%2FSeoul"target="myframe">
<img src=./image/people.png width=60 height=60 alt=user2 /></a>
<div class=bottom-left>&nbsp;&nbsp;&nbsp;<b>2</b></div>
</div>
</td>

<td>
<div class=container>
<a href="https://calendar.google.com/calendar/embed?mode=AGENDA&amp;height=600&amp;wkst=2&amp;hl=ko&amp;bgcolor=%23FFFFFF&amp;src=t89qfg8kbbbj6vrofhggd5df1s%40group.calendar.google.com&amp;color=%23B1440E&amp;ctz=Asia%2FSeoul" target="myframe">
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
if ($weather_text == "Haze"){
    echo "<img width=150 height=100 src='./svg/wi-day-haze.svg'/>";
    $w_rain_prev = 0;
}
else if($weather_text =="Rain" || $weather_text == "Light rain"){
    echo "<img width=150 height=100 src='./image/umbrella.gif'/>";
    if ($w_rain_prev == 0 && $w_rain_curr == 1){
        // TODO: we have to improve execution speed of ssmtp command
        // I uploaded hint file (jpeg) into my dropbox
        system("/usr/sbin/ssmtp $receiver_email < ./data/msg_rain.txt");
    }
   $w_rain_prev = 1;
}

else if($weather_text == "Mist"){
    echo "<img width=150 height=100 src='./svg/wi-night-fog.svg'/>";
    $w_rain_prev = 0;
}
else if($weather_text == "Clear"){
    echo "<img width=150 height=100 src='./svg/wi-night-clear.svg'/>";
    $w_rain_prev = 0;
}
else if($weather_text == "Wind"){
    echo "<img width=150 height=100 src='./svg/wi-day-windy.svg'/>";
    $w_rain_prev = 0;
}
else{
    echo "<img width=150 height=100 src='http://openweathermap.org/img/w/" . $weather_icon ."'/ >";
    $w_rain_prev = 0;
}

// Display current weather.
// And save current weather into ./data/current.txt file for pir sensor
if($weather_text =="Rain" || $weather_text == "Light rain"){
    echo "<center>Current: <b><font color=red>" . $weather_text . "</font></b></center><br>";
    system("echo 'Rain' > ./data/current.txt");
}
else{
    echo "<center>Current: <b><font color=black>" . $weather_text . "</font></b></center><br>";
    system("echo 'Unknown' > ./data/current.txt");
}
echo "</td>";

//3rd column table

echo "<td align = left>";
echo "City: " . $cityname . "<br>";
echo "Time: " .$today . "<br>";
echo "Temp Max: " . $temp_max ."&deg;C<br>";
if($w_cold_curr == 2){
    if($w_cold_prev == 0|| $w_cold_curr == 2){
       system("/usr/sbin/ssmtp $receiver_email < ./data/msg_cold.txt");
    }
$w_cold_prev=2;
}
else if($w_vhot_curr == 3){
    if($w_vhot_prev == 0 || $w_vhot_curr == 3){
    system("/usr/sbin/ssmtp $receiver_email < ./data/msg_vhot.txt");
    }
$w_vhot_prev=3;
}
echo "Temp Min: " . $temp_min ."&deg;C<br>";
echo "</td>";
echo "</tr>";
echo "</table>";
echo "</td>";
?>

<iframe name="myframe" src="./schedule.php"  style="width:95%; height: 60% ; background: #FFFFFF;"></iframe>

</body>
</html>
