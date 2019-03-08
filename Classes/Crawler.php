<?php

//Fetch html from across the web
class Crawler {
	
	public function __construct($url, $request_headers) {
		$this->url = $url;
		$this->request_headers = $request_headers;
		$this->curl = curl_init();
		$this->setOptions();
	}

	private function setOptions() {
		curl_setopt($this->curl, CURLOPT_URL, $this->url);
		curl_setopt($this->curl, CURLOPT_HTTPHEADER, $this->request_headers);
		curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($this->curl, CURLOPT_HEADER, false);
		curl_setopt($this->curl, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($this->curl,CURLOPT_ENCODING , "gzip");
	}
	
	public function getHTML() {
		$html = curl_exec($this->curl);
		return $html;
	}

	public function getURL() {
		$last_url = curl_getinfo($this->curl, CURLINFO_EFFECTIVE_URL);
		return $last_url;
	}

	public function __destruct() {
		curl_close($this->curl);
	}
}