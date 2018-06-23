<?php
// Author: Hyunjoon Lim, Suyeon Lim
// Title: Par2 /  display weather icon , send email (rain)
// Date: May-06-2018
// License: Star License
//
// Description: This webpage is to display weather and user schedule
// The below statements do not make a PHP debug message to show parse errors.
// In case of PHP7/Ubuntu 16.04, the only way to show those errors is to

?>

<?php
// Part2: 2nd column table
echo "<td width=200>";
//display more good icons instead of icons of openweathermap.org
// https://github.com/erikflowers/weather-icons
if ($weather_text == "Haze"){
    echo "<img width=150 height=100 src='./svg/wi-day-haze.svg'/>";
    system("echo 0 > $filename_w_rain_prev"); 
}
else if($weather_text =="Rain" || $weather_text == "Light rain"){
    echo "<img width=150 height=100 src='./image/umbrella.gif'/>";
    if ($w_rain_prev == 0 && $w_rain_curr_condition == 1){
        // We improve execution speed (6secs) of ssmtp command by running  ssmtp command asynchronously
        // Run a script asynchronously to avoid service timeout that is generated due to long build time.
        // https://stackoverflow.com/questions/222414/asynchronous-shell-exec-in-php
        // https://stackoverflow.com/questions/2368137/asynchronous-shell-commands
        // system("/usr/sbin/ssmtp $receiver_email < ./data/msg_rain.txt");
        system("/usr/sbin/ssmtp $receiver_email < ./data/msg_rain.txt > /dev/null 2>/dev/null &");
    }
   system("echo 1 > $filename_w_rain_prev"); 
}
else if($weather_text == "Snow"){
    echo "<img width=150 height=100 src='./image/snow.png'/>";
    system("echo 0 > $filename_w_rain_prev"); 
}
else if($weather_text == "Mist"){
    echo "<img width=150 height=100 src='./svg/wi-night-fog.svg'/>";
    system("echo 0 > $filename_w_rain_prev"); 
}
else if($weather_text == "Clear"){
   echo "<img width=150 height=100 src='./svg/wi-night-clear.svg'/>";
   $w_rain_prev = 0;
   system("echo 0 > $filename_w_rain_prev");
}
else if($weather_text == "Wind"){
    echo "<img width=150 height=100 src='./svg/wi-day-windy.svg'/>";
    system("echo 0 > $filename_w_rain_prev");
}
else{
    echo "<img width=150 height=100 src='http://openweathermap.org/img/w/" . $weather_icon ."'/ >";
    system("echo 0 > $filename_w_rain_prev");
}

// Check if ./data/current_weather.txt file is writable.
// is_writable — Tells whether the filename is writable
$file_curr_conditionent_weather = './data/current_weather.txt';
if (!is_writable($file_curr_conditionent_weather)) {
    echo "<font color=red>[DEBUG] Oooops. The ".$file_curr_conditionent_weather." is not writable.</font>";
}

// Display current weather. And save current weather to ./data/current_weather.txt file for pir sensor
if($weather_text =="Rain" || $weather_text == "Light rain"){
    echo "<center>Current: <b><font color=red>" . $weather_text . "</font></b></center><br>";
    system("echo 'Rain'    > ".$file_curr_conditionent_weather);
}
else{
    echo "<center>Current: <b><font color=black>" . $weather_text . "</font></b></center><br>";
    system("echo 'Unknown' > ".$file_curr_conditionent_weather);
}
echo "</td>";

?>
