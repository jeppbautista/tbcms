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
		?>

			<div style="background-color: rgb(255,255,255,0.5); height: auto; padding-top: 10px;
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
				<a class="btn btn-primary" href="https://tbcmerchantservices.com/admin_encash/"> ENCASHMENT</a>
<a class="btn btn-primary" href="https://tbcmerchantservices.com/info/">INFO</a>
<a class="btn btn-primary" href="https://tbcmerchantservices.com/admin_trade/">TRADING</a>
<a class="btn btn-primary" href="https://tbcmerchantservices.com/admin_cashin/">CASH-IN</a>
			</div><br>

			<?php 
				$mquery="select * from xtbl_btc_request where Status='UNCONFIRM' order by Ctr ASC";
				$mrs=mysql_query($mquery);

			?>
			<div class="container">
				<table class="table table-bordered">
				<?php 
				while($mrow=mysql_fetch_assoc($mrs)) {
				?>
				<tr>
					<td><?php dateformat_created($mrow['Date']);?></td>
					<td><?php echo $mrow['Btc_Address'];?></td>
					<td><?php echo $mrow['Peso_Value'];?> PHP</td>
					<td><?php echo $mrow['Tbc_Value'];?> TBC</td>

					<td width="120px" style="padding: 0px; padding-top: 2px">
						<form <?php echo 'id="frmmarkasdone'.$mrow['Ctr'].'"';?> hidden>
							<input name="markasdone1" <?php echo 'value="'.$mrow['Ctr'].'"';?> />
							<input name="markasdone2" <?php echo 'value="'.md5($mrow['Ctr'].$mrow['Ctr']).'"';?> />
						</form>
						<a href="javascript:void" <?php echo 'onclick=markasdone("'.$mrow['Ctr'].'");';?> style="border-radius: 0px" class="btn btn-primary btn-block">
						Mark as Done
						</a>
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

	function dateformat_created($date) {
    	if($date=='0000-00-00') { echo ' ';}
    	else {
    		if($date[5].$date[6]=='01') {$bday='January';}
    		else if($date[5].$date[6]=='02') {$bday='February';}
    		else if($date[5].$date[6]=='03') {$bday='March';}
    		else if($date[5].$date[6]=='04') {$bday='April';}
    		else if($date[5].$date[6]=='05') {$bday='May';}
    		else if($date[5].$date[6]=='06') {$bday='June';}
    		else if($date[5].$date[6]=='07') {$bday='July';}
    		else if($date[5].$date[6]=='08') {$bday='August';}
    		else if($date[5].$date[6]=='09') {$bday='September';}
    		else if($date[5].$date[6]=='10') {$bday='October';}
    		else if($date[5].$date[6]=='11') {$bday='November';}
    		else if($date[5].$date[6]=='12') {$bday='December';}
    		echo $bday.' '.$date[8].$date[9].', '.$date[0].$date[1].$date[2].$date[3]; 
    	}
    }
?>

