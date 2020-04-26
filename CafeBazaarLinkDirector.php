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
	
	$send = '{"properties":{"androidClientInfo":{"adId":"95370c51-d6f0-4d3e-9b0f-3c8810269497","province":"NA","androidId":"2c337a4143e55235","city":"NA","country":"NA","cpu":"x86","device":"","product":"SM-G925F","hardware":"","osBuild":"","locale":"","manufacturer":"samsung","model":"SM-G925F","mnc":11,"mcc":432,"height":1280,"dpi":240,"adOptOut":false,"sdkVersion":19,"width":720},"clientID":"Zx9T7Bj4QGOLdjgkN6_GIw","clientVersion":"8.9.8","isKidsEnabled":false,"clientVersionCode":800908,"language":2,"appThemeState":0},"singleRequest":{"appDownloadInfoRequest":{"referrers":[{"type":17,"extraJson":"{\"package_name\":\"' . $packagename . '\",\"service\":\"sejel\"}"}],"packageName":"' . $packagename . '","downloadStatus":1}}}';
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://api.cafebazaar.ir/rest-v1/process/AppDownloadInfoRequest');
	curl_setopt($ch, CURLOPT_USERAGENT,'okhttp/3.12.3');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json; charset=UTF-8',
    'Connection: Keep-Alive',
	'Accept-Encoding: gzip'
	));
	curl_setopt($ch, CURLOPT_POSTFIELDS, $send);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt( $ch, CURLOPT_ENCODING, "UTF-8" );
	$answer = curl_exec($ch);
	if (curl_error($ch)) {
  	 echo curl_error($ch);
	}
	// echo $answer;
	echo "Generated Link : ";
    $json = json_decode($answer);
	$name = $json->singleReply->appDownloadInfoReply->token;
	$addresses = $json->singleReply->appDownloadInfoReply->cdnPrefix;
	echo $addresses[0] . 'apks/' . $name . '.apk';

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
