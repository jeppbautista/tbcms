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

	$amount=str_replace("'", '', $_REQUEST['urlblockchaini']);
	$amount=str_replace('"', '', $amount);
	$amount=str_replace("<", '', $amount);
	$amount=str_replace('>', '', $amount);

	$query="select * from xtbl_adminaccount";
	$rs=mysql_query($query);
	$row=mysql_fetch_assoc($rs);
	$our_btc=$row['BTC'];
	$our_coinsph=$row['CoinPH'];
	$our_paypal=$row['Paypal'];
	$tbc_to_peso=$row['Tbc_to_Peso'];

	$mquery="select * from xtbl_btcadd where Ctr='".$ctr."'";
	$mrs=mysql_query($mquery);
	$mrow=mysql_fetch_assoc($mrs);

	$mytbcamount4=0;
	$query4="select * from xtbl_btc_request where Main_Ctr='$ctr'";
	$rs4=mysql_query($query4);
	while($row4=mysql_fetch_assoc($rs4)) {
		$mytbcamount4=$mytbcamount4+$row4['Tbc_Value'];
	}

	?>
	<div class="container">
		<?php 
		echo '<input hidden id="inputtbctophp" value="'.$tbc_to_peso.'"/>';
$amount=0;
		if($amount<250000) {
			?>
			<div class="col-md-3"></div>
			<div class="col-md-6 alert" style="background-color: #f2f2f2; padding: 20px">
				<center>
					<h3>Please Deposit 0.005 BTC Admin Fee to the Bitcoin Address Below as a support to TBCMS<h3>
					<span class="glyphicon glyphicon-circle-arrow-down" style="font-size: 40px"></span><br>
					3A9qBQkV9tu3zQ7cDosenG5ev3TyJ56CfG
                                        <br><br>

					<span style="color: red">Total Deposited is <?php echo number_format(0,8);?> BTC</span>

				</center>
			</div>
			<div class="col-md-3"></div>
			<?php
		}
		else {
			?>
			<div class="col-md-7">
				<div class="alert" style="background-color: #f2f2f2; padding-top: 4px">
					<center><h3>RELOAD TBC</h3></center><br>
					<table width="100%">
						<tr>
							<td width="170px" align="center" valign="top">
								<img src="https://tbcmerchantservices.com/images/coinph.png" width="80%">
							</td>
							<td>
								<b>Load Via Coins.Ph</b><br>
								Send any amount to CoinsPh Address below and don't forget to include your username in the remarks section of the sending form of coinsph<br>
								CoinsPH : <b>3A9qBQkV9tu3zQ7cDosenG5ev3TyJ56CfG</b> <br><br>
							</td>
						</tr>
						<tr>
							<td width="170px" align="center" valign="top">
								<img src="https://tbcmerchantservices.com/images/bitcoin.png" width="80%">
							</td>
							<td>
								<b>Load via Bitcoin</b><br>
								Send any amount to Bitcoin Address below and Email the blockchain record in the email provided below together with your username<br>
								BTC Address : <b>3A9qBQkV9tu3zQ7cDosenG5ev3TyJ56CfG</b> <br>
								Email Address : <b>support@tbcmerchantservices.com</b> <br><br>
							</td>
						</tr>
						<tr>
							<td width="170px" align="center" valign="top">
								<img src="https://tbcmerchantservices.com/images/paypal.png" width="80%">
							</td>
							<td>
								<b>Load via Bitcoin</b><br>
								Send any amount to Paypal Account below and Email the transaction record and screenshot of the transaction together with your username<br>
								Paypal : <b>https://www.paypal.me/tbcmerchantservices</b> <br>
								Email Address : <b>support@tbcmerchantservices.com</b>
							</td>
						</tr>
					</table>
					

				</div>
				
			</div>

			<div class="col-md-5" >
				<div class="alert" style="background-color: #f2f2f2; padding-top: 4px">
					<center><h3>SELL TBC</h3></center><br>
					<div id="tbccurrentbal" style="font-size: 17px">
						Available Balance: <?php echo number_format($mytbcamount4,8);?> TBC
					</div>
					<form>
						<center><div id="tradingerror" style="color: red">&nbsp</div></center>
						<table width="100%">
							<tr>
								<td width="100px">BTC Address</td>
								<td style="padding: 4px">
									<input name="inputbtcaddress" class="form-control" style="height: 40px; font-size: 20px" />
								</td>
							</tr>
							<tr>
								<td width="100px">PHP Value</td>
								<td style="padding: 4px">
									<input name="inputphpvalue" class="form-control" style="height: 40px; font-size: 20px" />
								</td>
							</tr>
							<tr>
								<td width="100px">TBC Value</td>
								<td style="padding: 4px">
									<input readonly name="inputtbcvalue" class="form-control" style="height: 40px; background-color: white; font-size: 20px"/>
								</td>
							</tr>

							<tr>
								<td width="100px"></td>
								<td style="padding: 4px">
									Please give us 24hrs to process your request. You can only request once a day.
								</td>
							</tr>

							<tr>
								<td width="100px"></td>
								<td style="padding: 4px">
									<a href="javascript:void(0)" id="btntradebutton" class="btn btn-primary btn-lg" style="border-radius: 0px" onclick="submit_request()">
										SUBMIT REQUEST
									</a>
								</td>
							</tr>

						</table>

					</form>

				</div>
			</div>

			<script>
				$("[name=inputphpvalue]").keydown(function (e) {

			        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
			            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
			            (e.keyCode >= 35 && e.keyCode <= 40)) {
			           	return;
			        }
			        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
			            e.preventDefault();
			        }
			    });

			    $("[name=inputphpvalue]").keyup(function() {
			    	var tr=$("[name=inputphpvalue]").val();
					var sr=$('#inputtbctophp').val();

					if(tr>=200 && tr<=250) {
						$('[name=inputtbcvalue]').val(tr/sr);
					} 
					else {
						$('[name=inputtbcvalue]').val('Min:P200, Max:P250');	
					}
			    });

			    function submit_request(value) {
			    	$('#btntradebutton').hide(0, function() {
						$.ajax({
					        type: "POST",
					        url: 'https://tbcmerchantservices.com/traderequest/', 
					        data: $("form").serialize(),
					        success: function(data){
					        	if(data=='success') {
					        		window.location.assign("https://tbcmerchantservices.com/exchange/");
					        	}
					        	else {
					        		$('#tradingerror').html(data);
					        		$('#btntradebutton').show();
					        	}
					        }
					    });
			    	});

				}

			</script>

		</div>

		<div class="container">
			<table class="table table-bordered" style="font-size: 17px">
		<?php

			$query="select * from xtbl_btc_request where Main_Ctr='$ctr' order by Ctr DESC LIMIT 300";
			$rs=mysql_query($query);
			while($row=mysql_fetch_assoc($rs)) {
				?>
				<tr>
					<td><?php dateformat_created($row['Date']);?></td>
					<td><?php echo $row['Btc_Address'];?></td>
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

	}

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
