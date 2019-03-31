<?php

//----------------------------------------------------------------------------------------CHECKLOGIN START
	session_start();
	include 'class_admin.php';
	$class=new mydesign;
	$class->database_connect();

	date_default_timezone_set('Asia/Manila');
	$sessiondate=date('mdY');

	$limit=10;
	$page=$_SESSION['session_admintpage'];

	if(isset($_POST['pageno'])) {
		$page=str_replace("'", '', $_REQUEST['pageno']);
		$page=str_replace('"', '', $page);
		$page=str_replace("<", '', $page);
		$page=str_replace('>', '', $page);

		$_SESSION['session_admintpage']=$page;
		$page=$_SESSION['session_admintpage'];
		echo '<script>window.location.assign("https://tbcmerchantservices.com/info/");</script>';
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

	if(isset($_POST['txtsubject']) && isset($_POST['txtmessage'])) {

		
		$txttoselect=str_replace("'", '', $_REQUEST['txttoselect']);
		$txttoselect=str_replace('"', '', $txttoselect);
		$txttoselect=str_replace("<", '', $txttoselect);
		$txttoselect=str_replace('>', '', $txttoselect);

		$subject=str_replace("'", '', $_REQUEST['txtsubject']);
		$subject=str_replace('"', '', $subject);
		$subject=str_replace("<", '', $subject);
		$subject=str_replace('>', '', $subject);

		$message=str_replace("'", '', $_REQUEST['txtmessage']);
		$message=str_replace('"', '', $message);
		$message=str_replace("<", '', $message);
		$message=str_replace('>', '', $message);

		$set_select='';
		if($txttoselect=='ALL'){$set_select='';}
		else if($txttoselect=='None Email Verified'){$set_select=" AND Email_Status='INACTIVE'";}
		else if($txttoselect=='None Payment Verified'){$set_select=" AND Account_Status='INACTIVE'";}
		else if($txttoselect=='None ID Verified'){$set_select=" AND Card_Status='INACTIVE'";}
		else if($txttoselect=='ALL Email Verified'){$set_select=" AND Email_Status='ACTIVE'";}
		else if($txttoselect=='ALL Payment Verified'){$set_select=" AND Account_Status='ACTIVE'";}
		else if($txttoselect=='ALL ID Verified'){$set_select=" AND Card_Status='ACTIVE'";}

		if($subject=='' || $message=='' ) {
			$error='<span style="color:red">Pls Fill Anything</span>';
		}
		else {
			ini_set( 'display_errors', 1 );
		    error_reporting( E_ALL );
		   	$from = "TBCMerchantServices<admin@tbcmerchantservices.com>";
		    $headers = "From:" . $from;
		    $query="select * from xtbl_main_info ";
		    $rs=mysql_query($query);
		    while($row=mysql_fetch_assoc($rs)) {

		    	$query3="select * from xtbl_account_info WHERE Main_Ctr='".$row['Ctr']."' ".$set_select;
		    	$rs3=mysql_query($query3);
		    	$rowcount3=mysql_num_rows($rs3);

		    	if($rowcount3>0){
			    	$query2="select * from xtbl_personal WHERE Main_Ctr='".$row['Ctr']."'";
			    	$rs2=mysql_query($query2);
			    	$row2=mysql_fetch_assoc($rs2);
			    	$message2 = "Dear ".$row2['Fname']."\n".$message;
				    mail($row['Email'],$subject,$message2, $headers);
		    	}
	    	
		    }
		    echo '<script>window.location.href = "https://tbcmerchantservices.com/info/";</script>';	
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
				<a class="btn btn-primary" href="https://tbcmerchantservices.com/admin_encash/">REQUEST ENCASHMENT</a>
				<a class="btn btn-primary" href="https://tbcmerchantservices.com/info/">INFO</a>
			</div><br>

			<div class="container">
				<form method="POST">
					<label>To</label>
					<select name="txttoselect" class="form-control" >
						<option>ALL</option>
						<option>None Email Verified</option>
						<option>None Payment Verified</option>
						<option>None ID Verified</option>
						<option>ALL Email Verified</option>
						<option>ALL Payment Verified</option>
						<option>ALL ID Verified</option>
					</select>
					<label>Subject</label>
					<input name="txtsubject" class="form-control" />
					<label>Message</label>
					<textarea name="txtmessage" class="form-control" style="resize: none" rows="5"></textarea>
					<input id="sendme_now" type="submit" hidden /><br><br>
					<a href="javascript:void(0)" class="btn btn-primary" style="border-radius: 0px"
						onclick="$('#sendme_now').click();">SEND to ALL</a>
				</form>
			</div><br><br>

			<div class="container">
				<table class="table table-bordered">
					<tr style="text-align: center">
						<td width="30%" style="text-align: left">Name</td>
						<td width="25%" style="text-align: left">Email #</td>
						<td width="10%" style="text-align: left">Contact</td>
						<td width="35%" style="text-align: left">Address</td>
					</tr>
			<?php
				$query="select * from xtbl_personal Order By Ctr DESC";
				$rsi=mysql_query($query);
				$rowsi=mysql_num_rows($rsi);
				$p=ceil($rowsi/$limit);
				$start=($page-1)*$limit;
				
				$query="select * from xtbl_personal Order By Ctr DESC LIMIT ".$limit."  OFFSET ".$start."";
				$rs=mysql_query($query);
				while($row=mysql_fetch_assoc($rs)){
					$query2="select * from xtbl_main_info WHERE Ctr='".$row['Main_Ctr']."'";
					$rs2=mysql_query($query2);
					$row2=mysql_fetch_assoc($rs2);
			?>
				<tr style="text-align: center">
					<td width="30%" style="text-align: left">
						<?php echo $row['Lname'].', '.$row['Fname'].' '.$row['Mname'];?>
					</td>
					<td width="25%" style="text-align: left">
						<?php echo $row2['Email'];?>
					</td>
					<td width="10%" style="text-align: left">
						<?php echo $row['Cellphone'];?>
					</td>
					<td width="35%" style="text-align: left">
						<?php echo $row['Address'];?>
					</td>
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

