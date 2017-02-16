<?php
    $packagename = $_POST['packagename'];
	$packagename = $_GET['packagename'];
	if($packagename == null && $packagename == ""){
		echo 'err';
		return;
	}
    function hashed($package) {
	$hash = '{"7cc78271-e338-4edc-849c-b105c5d51ba5":["getAppDownloadInfo","' . $package . '"' . ',19]}';
	return sha1($hash);
	}

	function do_post_request($url, $data, $optional_headers = null)
	{
		$params = array('http' => array(
			'method' => 'POST',
		'content' => $data
		));
		if ($optional_headers !== null) {
			$params['http']['header'] = $optional_headers;
		}
		$ctx = stream_context_create($params);
		$fp = @fopen($url, 'rb', false, $ctx);
		if (!$fp) {
			throw new Exception("Problem with $url, $php_errormsg");
		}
		$response = @stream_get_contents($fp);
		if ($response === false) {
			throw new Exception("Problem reading data from $url, $php_errormsg");
		}
		return $response;
	}
	function current_millis() {
    list($usec, $sec) = explode(" ", microtime());
    return round(((float)$usec + (float)$sec) * 1000);
	}
	$send = '{"id":1,"hash":"' . hashed($packagename) . '","packed":"S\/NNuBO0LXIyFIIo2UZ2gMhvQHttPoXiqAp3Z43Fz\/rUOSgphpIT+7Gx1fNYhqSm4zFG5Bx+jU1yW8\/FVZAnJAAYFf4bJuaABojX7OPQNqigm0wzRuq7b1TJuwpY0jam","iv":"mosLEvk1Ti0pNGEw0mW0tfRTuEuCoUBy\/prQyL4Xy5gujrp69k4OKHf6GxE9LLxcZjBKQuwswoxzGnMXpxwqNamE49LsP30Sd7i+ZPCT8N8uDiQos8h1kfUB02KDoPpQGsXktpEugQjxHFxoHve+25uAuU4WANND7KI\/LN3gI9A=","p2":"Cpo0+8o2CyXOlTd41Z\/3IaDOHy5ByDbmMBMRtHEVJfDvJCTgXpJFNlr7GTOZ5JMqI5jFm8xGtL9noYTiiIk5NUCDl27w3U3wXOCucTzulmLM+68Iigu4f9B2371liFsnLZr+i0IjnffAI63sQXLxh2njpfcCuKuUQneX\/LeSsqs=","p1":"aZaq4qYY32qIvnqI7svHcznKx1Pq0VuYQIpg9dCmI+2KHDRTu6hUlc7tfICcy0vn9YpSIl6vtsM1687c7As\/lSWoxYXVjQYgx2XvJko\/+vbboXZAhEnsUPaME3IQ97jGTLBsWY4ds4ZrR0iNR2uVyT+rGXiqGxaKxHgmyFwZd3E=","method":"getAppDownloadInfo","non_enc_params":"{\"device\":{\"mn\":16,\"abi\":\"x86\",\"sd\":19,\"bv\":\"7.5.1\",\"us\":{},\"ct\":\"\",\"id\":\"6cAUX_eAThCrjoUbSxgISg\",\"dd\":\"android\",\"co\":\"\",\"mc\":310,\"dm\":\"bignox\",\"do\":\"Nexus\",\"dpi\":240,\"abi2\":\"armeabi-v7a\",\"sz\":\"l\",\"dp\":\"nox\",\"pr\":\"\"},\"referer\":{\"name\":\"page_home|!EX!None_experiment|!VA!None_variation|row-0-Best New Apps and Games|0|not_initiated\"}}","params":[]}';
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'http://ad.cafebazaar.ir/json/getAppDownloadInfo');
	curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:48.0) Gecko/20100101 Firefox/48.0');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/x-www-form-urlencoded; charset=UTF-8',
    'Connection: Keep-Alive',
	'Expect:'
	));
	curl_setopt($ch, CURLOPT_POSTFIELDS, $send);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$answer = curl_exec($ch);
	if (curl_error($ch)) {
    echo curl_error($ch);
	}
	
		preg_match_all("/\"t\": \"(.*?)\"/", $answer, $matchesName);
		
	
		preg_match_all("/\"cp\": \[\"(.*?)\"\]/", $answer, $matchesAddres);
		
	$t = 0;
	foreach ($matchesName[1] as $match) {
       if (is_numeric($match))
		   $t = $match;
	}
	echo $matchesAddres[1][0] . 'apks/' . $t . '.apk?rand=' . current_millis();
?>