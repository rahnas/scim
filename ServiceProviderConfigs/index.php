<?php

/***************************************/

// send the configuration back to Okta //

/***************************************/


$json = file_get_contents("scimConfig.json");

echo $json;

exit;