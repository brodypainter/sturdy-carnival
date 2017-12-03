<?php

	$name = $_GET["name"];
	$endpoint = "http://8a073ae2.ngrok.io/test?name=" . $name;
	$response = getUrlContent($endpoint);
	
	echo $response;


	function getUrlContent($url) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
		curl_setopt($ch, CURLOPT_TIMEOUT, 5);
		$data = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		return ($httpcode >= 200 && $httpcode < 300) ? $data : $httpcode;
	}
?>