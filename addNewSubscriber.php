<?php
/*
	Author: Zachary J. Huberty
	Date: April 11, 2016
	This will subscribe a user to an InboxFirst Mailing List.
	Good Luck, ProsperGroup.
*/

$organization_id = 0; # Org Id found in InboxFirst Admin section
$api_key = ""; # Api Key found in InboxFirst Admin section
$mailing_list_id = 0; # MAILING LIST ID CAN BE FOUND IN THE INBOX FIRST DASHBOARD UNDER "MAILING LISTS"
$email = ""; # email address that you wish to subscribe

// set up service url
$serviceUrl = "http://if.inboxfirst.com/ga/api/v2/mailing_lists/" . $mailing_list_id . "/subscribers";

// set up header fields
$header_fields = array(
	"Accept" => "*/*",
	"User-Agent" => $_SERVER['HTTP_USER_AGENT'],
	"Content-Type" => "application/json",
	"Content-Length" => "430" # this length may need to be adjusted
);

// initialize cURL
$curl = curl_init($serviceUrl);

# create subscriber
$subscriber = array();
$subscriber["custom_fields"] = null;
$subscriber["email"] = $email;
$subscriber["status"] = "active";
$subscriber["subscribe_time"] = date('c');
$subscriber["subscribe_ip"] = null;

// set up post fields
$fields = array(
		'subscriber' => $subscriber
);

$fields_string = json_encode($fields);

//set the number of POST vars, POST data, options
curl_setopt($curl, CURLOPT_POST, count($fields));
curl_setopt($curl, CURLOPT_POSTFIELDS, $fields_string);
curl_setopt($curl, CURLOPT_HTTPHEADER, $header_fields);
curl_setopt($curl, CURLOPT_USERPWD, $organization_id . ":" . $api_key);
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// get response
$curl_response = curl_exec($curl);

// Check if any error occurred
if(!curl_errno($curl))
{
	$info = curl_getinfo($curl);

	echo 'Took ' . $info['total_time'] . ' seconds to send a request to ' . $info['url'];
	echo "<br />HTTP CODE: " . $info['http_code'];
}else {
	echo curl_errno($curl) . ": " . curl_error($curl);
}

// close connection
curl_close($curl);

// display result
echo $curl_response;
?>