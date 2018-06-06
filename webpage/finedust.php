<?php
// http://openapi.airkorea.or.kr/openapi/services/rest/ArpltnInforInqireSvc/getCtprvnRltmMesureDnsty?sidoName=서울&pageNo=1&numOfRows=10&ServiceKey=SIWaWSrBVuPLMIiRMgaD7%2FZFYT4xEQwqDTG67Nkk1HiO3xxpvCYu2hXU%2FK7%2Fuk3jiKS2LxIGSgz4%2FmVHCs1Y%2FA%3D%3D&ver=1.3

// ---------- Configuration-----------------------------------------------------------
$city_name="경기";
$fine_dust_key="SIWaWSrBVuPLMIiRMgaD7%2FZFYT4xEQwqDTG67Nkk1HiO3xxpvCYu2hXU%2FK7%2Fuk3jiKS2LxIGSgz4%2FmVHCs1Y%2FA%3D%3D";
$receiver_email="lsy0314@gmail.com";

// ---------- Do not modify from now on ----------------------------------------------
// We can use Open API Service from airkorea.or.kr. 
// For more detail, visit https://www.data.go.kr/dataset/15000581/openapi.do. Then, read Page 17.
$url = "http://openapi.airkorea.or.kr/openapi/services/rest/ArpltnInforInqireSvc/getCtprvnRltmMesureDnsty?sidoName=${city_name}&pageNo=1&numOfRows=10&ServiceKey=${fine_dust_key}&ver=1.3";

// Use json format to get the fine dust information
$contents = file_get_contents($url);
$dust=json_decode($contents);

echo "content: ".$contents;
echo "<br>";
echo "dust: ".$dust;
$idx = -1;
$cityNameList = Array();
$output=$dust->response->header->resultMsg;
echo "data: $output . ";
for ($i = 0; $i < $response["value"]["totalCount"]; $i++) {
    if ($response["value"]["list"][$i]["cityName"] == $city_name) {
        $idx = $i;
    }
    array_push($cityNameList, $response["value"]["list"][$i]["cityName"]);
}
if ($idx >= 0) {
    $ret["pm10Value"] = $response["value"]["list"][$idx]["pm10Value"];
    echo "result".$ret["pm10Value"];
    $ret["pm25Value"] = $response["value"]["list"][$idx]["pm25Value"];
    $ret["no2Value"] = $response["value"]["list"][$idx]["no2Value"];
    $ret["o3Value"] = $response["value"]["list"][$idx]["o3Value"];
    $ret["so2Value"] = $response["value"]["list"][$idx]["so2Value"];
    $ret["coValue"] = $response["value"]["list"][$idx]["coValue"];
    $ret["updated"] = $response["value"]["list"][$idx]["dataTime"];
    $ret["cached"] = $response["cached"];

    $ret["sidoNameList"] = $sidoNameList;
    $ret["searchConditionList"] = $searchConditionList;
    $ret["cityNameList"] = $cityNameList;

    // Browser 로 결과 값 전달 (JSON?)
} else {
    // Browser 로 Error 정보 전달
}

?>
