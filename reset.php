<?php
	session_start();
	include 'class.php';
	$class=new mydesign;
	$class->database_connect();

	date_default_timezone_set('Asia/Manila');
	$sessiondate=date('mdY');

	if(isset($_SESSION['session_tbcmerchant_ctr'.$sessiondate])){
		header("location: https://tbcmerchantservices.com/home/");
	}

	if(isset($_POST['codereset']) && isset($_POST['newpass1']) && isset($_POST['newpass2']) && isset($_POST['emailreset'])){
		$email=str_replace("'", '', $_REQUEST['emailreset']);
		$email=str_replace('"', '', $email);
		$email=str_replace("<", '', $email);
		$email=str_replace('>', '', $email);	

		$codereset=str_replace("'", '', $_REQUEST['codereset']);
		$codereset=str_replace('"', '', $codereset);
		$codereset=str_replace("<", '', $codereset);
		$codereset=str_replace('>', '', $codereset);	

		$newpass1=str_replace("'", '', $_REQUEST['newpass1']);
		$newpass1=str_replace('"', '', $newpass1);
		$newpass1=str_replace("<", '', $newpass1);
		$newpass1=str_replace('>', '', $newpass1);

		$newpass2=str_replace("'", '', $_REQUEST['newpass2']);
		$newpass2=str_replace('"', '', $newpass2);
		$newpass2=str_replace("<", '', $newpass2);
		$newpass2=str_replace('>', '', $newpass2);	

		$query="select * from xtbl_main_info where Email='$email'";
		$rs=mysql_query($query);
		$row=mysql_fetch_assoc($rs);
		$ctr=$row['Ctr'];

		$query="select * from xtbl_account_info where Main_Ctr='$ctr'";
		$rs=mysql_query($query);
		$row=mysql_fetch_assoc($rs);
		$username=$row['Username'];

		if(md5(md5($email).md5($email))==$codereset && $newpass1==$newpass2){
			$pass=md5(md5($newpass1).md5($username));
			$query="update xtbl_account_info set Password='$pass' WHERE Main_Ctr='$ctr'";
			$rs=@mysql_query($query);

         ini_set( 'display_errors', 1 );
		    error_reporting( E_ALL );
		    $code=md5(md5($email).md5($email));
		   	$from = "TBCMerchantServices<automail@tbcmerchantservices.com>";
		   	$subject = "New Password";
		    $message = "Your New Password is ".$newpass1;
		    $headers = "From:" . $from;
		    mail($email,$subject,$message, $headers);
                //mail('urfren.samson@gmail.com',$subject,$message, $headers);

			if($rs) { header("location: https://tbcmerchantservices.com/welcome/");}
			else{header("location: https://tbcmerchantservices.com/reset");}
		}
	}

	if(isset($_POST['emailreset'])){
		$email=str_replace("'", '', $_REQUEST['emailreset']);
		$email=str_replace('"', '', $email);
		$email=str_replace("<", '', $email);
		$email=str_replace('>', '', $email);

		$query="select * from xtbl_main_info where Email='$email'";
		$rs=mysql_query($query);
		$rows=mysql_num_rows($rs);
		//echo md5(md5($email).md5($email));

		if($rows==1){
			ini_set( 'display_errors', 1 );
		    error_reporting( E_ALL );
		    $code=md5(md5($email).md5($email));
		   	$from = "TBCMerchantServices<automail@tbcmerchantservices.com>";
		   	$subject = "Password Reset";
		    $message = "Your Password Reset Code is ".$code;
		    $headers = "From:" . $from;
		    mail($email,$subject,$message, $headers);	

		    $class->doc_type();
			$class->html_start('');
				$class->head_start();
					echo '<link rel="shortcut icon" type="image/x-icon" href="https://tbcmerchantservices.com/images/tbslogo.png" />';
					$class->title_page('TBC Merchant Services');
					$class->script('https://tbcmerchantservices.com/js/jquery-3.1.1.js');
					$class->script('https://tbcmerchantservices.com/js/bootstrap.js');
					$class->link('https://tbcmerchantservices.com/css/bootstrap.css');

				$class->head_end();
				$class->body_start('');	
					$class->page_welcome_header_start();
						$class->page_welcome_header_content_signup();
					$class->page_welcome_header_end();
					?>
					<br><br><br><br><br><br>
					<div class="container" style="text-align: center;">
						<form method="POST">
							<input name="emailreset" hidden <?php echo 'value="'.$email.'"'; ?> style="width: 300px"/>
							<h4>Password Reset</h4>
							<h4>Password Reset Code</h4>
							<center><input name="codereset" class="form-control" style="width: 300px"/></center><br>
							<h4>New Password</h4>
							<center><input name="newpass1" class="form-control" style="width: 300px"/></center><br>
							<h4>Re-Enter Password</h4>
							<center><input name="newpass2" class="form-control" style="width: 300px"/></center><br>
							<input type="submit" id="submit_now2" hidden/>
							<center>
								<a href="javascript:void(0)" onclick="$('#submit_now2').click();" class="btn btn-primary">SEND</a>
							</center>
						</form>
					</div>
					<?php	
				$class->body_end();	
			$class->html_end();		
		}

		else {
			$class->doc_type();
			$class->html_start('');
				$class->head_start();
					echo '<link rel="shortcut icon" type="image/x-icon" href="https://tbcmerchantservices.com/images/tbslogo.png" />';
					$class->title_page('TBC Merchant Services');
					$class->script('https://tbcmerchantservices.com/js/jquery-3.1.1.js');
					$class->script('https://tbcmerchantservices.com/js/bootstrap.js');
					$class->link('https://tbcmerchantservices.com/css/bootstrap.css');

				$class->head_end();
				$class->body_start('');	
					$class->page_welcome_header_start();
						$class->page_welcome_header_content_signup();
					$class->page_welcome_header_end();
					?>
					<br><br><br><br><br><br>
					<div class="container" style="text-align: center; con">
						<form method="POST">
							<h4>Password Reset</h4>
							<h4>Enter your Email Address</h4>
							<h4 style="color: red">EMAIL ADDRESS NOT FOUND</h4>
							<center><input name="emailreset" class="form-control" style="width: 300px"/></center><br>
							<input type="submit" id="submit_now" hidden/>
							<center>
								<a href="javascript:void(0)" onclick="$('#submit_now').click();" class="btn btn-primary">SEND</a>
							</center>
						</form>
					</div>
					<?php	
				$class->body_end();	
			$class->html_end();		
		}
	}

	else {

		$class->doc_type();
		$class->html_start('');
			$class->head_start();
				echo '<link rel="shortcut icon" type="image/x-icon" href="https://tbcmerchantservices.com/images/tbslogo.png" />';
				$class->title_page('TBC Merchant Services');
				$class->script('https://tbcmerchantservices.com/js/jquery-3.1.1.js');
				$class->script('https://tbcmerchantservices.com/js/bootstrap.js');
				$class->link('https://tbcmerchantservices.com/css/bootstrap.css');

			$class->head_end();
			$class->body_start('');	
				$class->page_welcome_header_start();
					$class->page_welcome_header_content_signup();
				$class->page_welcome_header_end();
				?>
				<br><br><br><br><br><br>
				<div class="container" style="text-align: center; con">
					<form method="POST">
						<h4>Password Reset</h4>
						<h4>Enter your Email Address</h4>
						<center><input name="emailreset" class="form-control" style="width: 300px"/></center><br>
						<input type="submit" id="submit_now" hidden/>
						<center>
							<a href="javascript:void(0)" onclick="$('#submit_now').click();" class="btn btn-primary">SEND</a>
						</center>
					</form>
				</div>
				<?php	
			$class->body_end();	
		$class->html_end();		
	}


?>
