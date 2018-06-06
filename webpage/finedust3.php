<?php
// OpenAPI :
// 1. http://openapi.airkorea.or.kr/openapi/services/rest/ArpltnInforInqireSvc/getCtprvnRltmMesureDnsty?sidoName=서울&pageNo=1&numOfRows=10&ServiceKey=SIWaWSrBVuPLMIiRMgaD7%2FZFYT4xEQwqDTG67Nkk1HiO3xxpvCYu2hXU%2FK7%2Fuk3jiKS2LxIGSgz4%2FmVHCs1Y%2FA%3D%3D&ver=1.3
// Reference:
// 0. https://api.waqi.info/feed/geo:37.517530;126.719561/?token=41da8ebfbc9cc68442af347291689e8cbeb5a9b1
// 1. http://kindmaster.tistory.com/61
// 2. http://tech.leotek.co.kr/2017/04/27/aqicn-%EA%B3%B5%EA%B8%B0%EC%A7%88-open-api-%EC%82%AC%EC%9A%A9/
// ---------- Configuration-----------------------------------------------------------
$city_name="경기";
$fine_dust_key="SIWaWSrBVuPLMIiRMgaD7%2FZFYT4xEQwqDTG67Nkk1HiO3xxpvCYu2hXU%2FK7%2Fuk3jiKS2LxIGSgz4%2FmVHCs1Y%2FA%3D%3D";
$receiver_email="lsy0314@gmail.com";

// ---------- Do not modify from now on ----------------------------------------------
// Airkorea OpenAPI: Korean Air Quality API 
// We can use Open API Service from airkorea.or.kr. 
// For more detail, visit https://www.data.go.kr/dataset/15000581/openapi.do. Then, read Page 17.
$url = "http://openapi.airkorea.or.kr/openapi/services/rest/ArpltnInforInqireSvc/getCtprvnRltmMesureDnsty?sidoName=${city_name}&pageNo=1&numOfRows=10&ServiceKey=${fine_dust_key}&ver=1.3";

// Use json format to get the fine dust information
$contents = file_get_contents($url);
$xml=simplexml_load_string($contents);
$obj_addr=$xml->body[0]->items[0];  // item[0]

echo "<font color=red>Grade:1(very good), 2(good), 3(bad), 4(worse)</font><br><br>";
foreach($obj_addr->item as $value) {
echo "stationNmae:".$value->stationName."<br>" ; 
echo "mangName   :".$value->mangName."<br>" ; 
echo "pm10Grade  :".$value->pm10Grade."<br>";
echo "pm25Grade  :".$value->pm25Grade."<br>";
echo "-------------------<br>";
}

?>
