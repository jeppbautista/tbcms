<?php
	session_start();
	include 'class3.php';
	$class=new mydesign;
	$class->database_connect();

	date_default_timezone_set('Asia/Manila');
	$sessiondate=date('mdY');

	$limit=10;
	$page=$_SESSION['session_sharepage'];

	if(isset($_POST['pageno'])) {
		$page=str_replace("'", '', $_REQUEST['pageno']);
		$page=str_replace('"', '', $page);
		$page=str_replace("<", '', $page);
		$page=str_replace('>', '', $page);

		$_SESSION['session_sharepage']=$page;
		$page=$_SESSION['session_sharepage'];
		echo '<script>window.location.assign("https://tbcmerchantservices.com/share/");</script>';
	}

	if($page==""){$page=1;}

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
	$passwordlink=$row['Password'];
	$currentcryptid=$row['Crypt_Id'];
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
				echo '<br><br><br>';
?>
			<center>
				<h3>Share the gift of convenience by inviting your friends to TBCMS</h3><br>
				<img src="https://tbcmerchantservices.com/images/Red-Gift-Bow-PNG.png" width="200px">
				<h4>You can share this link with your friends to receive bonus</h4>
				<h3><a <?php echo 'href="https://tbcmerchantservices.com/welcome/#'.$passwordlink.'"'; ?> ><?php echo 'https://tbcmerchantservices.com/welcome/#'.$passwordlink; ?></a></h3>
			</center>

<div class="container">
<h3><b>REFERRALS</b></h3>
</div>

<?php
			$query="select * from xtbl_main_info WHERE Sponsor_Id='".$currentcryptid."' Order By Ctr DESC";
			$rsi=mysql_query($query);
			$rowsi=mysql_num_rows($rsi);
			$p=ceil($rowsi/$limit);
			$start=($page-1)*$limit;
			$query="select * from xtbl_main_info WHERE Sponsor_Id='".$currentcryptid."' order by Ctr DESC LIMIT ".$limit."  OFFSET ".$start."";
			$rs=mysql_query($query);
			echo '<div class="container">';
			echo '	<table class="table table-bordered">';
			echo '		<tr style="text-align: center">';
			echo '			<td width="60%" style="text-align: left">Email Address</td>';
			echo '			<td width="60%" style="text-align: left">Name</td>';
			echo '			<td width="12%">Payment</td>';
			echo '			<td width="12%">Email</td>';
			echo '			<td width="12%">ID</td>';
			echo '		</tr>';
			while($row=mysql_fetch_assoc($rs)) {
				$query2="select * from xtbl_account_info WHERE Main_Ctr='".$row['Ctr']."'";
				$rs2=mysql_query($query2);
				$row2=mysql_fetch_assoc($rs2);
				$query_pers = "select * from xtbl_personal WHERE Main_Ctr='".$row['Ctr']."'";
				$rs_pers=mysql_query($query_pers);
				$row_pers=mysql_fetch_assoc($rs_pers);
?>
				<tr style="text-align: center">
					<td style="text-align: left"><?php echo $row['Email'][0].$row['Email'][1].$row['Email'][2].str_repeat("*", strlen($row['Email'])-6).$row['Email'][strlen($row['Email'])-3].$row['Email'][strlen($row['Email'])-2].$row['Email'][strlen($row['Email'])-1];?></td>
					<td style="text-align: left"><?php echo $row_pers['Lname'] . ", " . $row_pers["Fname"]; ?></td>
					<td>
						<?php
							if($row2['Account_Status']=='ACTIVE') {
								echo '<img src="https://tbcmerchantservices.com/images/1482106046_tick_16.png" width="30px">';
							}
							else {
								echo '<img src="https://tbcmerchantservices.com/images/1482106270_Delete.png" width="30px">';
							}

						?>
					</td>
					<td>
						<?php
							if($row2['Email_Status']=='ACTIVE') {
								echo '<img src="https://tbcmerchantservices.com/images/1482106046_tick_16.png" width="30px">';
							}
							else {
								echo '<img src="https://tbcmerchantservices.com/images/1482106270_Delete.png" width="30px">';
							}

						?>
					</td>
					<td>
						<?php
							if($row2['Card_Status']=='ACTIVE') {
								echo '<img src="https://tbcmerchantservices.com/images/1482106046_tick_16.png" width="30px">';
							}
							else {
								echo '<img src="https://tbcmerchantservices.com/images/1482106270_Delete.png" width="30px">';
							}

						?>
					</td>
				</tr>
<?php
			}
			echo '	</table>';
			echo '</div>';
?>
			<div class="container">

				<div class="col-md-3" align="left">
					<form method="POST" hidden>
						<input name="pageno" <?php echo 'value="'.($page-1).'"';?> />
						<input id="prev_page" type="submit" />
					</form>
				<?php if($page>1) { ?>
					<a href="javascript:void(0)" onclick="$('#prev_page').click();"
						class="btn btn-warning btn-lg" style="border-radius: 0px">
					<span class="glyphicon glyphicon-chevron-left"></span> PREVIOUS PAGE</a>
				<?php } ?>
				</div>
				<div class="col-md-6" align="center">
					<?php echo '<h4 style="color: green"><b>PAGE '.$page.' of '.$p.'</b></h4>';?>
				</div>


				<div class="col-md-3" align="right">
					<form method="POST" hidden>
						<input name="pageno" <?php echo 'value="'.($page+1).'"';?> />
						<input id="next_page" type="submit" />
					</form>
				<?php if($page<$p) { ?>
					<a href="javascript:void(0)" onclick="$('#next_page').click();"
						class="btn btn-warning btn-lg" style="border-radius: 0px">
					NEXT PAGE <span class="glyphicon glyphicon-chevron-right"></span></a>
				<?php } ?>
				</div>

			</div><br><br><br>
<?php
			$class->page_welcome_header_content_start_footer();
                        //$class->chatscript();
			$class->body_end();
		$class->html_end();
	}

?>
