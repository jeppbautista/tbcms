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
	$account_addressyou=$row['Crypt_Id'];
	$activation_amount=0;
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
	$my_btc_account=$row['Btc_Account'];

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
				$class->script('https://tbcmerchantservices.com/js/jquery1.3.js');
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

			echo '<div class="container"><h3>Welcome back,  <b>'.$current_email.'</b></h3></div>';

			$query="select * from xtbl_mytransaction".$ctr." WHERE Status='ACTIVE'";
			$rs=mysql_query($query);
			$my_amount=0;
			while($row=mysql_fetch_assoc($rs)) {
				$my_amount=$my_amount+$row['Amount'];
			}

			if(isset($_POST['btc_receiving_address']) && isset($_POST['btc_amount']) && isset($_POST['btc_trans_id']) ) {
				$btcamount=str_replace("'", '', $_REQUEST['btc_amount']);
				$btcamount=str_replace('"', '', $btcamount);
				$btcamount=str_replace("<", '', $btcamount);
				$btcamount=str_replace('>', '', $btcamount);

				$btctransid=str_replace("'", '', $_REQUEST['btc_trans_id']);
				$btctransid=str_replace('"', '', $btctransid);
				$btctransid=str_replace("<", '', $btctransid);
				$btctransid=str_replace('>', '', $btctransid);

				$btctype=str_replace("'", '', $_REQUEST['btc_type']);
				$btctype=str_replace('"', '', $btctype);
				$btctype=str_replace("<", '', $btctype);
				$btctype=str_replace('>', '', $btctype);

				if($btcamount=='' || $btcamount==0 || $btcamount==null || !is_numeric($btcamount) ) {
					$error='<br>Invalid Amount Format';
				}
				else if($btctransid=='' || $btctransid==null || strlen($btctransid)<5) {
					$error='<br>Invalid Transaction ID';
				}
				else{
					$query78="select * from xtbl_admin_transaction WHERE Transaction='$btctransid'";
					$rs78=mysql_query($query78);
					$row78=mysql_fetch_assoc($rs78);
					if(mysql_num_rows($rs78)==0){
						$tbcamount=$btcamount/$tbc_to_peso;

						$query="Insert into xtbl_admin_transaction(Tbc_Amount, Peso_Amount, Sender_Address, Type, Main_Ctr, Status, Datetime, Transaction, Remarks) values(
							'$tbcamount',
							'$btcamount',
							'$my_btc_account',
							'$btctype',
							'$ctr',
							'WAITING',
							'".date('Y-m-d H:i:s')."',
							'$btctransid',
							'RELOAD'
						)";
						$result=@mysql_query($query);
						echo '<script>window.location.assign("https://tbcmerchantservices.com/request/");</script>';
					}
					else{
						$error='<br>Transaction ID already in Used';
					}
				}
			}

			?>
				<div class="container">
					<div class="col-md-4">
						<h4><b>ACCOUNT BALANCE</b></h4>
						<center>
							<div style="color: #339933; font-size: 40px">
								<?php echo number_format($my_amount, 8);?>&nbsp
							</div>
							<div style="color: #339933; font-size: 20px">
								<?php echo 'Php '.number_format($tbc_to_peso*$my_amount, 2);?>&nbsp
							</div>
						</center><hr>
						<h4><b>TBCMS ACCOUNT ADDRESS</b></h4>
						<h4><center><b><?php echo $account_addressyou;?></b><br><small>Share this address to receive payments</small></center></h4><hr>

						<h4><b>REQUEST MERCHANT COIN</b></h4>
						<h5>Please send Amount to any of our address below</h5><hr>
						<form method="POST">
							<div>
								<div class="col-md-4">
									<center><img src="https://tbcmerchantservices.com/images/bitcoin.png" width="100%"></center>
								</div>
								<div class="col-md-4">
									<center><img src="https://tbcmerchantservices.com/images/coinph.png" width="100%"></center>
								</div>
								<div class="col-md-4">
									<center><img src="https://tbcmerchantservices.com/images/paypal.png" width="100%"></center>
								</div><br>
							</div>


							<div style="padding: 4px;">
								<center><h6 style="color: red"><?php echo $error;?>&nbsp</h6></center>
								<select name="btc_type" class="form-control" >
									<option>BTC</option>
									<option>COINSPH</option>
									<option>PAYPAL</option>
								</select>
							</div>
							<div style="padding: 4px;">
								<input name="btc_receiving_address" class="form-control" readonly style="background-color: white" value="3A9qBQkV9tu3zQ7cDosenG5ev3TyJ56CfG''  placeholder="Receiver Address" />
							</div>

							<script>
							    $('[name=btc_type]').change( function() {
							    	if($('[name=btc_type]').val()=='BTC') {
							    		$('[name=btc_receiving_address]').val('3A9qBQkV9tu3zQ7cDosenG5ev3TyJ56CfG');
							    	}
							    	else if($('[name=btc_type]').val()=='COINSPH') {
							    		$('[name=btc_receiving_address]').val('3A9qBQkV9tu3zQ7cDosenG5ev3TyJ56CfG');
							    	}
							    	else{
							    		$('[name=btc_receiving_address]').val('<?php echo $our_paypal;?>');
							    	}

							    });
							</script>

							<div style="padding: 4px;">
								<input name="btc_trans_id" class="form-control" style="background-color: white"
									 placeholder="Transaction ID" />
							</div>
							<div style="padding: 4px;">
								<input width="100px" class="form-control" placeholder="Peso Value"
									name="btc_amount" />
								<span id="btc_lbl_amount">&nbsp</span><br>
								<input type="submit" name="submit_amount_btc" hidden />
								<a id="btn_submit_amount" href="javascript:void(0)" onclick="$('[name=submit_amount_btc]').click();"
									class="btn btn-primary btn-lg">SEND</a>
							</div>
						</form><hr>

					</div>

					<div class="col-md-8">
						<h3>Request List</h3>
						<?php
							$query="select * from xtbl_admin_transaction WHERE Main_Ctr='$ctr' Order by Ctr DESC";
							$rs=mysql_query($query);
						?>
						<div style="overflow-y: auto; height: 500px;">
							<table class="table table-bordered">
								<tr>
									<td width="15%">Remarks</td>
									<td width="15%">Date</td>
									<td width="40%" style="word-wrap: break-word;">Transaction ID</td>
									<td width="15%">Status</td>
									<td width="15%">Amount</td>
								</tr>
								<?php
									while($rows=mysql_fetch_assoc($rs)) {
								?>
								<tr>
									<td width="15%"><?php echo $rows['Remarks'];?></td>
									<td width="15%"><?php echo $rows['Datetime'];?></td>
									<td width="40%" >
										<div style="width: 19em; word-wrap: break-word;">
											<?php echo $rows['Transaction'];?>
										</div>
									</td>
									<td width="15%"><?php echo $rows['Status'];?></td>
									<td width="15%"><?php echo $rows['Tbc_Amount'];?></td>
								</tr>
								<?php
									}
								?>
							</table>
						</div>

					</div>
				</div>

			<?php

			$class->page_welcome_header_content_start_footer();
                        $class->chatscript();
			$class->body_end();
		$class->html_end();
	}

?>
