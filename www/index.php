<?php
	
	require_once '../vendor/autoload.php';
	
	use Crema\Pingboard;
	
	$credentials = json_decode(file_get_contents('../config.json'))->pingboard;
	$pingboard = new Pingboard($credentials);
	
	$response = $pingboard->users();
	
	$users = array_map(function($item) {
		$id = $item['id'];
		$locations = $item['links']['locations'] ?? [];
		$departments = $item['links']['departments'] ?? [];
		
		return [
			'id' => $item['id'],
			'first_name' => $item['first_name'],
			'last_name' => $item['last_name'],
			'nickname' => $item['nickname'],
			'job_title' => $item['job_title'],
			'email' => $item['email'],
			'phone' => $item['phone'],
			'office_phone' => $item['office_phone'],
			'reports_to_id' => $item['reports_to_id'],
			'locations' => implode(",", $locations),
			'departments' => implode(",", $departments),
			'image' => $item['avatar_urls']['original'] ?? false
		];
	}, $response['users']);
	
	dump($users);
	
?>
