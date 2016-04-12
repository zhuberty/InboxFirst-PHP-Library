<?php
/*
	Author: Zachary J. Huberty
	Date: April 12, 2016
	
	Introduction:
		This package takes the most essential API calls from InboxFirst
		and packages them neatly so that the developer can integrate the
		API into his/her applications more easily. 
*/

namespace InboxFirst;

# Load Configuration file, if it exists
include("config.php");

# Check if the API Key and Organization ID are defined
if ( ! (defined(API_KEY) && defined(ORG_ID)) )
{
	# If they are not defined, set a generic default value,
	# this should make error handling more elegant.
	@define("API_KEY", "");
	@define("ORG_ID", 0);
}

# Load the rest of the modules
require("includes/Utilities.php");
require("includes/Subscribers.php");
require("includes/MailingLists.php");
require("includes/CustomFields.php");
require("includes/Campaigns.php");
require("includes/Users.php");
require("includes/InboxFirstRequest.php");

//Subscribers\create_subscriber(2677, "test@test.com");

