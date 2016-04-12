<?php

// set up service url
$serviceUrl = "http://if.inboxfirst.com/ga/api/v2/mailing_lists";

// set up header fields
$header_fields = array(
	"Accept" => "*/*",
	"User-Agent" => $_SERVER['HTTP_USER_AGENT'],
	"Content-Type" => "application/json"
);

// initialize cURL
$curl = curl_init($serviceUrl);

// set cURL options
curl_setopt($curl, CURLOPT_HTTPHEADER, $header_fields);
curl_setopt($curl, CURLOPT_USERPWD, "475:a73074e968c4caa09ebbb80f4029939b3c5034b2");
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// get response
$curl_response = curl_exec($curl);

// Check if any error occurred
if(!curl_errno($curl))
{
 $info = curl_getinfo($curl);

 echo 'Took ' . $info['total_time'] . ' seconds to send a request to ' . $info['url'];
}else {
	echo curl_errno($curl) . ": " . curl_error($curl);
}

// close connection
curl_close($curl);

// display result
echo "<br />" . $curl_response;
?>