<?php
	session_start();
	include 'class3.php';
	$class=new mydesign;
	$class->database_connect();

	date_default_timezone_set('Asia/Manila');
	$sessiondate=date('mdY');
	if(!isset($_SESSION['session_tbcmerchant_ctr'.$sessiondate])){
		echo '<script>window.location.assign("https://tbcmerchantservices.com/welcome/");</script>';
	}

	$ctr=$_SESSION['session_tbcmerchant_ctr'.$sessiondate];

	$query="select * from xtbl_adminaccount";
	$rs=mysql_query($query);
	$row=mysql_fetch_assoc($rs);
	$our_btc=$row['BTC'];
	$our_coinsph=$row['CoinPH'];
	$our_paypal=$row['Paypal'];
	$tbc_to_peso=$row['Tbc_to_Peso'];

	$query="select * from xtbl_account_info WHERE Main_Ctr='$ctr'";
	$rs=mysql_query($query);
	$row=mysql_fetch_assoc($rs);
	$email_status=$row['Email_Status'];
	$account_type=$row['Account_Type'];
	$account_status=$row['Account_Status'];
	$card_status=$row['Card_Status'];
	$username=$row['Username'];
	$activation_amount=0;
	$account_addressyou=$row['Crypt_Id'];
	if($account_type=='MERCHANT') {$activation_amount=2500;}
	else {$activation_amount=1500;}
	$activition_tbc_amount=$activation_amount/$tbc_to_peso;

	$query="select * from xtbl_main_info WHERE Ctr='$ctr'";
	$rs=mysql_query($query);
	$row=mysql_fetch_assoc($rs);
	$current_email=$row['Email'];
	$business_logo=$row['Business_Logo'];
	$business_name=$row['Business_Name'];
	$business_category=$row['Business_Category'];
	$business_description=$row['Description'];
	$business_country=$row['Country'];

	$query="select * from xtbl_personal WHERE Main_Ctr='$ctr'";
	$rs=mysql_query($query);
	$row=mysql_fetch_assoc($rs);
	$fullname=$row['Fname'].' '.$row['Lname'];
	$lastname=$row['Lname'];
	$firstname=$row['Fname'];
	$middlename=$row['Mname'];
	$birthday=$row['Birthday'];
	$cellphone=$row['Cellphone'];
	$address=$row['Address'];
	$profile_image=$row['Profile_Image'];

	if($email_status=='INACTIVE' || $account_status=='INACTIVE' || $card_status=='INACTIVE'){
		header("location: https://tbcmerchantservices.com/home/");
	}
	else {
		$class->doc_type();
		$class->html_start('');
			$class->head_start();
				echo '<link rel="shortcut icon" type="image/x-icon" href="https://tbcmerchantservices.com/images/tbslogo.png" />';
				$class->title_page('TBCMS-'.$username);
				$class->script('https://tbcmerchantservices.com/js/jquery-3.1.1.js');
				$class->script('https://tbcmerchantservices.com/js/bootstrap.js');
				$class->link('https://tbcmerchantservices.com/css/bootstrap.css');
				$class->script('https://tbcmerchantservices.com/js/jquery1.5.js');
			$class->head_end();
			$class->body_start('');
			if($account_type=='MERCHANT') {
				$class->page_home_header_start();
					$class->page_home2_header_content();
				$class->page_home_header_end();
			}
			else { //if buyer
				$class->page_home_header_start();
					$class->page_home3_header_content();
				$class->page_home_header_end();
			}
			echo '<input hidden id="inputtbctophp" value="'.$tbc_to_peso.'"/>';
			
			echo '<div class="container"><h3>Welcome back,  <b>'.$current_email.'</b></h3></div>';

			$mquery="select * from xtbl_btcadd where Ctr='".$ctr."'";
			$mrs=mysql_query($mquery);
			$mrow=mysql_fetch_assoc($mrs);

			$url="https://api.blockcypher.com/v1/btc/main/addrs/".$mrow['Address']."/balance";
			echo '<form hidden id="urlblockchain"><input hidden name="urlblockchaini" /></form>';
	
			if($mrow['Address']=='' || $mrow['Address']==null) {
				//echo '<div class="container"><h3>PLEASE WAIT UNTIL ADMIN ALLOWS YOU TO ACTIVATE. THIS WILL SHOW 48 to 72HRS.</h3><div class="container">';
echo '<div><center>Please Deposit 0.003 BTC Admin Fee to the Bitcoin Address Below as a 
                       support to TBCMS<br/>Deposit 0.003 BTC to <b>3A9qBQkV9tu3zQ7cDosenG5ev3TyJ56CfG</b></center></div>';
			}
			else {
				echo '<script> urlblockchain("'.$url.'");</script><br>';
			}
			



                        echo '<div  id="exchangecontent"></div>';
                        
/*
                       echo '<div>Please Deposit 0.003 BTC Admin Fee to the Bitcoin Address Below as a 
                       support to TBCMS<br/>3A9qBQkV9tu3zQ7cDosenG5ev3TyJ56CfG</div>';*/

			echo '<div class="container" id="myexchanges"></div>';
			$class->page_welcome_header_content_start_footer();

			$class->body_end();	
		$class->html_end();
	}

?>







































