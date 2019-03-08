<?php

require_once($_SERVER["DOCUMENT_ROOT"] . '/Constants/Logger.Constants.php'); 


final class Logger {

	public static function getInstance() {
		static $instance = null;
		if ($instance === null) {
			$instance = new Logger(MAIN_LOG_PATH);
		}
		return $instance;
	}

	private function __construct($logPath) {
		$this->logPath = $logPath;
	} 

	private function formatString($string, $type) {
		$prefix  = '(' . date("d/m/Y") . ' | ' .  date("h:i:s") . ')';
		$suffix = ".\r\n";
		switch ($type) {
			case 1:
				$prefix = '[!] ' . $prefix . ' ';
				break;
			
			case 2:
				$prefix = '[X] ' . $prefix . ' ';
				break;

			default:
				$prefix = '[+] ' . $prefix . ' ';
				break;
		}
		$new_string = $prefix . $string . $suffix;
		return $new_string;
	}

	public function log($string, $type=0) {
		$formatted_string = $this->formatString($string, $type);
		file_put_contents($this->logPath, $formatted_string, FILE_APPEND | LOCK_EX);
	}
}