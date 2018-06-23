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
// load part3 file
include "./include/part3.php";

?>

<iframe name="myframe" src="./schedule.php"  style="width:95%; height:60% ; background:#FFFFFF;"></iframe>

</body>
</html>
