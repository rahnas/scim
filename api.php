<?php

/**********************************************/

/********** Okta SCIM connector *******************/

/**********************************************/


// example query: PUT /scim/Users/{id} + JSON payload

$method = getMethod($_SERVER['REQUEST_METHOD']); // PUT

$endpoint = getEndpoint(); // Users

$resourceID = getResourceID(); // {id}

$payload = getPayload(); // json payload

if ($method === "GET") {

	if ($endpoint === "ServiceProviderConfigs") {
		echo file_get_contents("scimConfig.json");
		exit;
	}
}

echo "<p> the server request method is: " . $method;

echo "<p> the request itself is: " . $_REQUEST['request'];

echo "<p> the endpoint is: " . $endpoint;

echo "<p> the resourceID is: " . $resourceID;

exit;

function getEndpoint() {

	$args = explode("/", $_REQUEST['request']);

	return $args[0];
}

function getMethod($method) {
	if ($method == 'POST' && array_key_exists('HTTP_X_HTTP_METHOD', $_SERVER)) {
		if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'DELETE') {
			$method = 'DELETE';
		} else if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'PUT') {
			$method = 'PUT';
		} else {
			echo "<p>cannot parse header";
			exit;
		}
	}

	return $method;
}

function getPayload() { return ""; }

function getResourceID() {
	$args = explode("/", $_REQUEST['request']);

	return $args[1];
}