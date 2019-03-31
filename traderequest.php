<?php
	session_start();
	include 'class3.php';
	$class=new mydesign;
	$class->database_connect();
	$btc_Address=new btc_Address;

	date_default_timezone_set('Asia/Manila');
	$sessiondate=date('mdY');
	if(!isset($_SESSION['session_tbcmerchant_ctr'.$sessiondate])){
		echo '<script>window.location.assign("https://tbcmerchantservices.com/welcome/");</script>';
	}

	$ctr=$_SESSION['session_tbcmerchant_ctr'.$sessiondate];

	$query="select * from xtbl_adminaccount";
	$rs=mysql_query($query);
	$row=mysql_fetch_assoc($rs);
	$tbc_to_peso=$row['Tbc_to_Peso'];
	

	if($email_status=='INACTIVE' || $account_status=='INACTIVE' || $card_status=='INACTIVE'){
		header("location: https://tbcmerchantservices.com/home/");
	}
	else {

		if( isset($_REQUEST['inputbtcaddress']) && isset($_REQUEST['inputphpvalue']) && 
			isset($_REQUEST['inputtbcvalue']) ) {

			$txtbtcaddress=str_replace("'", '', $_REQUEST['inputbtcaddress']);
			$txtbtcaddress=str_replace('"', '', $txtbtcaddress);
			$txtbtcaddress=str_replace("<", '', $txtbtcaddress);
			$txtbtcaddress=str_replace('>', '', $txtbtcaddress);

			$phpamount=str_replace("'", '', $_REQUEST['inputphpvalue']);
			$phpamount=str_replace('"', '', $phpamount);
			$phpamount=str_replace("<", '', $phpamount);
			$phpamount=str_replace('>', '', $phpamount);

			$phpconvert=$phpamount/$tbc_to_peso;

			$s = array( $txtbtcaddress );
			$message='';

			foreach($s as $btc){
	    		$message = "OK";
	    		try { $btc_Address->validate($btc); }
	    		catch(Exception $btc_Address){ $message = $btc_Address->getMessage(); }
			}
			
			if($message=='bad digest'){ //check if BTC Address is valid
				echo '<span>INVALID BTC ADDRESS</span>';
			}
			else if($phpamount=='') {echo '<span>Amount acceptable is from P200 to P250</span>';}
			else if($phpamount>=200 && $phpamount<=250) {

				$query="select * from xtbl_btc_request where Main_Ctr='$ctr' and Date='".date('Y-m-d')."' and  Tbc_Value<'0'";
				$rs=mysql_query($query);
				$rows=mysql_num_rows($rs);
				if($rows==0) {

					$mytbcamount=0;
					$query="select * from xtbl_btc_request where Main_Ctr='$ctr' and Status='CONFIRM'";
					$rs=mysql_query($query);
					while($row=mysql_fetch_assoc($rs)) {
						$mytbcamount=$mytbcamount+$row['Tbc_Value'];
					}
					if($phpconvert>$mytbcamount){
						echo '<span>Insufficient Funds</span>';
					} 
					else {
						$query="insert into xtbl_btc_request(Tbc_Value, Peso_Value, Main_Ctr, Status, Date, Btc_Address) 
							values('-".$phpconvert."', '".$phpamount."', '".$ctr."', 'UNCONFIRM', '".date('Y-m-d')."', '".$txtbtcaddress."')";

						$rs=@mysql_query($query);
						if($rs) {
							echo 'success';
						}
					}
				}
				else {
					echo '<span>Request already made this day</span>';
				}

			}
		}

	}

	
?>