<?php
	session_start();
	include 'class3.php';
	$class=new mydesign;
	$class->database_connect();

	date_default_timezone_set('Asia/Manila');
	$sessiondate=date('mdY');

	if(!isset($_SESSION['session_tbcmerchant_ctr'.$sessiondate])){
		header("location: https://tbcmerchantservices.com/welcome/");
	}

	$amount=str_replace("'", '', $_REQUEST['btc_amount']);
	$amount=str_replace('"', '', $amount);
	$amount=str_replace("<", '', $amount);
	$amount=str_replace('>', '', $amount);

	$ctr=$_SESSION['session_tbcmerchant_ctr'.$sessiondate];

	$query="select Tbc_to_Peso from xtbl_adminaccount WHERE Ctr='1'";
	$rs=mysql_query($query);
	$row=mysql_fetch_array($rs);
	if($amount>0){
		$amount=$amount/$row['Tbc_to_Peso'];
		echo 'TBCMS = '.number_format($amount,8);
	}
	else {
		echo 'TBCMS = '.number_format(0,8);
	}
	
	

?>
