<?php
	$packagename = '';
	if(isset($_POST['packagename'])){
		$packagename = $_POST['packagename'];
	}else if (isset($_GET['packagename'])){
		$packagename = $_GET['packagename'];
	}else if ($argc > 0 && isset($argv[1])){
		$packagename = $argv[1];
	}
	if($packagename == null && $packagename == ""){
		echo 'err';
		return;
	}
	
	if (preg_match("/\?id=(.+)/", $packagename)>0){
		preg_match("/\?id=(.+)/", $packagename, $mat);
		$packagename = $mat[1];
	}
	
	if (preg_match("/\/app\/(.+)\//", $packagename)>0){
		preg_match("/\/app\/(.+)\//", $packagename, $mat);
		$packagename = $mat[1];
	}
	
	$send = '{"id":1,"hash":"' . hashed($packagename) . '","packed":"xzrBQdWmJqg\/BQN+4Ll+XCuNIhYwIpWmFRH+I1wjEKfb2NwtXaU4OO6LmDY+dcNKPh6v1a2GdLYcCdZ6NliD0nbYjcglOT7OYB9fefCL5Ec=","iv":"UFDpSQCua3LwOKb8QWW4dS2PNSfMQ3ua1eWAuJY1G8xcaTS+Md+gbGMCSG3C5QJLmoiSFyOv\/QRFv6hWYsrA31ji0fGhWNGiqY9sWltqBst7YKoCqPLG0fCjoPKWPhvVhxKhjO8yT3RPalmDuPKpqGwW2fdHH+xPnuCDU51uUaE=","p2":"r7oshN8AYo64PZDDlJg8TmiEiXrrBjKlwPQITF94s\/3tKsyB1PJRJM5cD\/JZBEHK\/wWvGb\/jyj0GrOgbEMONHBoLCMR\/X6RWeC59LaItQaDk\/uY3+2cEisuBw3VCAkKL887SebW0xmB\/16rNl3LxLL5\/vgCZ4jaUvIb1dj0JEH4=","p1":"Kvn\/n9BLGkFAcpAWBQsAVbcF8SVnS6f3XGulLM\/J6a3SQOS5q8CagfCm2zbzQxHT0kRb9z90eCIBP9huKDth0Mu9JaAuNn9SiV7pBTs6C3hVlolY41W93hKPwhBfNyWCATymDnSjqcX\/KKNcKn3fvMU7zR0w9h\/WM\/sUkccX8pg=","enc_resp":false,"method":"getAppDownloadInfo","non_enc_params":"{\"device\":{\"mn\":260,\"abi\":\"x86\",\"sd\":19,\"bv\":\"7.12.2\",\"us\":{},\"cid\":0,\"lac\":0,\"ct\":\"\",\"id\":\"YGrrXv9TQkGyRwo6GaU0kw\",\"dd\":\"hlteatt\",\"co\":\"\",\"mc\":310,\"dm\":\"samsung\",\"do\":\"SAMSUNG-SM-N900A\",\"dpi\":160,\"abi2\":\"armeabi-v7a\",\"sz\":\"l\",\"dp\":\"hlteuc\",\"bc\":701202,\"pr\":\"\"},\"referer\":{\"name\":\"page_home|!EX!PaidRowTest|!VA!empty_key|referrer_slug=home|row-2-Best New Updates|3|test_group=A|not_initiated\"}}","params":[]}';
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'http://ad.cafebazaar.ir/json/getAppDownloadInfo');
	curl_setopt($ch, CURLOPT_USERAGENT,'Dalvik/1.6.0 (Linux; U; Android 4.4.2; SAMSUNG-SM-N900A Build/KOT49H)');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Connection: Keep-Alive',
	'Expect:'
	));
	curl_setopt($ch, CURLOPT_POSTFIELDS, $send);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$answer = curl_exec($ch);
	if (curl_error($ch)) {
  	 echo curl_error($ch);
	}
	echo "Generated Link : ";
    $json = json_decode($answer);
	$name = $json->result->t;
	$addresses = $json->result->cp;
	echo $addresses[0] . 'apks/' . $name . '.apk?rand=' . current_millis();
	
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
?>