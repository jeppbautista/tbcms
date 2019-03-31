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

	$error="";
	if(isset($_POST['txtproduct_type']) && isset($_POST['txtproduct_name']) && isset($_POST['txtproduct_description'])
		&& isset($_POST['txtpesoamount_onadd']) ) {

		$ptype=str_replace("'", '', $_REQUEST['txtproduct_type']);
		$ptype=str_replace('"', '', $ptype);
		$ptype=str_replace("<", '', $ptype);
		$ptype=str_replace('>', '', $ptype);

		$pname=str_replace("'", '', $_REQUEST['txtproduct_name']);
		$pname=str_replace('"', '', $pname);
		$pname=str_replace("<", '', $pname);
		$pname=str_replace('>', '', $pname);

		$pdesc=str_replace("'", '', $_REQUEST['txtproduct_description']);
		$pdesc=str_replace('"', '', $pdesc);
		$pdesc=str_replace("<", '', $pdesc);
		$pdesc=str_replace('>', '', $pdesc);

		$pamount=str_replace("'", '', $_REQUEST['txtpesoamount_onadd']);
		$pamount=str_replace('"', '', $pamount);
		$pamount=str_replace("<", '', $pamount);
		$pamount=str_replace('>', '', $pamount);

		$query="select * from xtbl_product WHERE Main_Ctr='$ctr'";
		$rs=mysql_query($query);
		$rows=mysql_num_rows($rs);

		if($rows>50) {$error="<span style='color:red'>You reach maximum of 50 product Upload</span>";}
		else if($ptype==""){$error="<span style='color:red'>Please Select Product Type</span>";}
		else if($pname==""){$error="<span style='color:red'>Please Fill Product Name</span>";}
		else if($pdesc==""){$error="<span style='color:red'>Please Fill Product Description</span>";}
		else if($pamount==""){$error="<span style='color:red'>Please Fill Product Amount</span>";}
		else if($pamount=='' || $pamount==0 || $pamount==null || !is_numeric($pamount) ) {
			$error="<span style='color:red'>Invalid Amount Format</span>";
		}
		else {
			$query="insert into xtbl_product(Product_Name, Product_Description, Product_Price, Main_Ctr, Type, Datetime) 
				values(
				'$pname', '$pdesc', '$pamount', '$ctr', '$ptype', '".date('Y-m-d H:i:s')."'
				)";
			$rs=@mysql_query($query);
			if($rs){ echo '<script>window.location.assign("https://tbcmerchantservices.com/my_store/");</script>'; }
			else {$error="<span style='color:red'>Error Occured</span>";}
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
					$class->script('https://tbcmerchantservices.com/js/jquery1.3.js');
				$class->head_end();
				$class->body_start('');
					$class->page_home_header_start();
						$class->page_home2_header_content();
					$class->page_home_header_end();
					echo '<div class="container"><h3>Welcome back,  <b>'.$current_email.'</b></h3></div>';
			?>

					<div class="container">
						<div class="col-md-3" ></div>
						<div class="col-md-6" >
							<h4><center><?php echo $error;?></center></h4>
							<div align="right">
								<a href="https://tbcmerchantservices.com/my_store/">CLOSE</a>
							</div>
							<div class="alert alert-info" style="border-radius: 0px; background-color: #e6e6e6">
								<form method="POST">
									<label>Product Category</label>
									<select class="form-control" name="txtproduct_type">
										<?php 
											$query="select * from xtbl_product_type order by Type ASC";
											$rs=mysql_query($query);
											while($row=mysql_fetch_array($rs)) {
												echo '<option>'.$row['Type'].'</option>';
											}
										?>
									</select>
									<label>Product Name</label>
									<input class="form-control" style="font-size: 30px; height:50px" name="txtproduct_name" placeholder="Product Brand and Name"/>
									<label>Product Description</label>
									<textarea class="form-control" style="font-size: 20px; resize: none;" rows="7" name="txtproduct_description">Put Description here</textarea>
									<label>Product Price in Peso</label><br>
									Please include charges if any like shipping fee(within PH Area only) etc.
									<input name="txtpesoamount_onadd" class="form-control" style="font-size: 30px; height:50px" name="txtproduct_price" placeholder="Php 0.00"/><br>
									<input hidden name="txtproduct_submit" type="submit"/>
									NOTE: Make Sure that all information of the product is correct. All products created cannot be edited
									<center><a href="javascript:void(0)" onclick="$('#modal_save_product').modal('show');" 
										class="btn btn-success btn-lg btn-block">CREATE</a></center>
								</form>
							</div>
						</div>
						<div class="col-md-3" ></div>
	
					</div>

					<div id="modal_save_product" class="modal fade">
						<div class="modal-dialog modal-sm">
							<div class="modal-content" style="border-radius: 0px;">
								<div class="modal-header" style="background-color: #191970; text-align: center; color: white">
									<span class="modal-title" style="font-size: 20px">CONFIRMATION</span>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          								<span aria-hidden="true" style="color: white">&times;</span>
        							</button>
								</div>
								<div class="modal-body">
									<b>Make Sure that all information of the product is correct. All products created cannot be edited<br><br>ARE YOU SURE YOU WANT TO POST THIS PRODUCT?<br>
									</b>
								</div>
								<div class="modal-footer" style="padding:5px">
									<a href="javascript:void(0)" onclick="$('[name=txtproduct_submit]').click();" 
										class="btn btn-primary btn-lg btn-block" style="border-radius: 0px">&nbsp YES &nbsp</a>
								</div>
							</div>
						</div>
					</div>

			<?php
					$class->page_welcome_header_content_start_footer();
                                $class->chatscript();
				$class->body_end();	
			$class->html_end();
		}
	}
?>
