<?php
	session_start();
	include 'class2.php';
	$class=new mydesign;
	$class->database_connect();

	date_default_timezone_set('Asia/Manila');
	$sessiondate=date('mdY');
	$GLOBALS['test'] = 0;

	if (isset($_GET['test'])) {
	    $GLOBALS['test'] = 1;
	}
	// else {
	// 	header("location: https://tbcmerchantservices.com/welcome/");
	// }
	// if(!isset($_SESSION['session_tbcmerchant_ctr'.$sessiondate])){
	// 	header("location: https://tbcmerchantservices.com/welcome/");
	// }
	$ctr=$_SESSION['session_tbcmerchant_ctr'.$sessiondate];

	$query="select * from xtbl_adminaccount";
	$rs=mysql_query($query);
	$row=mysql_fetch_assoc($rs);
	$our_btc='3DPzNKXwUVTU8jtzY4FRMCQ6sANfzWUUFL';
	$our_coinsph='3DPzNKXwUVTU8jtzY4FRMCQ6sANfzWUUFL';
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
	if($account_type=='MERCHANT') {$activation_amount=2500;}
	else {$activation_amount=1500;}
	$activition_tbc_amount=$activation_amount/$tbc_to_peso;

	$query="select * from xtbl_main_info WHERE Ctr='$ctr'";
	$rs=mysql_query($query);
	$row=mysql_fetch_assoc($rs);
	$current_email=$row['Email'];
	$sponsorIDv=$row['Sponsor_Id'];

	$query="select * from xtbl_personal WHERE Main_Ctr='$ctr'";
	$rs=mysql_query($query);
	$row=mysql_fetch_assoc($rs);
	$mybtc_account=$row['Btc_Account'];
	$mycoinsph_account=$row['Coinsph_Account'];
	$mypaypal_email=$row['Paypal_Email'];

	$query="select * from xtbl_admin_transaction WHERE Main_Ctr='$ctr'";
	$rs=mysql_query($query);
	$row=mysql_fetch_assoc($rs);
	$admin_transaction_id=$row['Transaction'];
	$admin_transaction_status=$row['Status'];
	$admin_transaction_type=$row['Type'];
	$trans_count=mysql_num_rows($rs);

	$query="select * from xtbl_admin_transaction2 WHERE Main_Ctr='$ctr'";
	$rs=mysql_query($query);
	$row=mysql_fetch_assoc($rs);
	$admin_transaction_id2=$row['Transaction'];
	$admin_transaction_status2=$row['Status'];
	$admin_transaction_type2=$row['Type'];
	$trans_count2=mysql_num_rows($rs);



	if(($email_status=='INACTIVE' && $account_status=='INACTIVE' && $card_status=='INACTIVE')){//--------------------------------------

		$class->doc_type();
		$class->html_start('');
		$class->head_start();
			echo '<link rel="shortcut icon" type="image/x-icon" href="https://tbcmerchantservices.com/images/tbslogo.png" />';
			$class->title_page('TBCMS-'.$username);
			$class->script('https://tbcmerchantservices.com/js/jquery-3.1.1.js');
			$class->script('https://tbcmerchantservices.com/js/bootstrap.js');
			$class->link('https://tbcmerchantservices.com/css/bootstrap.css');
			$class->script('https://tbcmerchantservices.com/js/jquery1.1.js');
		$class->head_end();
			$class->body_start('');
				$class->page_home_header_start();
					$class->page_home_header_content();
				$class->page_home_header_end();
				$error1='';
				$error2='';
				$error3='';
				$code=md5(md5($current_email).md5($username));
				if(isset($_POST['txtemail_verification_code'])) {
					$txtemail_code=str_replace("'", '', $_POST['txtemail_verification_code']);
					$txtemail_code=str_replace('"', '', $txtemail_code);
					$txtemail_code=str_replace("<", '', $txtemail_code);
					$txtemail_code=str_replace('>', '', $txtemail_code);

					if($code!=$txtemail_code){$error1='Verification Code is not correct';}
					else {
						$update_query="update xtbl_account_info SET Email_Status='ACTIVE' WHERE Main_Ctr='$ctr'";
						$update_rs=@mysql_query($update_query);
					}
				}

				if(isset($_POST['txtbtc_trans_id'])) {
					$txtbtc_trans=str_replace("'", '', $_POST['txtbtc_trans_id']);
					$txtbtc_trans=str_replace('"', '', $txtbtc_trans);
					$txtbtc_trans=str_replace("<", '', $txtbtc_trans);
					$txtbtc_trans=str_replace('>', '', $txtbtc_trans);

					$txtemail_btc_trans_id=str_replace("'", '', $_POST['txtemail_btc_trans_id']);
					$txtemail_btc_trans_id=str_replace('"', '', $txtemail_btc_trans_id);
					$txtemail_btc_trans_id=str_replace("<", '', $txtemail_btc_trans_id);
					$txtemail_btc_trans_id=str_replace('>', '', $txtemail_btc_trans_id);

					if($txtemail_btc_trans_id=="3DPzNKXwUVTU8jtzY4FRMCQ6sANfzWUUFL") {

						$query78="select * from xtbl_admin_transaction2 WHERE Transaction='$txtbtc_trans'";
						$rs78=mysql_query($query78);
						$row78=mysql_fetch_assoc($rs78);
						if(mysql_num_rows($rs78)==0){
							if($trans_count==1) { $error2='Request already sent';}
							else if($txtbtc_trans=='' || strlen($txtbtc_trans)<9){$error2='Do not submit a blank or not valid Transaction ID';}
							else{
								$btc_query="insert into xtbl_admin_transaction2(Tbc_Amount, Peso_Amount, Sender_Address, Type, Main_Ctr,
									Status, Datetime, Transaction, Remarks) values('$activition_tbc_amount', '$activation_amount',
									'$mybtc_account', 'BTC', '$ctr', 'WAITING', NOW(), '$txtbtc_trans', 'ACTIVATION')";
								$btc_rs=@mysql_query($btc_query);

								$query="select * from xtbl_admin_transaction2 WHERE Main_Ctr='$ctr'";
								$rs=mysql_query($query);
								$row=mysql_fetch_assoc($rs);
								$admin_transaction_id=$row['Transaction'];
								$admin_transaction_status=$row['Status'];
								$admin_transaction_type=$row['Type'];
								$trans_count=mysql_num_rows($rs);
								echo '<script>window.location.href = "https://tbcmerchantservices.com/home/";</script>';
							}
						}
						else{
							$error2='Transaction ID already used';
						}
					}
					else {

						$query78="select * from xtbl_admin_transaction WHERE Transaction='$txtbtc_trans'";
						$rs78=mysql_query($query78);
						$row78=mysql_fetch_assoc($rs78);
						if(mysql_num_rows($rs78)==0){
							if($trans_count==1) { $error2='Request already sent';}
							else if($txtbtc_trans=='' || strlen($txtbtc_trans)<9){$error2='Do not submit a blank or not valid Transaction ID';}
							else{
								$btc_query="insert into xtbl_admin_transaction(Tbc_Amount, Peso_Amount, Sender_Address, Type, Main_Ctr,
									Status, Datetime, Transaction, Remarks) values('$activition_tbc_amount', '$activation_amount',
									'$mybtc_account', 'BTC', '$ctr', 'WAITING', NOW(), '$txtbtc_trans', 'ACTIVATION')";
								$btc_rs=@mysql_query($btc_query);

								$query="select * from xtbl_admin_transaction WHERE Main_Ctr='$ctr'";
								$rs=mysql_query($query);
								$row=mysql_fetch_assoc($rs);
								$admin_transaction_id=$row['Transaction'];
								$admin_transaction_status=$row['Status'];
								$admin_transaction_type=$row['Type'];
								$trans_count=mysql_num_rows($rs);
								echo '<script>window.location.href = "https://tbcmerchantservices.com/home/";</script>';
							}
						}
						else{
							$error2='Transaction ID already used';
						}
					}
				}

				if(isset($_POST['txtcoinph_trans_id'])) {
					$txtcoinph_trans=str_replace("'", '', $_POST['txtcoinph_trans_id']);
					$txtcoinph_trans=str_replace('"', '', $txtcoinph_trans);
					$txtcoinph_trans=str_replace("<", '', $txtcoinph_trans);
					$txtcoinph_trans=str_replace('>', '', $txtcoinph_trans);

					$txtemail_coinph_trans_id=str_replace("'", '', $_POST['txtemail_coinph_trans_id']);
					$txtemail_coinph_trans_id=str_replace('"', '', $txtemail_coinph_trans_id);
					$txtemail_coinph_trans_id=str_replace("<", '', $txtemail_coinph_trans_id);
					$txtemail_coinph_trans_id=str_replace('>', '', $txtemail_coinph_trans_id);

					if($txtemail_coinph_trans_id=="3DPzNKXwUVTU8jtzY4FRMCQ6sANfzWUUFL") {
						$query78="select * from xtbl_admin_transaction2 WHERE Transaction='$txtcoinph_trans'";
						$rs78=mysql_query($query78);
						$row78=mysql_fetch_assoc($rs78);
						if(mysql_num_rows($rs78)==0){
							if($trans_count==1) { $error3='Request already sent';}
							else if($txtcoinph_trans=='' || strlen($txtcoinph_trans)<9){$error3='Do not submit a blank or not valid Transaction ID';}
							else{
								$coinph_query="insert into xtbl_admin_transaction2(Tbc_Amount, Peso_Amount, Sender_Address, Type, Main_Ctr,
									Status, Datetime, Transaction, Remarks) values('$activition_tbc_amount', '$activation_amount',
									'$mybtc_account', 'COINSPH', '$ctr', 'WAITING', NOW(), '$txtcoinph_trans', 'ACTIVATION')";
								$coinph_rs=@mysql_query($coinph_query);

								$query="select * from xtbl_admin_transaction2 WHERE Main_Ctr='$ctr'";
								$rs=mysql_query($query);
								$row=mysql_fetch_assoc($rs);
								$admin_transaction_id=$row['Transaction'];
								$admin_transaction_status=$row['Status'];
								$admin_transaction_type=$row['Type'];
								$trans_count=mysql_num_rows($rs);
								echo '<script>window.location.href = "https://tbcmerchantservices.com/home/";</script>';
							}
						}
						else{
							$error3='Transaction ID already used';
						}
					}
					else {
						$query78="select * from xtbl_admin_transaction WHERE Transaction='$txtcoinph_trans'";
						$rs78=mysql_query($query78);
						$row78=mysql_fetch_assoc($rs78);
						if(mysql_num_rows($rs78)==0){
							if($trans_count==1) { $error3='Request already sent';}
							else if($txtcoinph_trans=='' || strlen($txtcoinph_trans)<9){$error3='Do not submit a blank or not valid Transaction ID';}
							else{
								$coinph_query="insert into xtbl_admin_transaction(Tbc_Amount, Peso_Amount, Sender_Address, Type, Main_Ctr,
									Status, Datetime, Transaction, Remarks) values('$activition_tbc_amount', '$activation_amount',
									'$mybtc_account', 'COINSPH', '$ctr', 'WAITING', NOW(), '$txtcoinph_trans', 'ACTIVATION')";
								$coinph_rs=@mysql_query($coinph_query);

								$query="select * from xtbl_admin_transaction WHERE Main_Ctr='$ctr'";
								$rs=mysql_query($query);
								$row=mysql_fetch_assoc($rs);
								$admin_transaction_id=$row['Transaction'];
								$admin_transaction_status=$row['Status'];
								$admin_transaction_type=$row['Type'];
								$trans_count=mysql_num_rows($rs);
								echo '<script>window.location.href = "https://tbcmerchantservices.com/home/";</script>';
							}
						}
						else{
							$error3='Transaction ID already used';
						}
					}
				}

				if(isset($_POST['txtpaypal_trans_id'])) {
					$txtpaypal_trans=str_replace("'", '', $_POST['txtpaypal_trans_id']);
					$txtpaypal_trans=str_replace('"', '', $txtpaypal_trans);
					$txtpaypal_trans=str_replace("<", '', $txtpaypal_trans);
					$txtpaypal_trans=str_replace('>', '', $txtpaypal_trans);

					$query78="select * from xtbl_admin_transaction WHERE Transaction='$txtpaypal_trans_id'";
					$rs78=mysql_query($query78);
					$row78=mysql_fetch_assoc($rs78);
					if(mysql_num_rows($rs78)==0){
						if($trans_count==1) { $error4='Request already sent';}
						else if($txtpaypal_trans=='' || strlen($txtpaypal_trans)<9){$error4='Do not submit a blank or not valid Transaction ID';}
						else{
							$paypal_query="insert into xtbl_admin_transaction(Tbc_Amount, Peso_Amount, Sender_Address, Type, Main_Ctr,
								Status, Datetime, Transaction, Remarks) values('$activition_tbc_amount', '$activation_amount',
								'$mybtc_account', 'PAYPAL', '$ctr', 'WAITING', NOW(), '$txtpaypal_trans', 'ACTIVATION')";
							$paypal_rs=@mysql_query($paypal_query);

							$query="select * from xtbl_admin_transaction WHERE Main_Ctr='$ctr'";
							$rs=mysql_query($query);
							$row=mysql_fetch_assoc($rs);
							$admin_transaction_id=$row['Transaction'];
							$admin_transaction_status=$row['Status'];
							$admin_transaction_type=$row['Type'];
							$trans_count=mysql_num_rows($rs);
							echo '<script>window.location.href = "https://tbcmerchantservices.com/home/";</script>';
						}
					}
					else{
						$error4='Transaction ID already used';
					}
				}

				if(isset($_POST['submit'])){
				    if(count($_FILES['upload']['name']) > 0){
				        for($i=0; $i<count($_FILES['upload']['name']); $i++) {
				        	if($i>3){}
				        	else{
					            $tmpFilePath = $_FILES['upload']['tmp_name'][$i];

					            if($tmpFilePath != ""){
					            	$endfilename=str_replace(" ", '', $_FILES["upload"]["name"][$i]);
					                $shortname = $_FILES['upload']['name'][$i];
					                $filePath = "requirements/".$ctr.md5(date('dmYHis')).$i.$endfilename;

					                $check = getimagesize($_FILES["upload"]["tmp_name"][$i]);
					                if($check !== false) {
					                	if(move_uploaded_file($tmpFilePath, $filePath)) {

																$query_req="select * from xtbl_requirements where Image='$filePath'";
																$rs_req=mysql_query($query_req);
																$rows_req=mysql_num_rows($rs_req);
																if($rows_req == 0){
																	$files[] = $shortname;
							                    $upload_query="insert into xtbl_requirements(Main_Ctr, Image) values(
							                    '$ctr', '$filePath')";
							                    $upload_rs=@mysql_query($upload_query);
																}
																echo '<script>window.location.href = "https://tbcmerchantservices.com/home/";</script>';
						                }
					                }
					          	}
					       	}
				        }
				    }

				}

				?>

				<div class="container">
					<h3>Welcome back,  <b><?php echo $current_email;?></b></h3>
					<h4>
						To fully activate your account, you should complete all the verifications and
						confirmation required by the system.
					</h4>
					<table class="table table-bordered" style="background-color: white;">
						<tr style="background-color: #33bbff; color: white">
							<td width="75%">ACTIVATIONS</td>
							<td width="25%">Status</td>
						</tr>
						<tr>
							<td width="75%">
								<h4 style="color: #00bfff">EMAIL CONFIRMATION</h4>
								Confirmation has been sent to your Email <b style="color: #990000"><?php echo $current_email;?></b>
								<hr>
							</td>
							<td width="25%">
							<?php
								if($email_status=='INACTIVE') {
									echo '<img width="50px" src="https://tbcmerchantservices.com/images/1482106270_Delete.png">
									<span style="color: red">UNCONFIRMED</span>';
								}
								else{
									echo '<img width="50px" src="https://tbcmerchantservices.com/images/1482106046_tick_16.png">
									<span style="color: green">CONFIRMED</span>';
								}
							?>
							</td>
						</tr>
						<tr>
							<td width="75%">
								<h4 style="color: #00bfff">FUND ACTIVATION</h4>
								Please send amount of <span style="color: red">0.013BTC </span>
								using any of your wallets (BTC, CoinsPH (P2,500))
								<?php
									if($account_status=='INACTIVE') {
										if($trans_count==0 && $trans_count2==0) {
											if($sponsorIDv=='8088000000000026'){
												$our_coinsph='3DPzNKXwUVTU8jtzY4FRMCQ6sANfzWUUFL';
												$our_btc='3DPzNKXwUVTU8jtzY4FRMCQ6sANfzWUUFL';
											}
								?>
											<hr>
											<h4><img src="https://tbcmerchantservices.com/images/bitcoin.png" width="80px"> </h4>
											Send Amount to our BTC Address below <span style="color: red"><?php echo $error2;?></span>
											<input class="form-control"/ readonly name="txtemail_btc_trans_id"
														 placeholder="BTC Transaction ID Here" value=<?php echo '"3DPzNKXwUVTU8jtzY4FRMCQ6sANfzWUUFL"';?> >
											<span style="font-size: 5px">&nbsp</span>
											<form method="POST">
												<div width="50%">
													<input class="form-control"/ name="txtbtc_trans_id" placeholder="BTC Transaction ID Here">
												</div><br>
												<input name="submit_btc_transact" type="submit" hidden />
												<a href="javascript:void(0)" id="btn_btc_transact" class="btn btn-primary btn-lg">SEND REQUEST</a>
											</form>

											<hr>
											<h4 hidden><img src="https://tbcmerchantservices.com/images/coinph.png" width="80px"> </h4>
											<span hidden> Send Amount to our CoinsPH Address below <span style="color: red"><?php echo $error3;?></span></span>
											<form method="POST" hidden>
											<input class="form-control"/ readonly name="txtemail_coinph_trans_id"
														  value=<?php echo '"'.$our_coinsph.'"';?> >
											<span style="font-size: 5px">&nbsp</span>

												<div width="50%">
													<input class="form-control"/ name="txtcoinph_trans_id"
														placeholder="CoinsPH Transaction ID Here">
												</div><br>
												<input name="submit_coinph_transact" type="submit" hidden />
												<a href="javascript:void(0)" id="btn_coinph_transact" class="btn btn-primary btn-lg">SEND REQUEST</a>
											</form>

											<hr>
											<h4><img src="https://tbcmerchantservices.com/images/paypal.png" width="80px"> </h4>
											Send Amount ($50) to our Paypal Address below <span style="color: red"><?php echo $error4;?></span>
											<input class="form-control"/ readonly name="txtemail_paypal_trans_id"
														  value=<?php echo '"'.$our_paypal.'"';?> >
											<span style="font-size: 5px">&nbsp</span>
											<form method="POST">
												<div width="50%">
													<input class="form-control"/ name="txtpaypal_trans_id"
														placeholder="Paypal Transaction ID Here">
												</div><br>
												<input name="submit_paypal_transact" type="submit" hidden />
												<a href="javascript:void(0)" id="btn_paypal_transact" class="btn btn-primary btn-lg">
												SEND REQUEST</a>
											</form>

								<?php
										}
										else{
								?>
											<br><span style="color: red; font-size: 15px">
											Transaction on: <?php echo $admin_transaction_type.$admin_transaction_type2; ?> <br>
											Transaction ID: <?php echo $admin_transaction_id.$admin_transaction_id2; ?> <br>
											Status : <?php echo $admin_transaction_status.$admin_transaction_status2; ?><br>
								<?php
										}
									}
								?>
							</td>
							<td width="25%">
							<?php
								if($account_status=='INACTIVE') {
									echo '<img width="50px" src="https://tbcmerchantservices.com/images/1482106270_Delete.png">
									<span style="color: red">NOT ACTIVE</span>';
								}
								else{
									echo '<img width="50px" src="https://tbcmerchantservices.com/images/1482106046_tick_16.png">
									<span style="color: green">ACTIVATED</span>';
								}
							?>
							</td>
						</tr>
						<?php
							if($account_type=='MERCHANT' || $account_type=='BUYER') {
						?>
						<tr>
							<td width="75%">
								<h4 style="color: #00bfff">CARD ACTIVATION</h4>
								Please Submit the Following Documents us for Card Activation<br>
								1 Valid ID with Picture<br>
								Proof of Billing(Latest)<br>
								A selfie holding ID <br>
								Maximum of 4 Files <br>
								<?php
									if($card_status=='INACTIVE') {
										$query_image="select * from xtbl_requirements WHERE Main_Ctr='$ctr'";
										$rs_image=mysql_query($query_image);
										$rs_imagecount=mysql_num_rows($rs_image);
										if($rs_imagecount==0) {
								?>
									<br>
									<form action="" enctype="multipart/form-data" method="post">
										<input id='upload' name="upload[]" type="file" multiple="multiple" accept="image/*"/><br>
										<input id="txtsubmit_upload" type="submit" hidden name="submit" value="Submit" />
										<a href="javascript:void(0)" onclick="$('#txtsubmit_upload').click();" id="btn_upload_requirements" class="btn btn-primary btn-lg">
												SEND IMAGES</a>
									</form><br>
									RECENT UPLOAD<br>
								<?php
										}
										else {
											echo '<b>VERIFYING, PLEASE WAIT (1-3 working days)...<br></b>';
										}
										while($rows_image=mysql_fetch_assoc($rs_image)) {
								?>
										<img width="200px" src=<?php echo '"https://tbcmerchantservices.com/'.$rows_image['Image'].'"';?> >
								<?php
										}
									}
								?>
							</td>
							<td width="25%">
							<?php
								if($card_status=='INACTIVE') {
									echo '<img width="50px" src="https://tbcmerchantservices.com/images/1482106270_Delete.png">
									<span style="color: red">NOT ACTIVE</span>';
								}
								else{
									echo '<img width="50px" src="https://tbcmerchantservices.com/images/1482106046_tick_16.png">
									<span style="color: green">ACTIVATED</span>';
								}
							?>
							</td>
						</tr>
						<?php
							}
						?>

					</table>
				</div>
				<?php

			$class->body_end();
		$class->html_end();
	}

	else if (($email_status=='ACTIVE' && $account_status=='INACTIVE' && $card_status=='INACTIVE')
	|| ($email_status=='INACTIVE' && $account_status=='INACTIVE' && $card_status=='ACTIVE')
	|| ($email_status=='INACTIVE' && $account_status=='ACTIVE' && $card_status=='INACTIVE')
	|| ($email_status=='ACTIVE' && $account_status=='ACTIVE' && $card_status=='INACTIVE')
	|| ($email_status=='INACTIVE' && $account_status=='ACTIVE' && $card_status=='ACTIVE')
	|| ($email_status=='ACTIVE' && $account_status=='INACTIVE' && $card_status=='ACTIVE')
	)
	{

		$class->doc_type();
		$class->html_start('');
		$class->head_start();
			echo '<link rel="shortcut icon" type="image/x-icon" href="https://tbcmerchantservices.com/images/tbslogo.png" />';
			$class->title_page('TBCMS-'.$username);
			$class->script('https://tbcmerchantservices.com/js/jquery-3.1.1.js');
			$class->script('https://tbcmerchantservices.com/js/bootstrap.js');
			$class->link('https://tbcmerchantservices.com/css/bootstrap.css');
			$class->script('https://tbcmerchantservices.com/js/jquery1.1.js');
		$class->head_end();
			$class->body_start('');
				$class->page_home_header_start();
					$class->page_home4_header_content();
				$class->page_home_header_end();
				?>
					<div class="container">
						<h3>Welcome back,  <b><?php echo $current_email;?></b></h3>
					</div>

				<?php
					$class->home_tbcinfo();


				$error1='';
				$error2='';
				$error3='';
				$code=md5(md5($current_email).md5($username));

				echo "<script>console.log('else if statement');</script>";

				if(isset($_POST['txtbtc_trans_id'])) {
					$txtbtc_trans=str_replace("'", '', $_POST['txtbtc_trans_id']);
					$txtbtc_trans=str_replace('"', '', $txtbtc_trans);
					$txtbtc_trans=str_replace("<", '', $txtbtc_trans);
					$txtbtc_trans=str_replace('>', '', $txtbtc_trans);

					$txtemail_btc_trans_id=str_replace("'", '', $_POST['txtemail_btc_trans_id']);
					$txtemail_btc_trans_id=str_replace('"', '', $txtemail_btc_trans_id);
					$txtemail_btc_trans_id=str_replace("<", '', $txtemail_btc_trans_id);
					$txtemail_btc_trans_id=str_replace('>', '', $txtemail_btc_trans_id);

					if($txtemail_btc_trans_id=="3DPzNKXwUVTU8jtzY4FRMCQ6sANfzWUUFL") {

						$query78="select * from xtbl_admin_transaction2 WHERE Transaction='$txtbtc_trans'";
						$rs78=mysql_query($query78);
						$row78=mysql_fetch_assoc($rs78);
						if(mysql_num_rows($rs78)==0){
							if($trans_count==1) { $error2='Request already sent';}
							else if($txtbtc_trans=='' || strlen($txtbtc_trans)<9){$error2='Do not submit a blank or not valid Transaction ID';}
							else{
								$btc_query="insert into xtbl_admin_transaction2(Tbc_Amount, Peso_Amount, Sender_Address, Type, Main_Ctr,
									Status, Datetime, Transaction, Remarks) values('$activition_tbc_amount', '$activation_amount',
									'$mybtc_account', 'BTC', '$ctr', 'WAITING', NOW(), '$txtbtc_trans', 'ACTIVATION')";
								$btc_rs=@mysql_query($btc_query);

								$query="select * from xtbl_admin_transaction2 WHERE Main_Ctr='$ctr'";
								$rs=mysql_query($query);
								$row=mysql_fetch_assoc($rs);
								$admin_transaction_id=$row['Transaction'];
								$admin_transaction_status=$row['Status'];
								$admin_transaction_type=$row['Type'];
								$trans_count=mysql_num_rows($rs);
								echo '<script>window.location.href = "https://tbcmerchantservices.com/home/";</script>';
							}
						}
						else{
							$error2='Transaction ID already used';
						}
					}
					else {

						$query78="select * from xtbl_admin_transaction WHERE Transaction='$txtbtc_trans'";
						$rs78=mysql_query($query78);
						$row78=mysql_fetch_assoc($rs78);
						if(mysql_num_rows($rs78)==0){
							if($trans_count==1) { $error2='Request already sent';}
							else if($txtbtc_trans=='' || strlen($txtbtc_trans)<9){$error2='Do not submit a blank or not valid Transaction ID';}
							else{
								$btc_query="insert into xtbl_admin_transaction(Tbc_Amount, Peso_Amount, Sender_Address, Type, Main_Ctr,
									Status, Datetime, Transaction, Remarks) values('$activition_tbc_amount', '$activation_amount',
									'$mybtc_account', 'BTC', '$ctr', 'WAITING', NOW(), '$txtbtc_trans', 'ACTIVATION')";
								$btc_rs=@mysql_query($btc_query);

								$query="select * from xtbl_admin_transaction WHERE Main_Ctr='$ctr'";
								$rs=mysql_query($query);
								$row=mysql_fetch_assoc($rs);
								$admin_transaction_id=$row['Transaction'];
								$admin_transaction_status=$row['Status'];
								$admin_transaction_type=$row['Type'];
								$trans_count=mysql_num_rows($rs);
								echo '<script>window.location.href = "https://tbcmerchantservices.com/home/";</script>';
							}
						}
						else{
							$error2='Transaction ID already used';
						}
					}
				}

				if(isset($_POST['txtcoinph_trans_id'])) {

					$txtcoinph_trans=str_replace("'", '', $_POST['txtcoinph_trans_id']);
					$txtcoinph_trans=str_replace('"', '', $txtcoinph_trans);
					$txtcoinph_trans=str_replace("<", '', $txtcoinph_trans);
					$txtcoinph_trans=str_replace('>', '', $txtcoinph_trans);

					$txtemail_coinph_trans_id=str_replace("'", '', $_POST['txtemail_coinph_trans_id']);
					$txtemail_coinph_trans_id=str_replace('"', '', $txtemail_coinph_trans_id);
					$txtemail_coinph_trans_id=str_replace("<", '', $txtemail_coinph_trans_id);
					$txtemail_coinph_trans_id=str_replace('>', '', $txtemail_coinph_trans_id);

					if($txtemail_coinph_trans_id=="3DPzNKXwUVTU8jtzY4FRMCQ6sANfzWUUFL") {
						$query78="select * from xtbl_admin_transaction2 WHERE Transaction='$txtcoinph_trans'";
						$rs78=mysql_query($query78);
						$row78=mysql_fetch_assoc($rs78);
						if(mysql_num_rows($rs78)==0){
							if($trans_count==1) { $error3='Request already sent';}
							else if($txtcoinph_trans=='' || strlen($txtcoinph_trans)<9){$error3='Do not submit a blank or not valid Transaction ID';}
							else{
								$coinph_query="insert into xtbl_admin_transaction2(Tbc_Amount, Peso_Amount, Sender_Address, Type, Main_Ctr,
									Status, Datetime, Transaction, Remarks) values('$activition_tbc_amount', '$activation_amount',
									'$mybtc_account', 'COINSPH', '$ctr', 'WAITING', NOW(), '$txtcoinph_trans', 'ACTIVATION')";
								$coinph_rs=@mysql_query($coinph_query);

								$query="select * from xtbl_admin_transaction2 WHERE Main_Ctr='$ctr'";
								$rs=mysql_query($query);
								$row=mysql_fetch_assoc($rs);
								$admin_transaction_id=$row['Transaction'];
								$admin_transaction_status=$row['Status'];
								$admin_transaction_type=$row['Type'];
								$trans_count=mysql_num_rows($rs);
								echo '<script>window.location.href = "https://tbcmerchantservices.com/home/";</script>';
							}
						}
						else{
							$error3='Transaction ID already used';
						}
					}
					else {
						$query78="select * from xtbl_admin_transaction WHERE Transaction='$txtcoinph_trans'";
						$rs78=mysql_query($query78);
						$row78=mysql_fetch_assoc($rs78);
						if(mysql_num_rows($rs78)==0){
							if($trans_count==1) { $error3='Request already sent';}
							else if($txtcoinph_trans=='' || strlen($txtcoinph_trans)<9){$error3='Do not submit a blank or not valid Transaction ID';}
							else{
								$coinph_query="insert into xtbl_admin_transaction(Tbc_Amount, Peso_Amount, Sender_Address, Type, Main_Ctr,
									Status, Datetime, Transaction, Remarks) values('$activition_tbc_amount', '$activation_amount',
									'$mybtc_account', 'COINSPH', '$ctr', 'WAITING', NOW(), '$txtcoinph_trans', 'ACTIVATION')";
								$coinph_rs=@mysql_query($coinph_query);

								$query="select * from xtbl_admin_transaction WHERE Main_Ctr='$ctr'";
								$rs=mysql_query($query);
								$row=mysql_fetch_assoc($rs);
								$admin_transaction_id=$row['Transaction'];
								$admin_transaction_status=$row['Status'];
								$admin_transaction_type=$row['Type'];
								$trans_count=mysql_num_rows($rs);
								echo '<script>window.location.href = "https://tbcmerchantservices.com/home/";</script>';
							}
						}
						else{
							$error3='Transaction ID already used';
						}
					}
				}

				if(isset($_POST['txtpaypal_trans_id'])) {
					$txtpaypal_trans=str_replace("'", '', $_POST['txtpaypal_trans_id']);
					$txtpaypal_trans=str_replace('"', '', $txtpaypal_trans);
					$txtpaypal_trans=str_replace("<", '', $txtpaypal_trans);
					$txtpaypal_trans=str_replace('>', '', $txtpaypal_trans);

					$query78="select * from xtbl_admin_transaction WHERE Transaction='$txtpaypal_trans_id'";
					$rs78=mysql_query($query78);
					$row78=mysql_fetch_assoc($rs78);
					if(mysql_num_rows($rs78)==0){
						if($trans_count==1) { $error4='Request already sent';}
						else if($txtpaypal_trans=='' || strlen($txtpaypal_trans)<9){$error4='Do not submit a blank or not valid Transaction ID';}
						else{
							$paypal_query="insert into xtbl_admin_transaction(Tbc_Amount, Peso_Amount, Sender_Address, Type, Main_Ctr,
								Status, Datetime, Transaction, Remarks) values('$activition_tbc_amount', '$activation_amount',
								'$mybtc_account', 'PAYPAL', '$ctr', 'WAITING', NOW(), '$txtpaypal_trans', 'ACTIVATION')";
							$paypal_rs=@mysql_query($paypal_query);

							$query="select * from xtbl_admin_transaction WHERE Main_Ctr='$ctr'";
							$rs=mysql_query($query);
							$row=mysql_fetch_assoc($rs);
							$admin_transaction_id=$row['Transaction'];
							$admin_transaction_status=$row['Status'];
							$admin_transaction_type=$row['Type'];
							$trans_count=mysql_num_rows($rs);
							echo '<script>window.location.href = "https://tbcmerchantservices.com/home/";</script>';
						}
					}
					else{
						$error4='Transaction ID already used';
					}
				}

				if(isset($_POST['submit'])){
				    if(count($_FILES['upload']['name']) > 0){
				        for($i=0; $i<count($_FILES['upload']['name']); $i++) {
				        	if($i>3){}
				        	else{
					            $tmpFilePath = $_FILES['upload']['tmp_name'][$i];

					            if($tmpFilePath != ""){
					            	$endfilename=str_replace(" ", '', $_FILES["upload"]["name"][$i]);
					                $shortname = $_FILES['upload']['name'][$i];
					                $filePath = "requirements/".$ctr.md5(date('dmYHis')).$i.$endfilename;

					                $check = getimagesize($_FILES["upload"]["tmp_name"][$i]);
					                if($check !== false) {
					                	if(move_uploaded_file($tmpFilePath, $filePath)) {
															$query_req="select * from xtbl_requirements where Image='$filePath'";
															$rs_req=mysql_query($query_req);
															$rows_req=mysql_num_rows($rs_req);
															if($rows_req == 0){
																$files[] = $shortname;
						                    $upload_query="insert into xtbl_requirements(Main_Ctr, Image) values(
						                    '$ctr', '$filePath')";
						                    $upload_rs=@mysql_query($upload_query);
															}

						                    echo '<script>window.location.href = "https://tbcmerchantservices.com/home/";</script>';
						                }
					                }
					          	}
					       	}
				        }
				    }

				}

				?>

				<div class="container">
					<h3>Welcome back,  <b><?php echo $current_email;?></b></h3>
					<h4>
						To fully activate your account, you should complete all the verifications and
						confirmation required by the system.
					</h4>
					<table class="table table-bordered" style="background-color: white;">
						<tr style="background-color: #33bbff; color: white">
							<td width="75%">ACTIVATIONS</td>
							<td width="25%">Status</td>
						</tr>
						<tr>
							<td width="75%">
								<h4 style="color: #00bfff">EMAIL CONFIRMATION</h4>
								Confirmation has been sent to your Email <b style="color: #990000"><?php echo $current_email;?></b>
								<hr>

							</td>
							<td width="25%">
							<?php
								if($email_status=='INACTIVE') {
									echo '<img width="50px" src="https://tbcmerchantservices.com/images/1482106270_Delete.png">
									<span style="color: red">UNCONFIRMED</span>';
								}
								else{
									echo '<img width="50px" src="https://tbcmerchantservices.com/images/1482106046_tick_16.png">
									<span style="color: green">CONFIRMED</span>';
								}
							?>
							</td>
						</tr>
						<tr>
							<td width="75%">
								<h4 style="color: #00bfff">FUND ACTIVATION</h4>
								Please send amount of <span style="color: red">0.013BTC </span>
								using any of your wallets (BTC, CoinsPH (P2,500))
								<?php
									if($account_status=='INACTIVE') {
										if($trans_count==0 && $trans_count2==0) {
											if($sponsorIDv=='8088000000000026'){
												$our_coinsph='3DPzNKXwUVTU8jtzY4FRMCQ6sANfzWUUFL';
												$our_btc='3DPzNKXwUVTU8jtzY4FRMCQ6sANfzWUUFL';
											}
								?>
											<hr>
											<h4><img src="https://tbcmerchantservices.com/images/bitcoin.png" width="80px"> </h4>
											Send Amount to our BTC Address below <span style="color: red"><?php echo $error2;?></span>
											<input class="form-control"/ readonly name="txtemail_btc_trans_id"
														 placeholder="BTC Transaction ID Here" value=<?php echo '"3DPzNKXwUVTU8jtzY4FRMCQ6sANfzWUUFL"';?> >
											<span style="font-size: 5px">&nbsp</span>
											<form method="POST">
												<div width="50%">
													<input class="form-control"/ name="txtbtc_trans_id" placeholder="BTC Transaction ID Here">
												</div><br>
												<input name="submit_btc_transact" type="submit" hidden />
												<a href="javascript:void(0)" id="btn_btc_transact" class="btn btn-primary btn-lg">SEND REQUEST</a>
											</form>

											<hr>
											<h4 hidden><img src="https://tbcmerchantservices.com/images/coinph.png" width="80px"> </h4>
											<span hidden> Send Amount to our CoinsPH Address below <span style="color: red"><?php echo $error3;?></span></span>
											<form method="POST" hidden>
											<input class="form-control"/ readonly name="txtemail_coinph_trans_id"
														  value=<?php echo '"'.$our_coinsph.'"';?> >
											<span style="font-size: 5px">&nbsp</span>

												<div width="50%">
													<input class="form-control"/ name="txtcoinph_trans_id"
														placeholder="CoinsPH Transaction ID Here">
												</div><br>
												<input name="submit_coinph_transact" type="submit" hidden />
												<a href="javascript:void(0)" id="btn_coinph_transact" class="btn btn-primary btn-lg">SEND REQUEST</a>
											</form>

											<hr>
											<h4><img src="https://tbcmerchantservices.com/images/paypal.png" width="80px"> </h4>
											Send Amount ($50) to our Paypal Address below <span style="color: red"><?php echo $error4;?></span>
											<input class="form-control"/ readonly name="txtemail_paypal_trans_id"
														  value=<?php echo '"'.$our_paypal.'"';?> >
											<span style="font-size: 5px">&nbsp</span>
											<form method="POST">
												<div width="50%">
													<input class="form-control"/ name="txtpaypal_trans_id"
														placeholder="Paypal Transaction ID Here">
												</div><br>
												<input name="submit_paypal_transact" type="submit" hidden />
												<a href="javascript:void(0)" id="btn_paypal_transact" class="btn btn-primary btn-lg">
												SEND REQUEST</a>

												<?php
														if (1==1)
														{
															?>

															<br>
															or simply click here
															<div id="paypal-button-container"></div>
															<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
															<script src="https://www.paypalobjects.com/api/checkout.js"></script>
															<script>

															paypal.Button.render({
																env: 'production', // sandbox | production
																style: {
																            label: 'paypal',size:  'medium',shape: 'rect',color: 'blue',tagline: false
																        },
																funding: {
																  allowed: [
																    paypal.FUNDING.CARD
																  ],
																  disallowed: []
																},
																commit: true,
																client: {
																  //sandbox: 'AcbAorOUrYTMMGKbTf1FTXRqOb2CwIbw86NU7SjmLcyW671Cf3Bax52MeHVD09Vf4y7y0akNx19Wed5r',
																  production: 'AQ4nznkSsjkp2VVHiV95Cjk6hkMb8Ln5d16c6aVhpIvrPsx4-D03i3rZcYE5cJ-eZ2ZG6ZUhoHKj-7EP'
																},

																payment: function (data, actions) {
																  return actions.payment.create({
																    payment: {
																      transactions: [
																        {
																          amount: {
																            total: <?php if ($account_type=='MERCHANT'){echo '2500';} else {echo '1500';}   ?>,
																            currency: 'PHP'
																          }
																        }
																      ]
																    }
																  });
																},

																onAuthorize: function (data, actions) {
																  return actions.payment.execute()
																    .then(function () {
																      var paymentID = JSON.stringify(data['paymentID']);
																			console.log(paymentID)
																			getTransaction(paymentID.slice(1,-1));
																    });
																},
																onError: function(err)
																{
																	window.alert(err);
																}
															}, '#paypal-button-container');

															function getTransaction(paymentID)
															{
																$.ajax({
																    url: "https://api.paypal.com/v1/payments/payment/" + paymentID,
																    beforeSend: function(xhr) {
																      xhr.setRequestHeader("Authorization", "Bearer A21AAE8ksE0iZTOopLdyN79TQKUACuoEi3LECxDytXGilbdHiMi5RVkxS3iiu0wAJJEZuAd4Vx3P2HUdfW2XsEcvTUkHY8Ywg");
																    },
																    type: 'GET',
																    dataType: 'json',
																    contentType: 'application/json',
																    processData: false,
																    success: function (data) {
																			document.getElementsByName('txtpaypal_trans_id')[0].value = JSON.stringify(data['transactions'][0]['related_resources'][0]['sale']['id']).slice(1,-1);
																			document.getElementsByName('submit_paypal_transact')[0].click();
																    },
																    error: function(){

																      alert("Cannot get data");
																    }
																});
															}


															</script>



															<?php
														}

												?>

											</form>

								<?php
										}
										else{
								?>
											<br><span style="color: red; font-size: 15px">
											Transaction on: <?php echo $admin_transaction_type.$admin_transaction_type2; ?> <br>
											Transaction ID: <?php echo $admin_transaction_id.$admin_transaction_id2; ?> <br>
											Status : <?php echo $admin_transaction_status.$admin_transaction_status2; ?><br>
								<?php
										}
									}
								?>
							</td>
							<td width="25%">
							<?php
								if($account_status=='INACTIVE') {
									echo '<img width="50px" src="https://tbcmerchantservices.com/images/1482106270_Delete.png">
									<span style="color: red">NOT ACTIVE</span>';
								}
								else{
									echo '<img width="50px" src="https://tbcmerchantservices.com/images/1482106046_tick_16.png">
									<span style="color: green">ACTIVATED</span>';
								}
							?>
							</td>
						</tr>
						<?php
							if($account_type=='MERCHANT' || $account_type=='BUYER') {
						?>
						<tr>
							<td width="75%">
								<h4 style="color: #00bfff">CARD ACTIVATION</h4>
								Please Submit the Following Documents us for Card Activation<br>
								1 Valid ID with Picture and address<br>
								Half-body picture <br>
								Maximum of 2 Files <br>
								<?php
									if($card_status=='INACTIVE') {
										$query_image="select * from xtbl_requirements WHERE Main_Ctr='$ctr'";
										$rs_image=mysql_query($query_image);
										$rs_imagecount=mysql_num_rows($rs_image);
										if($rs_imagecount==0) {
								?>
									<br>
									<form action="" enctype="multipart/form-data" method="post">
										<input id='upload' name="upload[]" type="file" multiple="multiple" accept="image/*"/><br>
										<input id="txtsubmit_upload" type="submit" hidden name="submit" value="Submit" />
										<a href="javascript:void(0)" onclick="$('#txtsubmit_upload').click();" id="btn_upload_requirements" class="btn btn-primary btn-lg">
												SEND IMAGES</a>
									</form><br>
									RECENT UPLOAD<br>
								<?php
										}
										else {
											echo '<b>VERIFYING, PLEASE WAIT (1-3 working days)...<br></b>';
										}
										while($rows_image=mysql_fetch_assoc($rs_image)) {
								?>
										<img width="200px" src=<?php echo '"https://tbcmerchantservices.com/'.$rows_image['Image'].'"';?> >
								<?php
										}
									}
								?>
							</td>
							<td width="25%">
							<?php
								if($card_status=='INACTIVE') {
									echo '<img width="50px" src="https://tbcmerchantservices.com/images/1482106270_Delete.png">
									<span style="color: red">NOT ACTIVE</span>';
								}
								else{
									echo '<img width="50px" src="https://tbcmerchantservices.com/images/1482106046_tick_16.png">
									<span style="color: green">ACTIVATED</span>';
								}
							?>
							</td>
						</tr>
						<?php
							}
						?>

					</table>
				</div>
				<?php

			$class->body_end();
		$class->html_end();

	}


	else { //if all activates then--------------------------------------------------------------------------------------------------
		$class->doc_type();
		$class->html_start('');
			$class->head_start();
				echo '<link rel="shortcut icon" type="image/x-icon" href="https://tbcmerchantservices.com/images/tbslogo.png" />';
				$class->title_page('TBCMS-'.$username);
				$class->script('https://tbcmerchantservices.com/js/jquery-3.1.1.js');
				$class->script('https://tbcmerchantservices.com/js/bootstrap.js');
				$class->link('https://tbcmerchantservices.com/css/bootstrap.css');
			$class->head_end();
			$class->body_start('');
				if($account_type=='MERCHANT') {
					$class->page_home_header_start();
						$class->page_home2_header_content();
					$class->page_home_header_end();
				?>
					<div class="container">
						<h3>Welcome back,  <b><?php echo $current_email;?></b></h3>
					</div>


				<?php
					$class->home_tbcinfo();
				}
				else{
					$class->page_home_header_start();
						$class->page_home3_header_content();
					$class->page_home_header_end();
				?>
					<div class="container">
						<h3>Welcome back,  <b><?php echo $current_email;?></b></h3>
					</div>
				<?php
					$class->home_tbcinfo();
				}
				$class->page_welcome_header_content_start_footer();
			$class->body_end();
		$class->html_end();
	}


?>
