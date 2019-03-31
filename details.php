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

	$query="select * from xtbl_adminaccount";
	$rs=mysql_query($query);
	$row=mysql_fetch_assoc($rs);
	$our_btc=$row['BTC'];
	$our_coinsph=$row['CoinPH'];
	$our_paypal=$row['Paypal'];
	$tbc_to_peso=$row['Tbc_to_Peso'];

	$query="select * from xtbl_account_info WHERE Main_Ctr='$ctr'";
	$rs=mysql_query($query);
	$row=mysql_fetch_assoc($rs);
	$email_status=$row['Email_Status'];
	$account_type=$row['Account_Type'];
	$account_status=$row['Account_Status'];
	$card_status=$row['Card_Status'];
	$username=$row['Username'];
	$activation_amount=0;
	if($account_type=='MERCHANT') {$activation_amount=2500;}
	else {$activation_amount=1500;}
	$activition_tbc_amount=$activation_amount/$tbc_to_peso;

	$query="select * from xtbl_main_info WHERE Ctr='$ctr'";
	$rs=mysql_query($query);
	$row=mysql_fetch_assoc($rs);
	$current_email=$row['Email'];
	$business_logo=$row['Business_Logo'];
	$business_name=$row['Business_Name'];
	$business_category=$row['Business_Category'];
	$business_description=$row['Description'];
	$business_country=$row['Country'];

	$query="select * from xtbl_personal WHERE Main_Ctr='$ctr'";
	$rs=mysql_query($query);
	$row=mysql_fetch_assoc($rs);
	$fullname=$row['Fname'].' '.$row['Lname'];
	$lastname=$row['Lname'];
	$firstname=$row['Fname'];
	$middlename=$row['Mname'];
	$birthday=$row['Birthday'];
	$cellphone=$row['Cellphone'];
	$address=$row['Address'];
	$profile_image=$row['Profile_Image'];

	if($email_status=='INACTIVE' && $account_status=='INACTIVE' && $card_status=='INACTIVE'){
		header("location: https://tbcmerchantservices.com/home/");
	}
	else if ($email_status=='ACTIVE' && $account_status=='INACTIVE' && $card_status=='INACTIVE')
	{

		$class->doc_type();
		$class->html_start('');
			$class->head_start();
				echo '<link rel="shortcut icon" type="image/x-icon" href="https://tbcmerchantservices.com/images/tbslogo.png" />';
				$class->title_page('TBCMS-'.$username);
				$class->script('https://tbcmerchantservices.com/js/jquery-3.1.1.js');
				$class->script('https://tbcmerchantservices.com/js/bootstrap.js');
				$class->link('https://tbcmerchantservices.com/css/bootstrap.css');
			$class->head_end();
			$class->body_start('');
			if($account_type=='MERCHANT') {
				$class->page_home_header_start();
					$class->page_home4_header_content();
				$class->page_home_header_end();
				echo '<div class="container"><h3>Welcome back,  <b>'.$current_email.'</b></h3></div>';

				if(isset($_POST['submit'])){
						if(count($_FILES['upload_logo']['name']) > 0){
										$tmpFilePath = $_FILES['upload_logo']['tmp_name'];

										if($tmpFilePath != ""){
											$endfilename=str_replace(" ", '', $_FILES["upload_logo"]["name"]);
												$shortname = $_FILES['upload_logo']['name'];

												if(file_exists('business/'.$business_logo)) {
													unlink('business/'.$business_logo);
												}

												$business_logo = $ctr.md5(date('dmYHis')).$endfilename;

												$check = getimagesize($_FILES["upload_logo"]["tmp_name"]);
												if($check !== false) {
													if(move_uploaded_file($tmpFilePath, 'business/'.$business_logo)) {
															$files[] = $shortname;
															$upload_query="update xtbl_main_info SET
															Business_Logo='$business_logo'
															WHERE Ctr='$ctr'";
															$upload_rs=@mysql_query($upload_query);
													}
												}

										}

						}
				}
			?>

				<div class="container">
					<div class="col-md-4">
					<?php
						if(!file_exists('business/'.$business_logo)) {
							echo '<img class="img-thumbnail" width="100%" src="https://tbcmerchantservices.com/business/00000.png">';
						}
						else {
							echo '<img class="img-thumbnail" width="100%" src="https://tbcmerchantservices.com/business/'.$business_logo.'">';
						}
					?>
						<form hidden action="" enctype="multipart/form-data" method="post">
							<input id='upload_logo' hidden name="upload_logo" onchange="$('#txtsubmit_upload_logo').click();" type="file"/><br>
							<input id="txtsubmit_upload_logo" type="submit" hidden name="submit" value="Submit" />
						</form>
						<a href="javascript:void(0)" onclick="$('#upload_logo').click();" class="btn btn-primary btn-block btn-lg">UPLOAD IMAGE</a>

					</div>
					<div class="col-md-8 alert">
						<div>
							<img src="https://tbcmerchantservices.com/images/TBCMSTOS.png" width="100%">
						</div>

						<h1><b style="color:#A52A2A"><?php echo $business_name;?></b><br><span style="font-size: 25px;"><?php echo $business_category;?></span>
						</h1><hr>
						<h4><?php echo $business_description;?></h4>

						<hr><h3><b>TBC BUSINESS REGISTRATION</b></span></h3><hr>
						<div>
							<div class="col-md-3">Country:</div>
							<div class="col-md-9"><h4><b><?php echo $business_country;?></b></h4></div>
						</div>
						<div>
							<div class="col-md-3">Registered by:</div>
							<div class="col-md-9"><h4><b><?php echo $fullname;?></b></h4></div>
						</div>
						<div>
							<div class="col-md-3">Birthday:</div>
							<div class="col-md-9"><h4><b><?php $class->dateformat($birthday);?></b></h4></div>
						</div>
						<div>
							<div class="col-md-3">Cellphone:</div>
							<div class="col-md-9"><h4><b><?php echo $cellphone;?></b></h4></div>
						</div>
						<div>
							<div class="col-md-3">Address:</div>
							<div class="col-md-9"><h4><b><?php echo $address;?></b></h4></div>
						</div>

						<h3><b>SUPPORTING DOCUMENTS</b></span></h3><hr>
						<div>
							<?php
								$doc_query="select * from xtbl_requirements where Main_Ctr='$ctr' limit 3";
								$doc_rs=mysql_query($doc_query);
								$doc_counter=0;
								while($doc_rows=mysql_fetch_assoc($doc_rs)){
									echo '<div class="col-md-4">
											<img src="https://tbcmerchantservices.com/'.$doc_rows['Image'].'" width="100%">
										</div>';
								}
							?>
						</div>

					</div>
				</div>
			<?php
			}
			else { //if buyer
				$class->page_home_header_start();
					$class->page_home4_header_content();
				$class->page_home_header_end();
				echo '<div class="container"><h3>Welcome back,  <b>'.$current_email.'</b></h3></div>';

				if(isset($_POST['submit'])){
						if(count($_FILES['upload_logo']['name']) > 0){
										$tmpFilePath = $_FILES['upload_logo']['tmp_name'];

										if($tmpFilePath != ""){
											$endfilename=str_replace(" ", '', $_FILES["upload_logo"]["name"]);
												$shortname = $_FILES['upload_logo']['name'];

												if(file_exists('profile/'.$profile_image)) {
													unlink('profile/'.$profile_image);
												}

												$profile_image = $ctr.md5(date('dmYHis')).$endfilename;

												$check = getimagesize($_FILES["upload_logo"]["tmp_name"]);
												if($check !== false) {
													if(move_uploaded_file($tmpFilePath, 'profile/'.$profile_image)) {
															$files[] = $shortname;
															$upload_query="update xtbl_personal SET
															Profile_Image='$profile_image'
															WHERE Main_Ctr='$ctr'";
															$upload_rs=@mysql_query($upload_query);
													}
												}

										}

						}
				}
			?>
				<div class="container">
					<div class="col-md-4">
					<?php
						if(!file_exists('profile/'.$profile_image)) {
							echo '<img class="img-thumbnail" width="100%" src="https://tbcmerchantservices.com/profile/00000.jpg">';
						}
						else {
							echo '<img class="img-thumbnail" width="100%" src="https://tbcmerchantservices.com/profile/'.$profile_image.'">';
						}
					?>
						<form hidden action="" enctype="multipart/form-data" method="post">
							<input id='upload_logo' hidden name="upload_logo" onchange="$('#txtsubmit_upload_logo').click();" type="file"/><br>
							<input id="txtsubmit_upload_logo" type="submit" hidden name="submit" value="Submit" />
						</form>
						<a href="javascript:void(0)" onclick="$('#upload_logo').click();" class="btn btn-primary btn-block btn-lg">UPLOAD IMAGE</a>

					</div>

					<div class="col-md-8 alert">
						<h1><b style="color:#A52A2A"><?php echo $fullname;?></b><br><span style="font-size: 25px;"><?php echo $cellphone;?></span>
						</h1>
						<h3><b>PROFILE INFORMATION</b></span></h3><hr>
						<div>
							<div class="col-md-3">LastName:</div>
							<div class="col-md-9"><h4><b><?php echo $lastname;?></b></h4></div>
						</div>
						<div>
							<div class="col-md-3">FirstName:</div>
							<div class="col-md-9"><h4><b><?php echo $firstname;?></b></h4></div>
						</div>
						<div>
							<div class="col-md-3">MiddleName:</div>
							<div class="col-md-9"><h4><b><?php echo $middlename;?></b></h4></div>
						</div>
						<div>
							<div class="col-md-3">Birthday:</div>
							<div class="col-md-9"><h4><b><?php $class->dateformat($birthday);?></b></h4></div>
						</div>
						<div>
							<div class="col-md-3">Contact:</div>
							<div class="col-md-9"><h4><b><?php echo $cellphone;?></b></h4></div>
						</div>
						<div>
							<div class="col-md-3">Address:</div>
							<div class="col-md-9"><h4><b><?php echo $address;?></b></h4></div>
						</div>
					</div>
				</div>
			<?php
			}


			$class->page_welcome_header_content_start_footer();
			$class->body_end();
		$class->html_end();

	}
	else {
		$class->doc_type();
		$class->html_start('');
			$class->head_start();
				echo '<link rel="shortcut icon" type="image/x-icon" href="https://tbcmerchantservices.com/images/tbslogo.png" />';
				$class->title_page('TBCMS-'.$username);
				$class->script('https://tbcmerchantservices.com/js/jquery-3.1.1.js');
				$class->script('https://tbcmerchantservices.com/js/bootstrap.js');
				$class->link('https://tbcmerchantservices.com/css/bootstrap.css');
			$class->head_end();
			$class->body_start('');
			if($account_type=='MERCHANT') {
				$class->page_home_header_start();
					$class->page_home2_header_content();
				$class->page_home_header_end();
				echo '<div class="container"><h3>Welcome back,  <b>'.$current_email.'</b></h3></div>';

				if(isset($_POST['submit'])){
				    if(count($_FILES['upload_logo']['name']) > 0){
				            $tmpFilePath = $_FILES['upload_logo']['tmp_name'];

				            if($tmpFilePath != ""){
				            	$endfilename=str_replace(" ", '', $_FILES["upload_logo"]["name"]);
				                $shortname = $_FILES['upload_logo']['name'];

				                if(file_exists('business/'.$business_logo)) {
				                	unlink('business/'.$business_logo);
				                }

				                $business_logo = $ctr.md5(date('dmYHis')).$endfilename;

				                $check = getimagesize($_FILES["upload_logo"]["tmp_name"]);
				                if($check !== false) {
				                	if(move_uploaded_file($tmpFilePath, 'business/'.$business_logo)) {
					                    $files[] = $shortname;
					                    $upload_query="update xtbl_main_info SET
					                    Business_Logo='$business_logo'
					                    WHERE Ctr='$ctr'";
					                    $upload_rs=@mysql_query($upload_query);
					                }
				                }

				          	}

				    }
				}
			?>

				<div class="container">
					<div class="col-md-4">
					<?php
						if(!file_exists('business/'.$business_logo)) {
							echo '<img class="img-thumbnail" width="100%" src="https://tbcmerchantservices.com/business/00000.png">';
						}
						else {
							echo '<img class="img-thumbnail" width="100%" src="https://tbcmerchantservices.com/business/'.$business_logo.'">';
						}
					?>
						<form hidden action="" enctype="multipart/form-data" method="post">
							<input id='upload_logo' hidden name="upload_logo" onchange="$('#txtsubmit_upload_logo').click();" type="file"/><br>
							<input id="txtsubmit_upload_logo" type="submit" hidden name="submit" value="Submit" />
						</form>
						<a href="javascript:void(0)" onclick="$('#upload_logo').click();" class="btn btn-primary btn-block btn-lg">UPLOAD IMAGE</a>

					</div>
					<div class="col-md-8 alert">
						<div>
							<img src="https://tbcmerchantservices.com/images/TBCMSTOS.png" width="100%">
						</div>

						<h1><b style="color:#A52A2A"><?php echo $business_name;?></b><br><span style="font-size: 25px;"><?php echo $business_category;?></span>
						</h1><hr>
						<h4><?php echo $business_description;?></h4>

						<hr><h3><b>TBC BUSINESS REGISTRATION</b></span></h3><hr>
						<div>
							<div class="col-md-3">Country:</div>
							<div class="col-md-9"><h4><b><?php echo $business_country;?></b></h4></div>
						</div>
						<div>
							<div class="col-md-3">Registered by:</div>
							<div class="col-md-9"><h4><b><?php echo $fullname;?></b></h4></div>
						</div>
						<div>
							<div class="col-md-3">Birthday:</div>
							<div class="col-md-9"><h4><b><?php $class->dateformat($birthday);?></b></h4></div>
						</div>
						<div>
							<div class="col-md-3">Cellphone:</div>
							<div class="col-md-9"><h4><b><?php echo $cellphone;?></b></h4></div>
						</div>
						<div>
							<div class="col-md-3">Address:</div>
							<div class="col-md-9"><h4><b><?php echo $address;?></b></h4></div>
						</div>

						<h3><b>SUPPORTING DOCUMENTS</b></span></h3><hr>
						<div>
							<?php
								$doc_query="select * from xtbl_requirements where Main_Ctr='$ctr' limit 3";
								$doc_rs=mysql_query($doc_query);
								$doc_counter=0;
								while($doc_rows=mysql_fetch_assoc($doc_rs)){
									echo '<div class="col-md-4">
											<img src="https://tbcmerchantservices.com/'.$doc_rows['Image'].'" width="100%">
										</div>';
								}
							?>
						</div>

					</div>
				</div>
			<?php
			}
			else { //if buyer
				$class->page_home_header_start();
					$class->page_home3_header_content();
				$class->page_home_header_end();
				echo '<div class="container"><h3>Welcome back,  <b>'.$current_email.'</b></h3></div>';

				if(isset($_POST['submit'])){
				    if(count($_FILES['upload_logo']['name']) > 0){
				            $tmpFilePath = $_FILES['upload_logo']['tmp_name'];

				            if($tmpFilePath != ""){
				            	$endfilename=str_replace(" ", '', $_FILES["upload_logo"]["name"]);
				                $shortname = $_FILES['upload_logo']['name'];

				                if(file_exists('profile/'.$profile_image)) {
				                	unlink('profile/'.$profile_image);
				                }

				                $profile_image = $ctr.md5(date('dmYHis')).$endfilename;

				                $check = getimagesize($_FILES["upload_logo"]["tmp_name"]);
				                if($check !== false) {
				                	if(move_uploaded_file($tmpFilePath, 'profile/'.$profile_image)) {
					                    $files[] = $shortname;
					                    $upload_query="update xtbl_personal SET
					                    Profile_Image='$profile_image'
					                    WHERE Main_Ctr='$ctr'";
					                    $upload_rs=@mysql_query($upload_query);
					                }
				                }

				          	}

				    }
				}
			?>
				<div class="container">
					<div class="col-md-4">
					<?php
						if(!file_exists('profile/'.$profile_image)) {
							echo '<img class="img-thumbnail" width="100%" src="https://tbcmerchantservices.com/profile/00000.jpg">';
						}
						else {
							echo '<img class="img-thumbnail" width="100%" src="https://tbcmerchantservices.com/profile/'.$profile_image.'">';
						}
					?>
						<form hidden action="" enctype="multipart/form-data" method="post">
							<input id='upload_logo' hidden name="upload_logo" onchange="$('#txtsubmit_upload_logo').click();" type="file"/><br>
							<input id="txtsubmit_upload_logo" type="submit" hidden name="submit" value="Submit" />
						</form>
						<a href="javascript:void(0)" onclick="$('#upload_logo').click();" class="btn btn-primary btn-block btn-lg">UPLOAD IMAGE</a>

					</div>

					<div class="col-md-8 alert">
						<h1><b style="color:#A52A2A"><?php echo $fullname;?></b><br><span style="font-size: 25px;"><?php echo $cellphone;?></span>
						</h1>
						<h3><b>PROFILE INFORMATION</b></span></h3><hr>
						<div>
							<div class="col-md-3">LastName:</div>
							<div class="col-md-9"><h4><b><?php echo $lastname;?></b></h4></div>
						</div>
						<div>
							<div class="col-md-3">FirstName:</div>
							<div class="col-md-9"><h4><b><?php echo $firstname;?></b></h4></div>
						</div>
						<div>
							<div class="col-md-3">MiddleName:</div>
							<div class="col-md-9"><h4><b><?php echo $middlename;?></b></h4></div>
						</div>
						<div>
							<div class="col-md-3">Birthday:</div>
							<div class="col-md-9"><h4><b><?php $class->dateformat($birthday);?></b></h4></div>
						</div>
						<div>
							<div class="col-md-3">Contact:</div>
							<div class="col-md-9"><h4><b><?php echo $cellphone;?></b></h4></div>
						</div>
						<div>
							<div class="col-md-3">Address:</div>
							<div class="col-md-9"><h4><b><?php echo $address;?></b></h4></div>
						</div>
					</div>
				</div>
			<?php
			}


			$class->page_welcome_header_content_start_footer();
			$class->body_end();
		$class->html_end();
	}

?>
