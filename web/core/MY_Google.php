<?php
defined('BASEPATH') or exit('No direct script access allowed');


class MY_Google extends MY_Controller
{

	public $google;
	public $token;
	public function __construct()
	{
		parent::__construct();

		require_once APPPATH . 'libraries/google_api/vendor/autoload.php';

		$this->auth();

	}


	public function auth(){
		$key = SHAREDPATH . 'json/google_key.json';
		$this->google = new Google\Client();

		$this->google->setAuthConfig($key);
		$this->google->addScope('https://www.googleapis.com/auth/indexing');
		$this->google->addScope(Google\Service\Drive::DRIVE);

		$httpClient = $this->google->authorize();
		$endpoint = 'https://indexing.googleapis.com/v3/urlNotifications:publish';

		$redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
		$this->google->setRedirectUri($redirect_uri);

		//$response = $httpClient->post($endpoint, [ 'body' => $content ]);
		//$status_code = $response->getStatusCode();



	}

	function token()
	{
		if (isset($_GET['code'])) {
			$this->token = $this->google->fetchAccessTokenWithAuthCode($_GET['code']);
		}

	}


}
