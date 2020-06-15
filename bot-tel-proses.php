<?php
if (!defined('RA')) {
	die('Tidak dapat diakses langsung.');
}

function prosesApiMessage($sumber)
{
    if (isset($sumber['message'])) {
        $message = $sumber['message'];

        if (isset($message['text'])) {
            prosesPesanTeks($message);
        }
    }

    if (isset($sumber['callback_query'])) {
        prosesCallBackQuery($sumber['callback_query']);
    }

    return $updateid;
}

function prosesPesanTeks($message)
{
	$pesan = $message['text'];
	$chatid = $message['chat']['id'];
    $fromid = $message['from']['id'];
    $fromname = $message['from']['first_name'];

    switch (true) {
    	case $pesan == '/start':
    		$text = "Halo ".$fromname."!\nRobot berhasil mengeksekusi!\n\nSilakan untuk mengembangkan sendiri 😊";
    		sendApiMsg($chatid, $text, 'Markdown');
    		break;
    	
    	default:
    		$text = "Mohon maaf, perintah yang anda kirimkan tidak ada 🙏";
    		sendApiMsg($chatid, $text, 'Markdown');
    		break;
    }
}