<?php


$data = array('username'=>'dog','password'=>'tall');
$data_json = json_encode($data);

// 172.31.21.241 - - [05/Jun/2017:20:14:45 +0000] "PUT /scim/Users/101 HTTP/1.1" 200 125 "-" "Okta OPP Agent - 1.0.11"

$url = "../Users/101";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_json)));
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response  = curl_exec($ch);

curl_close($ch);