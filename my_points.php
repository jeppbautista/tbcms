<?php
	session_start();
	include 'class3.php';
	$class=new mydesign;
	$class->database_connect();

	date_default_timezone_set('Asia/Manila');
	$sessiondate=date('mdY');

	$limit=50;
	$page=$_SESSION['session_mypntpage'];

	if(isset($_POST['pageno'])) {
		$page=str_replace("'", '', $_REQUEST['pageno']);
		$page=str_replace('"', '', $page);
		$page=str_replace("<", '', $page);
		$page=str_replace('>', '', $page);

		$_SESSION['session_mypntpage']=$page;
		$page=$_SESSION['session_mypntpage'];
		echo '<script>window.location.assign("https://tbcmerchantservices.com/my_points/");</script>';
	}

	if($page==""){$page=1;}

	if(!isset($_SESSION['session_tbcmerchant_ctr'.$sessiondate])){
		header("location: https://tbcmerchantservices.com/welcome/");
	}

	$ctr=$_SESSION['session_tbcmerchant_ctr'.$sessiondate];

	$query="select * from xtbl_account_info WHERE Main_Ctr='$ctr'";
	$rs=mysql_query($query);
	$row=mysql_fetch_assoc($rs);
	$email_status=$row['Email_Status'];
	$account_type=$row['Account_Type'];
	$account_status=$row['Account_Status'];
	$card_status=$row['Card_Status'];
	$username=$row['Username'];
	$passwordlink=$row['Password'];
	$currentcryptid=$row['Crypt_Id'];
	$activation_amount=0;

	$query="select * from xtbl_main_info WHERE Ctr='$ctr'";
	$rs=mysql_query($query);
	$row=mysql_fetch_assoc($rs);
	$current_email=$row['Email'];
	$business_logo=$row['Business_Logo'];
	$business_name=$row['Business_Name'];
	$business_category=$row['Business_Category'];
	$business_description=$row['Description'];
	$business_country=$row['Country'];

	$error='';
	$total_reward=0;
	if(isset($_POST['gcashmobile'])) {

		$mobile=str_replace("'", '', $_REQUEST['gcashmobile']);
		$mobile=str_replace('"', '', $mobile);
		$mobile=str_replace("<", '', $mobile);
		$mobile=str_replace('>', '', $mobile);

		$query="select * from xtbl_main_info WHERE Sponsor_Id='".$currentcryptid."' Order By Ctr DESC";
		$rs=mysql_query($query);
		while($row=mysql_fetch_assoc($rs)){
			$query2="select * from xtbl_account_info WHERE Main_Ctr='".$row['Ctr']."' AND Email_Status='ACTIVE' AND Account_Status='ACTIVE' AND Card_Status='ACTIVE'";
			$rs2=mysql_query($query2);
			while( $row2=mysql_fetch_assoc($rs2)) {
				if($row2['Account_Type']=='MERCHANT'){$total_reward=$total_reward+250;}
				else{$total_reward=$total_reward+150;}
			}
		}
		$total_reward=$total_reward-300;

		$query="select * from xtbl_reward WHERE Main_Ctr='$ctr'";
		$rs=mysql_query($query);
		while($row=mysql_fetch_assoc($rs)){
			$total_reward=$total_reward-$row['Amount'];
		}

		if($total_reward<1000) {
			$error='Insufficient Balance<br>';
		}
		else if(strlen($mobile)<10) {$error='Mobile GCash Number Error<br>';}
		else {
			$query="Insert into xtbl_reward(Amount, Main_Ctr, Datetime, Remarks, Mobile)
				values('$total_reward', '$ctr', '".date('Y-m-d H:i:s')."', 'Withdraw via TBCMS GCASH Card',
				'$mobile')";
			$rs=@mysql_query($query);
			echo '<script>window.location.assign("https://tbcmerchantservices.com/my_points/");</script>';
		}
	}

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
			$class->head_end();
			$class->body_start('');
				$class->page_home_header_start();
					$class->page_home2_header_content();
				$class->page_home_header_end();
				echo '<div class="container"><h3>Welcome back,  <b>'.$current_email.'</b></h3></div>';
				echo '<br>';

				$total_bonus=0;

				$query="select * from xtbl_main_info WHERE Sponsor_Id='".$currentcryptid."' Order By Ctr DESC";
				$rs=mysql_query($query);
				while($row=mysql_fetch_assoc($rs)){
					$query2="select * from xtbl_account_info WHERE Main_Ctr='".$row['Ctr']."' AND Email_Status='ACTIVE' AND Account_Status='ACTIVE' AND Card_Status='ACTIVE'";
					$rs2=mysql_query($query2);
					while($row2=mysql_fetch_assoc($rs2)){
						if($row2['Account_Type']=='MERCHANT'){$total_bonus=$total_bonus+250;}
						else{$total_bonus=$total_bonus+150;}
					}
				}
				$total_bonus=$total_bonus-300;

				$query="select * from xtbl_reward WHERE Main_Ctr='$ctr'";
				$rs=mysql_query($query);
				while($row=mysql_fetch_assoc($rs)){
					$total_bonus=$total_bonus-$row['Amount'];
				}
