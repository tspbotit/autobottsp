<?php 
require_once('../vendor/autoload.php');

use \LINE\LINEBot\HTTPCLIENT\CurlHTTPClient;
use \LINE\LINEBot;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;


$channel_token='';

$channel_secret='';

$content = file_get_contents('php://input');

$events = json_decode($content,true);

if(!is_null($events['events'])){
	foreach ($events['events'] as $event) {
		if($event['type']=="message"){
			switch ($event['message']['type']) {
				case 'text':
					
					$replyToken = $event['replyToken'];

					$respMessage = 'Hello ,you '.$event['message']['text'];


					$httpClient = new CurlHTTPClient($channel_token);

					$bot = new LINEBot($httpClient,array('channelSecret'=>$channel_secret));

					$TextMessageBuilder = new TextMessageBuilder($respMessage);
					$respMessage=$bot->replyMessage($replyToken,$TextMessageBuilder);
					break;
				
				
			}
		}
	}
}

?>
