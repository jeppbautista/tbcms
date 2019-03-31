<?php
	function isLocalhost($whitelist = ['127.0.0.1', '::1']) {
		return in_array($_SERVER['REMOTE_ADDR'], $whitelist);
	}

	if(isLocalhost()==true)
	{
		header("location: maintenance.php");
	}
	else
	{
		header("location: https://tbcmerchantservices.com/welcome/");
	}

	
?>