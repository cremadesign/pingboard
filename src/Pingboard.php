<?php

	namespace Crema;
	
	use Crema\Fetcher;
	
	class Pingboard {
		public function __construct($credentials) {
			$this->urls = (object) [
				'auth' => "https://app.pingboard.com/oauth/token?grant_type=client_credentials",
				'company' => "https://app.pingboard.com/api/v2/companies/my_company",
				'groups' => "https://app.pingboard.com/api/v2/groups",
				'users' => "https://app.pingboard.com/api/v2/users"
			];
			
			$this->clientId = $credentials->client_id;
			$this->clientSecret = $credentials->client_secret;
			$this->auth();
		}
		
		public function auth() {
			$this->curl = new CurlRequest();
			
			$response = $this->curl->request("POST", $this->urls->auth, [
				'client_id' => $this->clientId,
				'client_secret' => $this->clientSecret
			]);
			
			$this->token = $response->object();
			
			$headers = $this->curl->setRequestHeaders([
				"Authorization" => "Bearer {$this->token->access_token}"
			]);
		}
		
		public function getToken() {
			return $this->token;
		}
		
		public function setClientSecret(string $clientSecret): void {
			$this->clientSecret = $clientSecret;
		}
		
		public function getClientSecret(): string {
			return $this->clientSecret;
		}
		
		public function setClientId(string $clientId): void {
			$this->clientId = $clientId;
		}
		
		public function getClientId(): string {
			return $this->clientId;
		}
		
		public function getHeaders() {
			return $this->curl->getRequestHeaders();
		}
		
		public function company() {
			$response = $this->curl->get($this->urls->company);
			return $response->json();
		}
		
		public function groups() {
			$response = $this->curl->get($this->urls->groups);
			return $response->json();
		}
		
		public function users() {
			$response = $this->curl->get($this->urls->users);
			return $response->json();
		}
	}
?>
