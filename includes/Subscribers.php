<?php
namespace InboxFirst\Subscribers;

function create_subscriber($mailing_list_id, $email, $custom_fields=null, $status="active")
{
	# set up service url
	$url = "http://if.inboxfirst.com/ga/api/v2/mailing_lists/" . $mailing_list_id . "/subscribers";

	# Create subscriber
	$subscriber = array();
	$subscriber["custom_fields"] = $custom_fields;
	$subscriber["email"] = $email;
	$subscriber["status"] = $status;
	$subscriber["subscribe_time"] = date('c');
	$subscriber["subscribe_ip"] = $_SERVER['REMOTE_ADDR'];

	# Set up post fields
	$fields = array(
			'subscriber' => $subscriber
	);
	
	# Send the request
	\InboxFirst\InboxFirstRequest::post_request($url, $fields);
}

function get_subscribers($mailing_list_id, $page_num=null, $per_page=500, $page_token=null)
{
	# set up service url
	$url = "http://if.inboxfirst.com/ga/api/v2/mailing_lists/" . $mailing_list_id . "/subscribers";

	# Set up post fields
	$args = array(
			'page' => $page_num,
			'page_token' => $page_token,
			'per_page' => $per_page
	);
	
	# Send the request
	\InboxFirst\InboxFirstRequest::get_request($url, $args);
}
