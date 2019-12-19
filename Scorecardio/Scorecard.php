<?php


namespace Scorecardio;


class Scorecard extends CurlExecutor {

	private const ARGUMENTS = 'arguments';
	private const EXECUTION = 'execution';

	private $partner_name;
	private $scorecard_name;
	private $version_number;
	private $request_type;


	public function executeScorecardVersion($partner_name, $scorecard_name, $version_number, $arguments) {
		$this->version_number = $version_number;
		return $this->executeScorecard($partner_name, $scorecard_name, $arguments);
	}


	public function executePublishedScorecard($partner_name, $scorecard_name, $arguments) {
		$this->version_number = null;
		return $this->executeScorecard($partner_name, $scorecard_name, $arguments);
	}


	private function executeScorecard($partner_name, $scorecard_name, $arguments) {
		$this->partner_name = $partner_name;
		$this->scorecard_name = $scorecard_name;
		$this->request_type = self::EXECUTION;

		$url = $this->buildUrl();
		return $this->executeCurlRequest($url, $arguments);
	}


	public function fetchArgumentsOfScorecardVersion($partner_name, $scorecard_name, $version_number) {
		$this->version_number = $version_number;
		return $this->fetchArgumentsOfScorecard($partner_name, $scorecard_name);
	}


	public function fetchArgumentsOfPublishedScorecard($partner_name, $scorecard_name) {
		$this->version_number = null;
		return $this->fetchArgumentsOfScorecard($partner_name, $scorecard_name);
	}


	private function fetchArgumentsOfScorecard($partner_name, $scorecard_name) {
		$this->partner_name = $partner_name;
		$this->scorecard_name = $scorecard_name;
		$this->request_type = self::ARGUMENTS;

		$url = $this->buildUrl();
		return $this->executeCurlRequest($url, []);
	}


	protected function buildUrl() {
		$partner_name = htmlentities(rawurlencode($this->partner_name));
		$scorecard_name = htmlentities(rawurlencode($this->scorecard_name));

		$url = self::BASE_URL . "/{$partner_name}/scorecard/{$scorecard_name}";

		if (!empty($this->version_number)) {
			$version_number = htmlentities(rawurlencode($this->scorecard_name));
			$url .= "/{$version_number}";
		}

		if ($this->request_type === self::ARGUMENTS) {
			$url .= '/arguments';
		}

		return $url;
	}

}
