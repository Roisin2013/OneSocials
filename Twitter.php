 <?php
function buildBaseString($baseURI, $method, $params) {
    $r = array();
    ksort($params);
    foreach($params as $key=>$value){
        $r[] = "$key=" . rawurlencode($value);
    }
    return $method."&" . rawurlencode($baseURI) . '&' . rawurlencode(implode('&', $r));
}

function buildAuthorizationHeader($oauth) {
    $r = 'Authorization: OAuth ';
    $values = array();
    foreach($oauth as $key=>$value)
        $values[] = "$key=\"" . rawurlencode($value) . "\"";
    $r .= implode(', ', $values);
    return $r;
}

function twitterConnect(){
	$twitterArray=array();
	$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";

	$oauth_access_token = "605686071-BYBAegsUsNDhDN4vbaloaxKVATnoNb8oi58rj4zO";
	$oauth_access_token_secret = "n2QwaJ5hL6JoqdOVQtGulQYopIpRXP5VgJGQn7BrEfc";
	$consumer_key = "Ge3BMcvnwyDdjXY3ZDWZg";
	$consumer_secret = "ErqXayBSzcypf80W2oII7imeNWNBXvXPCN1xwanYr8";

	$oauth = array( 'oauth_consumer_key' => $consumer_key,
                'oauth_nonce' => time(),
                'oauth_signature_method' => 'HMAC-SHA1',
                'oauth_token' => $oauth_access_token,
                'oauth_timestamp' => time(),
                'oauth_version' => '1.0');

	$base_info = buildBaseString($url, 'GET', $oauth);
	$composite_key = rawurlencode($consumer_secret) . '&' . rawurlencode($oauth_access_token_secret);
	$oauth_signature = base64_encode(hash_hmac('sha1', $base_info, $composite_key, true));
	$oauth['oauth_signature'] = $oauth_signature;

// Make Requests
	$header = array(buildAuthorizationHeader($oauth), 'Expect:');
	$options = array( CURLOPT_HTTPHEADER => $header,
                  //CURLOPT_POSTFIELDS => $postfields,
                  CURLOPT_HEADER => false,
                  CURLOPT_URL => $url,
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_SSL_VERIFYPEER => false);

	$feed = curl_init();
	curl_setopt_array($feed, $options);
	$json = curl_exec($feed);
	curl_close($feed);
	$data = json_decode($json);
	
    foreach ($data as $item) {     // ---- start foreach ---- 
 
	
	
	$dateString = $item->created_at;
	$date = strtotime($dateString);
	$dates = date('D d-M-Y H:i:s', strtotime($dateString));
$postItem=array("network"=>"Twitter","image"=>$item->user->profile_image_url, "name"=>$item->user->name, "text"=>$item->text, "created"=>$dates);
	array_push($twitterArray, $postItem);
	
	//print_r($item);
 
}  
	return $twitterArray;
}				
					?>