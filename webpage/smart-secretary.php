<?php
// Author: Hyunjoon Lim, Suyeon Lim
// Title: Weather Crawler from openweathermap.org
// Date: May-06-2018
// License: Star License
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
<link rel="stylesheet" type="text/css" href="style.css">
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

// TODO: This line is bug. The default value is 0.
// we have create a text file such as w_rain_prev.txt.

function file_is_empty($newfile){
    if (!file_exists($newfile)){
        system("echo 999 > $newfile");
    }
    return true;
}

//$w_rain_prev=999;
//$w_cold_prev=999;
//$w_vhot_prev=999;
//$w_dust_prev=999;

// read previous variable from ./data/*** file.
$filename_w_rain_prev = "./data/w_rain_prev.txt";
file_is_empty($filename_w_rain_prev);
$file = fopen($filename_w_rain_prev,'r') or die("Unable to open $filename_w_rain_prev !!!");
$w_rain_prev = fgets($file);
fclose($file);

$filename_w_cold_prev = "./data/w_cold_prev.txt";
file_is_empty($filename_w_cold_prev);
$file = fopen($filename_w_cold_prev,'r') or die("Unable to open $filename_w_cold_prev !!!");
$w_cold_prev = fgets($file);
fclose($file);


$filename_w_vhot_prev = "./data/w_vhot_prev.txt";
file_is_empty($filename_w_vhot_prev);
$file = fopen($filename_w_vhot_prev,'r') or die("Unable to open $filename_w_vhot_prev !!!");
$w_vhot_prev = fgets($file);
fclose($file);

$filename_w_dust_prev = "./data/w_dust_prev.txt";
file_is_empty($filename_w_dust_prev);
$file = fopen($filename_w_dust_prev,'r') or die("Unable to open $filename_w_dust_prev !!!");
$w_dust_prev = fgets($file);
fclose($file);

// initialize current variable
$w_rain_curr=999;
$w_cold_curr=999;
$w_vhot_curr=999;
$w_dust_curr=999;

// Use json format to get the weather information
$contents = file_get_contents($url);
$climate=json_decode($contents);

// Get Temperature, Weather, and city name
// https://en.wikipedia.org/wiki/Absolute_zero
$absolute_zero = 273.15;

// Not that we have to subtract 273.15 from temparature value
// because temperature is kelvin by default.
$temp_max=$climate->main->temp_max - $absolute_zero;
$temp_min=$climate->main->temp_min - $absolute_zero;
$weather_text=$climate->weather[0]->main;
// DEBUG
// $weather_text="Snow";

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
// TODO: We hav to get fine dust data from https://www.data.go.kr/dataset/15000581/openapi.do
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
    // $w_rain_prev = 0;
    system("echo 0 > $filename_w_rain_prev"); 
}
else if($weather_text =="Rain" || $weather_text == "Light rain"){
    echo "<img width=150 height=100 src='./image/umbrella.gif'/>";
    if ($w_rain_prev == 0 && $w_rain_curr == 1){
        // TODO: we have to improve execution speed (6secs) of ssmtp command
        // I uploaded hint file (jpeg) into my dropbox
        system("/usr/sbin/ssmtp $receiver_email < ./data/msg_rain.txt");
    }
    // $w_rain_prev = 1;
   system("echo 1 > $filename_w_rain_prev"); 
}
else if($weather_text == "Snow"){
    echo "<img width=150 height=100 src='./image/snow.png'/>";
    // $w_rain_prev = 0; 
    system("echo 0 > $filename_w_rain_prev"); 
}
else if($weather_text == "Mist"){
    echo "<img width=150 height=100 src='./svg/wi-night-fog.svg'/>";
    // $w_rain_prev = 0;
    system("echo 0 > $filename_w_rain_prev"); 
}
else if($weather_text == "Clear"){
    echo "<img width=150 height=100 src='./svg/wi-night-clear.svg'/>";
    // $w_rain_prev = 0;
    system("echo 0 > $filename_w_rain_prev"); 
}
else if($weather_text == "Wind"){
    echo "<img width=150 height=100 src='./svg/wi-day-windy.svg'/>";
    system("echo 0 > $filename_w_rain_prev");
    //$w_rain_prev = 0;
}
else{
    echo "<img width=150 height=100 src='http://openweathermap.org/img/w/" . $weather_icon ."'/ >";
    system("echo 0 > $filename_w_rain_prev");
    //$w_rain_prev = 0;
}

// Check if ./data/current_weather.txt file is writable.
// is_writable — Tells whether the filename is writable
$file_current_weather = './data/current_weather.txt';
if (!is_writable($file_current_weather)) {
    echo "<font color=red>[DEBUG] Oooops. The ".$file_current_weather." is not writable.</font>";
}

// Display current weather. And save current weather to ./data/current_weather.txt file for pir sensor
if($weather_text =="Rain" || $weather_text == "Light rain"){
    echo "<center>Current: <b><font color=red>" . $weather_text . "</font></b></center><br>";
    system("echo 'Rain'    > ".$file_current_weather);
}
else{
    echo "<center>Current: <b><font color=black>" . $weather_text . "</font></b></center><br>";
    system("echo 'Unknown' > ".$file_current_weather);
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

<iframe name="myframe" src="./schedule.php"  style="width:95%; height:60% ; background:#FFFFFF;"></iframe>

</body>
</html>
