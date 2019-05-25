<?php
	session_start();
	include 'class.php';
	$class=new mydesign;
	$class->database_connect();
	if(isset($_REQUEST['txttbc_email_signup']) && isset($_REQUEST['txttbc_firstname_signup'])
		&& isset($_REQUEST['txttbc_lastname_signup']) && isset($_REQUEST['txttbc_referral_signup'])
		&& isset($_REQUEST['txttbc_middlename_signup']) && isset($_REQUEST['txttbc_bday_signup'])
		&& isset($_REQUEST['txttbc_cellphone_signup']) && isset($_REQUEST['txttbc_address_signup'])
		&& isset($_REQUEST['txttbc_businessname_signup']) && isset($_REQUEST['txttbc_businessdescription_signup'])
		&& isset($_REQUEST['txttbc_walletbtc_signup']) && isset($_REQUEST['txttbc_walletcoinsph_signup'])
		&& isset($_REQUEST['txttbc_walletpaypal_signup']) && isset($_REQUEST['txttbc_accountusername_signup'])
		&& isset($_REQUEST['txttbc_accountpassword_signup']) && isset($_REQUEST['txttbc_accountrepassword_signup']) ) {

		$referral=str_replace("'", '', $_REQUEST['txttbc_referral_signup']);
		$referral=str_replace('"', '', $referral);
		$referral=str_replace("<", '', $referral);
		$referral=str_replace('>', '', $referral);

		$email=str_replace("'", '', $_REQUEST['txttbc_email_signup']);
		$email=str_replace('"', '', $email);
		$email=str_replace("<", '', $email);
		$email=str_replace('>', '', $email);

		$lname=str_replace("'", '', $_REQUEST['txttbc_lastname_signup']);
		$lname=str_replace('"', '', $lname);
		$lname=str_replace("<", '', $lname);
		$lname=str_replace('>', '', $lname);

		$fname=str_replace("'", '', $_REQUEST['txttbc_firstname_signup']);
		$fname=str_replace('"', '', $fname);
		$fname=str_replace("<", '', $fname);
		$fname=str_replace('>', '', $fname);

		$mname=str_replace("'", '', $_REQUEST['txttbc_middlename_signup']);
		$mname=str_replace('"', '', $mname);
		$mname=str_replace("<", '', $mname);
		$mname=str_replace('>', '', $mname);

		$bday=str_replace("'", '', $_REQUEST['txttbc_bday_signup']);
		$bday=str_replace('"', '', $bday);
		$bday=str_replace("<", '', $bday);
		$bday=str_replace('>', '', $bday);

		$cell=str_replace("'", '', $_REQUEST['txttbc_cellphone_signup']);
		$cell=str_replace('"', '', $cell);
		$cell=str_replace("<", '', $cell);
		$cell=str_replace('>', '', $cell);

		$address=str_replace("'", '', $_REQUEST['txttbc_address_signup']);
		$address=str_replace('"', '', $address);
		$address=str_replace("<", '', $address);
		$address=str_replace('>', '', $address);

		$bname=str_replace("'", '', $_REQUEST['txttbc_businessname_signup']);
		$bname=str_replace('"', '', $bname);
		$bname=str_replace("<", '', $bname);
		$bname=str_replace('>', '', $bname);

		$bdesc=str_replace("'", '', $_REQUEST['txttbc_businessdescription_signup']);
		$bdesc=str_replace('"', '', $bdesc);
		$bdesc=str_replace("<", '', $bdesc);
		$bdesc=str_replace('>', '', $bdesc);

		$bcategory=str_replace("'", '', $_REQUEST['txttbc_businesscategory_signup']);
		$bcategory=str_replace('"', '', $bcategory);
		$bcategory=str_replace("<", '', $bcategory);
		$bcategory=str_replace('>', '', $bcategory);

		$bcountry=str_replace("'", '', $_REQUEST['txttbc_businesscountry_signup']);
		$bcountry=str_replace('"', '', $bcountry);
		$bcountry=str_replace("<", '', $bcountry);
		$bcountry=str_replace('>', '', $bcountry);

		$btcwallet=str_replace("'", '', $_REQUEST['txttbc_walletbtc_signup']);
		$btcwallet=str_replace('"', '', $btcwallet);
		$btcwallet=str_replace("<", '', $btcwallet);
		$btcwallet=str_replace('>', '', $btcwallet);

		$coinphwallet=str_replace("'", '', $_REQUEST['txttbc_walletcoinsph_signup']);
		$coinphwallet=str_replace('"', '', $coinphwallet);
		$coinphwallet=str_replace("<", '', $coinphwallet);
		$coinphwallet=str_replace('>', '', $coinphwallet);

		$paypalwallet=str_replace("'", '', $_REQUEST['txttbc_walletpaypal_signup']);
		$paypalwallet=str_replace('"', '', $paypalwallet);
		$paypalwallet=str_replace("<", '', $paypalwallet);
		$paypalwallet=str_replace('>', '', $paypalwallet);

		$username=str_replace("'", '', $_REQUEST['txttbc_accountusername_signup']);
		$username=str_replace('"', '', $username);
		$username=str_replace("<", '', $username);
		$username=str_replace('>', '', $username);

		$password=str_replace("'", '', $_REQUEST['txttbc_accountpassword_signup']);
		$password=str_replace('"', '', $password);
		$password=str_replace("<", '', $password);
		$password=str_replace('>', '', $password);

		$repassword=str_replace("'", '', $_REQUEST['txttbc_accountrepassword_signup']);
		$repassword=str_replace('"', '', $repassword);
		$repassword=str_replace("<", '', $repassword);
		$repassword=str_replace('>', '', $repassword);

    $test=str_replace("'", '', $_REQUEST['txttbc_test']);

		if(0==1)
		{

			$email_activation_key = md5($email .$username);
			$query="insert into xtbl_account_info(Main_Ctr, Username, Password, Crypt_Id, Email_Status, Account_Type, Account_Status, Card_Status, email_verification) values('1111',
				'test', 'password', '000000','INACTIVE','MERCHANT','INACTIVE','INACTIVE','$email_activation_key')";
			$rs=@mysql_query($query);
			$new_ctr = 1111;

			date_default_timezone_set('Asia/Manila');
			$sessiondate=date('mdY');
			$_SESSION['session_tbcmerchant_ctr'.$sessiondate]=$new_ctr;
			$_SESSION['test'] = $test;
			$code=md5(md5($email).md5($username));
			ini_set( 'display_errors', 1 );
				error_reporting( E_ALL );
				$from = "TBCMerchantServices<automail@tbcmerchantservices.com>";
				$subject = "Email Verification";
				$message = "<html><body>Dear ".$fname.",
				<br>Welcome to TBC Merchant Services<br>Please follow the link below to verify your email address. <br>
				<a href=https://tbcmerchantservices.com/activation.php?key=".$email_activation_key.">
				https://tbcmerchantservices.com/activation.php?key=".$email_activation_key."</a></body></html>";
				$headers = "From:" . $from. "\r\n";
				$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
				mail($email,$subject,$message, $headers);
			#mail('urfren.samson@gmail.com',$subject,$message, $headers);
			#mail('accounts@tbcmerchantservices.com',$subject,$message, $headers);
				echo '?email='.$email;



		}
		else {

			$query="select * from xtbl_account_info where Crypt_Id='$referral'";
			$rs=mysql_query($query);
			$rows=mysql_num_rows($rs);

			$query2="select * from xtbl_account_info";
			$rs2=mysql_query($query2);
			$rows2=mysql_num_rows($rs2);

			if($rows2==0){$rows=1; $referral='8088000000000001';}

			if($rows==0) {echo 'error1'; } // referral not found
			else {

				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { echo 'error2';}//invalid email format
				else{
					$query="select * from xtbl_main_info where Email='$email'";
					$rs=mysql_query($query);
					$rows=mysql_num_rows($rs);

					if($rows==1) {echo 'error3';} //email not available
					else {
						if(empty($lname)) {echo 'error4';} //lastname empty
						else if(empty($fname)) {echo 'error5';} //firstname empty
						else if(empty($bday)) {echo 'error6';} //date empty
						else if(empty($cell)) {echo 'error7';} //cell empty
						else if(empty($address)) {echo 'error8';} //address empty
						else if(empty($btcwallet)) {echo 'error13';} //btc empty
						else if(empty($coinphwallet)) {echo 'error14';} //coinph empty
						else if(empty($paypalwallet)) {echo 'error15';} //paypal empty
						else if(!filter_var($paypalwallet, FILTER_VALIDATE_EMAIL)) {echo 'error16';} //paypal email format
						else if(empty($username)) {echo 'error17';} //username empty
						else if(empty($password)) {echo 'error18';} //password empty
						else if($repassword!=$password) {echo 'error19';} //password mismatch
						else {

							$query="select * from xtbl_account_info where Username='$username'";
							$rs=mysql_query($query);
							$rows=mysql_num_rows($rs);

							if($rows==1){ echo 'error20';} //username not available
							else {
								if (isset($_REQUEST['txttbc_signasmerchantornot_signup'])) { //if merchant

									if(empty($bname)) {echo 'error9';} //businessname empty
										else if(empty($bdesc)){ echo 'error10';} //business description empty
									else if(empty($bcategory)){ echo 'error11';} //business category empty
									else if(empty($bcountry)){ echo 'error12';} //business country empty
									else{

										$query="insert into xtbl_main_info(Sponsor_Id, Email, Business_Name, Business_Category, Description, Country) values('$referral','$email', '$bname','$bcategory',
											'$bdesc','$bcountry')";
										$rs=@mysql_query($query);
										$new_ctr = mysql_insert_id();

										$pass=md5(md5($password).md5($username));
										$querytrtr="select * from xtbl_account_info";
										$rstrtr=mysql_query($querytrtr);
										$rowstrtr=mysql_num_rows($rstrtr)+1;

										$cID='80880'.(10000000000+$new_ctr);
										$cID='808800'.$cID[6].$cID[7].$cID[8].$cID[9].$cID[10].$cID[11].$cID[12].$cID[13].$cID[14].$cID[15].$cID[16];
										if($rs) {
											$email_activation_key = md5($email .$username);
											$query="insert into xtbl_account_info(Main_Ctr, Username, Password, Crypt_Id, Email_Status, Account_Type, Account_Status, Card_Status, email_verification) values('$new_ctr',
												'$username', '$pass', '$cID','INACTIVE','MERCHANT','INACTIVE','INACTIVE','$email_activation_key')";
											$rs=@mysql_query($query);

											if($rs) {
												$query="insert into xtbl_personal(Main_Ctr, Lname, Fname, Mname, Birthday, Address, Cellphone, Btc_Account, Coinsph_Account, Paypal_Email) values('$new_ctr','$lname','$fname', '$mname', '$bday', '$address', '$cell', '$btcwallet', '$coinphwallet', '$paypalwallet')";
												$rs=@mysql_query($query);
												if($rs) {

													$newtable="CREATE TABLE xtbl_mytransaction".$new_ctr." (
														Ctr BIGINT(15) AUTO_INCREMENT PRIMARY KEY,
														Amount decimal(16,8) NOT NULL,
														Status VARCHAR(100) NOT NULL,
														Transact_Id TEXT NOT NULL,
														Type VARCHAR(100) NOT NULL,
														Date datetime NOT NULL)
													";

													if(mysql_query($newtable)) {
														//TODO fix message
														date_default_timezone_set('Asia/Manila');
														$sessiondate=date('mdY');
														$_SESSION['session_tbcmerchant_ctr'.$sessiondate]=$new_ctr;
														$code=md5(md5($email).md5($username));
														ini_set( 'display_errors', 1 );
													    error_reporting( E_ALL );
													   	$from = "TBCMerchantServices<automail@tbcmerchantservices.com>";
													   	$subject = "Email Verification";
	                            // $message = "<html><body>Dear ".$fname.", <br>Welcome to TBC Merchant Services<br>
															// code for TBC Merchant Services is: ".$code."<br>Your Username is: ".$username."<br>Your Password is: ".$password."</body></html>";
															$message = "<html><body>Dear ".$fname.",
															<br>Welcome to TBC Merchant Services<br>Please follow the link below to verify your email address. <br>
															<a href=https://tbcmerchantservices.com/activation.php?key=".$email_activation_key.">
															https://tbcmerchantservices.com/activation.php?key=".$email_activation_key."</a></body></html>";
															$headers = "From:" . $from. "\r\n";
	                            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
													    mail($email,$subject,$message, $headers);

															$message2 = "<html><body>
															Customer registration <br>
															Name : ".$lname .", " . $fname ." <br>
															Username : ".$username." <br>
															Email : ".$email."<br>";

															mail('tbcmsapp@gmail.com',"Customer registration ". $subject,$message2, $headers);
															mail('accounts@tbcmerchantservices.com',$subject,$message2, $headers);

														echo '?email='.$email;
													}

												}
												else { echo 'error21';} //cannot connect
											}
										}
									}
								}
								else { //if buyer
									$query="insert into xtbl_main_info(Sponsor_Id, Email, Business_Name, Business_Category, Description, Country) values('$referral','$email', '$bname','$bcategory',
											'$bdesc','$bcountry')";
									$rs=@mysql_query($query);
									$new_ctr = mysql_insert_id();

									$pass=md5(md5($password).md5($username));
									$querytrtr="select * from xtbl_account_info";
									$rstrtr=mysql_query($querytrtr);
									$rowstrtr=mysql_num_rows($rstrtr)+1;

									$cID='80880'.(10000000000+$new_ctr);
									$cID='808800'.$cID[6].$cID[7].$cID[8].$cID[9].$cID[10].$cID[11].$cID[12].$cID[13].$cID[14].$cID[15].$cID[16];

									if($rs) {
										//TODO add email_verification
										$email_activation_key = md5($email .$username);
										$query="insert into xtbl_account_info(Main_Ctr, Username, Password, Crypt_Id, Email_Status, Account_Type, Account_Status, Card_Status, email_verification) values('$new_ctr',
												'$username', '$pass', '$cID','INACTIVE','BUYER','INACTIVE','INACTIVE','$email_activation_key')";
										$rs=@mysql_query($query);

										if($rs) {
											$query="insert into xtbl_personal(Main_Ctr, Lname, Fname, Mname, Birthday, Address, Cellphone, Btc_Account, Coinsph_Account, Paypal_Email) values('$new_ctr','$lname','$fname', '$mname', '$bday', '$address', '$cell', '$btcwallet', '$coinphwallet', '$paypalwallet')";
											$rs=@mysql_query($query);
											if($rs) {
													$newtable="CREATE TABLE xtbl_mytransaction".$new_ctr." (
														Ctr BIGINT(15) AUTO_INCREMENT PRIMARY KEY,
														Amount decimal(16,8) NOT NULL,
														Status VARCHAR(100) NOT NULL,
														Transact_Id TEXT NOT NULL,
														Type VARCHAR(100) NOT NULL,
														Date datetime NOT NULL)
													";

													if(mysql_query($newtable)) {
														//TODO fix message
														date_default_timezone_set('Asia/Manila');
														$sessiondate=date('mdY');
														$_SESSION['session_tbcmerchant_ctr'.$sessiondate]=$new_ctr;
														$code=md5(md5($email).md5($username));
														ini_set( 'display_errors', 1 );
													    error_reporting( E_ALL );
													   	$from = "TBCMerchantServices<automail@tbcmerchantservices.com>";
													   	$subject = "Email Verification";
													    // $message = "<html><body>Dear ".$fname.", <br>Welcome to TBC Merchant Services<br>Your Validationcode for TBC Merchant Services is: ".$code."<br>Your Username is: ".$username."<br>Your Password is: ".$password."</body></html>";
															$message = "<html><body>Dear ".$fname.",
																<br>Welcome to TBC Merchant Services<br>Please follow the link below to verify your email address. <br>
															<a href=https://tbcmerchantservices.com/activation.php?key=".$email_activation_key.">
															https://tbcmerchantservices.com/activation.php?key=".$email_activation_key."</a></body></html>";
															$headers = "From:" . $from. "\r\n";
	                            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

													    mail($email,$subject,$message, $headers);
															// Welcome to TBC Merchant Services. Please reply the words 'ACTIVATE' to this email to verify your email address.

															$message2 = "<html><body>
															Customer registration <br>
															Name : ".$lname .", " . $fname ." <br>
															Username : ".$username." <br>
															Email : ".$email."<br>";

															mail('tbcmsapp@gmail.com',"Customer registration ". $subject,$message2, $headers);
															mail('accounts@tbcmerchantservices.com',$subject,$message2, $headers);


														echo '?email='.$email;
													}
												}
											else { echo 'error21';} //cannot connect
										}
									}
								}
							}
						}
					}
				}

			}
		}


	}


	mysql_close();

?>
