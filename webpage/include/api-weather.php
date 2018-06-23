<?php
// Author: Hyunjoon Lim, Suyeon Lim
// Title: Open API Crawler from openweathermap.org and www.data.go.kr
// Date: May-06-2018
// License: Star License
//
// Description: This webpage is to display weather and user schedule
// The below statements do not make a PHP debug message to show parse errors.
// In case of PHP7/Ubuntu 16.04, the only way to show those errors is to


// ---------- Configuration-----------------------------------------------------------
$city_name="Seoul";
$weather_api_key="f53e9bb210db8d3957b2dba44dd7f55c";
// email id of family
$receiver_email="hjoon0510@gmail.com lsy0314@gmail.com khs7516@gmail.com leemgs@gmail.com";

// ---------- Do not modify from now on ----------------------------------------------
$url = "http://api.openweathermap.org/data/2.5/weather?q=$city_name&APPID=$weather_api_key";

// Specify weather conditions to send email in case of below situation.
// -----[ Value Management Table for weather] -------------------------
// 1 = rain
// 2 = temperature cold (< 05 degree)
// 3 = temperature vhot  (> 32 degree)
// 4 = dust (dangerouse condition)
// --------------------------------------------------------------------


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

// We have to read previous values from ./data/*** file without varaible.
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

$filename_w_dust_prev = "./data/current_finedust.txt";
file_is_empty($filename_w_dust_prev);
$file = fopen($filename_w_dust_prev,'r') or die("Unable to open $filename_w_dust_prev !!!");
$w_dust_prev = fgets($file);
fclose($file);

// initialize current variable
$w_rain_curr_condition=999;
$w_cold_curr_condition=999;
$w_vhot_curr_condition=999;
$w_dust_curr_condition=999;

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

// Set the default timezone to use. Available since PHP 5.1
// Let's specify how to get currentdate time
date_default_timezone_set('Asia/Seoul');
$today = date("F-j-Y g:i A");

if ($weather_text == "Rain"){
    $w_rain_curr_condition=1;
}
else if ($temp_min < 5){
    $w_cold_curr_condition=2;
    $W_vhot_curr_condition=0;
}
else if ($temp_max > 32){
    $w_vhot_curr_condition=3;
    $w_cold_curr_condition=0;
}
// We hav to compare a fine dust data from variable $value->pm10Grade1h .
else if ($value->pm10Grade1h >= 3){
    $w_dust_curr_condition=4;
}
else{
    echo "[DEBUG] There are not any bad conditions. So current weather and fine dust are good.";
    $w_vhot_curr_condition=0;
    $w_cold_curr_condition=0;
}

?>

