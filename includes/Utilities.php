<?php

function prettyDump($obj)
{
	echo "<pre>" . var_export($obj, true) . "</pre>";
}