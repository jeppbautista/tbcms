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

	$query="select * from xtbl_account_info WHERE Main_Ctr='$ctr'";
	$rs=mysql_query($query);
	$row=mysql_fetch_assoc($rs);
	$email_status=$row['Email_Status'];
	$account_type=$row['Account_Type'];
	$account_status=$row['Account_Status'];
	$card_status=$row['Card_Status'];
	$username=$row['Username'];

	$query="select * from xtbl_adminaccount";
	$rs=mysql_query($query);
	$row=mysql_fetch_assoc($rs);
	$our_btc=$row['BTC'];
	$our_coinsph=$row['CoinPH'];
	$our_paypal=$row['Paypal'];
	$tbc_to_peso=$row['Tbc_to_Peso'];

	$query="select * from xtbl_main_info WHERE Ctr='$ctr'";
	$rs=mysql_query($query);
	$row=mysql_fetch_assoc($rs);
	$current_email=$row['Email'];
	$business_logo=$row['Business_Logo'];
	$business_name=$row['Business_Name'];
	$business_category=$row['Business_Category'];
	$business_description=$row['Description'];
	$business_country=$row['Country'];

	if(isset($_POST['submit'])){
    
        $tmpFilePath = $_FILES['p_upload']['tmp_name'];

        if($tmpFilePath != ""){
        	$endfilename=str_replace(" ", '', $_FILES["p_upload"]["name"]);
            $shortname = $_FILES['p_upload']['name'];
            $filen=$ctr.md5(date('dmYHis')).$endfilename;
            $filePath = "products/".$ctr.md5(date('dmYHis')).$endfilename;
            $txtid=$_POST['txtid'];
            $check = getimagesize($_FILES["p_upload"]["tmp_name"]);
            if($check !== false) {
            	$upload_query="select Image from xtbl_product WHERE Ctr='$txtid' and Main_Ctr='$ctr'";
            	$rs=mysql_query($upload_query);
            	$row=mysql_fetch_assoc($rs);
            	if(file_exists('products/'.$row['Image'])) {
            		unlink('products/'.$row['Image']);
            	}

            	if(move_uploaded_file($tmpFilePath, $filePath)) {
                    $files[] = $shortname;

                    $upload_query="update xtbl_product set Image='$filen', Datetime='".date('Y-m-d H:i:s')."' WHERE Ctr='$txtid' and Main_Ctr='$ctr'";
                    $upload_rs=@mysql_query($upload_query);
                    echo '<script>window.location.href = "https://tbcmerchantservices.com/my_store/";</script>';
                }
            }
      	}
	       	
       
	    
	}

	if($email_status=='INACTIVE' || $account_status=='INACTIVE' || $card_status=='INACTIVE'){
		header("location: https://tbcmerchantservices.com/home/");
	}
	else {
		if($account_type=='BUYER') {header("location: https://tbcmerchantservices.com/welcome/"); }
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
					$class->page_home_header_start();
						$class->page_home2_header_content();
					$class->page_home_header_end();
					echo '<div class="container"><h3>Welcome back,  <b>'.$current_email.'</b></h3></div>';

					$query="select * from xtbl_product_request where To_Ctr='$ctr' order by Ctr DESC LIMIT 1000";
					$rs=mysql_query($query);
		?>
					<div class="container" align="center">
						<a class="btn btn-primary btn-lg" style="border-radius: 0px"
							href="https://tbcmerchantservices.com/my_store/">BACK TO MY STORE</a>
					</div>

					<div class="container" >
						<h2>Latest Orders</h2>
						<table class="table table-bordered">
							<tr>
								<td>Date/Product</td>
								<td>Name/Address/Contact</td>
								<td>Quantity/Amount</td>
								<td>Transaction ID</td>
								<td>Status</td>
							</tr>
					<?php
							while($row=mysql_fetch_assoc($rs)){
					?>
							<tr>
								<td><?php echo '<b>'.$row['Datetime'].'<br>';

									$prod_query="select * from xtbl_product Where Ctr='".$row['Product_Ctr']."'";
									$prod_rd=mysql_query($prod_query);
									$prod_row=mysql_fetch_assoc($prod_rd);
									echo $prod_row['Product_Name'].'</b><br>';
									if(file_exists('products/'.$prod_row['Image'])) {
										echo '<img src="https://tbcmerchantservices.com/products/'.$prod_row['Image'].'" width="100px">';
									}
									else{
										echo '<img src="https://tbcmerchantservices.com/products/0000.jpg" width="100px">';
									}
									
									?>
								</td>
								<td>
									<?php echo '<b>'.$row['Name'].'</b><br>';
										echo '<b>'.$row['Address'].'</b><br>';
										echo '<b>'.$row['Contact'].'</b>';
									?>
								</td>
								<td><?php echo 'Qnty: <b>'.$row['Quantity'].'</b><br>';
										echo 'PHP '.number_format($row['Amount'],2);
									?>
								</td>
								<td><?php echo '<b>'.$row['Transact_Id'].'</b>';?></td>
								<td><?php echo '<b>'.$row['Status'].'</b>';?></td>
							</tr>
					<?php
							}
					?>
						</table>
					</div>
		<?php
					

					$class->page_welcome_header_content_start_footer();
                                $class->chatscript();
				$class->body_end();	
			$class->html_end();
		}
	}
?>
