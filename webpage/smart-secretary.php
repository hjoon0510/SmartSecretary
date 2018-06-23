<?php
// Author: Hyunjoon Lim, Suyeon Lim
// Title: Open API Crawler from openweathermap.org and www.data.go.kr
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
<meta http-equiv="refresh" content="600">
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body bgcolor=white>

<?php
// load find dust api file
include "./include/api-fine-dust.php";
?>

<?php
// load weather api file
include "./include/api-weather.php";
?>

<b> <center> <font color=blue> Smart Secretary </font></center></b>
<table border=0>

<tr width=100%>

<?php
// load part1 file
include "./include/part1.php";
?>

<?php
// load part2 file
include "./include/part2.php";

?>

<?php
// 3rd column table

echo "<td align = left>";
echo "City: " . $cityname . "<br>";
echo "Time: " .$today . "<br>";
echo "Temperature: ".(($temp_min+$temp_max)/2)."&deg;C (",$temp_min."~".$temp_max."&deg;C )<br>";
// The finedust variable is $value->pm10Grade1h
// Fine dust Grade: 1(very good), 2(good), 3(bad), 4(worse)
echo "FineDust: ";
if($value->pm10Grade1h == 1)
    echo "<font color=green>Very Good</font>";
else if($value->pm10Grade1h == 2)
    echo "<font color=green>Good</font>";
else if($value->pm10Grade1h == 3)
    echo "<font color=green>Bad</font>";
else if($value->pm10Grade1h == 4)
    echo "<font color=green>Worse</font>";
else
    echo "<font color=green>Error</font>";
// if fine dust is bad or wores, let's display "Dangerouse" message.
if ($w_dust_curr_condition == 4)
    echo "<font color=red>(Dangerous)</font>";
echo "<br>";
echo "</td>";
echo "</tr>";
echo "</table>";
echo "</td>";

// When send email, we have to wait for a long time (e.g., 6 seconds) in general.
// So we have to run ssmtp command with asynchrononous method. 
// Let's send email if now is very cold day.
if($w_cold_curr_condition == 2){
    if($w_cold_prev == 0|| $w_cold_curr_condition == 2){
        // We improve execution speed (6secs) of ssmtp command by running  ssmtp command asynchronously
        // Run a script asynchronously to avoid service timeout that is generated due to long build time.
        // https://stackoverflow.com/questions/222414/asynchronous-shell-exec-in-php
        // https://stackoverflow.com/questions/2368137/asynchronous-shell-commands
        // system("/usr/sbin/ssmtp $receiver_email < ./data/msg_cold.txt");
        system("/usr/sbin/ssmtp $receiver_email < ./data/msg_cold.txt > /dev/null 2>/dev/null &");
    }
    system("echo 2 > $filename_w_vhot_prev"); 
}
// Let's send email if now is very hot day.
else if($w_vhot_curr_condition == 3){
    if($w_vhot_prev == 0 || $w_vhot_curr_condition == 3){
        // We improve execution speed (6secs) of ssmtp command by running  ssmtp command asynchronously
        // Run a script asynchronously to avoid service timeout that is generated due to long build time.
        // https://stackoverflow.com/questions/222414/asynchronous-shell-exec-in-php
        // https://stackoverflow.com/questions/2368137/asynchronous-shell-commands
        // system("/usr/sbin/ssmtp $receiver_email < ./data/msg_vhot.txt");
        system("/usr/sbin/ssmtp $receiver_email < ./data/msg_vhot.txt > /dev/null 2>/dev/null &");
    }
    system("echo 3 > $filename_w_vhot_prev"); 
}

?>

<iframe name="myframe" src="./schedule.php"  style="width:95%; height:60% ; background:#FFFFFF;"></iframe>

</body>
</html>
