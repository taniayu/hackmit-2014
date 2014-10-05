<?php
	
	require_once('lib/OAuth.php');

	$CONSUMER_KEY = 'TJf85WhSp3LISZwRzuYYag';
	$CONSUMER_SECRET = '5EDPihUeN40tcUu9vkusIzNoXZw';
	$TOKEN = '7WM3dg7EQgP8UBfy4Irn45edHDmHHUZ4';
	$TOKEN_SECRET = 'R36XhAPl4iPmOPcGDdEUA4LIsNM';

	$API_HOST = 'api.yelp.com';
	$DEFAULT_TERM = 'dinner';
	$DEFAULT_LOCATION = 'San Francisco, CA';
	$SEARCH_LIMIT = 3;
	$SEARCH_PATH = '/v2/search/';
	$BUSINESS_PATH = '/v2/business/';

	function request($host, $path) {
		$unsigned_url = "http://" . $host . $path;
		// Token object built using the OAuth library
		$token = new OAuthToken($GLOBALS['TOKEN'], $GLOBALS['TOKEN_SECRET']);
		// Consumer object built using the OAuth library
		$consumer = new OAuthConsumer($GLOBALS['CONSUMER_KEY'], $GLOBALS['CONSUMER_SECRET']);
		// Yelp uses HMAC SHA1 encoding
		$signature_method = new OAuthSignatureMethod_HMAC_SHA1();
		$oauthrequest = OAuthRequest::from_consumer_and_token(
		$consumer,
		$token,
		'GET',
		$unsigned_url
		);
		// Sign the request
		$oauthrequest->sign_request($signature_method, $consumer, $token);
		// Get the signed URL
		$signed_url = $oauthrequest->to_url();
		// Send Yelp API Call
		$ch = curl_init($signed_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}

	function find_business($url) {
		$i = strpos($url, "biz") + 4;
		$id = substr($url, $i);
		$business_path = $GLOBALS['BUSINESS_PATH'] . $id;

		$business_info = request($GLOBALS['API_HOST'], $business_path);
		$business_name = json_decode($business_info, true)['name'];
		
		get_id($business_name);
	}

	function get_id($name) {
		require 'db.php';
		require 'get_dishes.php';

		$query = 'SELECT businessid FROM business WHERE name = ' . $name;
		$result = mysql_query($query, $db) or die(mysql_error());
		$id = mysql_fetch_assoc($result);
		getReviews($id);
	}
?>