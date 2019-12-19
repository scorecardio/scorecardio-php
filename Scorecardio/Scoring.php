<?php


namespace Scorecardio;


class Scoring extends CurlExecutor {

	private $identifier;


	public function fetchScoring($identifier) {
		$this->identifier = $identifier;

		$url = $this->buildUrl();

		return $this->executeCurlRequest($url, []);
	}


	protected function buildUrl() {
		$identifier = htmlentities(rawurlencode($this->identifier));

		return self::BASE_URL . "/scoring/{$identifier}";
	}

}
