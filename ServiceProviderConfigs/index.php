<?php

/***************************************/

// send the configuration back to Okta //

/***************************************/


$json = file_get_contents("scimConfig.json");

$arr = json_decode($json, TRUE);

$json = json_encode($arr);

echo $json;

exit;