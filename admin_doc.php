<?php

//----------------------------------------------------------------------------------------CHECKLOGIN START
	session_start();
	include 'class_admin.php';
	$class=new mydesign;
	$class->database_connect();

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

	$query="select * from xtbl_adminaccount";
	$rs=mysql_query($query);
	$row=mysql_fetch_assoc($rs);
	$our_btc=$row['BTC'];
	$our_coinsph=$row['CoinPH'];
	$our_paypal=$row['Paypal'];
	$tbc_to_peso=$row['Tbc_to_Peso'];

	$error='';
	if(isset($_POST['clientno']) && isset($_POST['clientcode']) ) { //for approved
		$clientno=str_replace("'", '', $_POST['clientno']);
		$clientno=str_replace('"', '', $clientno);
		$clientno=str_replace("<", '', $clientno);
		$clientno=str_replace('>', '', $clientno);

		$clientcode=str_replace("'", '', $_POST['clientcode']);
		$clientcode=str_replace('"', '', $clientcode);
		$clientcode=str_replace("<", '', $clientcode);
		$clientcode=str_replace('>', '', $clientcode);

		if($clientcode==md5(md5($clientno)) ) {
			$query="update xtbl_account_info SET Card_Status='ACTIVE' WHERE Ctr='$clientno'";
			$rs=@mysql_query($query);
			$error='<span style="color: green"><h2>SUCCESSFUL</h2></span>';
			echo '<script>window.location.assign("https://tbcmerchantservices.com/admin_doc/");</script>';
		}
		else{
			$error='<span style="color: red"><h2>ERROR</h2></span>';
		}
	}

	if(isset($_POST['clientnod']) && isset($_POST['clientcoded']) ) { //for approved
		$clientno=str_replace("'", '', $_POST['clientnod']);
		$clientno=str_replace('"', '', $clientno);
		$clientno=str_replace("<", '', $clientno);
		$clientno=str_replace('>', '', $clientno);

		$clientcode=str_replace("'", '', $_POST['clientcoded']);
		$clientcode=str_replace('"', '', $clientcode);
		$clientcode=str_replace("<", '', $clientcode);
		$clientcode=str_replace('>', '', $clientcode);

		if($clientcode==md5(md5($clientno)) ) {
			$query="select * from xtbl_requirements WHERE Main_Ctr='".$clientno."'";
			$rs=mysql_query($query);
			while($row=mysql_fetch_assoc($rs)){
				if(file_exists($row['Image'])) {
					unlink($row['Image']);
				}
			}

			$query="delete from xtbl_requirements WHERE Main_Ctr='$clientno'";
			$rs=@mysql_query($query);
			$error='<span style="color: green"><h2>SUCCESSFUL</h2></span>';
			echo '<script>window.location.assign("https://tbcmerchantservices.com/admin_doc/");</script>';
		}
		else{
			$error='<span style="color: red"><h2>ERROR</h2></span>';
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
				<table class="table table-bordered">
					<tr>
						<td width="20%">Profile/Business</td>
						<td width="60%">Images</td>
						<td width="20%">ACTIONS</td>
					</tr>
					<?php
						$query="select * from xtbl_account_info WHERE Card_Status='INACTIVE'";
						$rs=mysql_query($query);
						while($row=mysql_fetch_assoc($rs)) {
							$query5="select * from xtbl_requirements WHERE Main_Ctr='".$row['Main_Ctr']."'";
							$rs5=mysql_query($query5);
							$numrows5=mysql_num_rows($rs5);

							if($numrows5>0) {

								$query2="select * from xtbl_main_info WHERE Ctr='".$row['Main_Ctr']."'";
								$rs2=mysql_query($query2);
								$row2=mysql_fetch_assoc($rs2);

								$query3="select * from xtbl_personal WHERE Main_Ctr='".$row['Main_Ctr']."'";
								$rs3=mysql_query($query3);
								$row3=mysql_fetch_assoc($rs3);
					?>
								<tr>
									<td width="20%"><?php echo $row3['Lname'].', '.$row3['Fname'].'<br>'.$row2['Business_Name'].'<br><br>'.$row3['Birthday'].'<br>'.$row3['Address'];?></td>
									<td width="60%">
									<?php
										$query4="select * from xtbl_requirements WHERE Main_Ctr='".$row['Main_Ctr']."'";
										$rs4=mysql_query($query4);
										while($row4=mysql_fetch_assoc($rs4)) {
											echo '<img src="https://tbcmerchantservices.com/'.$row4['Image'].'" width="100%"><br>';
										}
									?><br><br>
									</td>
									<td width="20%">

										<form method="POST" hidden>
											<input type="text" name="clientno"
												<?php echo 'id="clientno'.$row['Main_Ctr'].'" value="'.$row['Main_Ctr'].'"';?> />
											<input type="text" name="clientcode"
												<?php echo 'id="clientcode'.$row['Main_Ctr'].'" value="'.md5(md5($row['Main_Ctr'])).'"';?> />
											<input type="submit" <?php echo 'id="clientsub'.$row['Main_Ctr'].'"';?> />
										</form>

										<form method="POST" hidden>
											<input type="text" name="clientnod"
												<?php echo 'id="clientnod'.$row['Main_Ctr'].'" value="'.$row['Main_Ctr'].'"';?> />
											<input type="text" name="clientcoded"
												<?php echo 'id="clientcoded'.$row['Main_Ctr'].'" value="'.md5(md5($row['Main_Ctr'])).'"';?> />
											<input type="submit" <?php echo 'id="clientsubd'.$row['Main_Ctr'].'"';?> />
										</form>

										<a href="javascript:void(0)" class="btn btn-success"
											<?php echo 'onclick=$("#clientsub'.$row['Main_Ctr'].'").click();';?> >APPROVE</a>
										<a href="javascript:void(0)" class="btn btn-danger"
											<?php echo 'onclick=$("#clientsubd'.$row['Main_Ctr'].'").click();';?> >DISMISS</a>
									</td>
								</tr>
					<?php
							}
						}
					?>
				</table>

				<table class="table table-bordered">
				<?php
					$query="select * from xtbl_account_info WHERE Card_Status='ACTIVE' and Account_Status='ACTIVE' and Email_Status='ACTIVE'";
					$rsi=mysql_query($query);
					$rowsi=mysql_num_rows($rsi);
					$p=ceil($rowsi/$limit);
					$start=($page-1)*$limit;

					$query="select * from xtbl_account_info WHERE Card_Status='ACTIVE' and Account_Status='ACTIVE' and Email_Status='ACTIVE' order by Ctr DESC LIMIT ".$limit."  OFFSET ".$start."";
					$rs=mysql_query($query);
					while($row=mysql_fetch_assoc($rs)) {
						$query2="select * from xtbl_personal where Main_Ctr='".$row['Ctr']."'";
						$rs2=mysql_query($query2);
						$row2=mysql_fetch_array($rs2);
				?>
						<tr>
							<td width="25%"><?php echo $row2['Lname'].', '.$row2['Fname'].' '.$row2['Mname'];?></td>
							<td width="10%"><?php echo $row2['Birthday'];?></td>
							<td width="15%"><?php echo $row2['Cellphone'];?></td>
							<td width="40%"><?php echo $row2['Address'];?></td>
							<td width="10%">
								<?php
									$query3="select * from xtbl_requirements where Main_Ctr='".$row['Ctr']."'";
									$rs3=mysql_query($query3);
								?>
								<div <?php echo 'id="modal_doc'.$row['Ctr'].'"';?> class="modal fade">
									<div class="modal-dialog modal-md">
										<div class="modal-content" style="border-radius: 0px;">
											<div class="modal-header" style="background-color: #191970; text-align: center; color: white">
												<span class="modal-title" style="font-size: 20px">DOCUMENTS</span>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				      								<span aria-hidden="true" style="color: white">&times;</span>
				    							</button>
											</div>
											<div class="modal-body">
											<?php
												while($row3=mysql_fetch_assoc($rs3)){
													echo '<img width="100%" src="https://tbcmerchantservices.com/'.$row3['Image'].'" >';
												}
											?>
											</div>
											<div class="modal-footer" style="padding:5px">
												<a href="javascript:void(0)"													class="btn btn-danger btn-lg btn-block"  data-dismiss="modal" style="border-radius: 0px">&nbsp CLOSE &nbsp</a>
											</div>
										</div>
									</div>
								</div>
								<a href="javascript:void(0)" <?php echo 'onclick=$("#modal_doc'.$row['Ctr'].'").modal("show");';?> >DOCUMENTS</a>
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
