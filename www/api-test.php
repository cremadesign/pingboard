<?php
	
	require_once '../vendor/autoload.php';
	use Crema\CurlRequest;
	
	$credentials = json_decode(file_get_contents('../config.json'))->pingboard;
	$api = "https://app.pingboard.com/api/v2";
	$auth_url = "https://app.pingboard.com/oauth/token?grant_type=client_credentials";
	$payload = "client_id=$credentials->client_id&client_secret=$credentials->client_secret";
	
	$curl = new CurlRequest();
	$response = $curl->request("POST", $auth_url, $payload, false, [
		"Content-Type" => "application/x-www-form-urlencoded"
	]);
	
	header('Content-Type: application/json');
	echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
	
?>
