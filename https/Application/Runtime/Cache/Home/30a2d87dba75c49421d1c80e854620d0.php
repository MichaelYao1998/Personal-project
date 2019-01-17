<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Https Request</title>
</head>
<body>
<?php
 function curl_get_https($url) { $curl = curl_init(); curl_setopt($curl,CURLOPT_URL,$url); curl_setopt($curl,CURLOPT_HEADER,false); curl_setopt($curl,CURLOPT_RETURNTRANSFER,false); curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false); curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,2); $tempInfo = curl_exec($curl); curl_close($curl); return $tempInfo; } $url = "https://www.taobao.com"; $result = curl_get_https($url); var_dump($result); ?>

</body>
</html>