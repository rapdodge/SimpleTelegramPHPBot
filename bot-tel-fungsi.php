<?php
if (!defined('RA')) {
	die('Tidak dapat diakses langsung.');
}

function apiRequest($method, $data)
{
	if (!is_string($method)) {
		error_log("Nama method harus bertipe string!\n");
		return false;
	}

	if (!$data) {
		$data = [];
	} elseif (!is_array($data)) {
		error_log("Data harus bertipe array\n");
		return false;
	}

	$url = 'https://api.telegram.org/bot'.$GLOBALS['token'].'/'.$method;
	$options = [
		'http' => [
			'header' => "Content-type: application/x-www-form-urlencoded\r\n",
			'method' => 'POST',
			'content' => http_build_query($data),
		],
	];
	$context = stream_context_create($options);
	$result = file_get_contents($url, false, $context);
	return $result;
}

function sendApiMsg($chatid, $text, $parse_mode = false, $msg_reply_id = false, $disablepreview = true)
{
	$method = 'sendMessage';
	$data = [
		'chat_id' => $chatid,
		'text' => $text
	];

	if ($parse_mode) {
		$data['parse_mode'] = $parse_mode;
	}
	if ($disablepreview) {
		$data['disable_web_page_preview'] = $disablepreview;
	}
	if ($msg_reply_id) {
		$data['reply_to_message_id'] = $msg_reply_id;
	}

	$result = apiRequest($method, $data);
}