<?php

function prettyDump($obj)
{
	# A prettier version of var_dump
	echo "<pre>" . var_export($obj, true) . "</pre>";
}