?>
			<div class="container">
				<div class="col-md-3"></div>
				<div class="col-md-6">
					<div class="alert alert-success" align="center" style="background-color:#DAA520; border-radius: 20px; color: white">
						Total Referral Reward<br>
						 <h1><?php echo '<small>PHP</small> '.number_format($total_bonus,2); ?></h1>
						 Thank you for sharing TBCMS to your friends<br>
					</div><br>
					<div align="center">
						<span style="color:red; font-size: 25px"><?php echo $error;?></span>
						<h4>P300 will be deducted to your reward for the TBCMS GCash Card</h4>
						<h4>Note: Minimum withdrawal is P1,000</h4>

						<a href="javascript:void(0)" onclick="$('#modal_mypoint').modal('show');" class="btn btn-info btn-lg">
							 	WITHDRAW TO TBCMS GCASH CARD
						</a>
						<h4>Withdrawal will take 1-2 working days to transfer on GCASH</h4>
					</div>
				</div>
				<div class="col-md-3"></div>
			</div>

			<div class="container">
				<h3>LATEST WITHDRAWAL/s</h3>

			<?php
				$query="select * from xtbl_reward WHERE Main_Ctr='$ctr' ORDER by Ctr DESC LIMIT 10";
				$rs=mysql_query($query);
				while($row=mysql_fetch_assoc($rs)){
			?>
					<div class="alert alert-success" style="background-color: 	#48D1CC; border-radius: 13px">
						<table width="100%">
							<tr>
								<td width="80%">
									<?php
										echo $row['Datetime'].'<br>';
										echo '<h4><b>'.$row['Remarks'].'</b></h4>';
										echo $row['Mobile'];?>
								</td>
								<td width="20%" style="color: white"><h1><?php echo 'PHP '.$row['Amount'];?></h1></td>
							</tr>

						</table>
					</div>
			<?php
				}
			?>

			</div>

			<div id="modal_mypoint" class="modal fade">
				<div class="modal-dialog modal-sm">
					<div class="modal-content">
						<div class="modal-header" style="background-color: #191970; text-align: center; color: white">
							<span class="modal-title" style="font-size: 20px">CONFIRMATION</span>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
  								<span aria-hidden="true" style="color: white">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form method="POST">
								<input name="sendnew" hidden value="us56udg668h28hcb7w7eg6" />
								<input name="submitnew" hidden type="submit" />
								<label>TBCMS GCash Mobile Number</label>
								<input class="form-control" name="gcashmobile" />
							</form>
							<b>ARE YOU SURE YOU WANT TO WITHDRAW ALL?</b>
						</div>
						<div class="modal-footer">
							<a href="javascript:void(0)" onclick="$('[name=submitnew]').click();" class="btn btn-primary" data-dismiss="modal" style="border-radius: 0px">&nbsp YES &nbsp</a>
							<a href="javascript:void(0)" class="btn btn-danger" data-dismiss="modal" style="border-radius: 0px">&nbsp NO &nbsp</a>
						</div>
					</div>
				</div>
			</div>
<?php
				$class->page_welcome_header_content_start_footer();
			$class->body_end();
		$class->html_end();
	}
?>
