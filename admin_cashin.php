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

	$errorcode='';

	if(isset($_POST['usertargetname']) && isset($_POST['usertargetvalue'])) {

		$usertargetname=str_replace("'", '', $_POST['usertargetname']);
		$usertargetname=str_replace('"', '', $usertargetname);
		$usertargetname=str_replace("<", '', $usertargetname);
		$usertargetname=str_replace('>', '', $usertargetname);

		$usertargetvalue=str_replace("'", '', $_POST['usertargetvalue']);
		$usertargetvalue=str_replace('"', '', $usertargetvalue);
		$usertargetvalue=str_replace("<", '', $usertargetvalue);
		$usertargetvalue=str_replace('>', '', $usertargetvalue);

		if($usertargetname=='' || $usertargetname==null) {
			$errorcode="<span style='color: red'>Username not Found</span>";
		}
		else if($usertargetvalue=='' || $usertargetvalue==0 || $usertargetvalue==null || !is_numeric($usertargetvalue) ) {
			$errorcode="<span style='color: red'>Peso Value Not Acceptable</span>";
		}
		else {
			$squery="select * from xtbl_account_info where Username='$usertargetname' LIMIT 1";
			$srs=mysql_query($squery);
			$snumr=mysql_num_rows($srs);
			$srow=mysql_fetch_assoc($srs);
			$sctr=$srow['Main_Ctr'];

			if($snumr==0) {
				$errorcode="<span style='color: red'>Username not Found</span>";
			}
			else {
				$itbcvalue=$usertargetvalue/$tbc_to_peso;

				$yquery="select * from xtbl_btc_request where Main_Ctr='$sctr' and Date='".date('Y-m-d')."' and  Tbc_Value='".$itbcvalue."'";
				$yrs=mysql_query($yquery);
				$yrown=mysql_num_rows($yrs);

				if($yrown==0){
					$iquery="insert into xtbl_btc_request(Tbc_Value, Peso_Value, Main_Ctr, Status, Date, Btc_Address)
						values('".$itbcvalue."', '".$usertargetvalue."', '".$sctr."', 'CONFIRM', '".date('Y-m-d')."', 'CASH IN by Username ".$usertargetname."')";
					$irs=@mysql_query($iquery);
					if($irs){ header("location: https://tbcmerchantservices.com/admin_cashin/");}
				}
				else {
					$errorcode="<span style='color: red'>Cash In Already Done</span>";
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

			<div class="container">

					<div class="alert">
						<form method="POST">
							<center><div><?php echo $errorcode; ?> &nbsp</div></center>
							<table class="table" style="border: 0px solid red">
								<tr>
									<td width="150px" align="right">Username</td>
									<td><input class="form-control" name="usertargetname" /></td>
									<td width="150px" align="right">Peso Amount</td>
									<td><input class="form-control" name="usertargetvalue" /></td>
									<td>
										<input type="submit" name="usertargetsub" hidden>
										<a href="javascript:void(0)" onclick="$('[name=usertargetsub]').click();"  class="btn btn-success">
										Cash In NOW
										</a>
									</td>
								<tr>
							</table>
						</form>
					</div>
				</div>


			</div>

			<div class="container">
				<table class="table table-bordered">
				<?php
				$query="select * from xtbl_btc_request where Tbc_Value>'0' order by Ctr DESC LIMIT 200";
				$rs=mysql_query($query);
				while($row=mysql_fetch_assoc($rs)) {
					?>
					<tr>
						<td><?php dateformat_created($row['Date']);?></td>
						<td><?php echo $row['Btc_Address'];?></td>
						<td><?php echo $row['Tbc_Value'];?></td>
						<td><?php echo $row['Peso_Value'];?> PHP</td>
						<td width="120px" style="padding: 0px; padding-top: 2px">
							<a href="javascript:void" style="border-radius: 0px"
							<?php
								if($row['Status']=='UNCONFIRM'){ echo 'class="btn btn-danger btn-block"';}
								else {echo 'class="btn btn-success btn-block"';}
							?> > <?php echo $row['Status']; ?>
							</a>
						</td>
						<td width="10px"></td>
						<td width="120px" style="padding: 0px; padding-top: 2px">
							<a href="javascript:void" style="border-radius: 0px"
							<?php
								if($row['Tbc_Value']<=0){ echo 'class="btn btn-danger btn-block"';}
								else {echo 'class="btn btn-success btn-block"';}
							?> > <?php echo $row['Tbc_Value']; ?> TBC
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
