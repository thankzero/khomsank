<?php
//created by Pol.Cpl khomsan khemthong
$access_token ='Jn2vamRDum7OI7RON99bpHi8u9kzgDrf7ICnW2P+xmdHN0+YVCmKlJmVn8NfQi6bzcmvI6PQ6zY35E2BOr247HnHAyOGFNk8crgz4+sjsbkFfX3NtU1Iv1KxAAV7/JbQDoHgH+GROTHDaAkzcvU6QAdB04t89/1O/w1cDnyilFU=';


// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			//source
     			$userId = $event['source']['userId'];

			// Get replyToken
			$replyToken = $event['replyToken'];
	   		$receivetext = $event['message']['text'];
			
			$processtext .= "ไง";

		 	 // Build message to reply back
	    		$messages = [
	   		'type' => 'text',
	    		'text' => $processtext
	     		];

			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
			'replyToken' => $replyToken,
			'messages' => [$messages],
			];

      $post = json_encode($data);
      $headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
      $result = curl_exec($ch);
      curl_close($ch);

      echo $result . "\r\n";


    }
  }
}
echo "OK";

?>
