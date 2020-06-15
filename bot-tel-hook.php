<?php
define('RA', true);

require_once 'bot-tel-config.php';
require_once 'bot-tel-fungsi.php';
require_once 'bot-tel-proses.php';

$entityBody = file_get_contents('php://input');
$message = json_decode($entityBody, true);
prosesApiMessage($message);