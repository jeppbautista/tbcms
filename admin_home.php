<?php

//----------------------------------------------------------------------------------------CHECKLOGIN START
	session_start();
	include 'class_admin.php';
	$class=new mydesign;
	$class->database_connect();



	date_default_timezone_set('Asia/Manila');
	$sessiondate=date('mdY');

	if(!isset($_SESSION['session_tbcmerchant_ctr_myadmin'.$sessiondate])){
		header("location: https://tbcmerchantservices.com/tbcmyadmin/");
	}

	$query="select * from xtbl_adminaccount";
	$rs=mysql_query($query);
	$row=mysql_fetch_assoc($rs);
	$our_btc=$row['BTC'];
	$our_coinsph=$row['CoinPH'];
	$our_paypal=$row['Paypal'];
	$tbc_to_peso=$row['Tbc_to_Peso'];
//----------------------------------------------------------------------------------------CHECKLOGIN END

//----------------------------------------------------------------------------------------SIGNUP_FORM START
	$error='';
	if(isset($_POST['temporary_value'])) {
		$temvalue=str_replace("'", '', $_POST['temporary_value']);
		$temvalue=str_replace('"', '', $temvalue);
		$temvalue=str_replace("<", '', $temvalue);
		$temvalue=str_replace('>', '', $temvalue);

		if($temvalue=='') {
			$error='Warning: Please do not attemp to hack';
		}
		else {
			$query="select * from xtbl_admin_transaction WHERE Ctr='$temvalue'";
			$rs=mysql_query($query);
			$row=mysql_fetch_assoc($rs);

			$temp_ctr=$row['Main_Ctr'];
			$tbc_value=$row['Tbc_Amount'];
			$trans_id=md5(md5(1).md5(date('mdYHis'))).md5(md5(date('mdYHis')).md5(1));

			if($row['Remarks']=='ACTIVATION') {
				$query="update xtbl_account_info SET Account_Status='ACTIVE'
					WHERE Ctr='$temp_ctr'";
				$rs=@mysql_query($query);
			}

			$query="Insert into xtbl_mytransaction".$temp_ctr."(Amount, Status, Transact_Id, Type, Date)
				values(
					'$tbc_value',
					'ACTIVE',
					'$trans_id',
					'RECEIVE',
					'".date('Y-m-d H:i:s')."'
					)";
			$rs=@mysql_query($query);

			$query="update xtbl_admin_transaction SET Status='SUCCESS'
				WHERE Ctr='$temvalue'";
			$rs=@mysql_query($query);

			$Mainctr = $temp_ctr;
			$query="select * from xtbl_account_info WHERE Main_Ctr='$Mainctr'";
		  $rs=mysql_query($query);
		  $row=mysql_fetch_assoc($rs);
			$username=$row['Username'];

			$query="select * from xtbl_main_info WHERE Ctr='$Mainctr'";
		  $rs=mysql_query($query);
		  $row=mysql_fetch_assoc($rs);
			$refcode  = $row['Sponsor_Id'];

			echo '<script>window.location.assign("https://tbcmerchantservices.com/admin_home/");</script>';
		}

	}

	if(isset($_POST['temporary_valueD'])) {
		$temvalue=str_replace("'", '', $_POST['temporary_valueD']);
		$temvalue=str_replace('"', '', $temvalue);
		$temvalue=str_replace("<", '', $temvalue);
		$temvalue=str_replace('>', '', $temvalue);

		if($temvalue=='') {
			$error='Warning: Please do not attemp to hack';
		}
		else {
			$query="select * from xtbl_admin_transaction WHERE Ctr='$temvalue'";
			$rs=mysql_query($query);
			$row=mysql_fetch_assoc($rs);

			$temp_ctr=$row['Main_Ctr'];
			$tbc_value=$row['Tbc_Amount'];
			$trans_id=md5(md5(1).md5(date('mdYHis'))).md5(md5(date('mdYHis')).md5(1));

			if($row['Remarks']=='ACTIVATION') {
				$query="update xtbl_account_info SET Account_Status='INACTIVE'
					WHERE Ctr='$temp_ctr'";
				$rs=@mysql_query($query);
				$query="delete from xtbl_admin_transaction WHERE Ctr='$temvalue'";
				$rs=@mysql_query($query);
			}

			$query="update xtbl_admin_transaction SET Status='DENIED'
				WHERE Ctr='$temvalue'";
			$rs=@mysql_query($query);
			echo '<script>window.location.assign("https://tbcmerchantservices.com/admin_home/");</script>';

		}

	}
	$annoucement='';
	if(isset($_POST['newtbcvalue'])) {
		$newtbcvalue=str_replace("'", '', $_POST['newtbcvalue']);
		$newtbcvalue=str_replace('"', '', $newtbcvalue);
		$newtbcvalue=str_replace("<", '', $newtbcvalue);
		$newtbcvalue=str_replace('>', '', $newtbcvalue);

		$query="update xtbl_adminaccount SET Tbc_to_Peso='$newtbcvalue'";
		$rs=@mysql_query($query);
		$tbc_to_peso=$newtbcvalue;
		$annoucement='<span style="color: green">Successfully Updated</span>';
		echo '<script>window.location.assign("https://tbcmerchantservices.com/admin_home/");</script>';
	}

	$class->doc_type();
	$class->html_start('');
		$class->head_start();
			echo '<link rel="shortcut icon" type="image/x-icon" href="https://tbcmerchantservices.com/images/tbslogo.png" />';
			$class->title_page('TBCMS ADMIN');
			$class->script('https://tbcmerchantservices.com/js/jquery-3.1.1.js');
			$class->script('https://tbcmerchantservices.com/js/bootstrap.js');
			$class->link('https://tbcmerchantservices.com/css/bootstrap.css');
			$class->script('https://tbcmerchantservices.com/js/jquery1.4.js');
		$class->head_end();

		$class->body_start('');
		$class->admin_page_header();
	?>

	<!-- <div style="background-color: rgb(255,255,255,0.5); height: auto; padding-top: 10px;
		background-image: url('https://tbcmerchantservices.com/images/Picture3.jpg'); background-size: 100% auto">
		<div class="container">
			<div class="col-md-10" style="padding-bottom: 5px;">
				<img width="230px" src="https://tbcmerchantservices.com/images/tbsheader.png">
			</div>
			<div class="col-md-2" style="padding-bottom: 5px; text-align: center;">
				<a href="https://tbcmerchantservices.com/logout/" style="color: red">
					LOGOUT <img width="35px" src="https://tbcmerchantservices.com/images/1484042800_exit.png">
				</a>
			</div>
		</div>
	</div><br>

	<div class="container">
		<a class="btn btn-primary" href="https://tbcmerchantservices.com/admin_home/">REQUEST</a>
		<a class="btn btn-primary" href="https://tbcmerchantservices.com/admin_doc/">DOCUMENTS</a>
		<a class="btn btn-primary" href="https://tbcmerchantservices.com/admin_encash/">ENCASHMENT</a>
		<a class="btn btn-primary" href="https://tbcmerchantservices.com/info/">INFO</a>
		<a class="btn btn-primary" href="https://tbcmerchantservices.com/admin_trade/">TRADING</a>
		<a class="btn btn-primary" href="https://tbcmerchantservices.com/admin_cashin/">CASH-IN</a>
		<a class="btn btn-primary" href="https://tbcmerchantservices.com/admin_edudona/">EDUDONA</a>
	</div><br> -->

			<div class="container">
				<form method="POST">
					Update TBC to Peso Value: 1TBC=
					<input type="text" name="newtbcvalue" <?php echo 'value="'.$tbc_to_peso.'"';?> placeholder="new Peso value"/>
					<input type="submit" value="CHANGE NOW" />
					<?php echo $annoucement;?>
				</form>
			</div><br>

			<div class="container">
				<table class="table table-bordered">
					<tr>
						<td width="10%">Date</td>
						<td width="10%">Amount</td>
						<td width="10%">From</td>
						<td width="40%">Name/Transaction</td>
						<td width="10%">REMARKS</td>
						<td width="20%">ACTIONS</td>
					</tr>
				<?php

				$query="select * from xtbl_admin_transaction WHERE Status='WAITING' Order by Datetime DESC";
				$rs=mysql_query($query);
				while($row=mysql_fetch_assoc($rs)) {
$query2="select * from xtbl_personal where Main_Ctr='".$row['Main_Ctr']."'";
					$rs2=mysql_query($query2);
					$row2=mysql_fetch_assoc($rs2);
				?>
					<tr>
						<td width="10%"><?php echo $row['Datetime'];?></td>
						<td width="10%"><?php echo 'P'.number_format($row['Peso_Amount'],2);?></td>
						<td width="10%"><?php echo $row['Type'];?></td>
						<td width="40%"><?php echo $row2['Fname'].' '.$row2['Lname'].'<br>'.$row['Transaction'];?></td>
						<td width="10%"><?php echo $row['Remarks'];?></td>
						<td width="20%">
							<a class="btn btn-success" href="javascript:void(0)"
								<?php echo 'onclick="btnaccept('.$row['Ctr'].')"';?> >ACCEPT</a>
							<a class="btn btn-danger" href="javascript:void(0)"
								<?php echo 'onclick="btndenied('.$row['Ctr'].')"';?> >DENIED</a>
						</td>
					</tr>
				<?php
				}

					$query="select * from xtbl_admin_transaction WHERE Status<>'WAITING' Order by Datetime DESC LIMIT 500";
					$rs=mysql_query($query);
					while($row=mysql_fetch_assoc($rs)) {
$query2="select * from xtbl_personal where Main_Ctr='".$row['Main_Ctr']."'";
					$rs2=mysql_query($query2);
					$row2=mysql_fetch_assoc($rs2);
				?>
					<tr>
						<td width="10%"><?php echo $row['Datetime'];?></td>
						<td width="10%"><?php echo 'P'.number_format($row['Peso_Amount'],2);?></td>
						<td width="10%"><?php echo $row['Type'];?></td>
						<td width="40%"><?php echo $row2['Fname'].' '.$row2['Lname'].'<br>'.$row['Transaction'];?></td>
						<td width="10%"><?php echo $row['Remarks'];?></td>
						<td width="20%">
						<?php
							if($row['Status']=='SUCCESS'){
								echo '<img src="https://tbcmerchantservices.com/images/1482106046_tick_16.png" height="30px"> SUCCESS';
							}
							else {
								echo '<img src="https://tbcmerchantservices.com/images/1482106270_Delete.png" height="30px"> DENIED';
							}
						?>
						</td>
					</tr>
				<?php
					}
				?>
				</table>

				<div id="modal_accept" class="modal fade">
					<div class="modal-dialog modal-sm">
						<div class="modal-content">
							<div class="modal-header"><h4>CONFIRMATION</h4></div>
							<div class="modal-body">
								<b>ARE YOU SURE YOU WANT TO ACCEPT THIS REQUEST?</b>
							</div>
							<div class="modal-footer">
								<form method="POST">
									<input name="temporary_value" hidden/>
									<input type="submit" name="temporary_value_submit" hidden />
								</form>
								<a href="javascript:void(0)" onclick="$('[name=temporary_value_submit]').click();"
									class="btn btn-primary">&nbsp YES &nbsp</a>
								<a href="javascript:void(0)" class="btn btn-danger" data-dismiss="modal">
									&nbsp&nbsp NO &nbsp&nbsp</a>
							</div>
						</div>
					</div>
				</div>


				<div id="modal_denied" class="modal fade">
					<div class="modal-dialog modal-sm">
						<div class="modal-content">
							<div class="modal-header"><h4>CONFIRMATION</h4></div>
							<div class="modal-body">
								<b>ARE YOU SURE YOU WANT TO DENY THIS REQUEST?</b>
							</div>
							<div class="modal-footer">
								<form method="POST">
									<input name="temporary_valueD" hidden/>
									<input type="submit" name="temporary_value_submitD" hidden />
								</form>
								<a href="javascript:void(0)" onclick="$('[name=temporary_value_submitD]').click();"
									class="btn btn-primary">&nbsp YES &nbsp</a>
								<a href="javascript:void(0)" class="btn btn-danger" data-dismiss="modal">
									&nbsp&nbsp NO &nbsp&nbsp</a>
							</div>
						</div>
					</div>
				</div>

			<div>
				<?php

		$class->body_end();
	$class->html_end();

?>
