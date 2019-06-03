	<?php
	//----------------------------------------------------------------------------------------CHECKLOGIN START
		session_start();
		include 'class_admin.php';
		$class=new mydesign;
		$class->database_connect();

		include 'model.php';
		$model = new eudodona_model;

		date_default_timezone_set('Asia/Manila');
		$sessiondate=date('mdY');

		$limit=10;
		$page=$_SESSION['session_admpage'];

		if(isset($_POST['pageno'])) {
			$page=str_replace("'", '', $_REQUEST['pageno']);
			$page=str_replace('"', '', $page);
			$page=str_replace("<", '', $page);
			$page=str_replace('>', '', $page);

			$_SESSION['session_admpage']=$page;
			$page=$_SESSION['session_admpage'];
			echo '<script>window.location.assign("https://tbcmerchantservices.com/admin_doc/");</script>';
		}

	  if($page==""){$page=1;}

		if(!isset($_SESSION['session_tbcmerchant_ctr_myadmin'.$sessiondate])){
			header("location: https://tbcmerchantservices.com/tbcmyadmin/");
		}

		if(isset($_POST['temporary_value'])) {
			# APPROVAL
			$temvalue=str_replace("'", '', $_POST['temporary_value']);
			$temvalue=str_replace('"', '', $temvalue);
			$temvalue=str_replace("<", '', $temvalue);
			$temvalue=str_replace('>', '', $temvalue);

			if($temvalue=='') {
				$error='Warning: Please do not attemp to hack';
			}
			else {
				$query="select * from xtbl_admin_eudodona WHERE Ctr='$temvalue'";
				$rs=mysql_query($query);
				$row=mysql_fetch_assoc($rs);

				$temp_ctr=$row['Main_Ctr'];
				$tbc_value=$row['Tbc_Amount'];
				$trans_id=md5(md5(1).md5(date('mdYHis'))).md5(md5(date('mdYHis')).md5(1));

				// $query="Insert into xtbl_mytransaction".$temp_ctr."(Amount, Status, Transact_Id, Type, Date)
				// 	values(
				// 		'$tbc_value',
				// 		'ACTIVE',
				// 		'$trans_id',
				// 		'RECEIVE',
				// 		'".date('Y-m-d H:i:s')."'
				// 		)";
				// $rs=@mysql_query($query);

				$query="update xtbl_admin_eudodona SET Status='SUCCESS'
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

				// $table_id = $model->get_tableid($table_id);
				$table_id = 2;
				$rank = $model->get_rank();
				$paid = 1;

				$query="select * from xtbl_eudodona WHERE MainCtr='$Mainctr'";
				$rs=mysql_query($query);
				$row=mysql_fetch_assoc($rs);
				$count=mysql_num_rows($rs);
				$sponsor_id = $row['refcode'];

				if($count == 0){
					# if not yet in edudona table
					$query="insert into xtbl_eudodona(MainCtr, username, refcode, table_id, rank, paid) values('$Mainctr','$username', '$refcode', '$table_id', '$rank', '$paid')";
					mysql_query($query);

					$query="select * from xtbl_eudodona WHERE MainCtr='$Mainctr'";
					$rs=mysql_query($query);
					$row=mysql_fetch_assoc($rs);
					$count=mysql_num_rows($rs);
					$sponsor_id = $row['refcode'];

					$query="select * from xtbl_account_info WHERE Crypt_Id='$sponsor_id'";
					$rs2=mysql_query($query);
					$row2=mysql_fetch_assoc($rs2);
					$sponsor_ctr = $row2['Main_Ctr'];

					$query="select * from xtbl_eudodona_wallet WHERE MainCtr='$sponsor_ctr'";
					$rs3=mysql_query($query);
					$row3=mysql_fetch_assoc($rs3);
					$curr_sponsor_balance = $row3['Balance'];

					$starting_balance = 0;
					$update_query = "update xtbl_eudodona_wallet SET Balance = '$starting_balance' WHERE MainCtr='$Mainctr'";
					mysql_query($update_query);

					$new_sponsor_balance = $curr_sponsor_balance + 100;

					$update_query2 = "update xtbl_eudodona_wallet SET Balance = '$new_sponsor_balance' WHERE MainCtr='$sponsor_ctr'";
					mysql_query($update_query2);
					$model->update_main_payment();
					$model->update_table();

					$email = "tbcmsapp@gmail.com";
					$from = "TBCMerchantServices<automail@tbcmerchantservices.com>";
					$subject = "Edudona Entry";
					$message = "<html><body>Entry by ".$username."</body></html>";
					$headers = "From:" . $from. "\r\n";
					$headers .= "Reply-To: ". $from. "\r\n";
					$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
					@mail($email,$subject,$message, $headers);


				}else{
					// $table_id = $row['table_id'];
					// $query="update xtbl_eudodona SET paid = 1
					// 	WHERE MainCtr='$Mainctr'";
					// @mysql_query($query);
					// $model->update_main_payment();

				}

					if($model->checkAllPaid(1) == 1){
							$model->update_edudona_cycle();
							$model->update_wallet(1);
							$model->update_ranks(1);
							$model->update_main_payment();
							$model->update_table();


							$email = "tbcmsapp@gmail.com";
							$from = "TBCMerchantServices<automail@tbcmerchantservices.com>";
							$subject = "Edudona Exit";
							$message = "<html><body>Main Table exit occured</body></html>";
							$headers = "From:" . $from. "\r\n";
							$headers .= "Reply-To: ". $from. "\r\n";
							$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
							@mail($email,$subject,$message, $headers);
							echo "<script>alert('Table exit occured!')</script>";
					}

				# echo '<script>window.location.assign("https://tbcmerchantservices.com/admin_edudona/");</script>';
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
				$query="select * from xtbl_admin_eudodona WHERE Ctr='$temvalue'";
				$rs=mysql_query($query);
				$row=mysql_fetch_assoc($rs);

				$temp_ctr=$row['Main_Ctr'];
				$tbc_value=$row['Tbc_Amount'];
				$trans_id=md5(md5(1).md5(date('mdYHis'))).md5(md5(date('mdYHis')).md5(1));

				// if($row['Remarks']=='ACTIVATION') {
				// 	$query="update xtbl_account_info SET Account_Status='INACTIVE'
				// 		WHERE Ctr='$temp_ctr'";
				// 	$rs=@mysql_query($query);
				// 	$query="delete from xtbl_admin_transaction WHERE Ctr='$temvalue'";
				// 	$rs=@mysql_query($query);
				// }
				$query="delete from xtbl_admin_eudodona WHERE Ctr='$temvalue'";
				$rs=@mysql_query($query);

				//
				// $query="update xtbl_admin_eudodona SET Status='DENIED'
				// 	WHERE Ctr='$temvalue'";
				// $rs=@mysql_query($query);
				echo '<script>window.location.assign("https://tbcmerchantservices.com/admin_edudona/");</script>';

			}

		}

	  $query="select * from xtbl_adminaccount";
	  $rs=mysql_query($query);
	  $row=mysql_fetch_assoc($rs);
	  $our_btc=$row['BTC'];
	  $our_coinsph=$row['CoinPH'];
	  $our_paypal=$row['Paypal'];
	  $tbc_to_peso=$row['Tbc_to_Peso'];

	  $errorcode='';

	  //----------------------------------------------------------------------------------------CHECKLOGIN END

	  //----------------------------------------------------------------------------------------SIGNUP_FORM START

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
				$query="select * from xtbl_admin_eudodona Order by Datetime DESC";
				$rs=mysql_query($query);
				while($row=mysql_fetch_assoc($rs)) {
					$query2="select * from xtbl_personal where Main_Ctr='".$row['Main_Ctr']."'";
					$rs2=mysql_query($query2);
					$row2=mysql_fetch_assoc($rs2);
				?>
				<tr>
					<td width="10%"><?php echo $row['Datetime'];?></td>
					<td width="10%"><?php echo 'P'.number_format($row['Peso_amount'],2);?></td>
					<td width="10%"><?php echo $row['Type'];?></td>
					<td width="40%"><?php echo $row2['Fname'].' '.$row2['Lname'].'<br>'.$row['Transaction'];?></td>
					<td width="10%"><?php echo $row['Remarks'];?></td>
					<td width="20%">
						<?php if ($row['Status']=='WAITING') { ?>
							<a class="btn btn-success" href="javascript:void(0)"
								<?php echo 'onclick="btnaccept('.$row['Ctr'].')"';?> >ACCEPT</a>
							<a class="btn btn-danger" href="javascript:void(0)"
								<?php echo 'onclick="btndenied('.$row['Ctr'].')"';?> >DENIED</a>
						<?php } else { echo '<img src="https://tbcmerchantservices.com/images/1482106046_tick_16.png" height="30px"> SUCCESS'; } ?>
							
					</td>
				</tr>
			<?php
			}
			?>
			</table>
	  </div>

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

	<?php
	?>
