<?php
// https://nicesj.com/article/calendar/3159
// http://php.net/manual/en/book.curl.php
// php -r "curl_init();"
// php -m | grep curl
// apt install php-curl
// sudo service apache2 restart
$ch = curl_init();
$API_BASE = "http://openapi.airkorea.or.kr/";
$CLIENT_KEY="SIWaWSrBVuPLMIiRMgaD7%2FZFYT4xEQwqDTG67Nkk1HiO3xxpvCYu2hXU%2FK7%2Fuk3jiKS2LxIGSgz4%2FmVHCs1Y%2FA%3D%3D";
$sidoName="경기";
$searchCondition="MONTH";
$url = $API_BASE."openapi/services/rest/ArpltnInforInqireSvc/getCtprvnMesureSidoLIst?ServiceKey=".$CLIENT_KEY."&numOfRows=100&pageNo=1&sidoName=$sidoName&searchCondition=$searchCondition&_returnType=json";

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

$response = curl_exec($ch);
if (!$response) {
    curl_close($ch);
    $record["status"] = 500;
    $record["code"] = 0;
    $record["message"] = "Network error";
    return $record;
}

$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
if ($status != 200) {
    curl_close($ch);
    $record = json_decode($response, TRUE);
    $record["status"] = $status;
    return $record;
}

curl_close($ch);
$record["updated"] = date("Y-m-d H:i:s");
$record["status"] = $status;


$record["value"] = json_decode($response, TRUE);

$idx = -1;
$cityNameList = Array();
$cityName = empty($_GET["cityName"]) == TRUE ? $response["value"]["list"][0]["cityName"] : $_GET["cityName"];
for ($i = 0; $i < $response["value"]["totalCount"]; $i++) {
    if ($response["value"]["list"][$i]["cityName"] == $cityName) {
        $idx = $i;
    }
    array_push($cityNameList, $response["value"]["list"][$i]["cityName"]);
}

if ($idx >= 0) {
    $ret["pm10Value"] = $response["value"]["list"][$idx]["pm10Value"];
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

echo "data:".$ret["pm10Value"];
return $record;

?>
