<?php

require_once($_SERVER["DOCUMENT_ROOT"] . '/Classes/Responder.php');


$responder = new Responder();
echo($responder->respond());