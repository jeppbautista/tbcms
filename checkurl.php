<?php
	session_start();
	include 'class.php';
	$class=new mydesign;
	$class->database_connect();

	if(isset($_REQUEST['txttbc_referral_signup']) ) {
		$referral=str_replace("'", '', $_POST['txttbc_referral_signup']);
		$referral=str_replace('"', '', $referral);
		$referral=str_replace("<", '', $referral);
		$referral=str_replace('>', '', $referral);

		$query="select Crypt_Id from xtbl_account_info where Password='$referral'";
		$rs=mysql_query($query);
		$rows=mysql_num_rows($rs);
		$row=mysql_fetch_assoc($rs);
		if($rows==1){
			$_SESSION['thereferralcode']=$referral;
			echo $row['Crypt_Id'];
		}
		else {
			echo '8088000000000001';
		}
	}

	mysql_close();

?>