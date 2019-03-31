<?php
	session_start();
	if(session_destroy()) // Destroying All Sessions
	{	header("location: https://tbcmerchantservices.com/tbcmyadmin/"); // Redirecting login page
	}
?>