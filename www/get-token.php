<?php
	
	require_once '../vendor/autoload.php';
	use Crema\Pingboard;
	
	$credentials = json_decode(file_get_contents('../config.json'))->pingboard;
	
	$pingboard = new Pingboard($credentials);
	header('Content-Type: application/json');
	dump($pingboard->getToken());
	
?>
