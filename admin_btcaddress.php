<?php

//----------------------------------------------------------------------------------------CHECKLOGIN START
	session_start();
	include 'class_admin.php';
	$class=new mydesign;
	$class->database_connect();
	$btc_Address=new btc_Address;
	date_default_timezone_set('Asia/Manila');
	$sessiondate=date('mdY');

	$limit=10;
	$page=$_SESSION['session_admgpage'];

	if(isset($_POST['pageno'])) {
		$page=str_replace("'", '', $_REQUEST['pageno']);
		$page=str_replace('"', '', $page);
		$page=str_replace("<", '', $page);
		$page=str_replace('>', '', $page);

		$_SESSION['session_admgpage']=$page;
		$page=$_SESSION['session_admgpage'];
		echo '<script>window.location.assign("https://tbcmerchantservices.com/admin_encash/");</script>';
	}

	if($page==""){$page=1;}

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

	$errorcode='';

	if(isset($_POST['usertargetbtc']) ) {

		$usertargetbtc=str_replace("'", '', $_POST['usertargetbtc']);
		$usertargetbtc=str_replace('"', '', $usertargetbtc);
		$usertargetbtc=str_replace("<", '', $usertargetbtc);
		$usertargetbtc=str_replace('>', '', $usertargetbtc);
		$usertargetbtc=str_replace(' ', '', $usertargetbtc);

		$s = array( $usertargetbtc );
		$message='';

		foreach($s as $btc){
    		$message = "OK";
    		try { $btc_Address->validate($btc); }
    		catch(Exception $btc_Address){ $message = $btc_Address->getMessage(); }
		}

		if($message=='bad digest'){ //check if BTC Address is valid
			$errorcode='<span>INVALID BTC ADDRESS</span>';
		}
		else {
			$tquery="select * from xtbl_btcadd where Address='$usertargetbtc'";
			$trs=mysql_query($tquery);
			$trows=mysql_num_rows($trs);
			if($trows>0){
				$errorcode='<span>BTC Address Already Inserted</span>';
			}
			else {
				$fquery="insert into xtbl_btcadd(Address) values('".$usertargetbtc."')";
				$frs=@mysql_query($fquery);
				if($frs) {
					header("location: https://tbcmerchantservices.com/admin_btcaddress/");
				}
			}
		}

	}

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

					<div class="alert">
						<form method="POST">
							<center><div><?php echo $errorcode; ?> &nbsp</div></center>
							<table class="table" style="border: 0px solid red">
								<tr>
									<td width="150px" align="right">BTC ADDRESS</td>
									<td><input class="form-control" name="usertargetbtc" /></td>
									<td>
										<input type="submit" name="usertargetsubx" hidden>
										<a href="javascript:void(0)" onclick="$('[name=usertargetsubx]').click();"  class="btn btn-success">
										Cash In NOW
										</a>
									</td>
								<tr>
							</table>
						</form>
					</div>
				</div>


			</div>

		<?php

		$class->body_end();
	$class->html_end();

?>
