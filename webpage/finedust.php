<?php
// Airkorea OpenAPI: Korean Air Quality API:
// 0. https://www.data.go.kr/dataset/15000581/openapi.do
// 1. http://openapi.airkorea.or.kr/openapi/services/rest/ArpltnInforInqireSvc/getCtprvnRltmMesureDnsty?sidoName=서울&pageNo=1&numOfRows=10&ServiceKey=<your_auth_key>&ver=1.3
// 2. https://api.waqi.info/feed/geo:37.517530;126.719561/?token=41da8ebfbc9cc68442af347291689e8cbeb5a9b1
// @author: Suyeon Lim
// @date  : Jun-07-2018
// ---------- Configuration-----------------------------------------------------------
$city_name="경기";
$my_city="인계동";
$fine_dust_key="SIWaWSrBVuPLMIiRMgaD7%2FZFYT4xEQwqDTG67Nkk1HiO3xxpvCYu2hXU%2FK7%2Fuk3jiKS2LxIGSgz4%2FmVHCs1Y%2FA%3D%3D";
$fine_dust_ver="1.3";

// ---------- Do not modify from now on ----------------------------------------------
// Airkorea OpenAPI: Korean Air Quality API 
// We can use Open API Service from airkorea.or.kr. 
// For more detail, visit https://www.data.go.kr/dataset/15000581/openapi.do. Then, read Page 17 of the manual.
$url_base = "http://openapi.airkorea.or.kr/openapi/services/rest/ArpltnInforInqireSvc/getCtprvnRltmMesureDnsty";
$url_full = "$url_base?sidoName=${city_name}&pageNo=1&numOfRows=10&ServiceKey=${fine_dust_key}&ver=${fine_dust_ver}";

// Use XML format to get the fine dust information
// If we have to get data with json format, we have to append "&_returnType=json" parameter behind $url_full.
// http://php.net/manual/kr/function.file-get-contents.php
// http://php.net/manual/kr/function.simplexml-load-string.php
$contents = file_get_contents($url_full);
$xml=simplexml_load_string($contents);
$obj_addr=$xml->body[0]->items[0];  // item[0]
echo "<b>Real-time inquiry of air pollution information</b><br>";
echo "<font color=red>Grade: 1(very good), 2(good), 3(bad), 4(worse)</font><br><br>";


// http://php.net/manual/en/control-structures.foreach.php
foreach($obj_addr->item as $value) {
    // let's display only my city among the cities.
    // pm10Grade1H : Particulate Matter, 미세먼지, 1시간 등급
    // pm2.5Grade1H: Particulate Matter, 초미세먼지, 1시간 등급
	if ($value->stationName == $my_city){
        echo "dataTime   :".$value->dataTime."<br>";
        echo "stationNmae:".$value->stationName."<br>"; 
        echo "mangName   :".$value->mangName."<br>" ; 
        echo "pm10Grade1h:".$value->pm10Grade1h."<br>";
        echo "o3Grade    :".$value->o3Grade."<br>";
        echo "----------------------------------------<br>";
        // let's create ./data/current_finedust.txt file for PIR sensor.
       break;
    }
}

?>
