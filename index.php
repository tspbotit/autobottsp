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

		$replyToken = $event['replyToken'];
		$ask = $event['message']['text'];

		switch (strtolower($ask)) {
			case '1':
				# code...
			    $respMessage = 'สินค้ามีคุณภาพ';
				break;

			case '2';

			    $respMessage = 'สินค้าคุณภาพสูง';
			    break;
			default:
				$respMessage = 'คุณต้องการรู้อะไรจากเรา ถ้าต้องการรู้สินค้าคุณภาพ พิพม์ 1 ถ้า อยากรู้เกี่ยวกับสินค้าคุณภาพสูง กด สอง 2'
				break;
		}

		$httpClient = new CurlHTTPClient($channel_token);

					$bot = new LINEBot($httpClient,array('channelSecret'=>$channel_secret));

					$TextMessageBuilder = new TextMessageBuilder($respMessage);
					$respMessage=$bot->replyMessage($replyToken,$TextMessageBuilder);
		/*if($event['type']=="message"){
			switch ($event['message']['type']) {
				case 'text':
					
					$replyToken = $event['replyToken'];

					$respMessage = 'สวัดดีครับ '.$event['message']['text'];


					$httpClient = new CurlHTTPClient($channel_token);

					$bot = new LINEBot($httpClient,array('channelSecret'=>$channel_secret));

					$TextMessageBuilder = new TextMessageBuilder($respMessage);
					$respMessage=$bot->replyMessage($replyToken,$TextMessageBuilder);
					break;
				
				
			}
		}*/

	}
}

?>
