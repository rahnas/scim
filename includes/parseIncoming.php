<?php

/**********************************************/

/** functions for parsing incoming requests ***/

/**********************************************/

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

function getPayload() {
	return file_get_contents('php://input');
}

function getResourceID() {
	$args = explode("/", $_REQUEST['request']);

	return $args[1];
}