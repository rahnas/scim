<?php


$data = array('username'=>'dog','password'=>'tall');
$data_json = json_encode($data);

if ($_SERVER['SERVER_NAME'] === "localhost") {
	$url = "http://localhost:8888/scim/Users/101";
}
else {
	$url = "http://ec2-54-144-201-238.compute-1.amazonaws.com/scim/Users/101";
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_json)));
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response  = curl_exec($ch);

// echo 'Curl error: ' . curl_error($ch);

// echo "<p>the response is: " . $response;

echo $response;

curl_close($ch);