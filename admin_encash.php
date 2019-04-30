<?php

//----------------------------------------------------------------------------------------CHECKLOGIN START
	session_start();
	include 'class_admin.php';
	$class=new mydesign;
	$class->database_connect();

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
				<table class="table table-bordered">
					<tr style="text-align: center">
						<td width="20%" style="text-align: left">Transaction#</td>
						<td width="60%" style="text-align: left">Mobile #</td>
						<td width="20%" style="text-align: left">Amount</td>
					</tr>
			<?php
				$query="select * from xtbl_reward Order By Ctr DESC";
				$rsi=mysql_query($query);
				$rowsi=mysql_num_rows($rsi);
				$p=ceil($rowsi/$limit);
				$start=($page-1)*$limit;

				$query="select * from xtbl_reward Order By Ctr DESC LIMIT ".$limit."  OFFSET ".$start."";
				$rs=mysql_query($query);
				while($row=mysql_fetch_assoc($rs)){
			?>
				<tr style="text-align: center">
					<td width="20%" style="text-align: left"><?php echo $row['Ctr'];?></td>
					<td width="60%" style="text-align: left"><?php echo $row['Mobile'];?></td>
					<td width="20%" style="text-align: left"><?php echo number_format($row['Amount'],2);?></td>
				</tr>
			<?php
				}
			?>
				</table>
			</div>

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

			</div>

		<?php

		$class->body_end();
	$class->html_end();

?>
