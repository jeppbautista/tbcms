<?php
	session_start();
	include 'class_admin.php';
	$class=new mydesign;
	$class->database_connect();

	date_default_timezone_set('Asia/Manila');
	$sessiondate=date('mdY');

	if(!isset($_SESSION['session_tbcmerchant_ctr_myadmin'.$sessiondate])){
		header("location: https://tbcmerchantservices.com/tbcmyadmin/");
	}

	$ctr=$_SESSION['session_tbcmerchant_ctr_myadmin'.$sessiondate];
	

	if( isset($_REQUEST['markasdone1']) && isset($_REQUEST['markasdone2']) ) {

		$markasdone1=str_replace("'", '', $_REQUEST['markasdone1']);
		$markasdone1=str_replace('"', '', $markasdone1);
		$markasdone1=str_replace("<", '', $markasdone1);
		$markasdone1=str_replace('>', '', $markasdone1);

		$markasdone2=str_replace("'", '', $_REQUEST['markasdone2']);
		$markasdone2=str_replace('"', '', $markasdone2);
		$markasdone2=str_replace("<", '', $markasdone2);
		$markasdone2=str_replace('>', '', $markasdone2);

		if($markasdone1=='') {
			echo '<span>Something went wrong1</span>';
		}
		else if(md5($markasdone1.$markasdone1)!=$markasdone2) {
			echo '<span>Something went wrong2</span>';
		}
		else {
			$query="update xtbl_btc_request SET Status='CONFIRM' where Ctr='".$markasdone1."'";
			$rs=@mysql_query($query);
			if($rs) {
				echo 'success';
			}
		}

	}
	else {
		echo '<span>Something went wrong3</span>';
	}

	
?>