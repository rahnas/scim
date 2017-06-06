<?php

/**********************************************/

/********** Okta SCIM connector *******************/

/**********************************************/

include "includes/parseIncoming.php";

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
	else if ($endpoint === "Users") {
		echo getUsers();
		exit;
	}
	else if ($endpoint === "Groups") {
		echo getGroups();
		exit;
	}
}
else if ($method === "PUT") {
	if ($endpoint === "Users") {
		file_put_contents("users.txt", $payload);

		$json = file_get_contents("data/users.json");

		$arr = json_decode($json, TRUE);

		$arr["Resources"][] = json_decode($payload, TRUE);

		file_put_contents("data/users.json", json_encode($arr));

		echo $payload;
	}
	exit;
}
else {
	echo "<p> the method is: " . $method;
	exit;
}

function getGroups() {
	$json = file_get_contents("data/groups.json");

	$arr = json_decode($json, TRUE);

	$retVal["totalResults"] = sizeof($arr["Resources"]);

	$retVal["schemas"] = array("urn:scim:schemas:core:1.0");

	$retVal["itemsPerPage"] = sizeof($arr["Resources"]);

	$retVal["startIndex"] = 1;

	$retVal["Resources"] = $arr["Resources"];

	return json_encode($retVal);
}

function getUsers() {
	$json = file_get_contents("data/users.json");

	$arr = json_decode($json, TRUE);

	$retVal["totalResults"] = sizeof($arr["Resources"]);

	$retVal["schemas"] = array("urn:scim:schemas:core:1.0");

	$retVal["Resources"] = $arr["Resources"];

	return json_encode($retVal);
}

echo "<p> the server request method is: " . $method;

echo "<p> the request itself is: " . $_REQUEST['request'];

echo "<p> the endpoint is: " . $endpoint;

echo "<p> the resourceID is: " . $resourceID;

exit;