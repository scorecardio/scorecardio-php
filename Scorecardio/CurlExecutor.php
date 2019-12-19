<?php


namespace Scorecardio;


abstract class CurlExecutor {

	protected const BASE_URL = 'https://scorecard.simbuka.com';

	private const CONNECT_TIMEOUT = 10;
	private const TIMEOUT = 60;

	protected $api_token;


	public function __construct($api_token) {
		$this->api_token = $api_token;
	}


	abstract protected function buildUrl();


	protected function executeCurlRequest($url, $arguments) {
		try {
			$arguments['api_token'] = $this->api_token;

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($arguments));
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, self::CONNECT_TIMEOUT);
			curl_setopt($ch, CURLOPT_TIMEOUT, self::TIMEOUT);
			curl_setopt($ch, CURLOPT_HTTPHEADER, ['Accept: application/json']);

			$result = curl_exec($ch);
			$curl_error = curl_error($ch);
			curl_close($ch);
			if (!empty($curl_error)) {
				return ['error' => 'An error has occurred: ' . $curl_error];
			}

			$json = json_decode($result, true);
			if (empty($json)) {
				return ['error' => 'An error has occurred: failed to decode response'];
			}

			return $json;
		} catch (\Exception $e) {
			return ['error' => 'An error has occurred'];
		}
	}
}