<?php
namespace InboxFirst;
class InboxFirstRequest {
	
	public static function get_header_fields($content_length)
	{
		# These fields will be used in every cURL request
		$header_fields = array(
			"Accept" => "*/*",
			"User-Agent" => $_SERVER['HTTP_USER_AGENT'],
			"Content-Type" => "application/json",
			"Content-Length" => $content_length
		);
		
		return $header_fields;
	}
	
	public static function send_request($url, $fields)
	{
		$curl = curl_init($url);
		
		# Stringify arrays for transport
		$fields_string = json_encode($fields);
		
		# Get header fields
		$fields_strlen = strlen($fields_string);
		$header_fields = InboxFirstRequest::get_header_fields($fields_strlen);
		
		# Set the number of POST vars, POST data, options		
		curl_setopt($curl, CURLOPT_POST, count($fields));
		curl_setopt($curl, CURLOPT_POSTFIELDS, $fields_string);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header_fields);
		curl_setopt($curl, CURLOPT_USERPWD, ORG_ID . ":" . API_KEY);
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
	}
}