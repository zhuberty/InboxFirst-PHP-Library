<?php
namespace InboxFirst\Subscribers;

function create_subscriber($mailing_list_id, $email, $custom_fields=null, $status="active")
{
	// set up service url
	$url = "http://if.inboxfirst.com/ga/api/v2/mailing_lists/" . $mailing_list_id . "/subscribers";

	# create subscriber
	$subscriber = array();
	$subscriber["custom_fields"] = $custom_fields;
	$subscriber["email"] = $email;
	$subscriber["status"] = $status;
	$subscriber["subscribe_time"] = date('c');
	$subscriber["subscribe_ip"] = $_SERVER['REMOTE_ADDR'];

	// set up post fields
	$fields = array(
			'subscriber' => $subscriber
	);
	
	# Send the request
	\InboxFirst\InboxFirstRequest::send_request($url, $fields);
}
