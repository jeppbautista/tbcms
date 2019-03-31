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
				$class->script('https://tbcmerchantservices.com/js/jquery1.2.js');
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

			if(isset($_POST['txt_amount']) && isset($_POST['txt_receiving_address'])) {
				
				$amount=str_replace("'", '', $_REQUEST['txt_amount']);
				$amount=str_replace('"', '', $amount);
				$amount=str_replace("<", '', $amount);
				$amount=str_replace('>', '', $amount);

				$r_address=str_replace("'", '', $_REQUEST['txt_receiving_address']);
				$r_address=str_replace('"', '', $r_address);
				$r_address=str_replace("<", '', $r_address);
				$r_address=str_replace('>', '', $r_address);

				$trans_id=md5(md5($ctr).md5(date('mdYHis'))).md5(md5(date('mdYHis')).md5($ctr));

				if($my_amount<$amount) {
					$error='Insufficient Balance';
				}
				else if($amount=='' || $amount==0 || $amount==null || !is_numeric($amount) ) {
					$error='Invalid Amount Format';
				}
				else if($r_address=='' || $r_address==null) {
					$error='Please Fill Address';
				}
				else {
					$query="select Main_Ctr from xtbl_account_info where Crypt_Id='$r_address'";
					$rs=mysql_query($query);
					$rows=mysql_num_rows($rs);
					$row=mysql_fetch_assoc($rs);
					$reciever=$row['Main_Ctr'];

					if($rows==1 && $reciever!=$ctr){
						$query="Insert into xtbl_mytransaction".$ctr."(Amount, Status, Transact_Id, Type, Date) 
							values(
							'-".$amount."', 
							'ACTIVE',
							'$trans_id',
							'SEND',
							'".date('Y-m-d H:i:s')."'
							);";
						$result=@mysql_query($query);

						$query="Insert into xtbl_mytransaction".$reciever."(Amount, Status, Transact_Id, Type, Date) 
							values(
							'".$amount."', 
							'ACTIVE',
							'$trans_id',
							'RECEIVE',
							'".date('Y-m-d H:i:s')."'
							);";
						$result=@mysql_query($query);
						$my_amount=$my_amount-$amount;
						echo '<script>window.location.assign("https://tbcmerchantservices.com/transaction/");</script>';
					}
					else{
						$error='Reciever Address Error';
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

						<h4><b>SEND MERCHANT COIN</b></h4>
						<center><h6 style="color: red"><?php echo $error;?>&nbsp</h6></center>
						<form method="POST">
							<div style="padding: 4px;">
								<input name="txt_receiving_address" class="form-control" placeholder="Receiver Address"/>
							</div>
							<div style="padding: 4px;">
								<input width="100px" class="form-control" placeholder="Amount in Merchant" 
									name="txt_amount" />
								<span id="lbl_amount">&nbsp</span><br>
								<input type="submit" name="submit_amount" hidden />
								<a id="btn_submit_amount" href="javascript:void(0)" onclick="$('[name=submit_amount]').click();" 
									class="btn btn-primary btn-lg">SEND</a>
							</div>
						</form><hr>
					</div>

					<div class="col-md-8">
						<h3>Transaction List</h3>
						<?php
							$query="select * from xtbl_mytransaction".$ctr." WHERE Status='ACTIVE' ORDER BY Ctr DESC";
							$rs=mysql_query($query);
						?>
						<div style="overflow-y: auto; height: 500px;">
							<table class="table table-bordered">
								<tr>
									<td width="15%">Date</td>
									<td width="15%">Type</td>
									<td width="55%" style="word-wrap: break-word;">Transaction ID</td>
									<td width="15%">Amount</td>
								</tr>
								<?php
									while($rows=mysql_fetch_assoc($rs)) {
								?>
								<tr>
									<td width="15%"><?php echo $rows['Date'];?></td>
									<td width="15%"><?php echo $rows['Type'];?></td>
									<td width="55%" >
										<div style="width: 23em; word-wrap: break-word;">
											<?php echo $rows['Transact_Id'];?>
										</div>
									</td>
									<td width="15%"><?php echo $rows['Amount'];?></td>
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
