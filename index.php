<?php
	include 'class.php';
	$class = new mydesign;
	if($class->isLocalhost()==true)
	{

		header("location: welcome.php");
	}
	else
	{
		header("location: https://tbcmerchantservices.com/welcome/");
	}

	
?>