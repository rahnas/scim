<?php

/**********************************************/

/********** /Users endpoint *******************/

/**********************************************/

echo "<p>the path is: " . $_SERVER['QUERY_STRING'];


if ($_GET) {

	$json = file_get_contents("users.json");

	$arr = json_decode($json, TRUE);

	$users = $arr["Resources"];

	echo "<p>the size of the array is: " . sizeof($users);
}

// $json = file_get_contents("users.json");

// $arr = json_decode($json, TRUE);

// $users = $arr["Resources"];

// echo "<p>the size of the array is: " . sizeof($users);






exit;