<?php


namespace Scorecardio;


class Scorecard {

	private const BASE_URL = 'https://scorecard.simbuka.com';

	private $api_token;

	public function __construct($api_token) {
		$this->api_token = $api_token;
	}

	public function executeScorecardVersion($partner_name, $scorecard_name, $version_number, $arguments) {
		$url = $this->buildUrl($partner_name, $scorecard_name, $version_number);
		return $this->executeCurlRequest($url, $arguments);
	}

	public function executePublishedScorecard($partner_name, $scorecard_name, $arguments) {
		$url = $this->buildUrl($partner_name, $scorecard_name, null);
		return $this->executeCurlRequest($url, $arguments);
	}

	private function buildUrl($partner_name, $scorecard_name, $version_number) {
		$partner_name = htmlentities(rawurlencode($partner_name));
		$scorecard_name = htmlentities(rawurlencode($scorecard_name));
		$url = self::BASE_URL . "/{$partner_name}/scorecard/{$scorecard_name}";
		if (!empty($version_number)) {
			$url .= "/{$version_number}";
		}
		$url .= "?api_token={$this->api_token}";
		return $url;
	}

	private function executeCurlRequest($url, $arguments) {
		try {
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $arguments);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
			curl_setopt($ch, CURLOPT_TIMEOUT, 60);
			curl_setopt($ch, CURLOPT_HTTPHEADER, ['Accept: application/json']);

			$result = curl_exec($ch);
			$curl_errno = curl_errno($ch);
			curl_close($ch);
			if ($curl_errno > 0) {
				return ['error' => 'An error has occurred: curl error number' . $curl_errno];
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
