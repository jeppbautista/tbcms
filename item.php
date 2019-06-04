<?php
	session_start();
	include 'class3.php';
	$class=new mydesign;
	$class->database_connect();
	$charge=350;

	date_default_timezone_set('Asia/Manila');
	$sessiondate=date('mdY');

	if(!isset($_GET['product'])){
		echo '<script>window.location.assign("https://tbcmerchantservices.com/shopping/");</script>';
	}
	else{
		if($_GET['product']=="") {
			echo '<script>window.location.assign("https://tbcmerchantservices.com/shopping/");</script>';
		}
		else{
			$product=str_replace("'", '', $_REQUEST['product']);
			$product=str_replace('"', '', $product);
			$product=str_replace("<", '', $product);
			$product=str_replace('>', '', $product);
		}

	}

	if(!isset($_SESSION['session_tbcmerchant_ctr'.$sessiondate])){

		$query="select * from xtbl_adminaccount";
		$rs=mysql_query($query);
		$row=mysql_fetch_assoc($rs);
		$tbc_to_peso=$row['Tbc_to_Peso'];

		$class->doc_type();
		$class->html_start('');
			$class->head_start();
			echo '<link rel="shortcut icon" type="image/x-icon" href="https://tbcmerchantservices.com/images/tbslogo.png" />';
$query="select * from xtbl_product WHERE Ctr='".$product."'";
				$rs=mysql_query($query);
				$row=mysql_fetch_assoc($rs);

			$class->title_page($row['Product_Name']);
echo '<meta property="og:title" content="'.$row['Product_Name'].' <b>&#8369;'.$row['Product_Price'].'</b>" />';
echo '<meta property="og:description" content="'.$row['Product_Description'].'" />';
				$class->script('https://tbcmerchantservices.com/js/jquery-3.1.1.js');
				$class->script('https://tbcmerchantservices.com/js/bootstrap.js');
				$class->link('https://tbcmerchantservices.com/css/bootstrap.css');
				$class->script('https://tbcmerchantservices.com/js/jquery1.3.js');
			$class->head_end();

			$class->body_start('');
				$class->page_home_header_start();
					$class->page_shopping_header_content1();
				$class->page_home_header_end();

				if($row['Ctr']==""){echo '<script>window.location.assign("https://tbcmerchantservices.com/shopping/");</script>';}
				$query2="select * from xtbl_main_info WHERE Ctr='".$row['Main_Ctr']."'";
				$rs2=mysql_query($query2);
				$row2=mysql_fetch_assoc($rs2);

				$query3="select * from xtbl_personal WHERE Main_Ctr='".$row['Main_Ctr']."'";
				$rs3=mysql_query($query3);
				$row3=mysql_fetch_assoc($rs3);

		?>		<br>
				<div class="container">
					<div class="col-md-4">
						<?php
							if(file_exists('products/'.$row['Image'])) {
			            ?>
			            	<img width="100%" <?php echo 'src="https://tbcmerchantservices.com/products/'.$row['Image'].'"';?> >
			            <?php
			            	}
			            	else{
			            ?>
			            	<img width="100%" <?php echo 'src="https://tbcmerchantservices.com/products/0000.jpg"';?> >
			            <?php
			            	}
						?>
					</div>
					<div class="col-md-8">

						<h2><b><?php echo $row['Product_Name'];?></b></h2>
						<h3 style="color:red">
							<b><?php echo '&#8369;'.number_format($row['Product_Price'],2);?></b><br>
							<small>(<?php echo number_format($row['Product_Price']/$tbc_to_peso,8);?> TBC)</small>
						</h3><br>
						<h4><?php echo nl2br($row['Product_Description']);?></h4><br><br>
						<h4>Merchant Name: <b><?php echo $row2['Business_Name'];?></b></h4>

						<h4>Seller Name: <b><?php echo $row3['Fname'].' '.$row3['Lname'];?></b></h4>

					</div>

				</div><br><br><br>
				<div class="container" align="center">
					<a class="btn btn-primary btn-lg" style="border-radius: 0px"
						href="https://tbcmerchantservices.com/shopping/">BACK TO SHOPPING</a>
				</div>
		<?php

			$class->page_welcome_header_content_start_footer();
			$class->body_end();
		$class->html_end();


	}
	else{
		$ctr=$_SESSION['session_tbcmerchant_ctr'.$sessiondate];

		$query="select * from xtbl_adminaccount";
		$rs=mysql_query($query);
		$row=mysql_fetch_assoc($rs);
		$tbc_to_peso=$row['Tbc_to_Peso'];

		$query="select * from xtbl_account_info WHERE Main_Ctr='$ctr'";
		$rs=mysql_query($query);
		$row=mysql_fetch_assoc($rs);
		$email_status=$row['Email_Status'];
		$account_type=$row['Account_Type'];
		$account_status=$row['Account_Status'];
		$card_status=$row['Card_Status'];
		$username=$row['Username'];
		$account_addressyou=$row['Crypt_Id'];
		$activation_amount=0;

		$query="select * from xtbl_main_info WHERE Ctr='$ctr'";
		$rs=mysql_query($query);
		$row=mysql_fetch_assoc($rs);
		$current_email=$row['Email'];

		if(isset($_POST['txtitem_quantity']) && isset($_POST['txtitem_quantityandamounta']) &&
			isset($_POST['txtitem_quantityandamountc']) && isset($_POST['txtitem_totalprice']) &&
			isset($_POST['txtitem_name']) && isset($_POST['txtitem_addressn']) && isset($_POST['txtitem_number']) &&
			isset($_POST['txtitem_idena']) && isset($_POST['txtitem_idenc']) &&
			isset($_POST['txtitem_persida']) && isset($_POST['txtitem_persidc']) ) {

			$txtitem_quantity=str_replace("'", '', $_POST['txtitem_quantity']);
			$txtitem_quantity=str_replace('"', '', $txtitem_quantity);
			$txtitem_quantity=str_replace("<", '', $txtitem_quantity);
			$txtitem_quantity=str_replace('>', '', $txtitem_quantity);
			$txtitem_quantity=str_replace('.', '', $txtitem_quantity);

			$txtitem_quantityandamounta=str_replace("'", '', $_POST['txtitem_quantityandamounta']);
			$txtitem_quantityandamounta=str_replace('"', '', $txtitem_quantityandamounta);
			$txtitem_quantityandamounta=str_replace("<", '', $txtitem_quantityandamounta);
			$txtitem_quantityandamounta=str_replace('>', '', $txtitem_quantityandamounta);

			$txtitem_totalprice=str_replace("'", '', $_POST['txtitem_totalprice']);
			$txtitem_totalprice=str_replace('"', '', $txtitem_totalprice);
			$txtitem_totalprice=str_replace("<", '', $txtitem_totalprice);
			$txtitem_totalprice=str_replace('>', '', $txtitem_totalprice);

			$txtitem_name=str_replace("'", '', $_POST['txtitem_name']);
			$txtitem_name=str_replace('"', '', $txtitem_name);
			$txtitem_name=str_replace("<", '', $txtitem_name);
			$txtitem_name=str_replace('>', '', $txtitem_name);

			$txtitem_address=str_replace("'", '', $_POST['txtitem_addressn']);
			$txtitem_address=str_replace('"', '', $txtitem_address);
			$txtitem_address=str_replace("<", '', $txtitem_address);
			$txtitem_address=str_replace('>', '', $txtitem_address);

			$txtitem_number=str_replace("'", '', $_POST['txtitem_number']);
			$txtitem_number=str_replace('"', '', $txtitem_number);
			$txtitem_number=str_replace("<", '', $txtitem_number);
			$txtitem_number=str_replace('>', '', $txtitem_number);

			$txtitem_idena=str_replace("'", '', $_POST['txtitem_idena']);
			$txtitem_idena=str_replace('"', '', $txtitem_idena);
			$txtitem_idena=str_replace("<", '', $txtitem_idena);
			$txtitem_idena=str_replace('>', '', $txtitem_idena);

			$txtitem_idenc=str_replace("'", '', $_POST['txtitem_idenc']);
			$txtitem_idenc=str_replace('"', '', $txtitem_idenc);
			$txtitem_idenc=str_replace("<", '', $txtitem_idenc);
			$txtitem_idenc=str_replace('>', '', $txtitem_idenc);

			$txtitem_persida=str_replace("'", '', $_POST['txtitem_persida']);
			$txtitem_persida=str_replace('"', '', $txtitem_persida);
			$txtitem_persida=str_replace("<", '', $txtitem_persida);
			$txtitem_persida=str_replace('>', '', $txtitem_persida);

			$txtitem_persidc=str_replace("'", '', $_POST['txtitem_persidc']);
			$txtitem_persidc=str_replace('"', '', $txtitem_persidc);
			$txtitem_persidc=str_replace("<", '', $txtitem_persidc);
			$txtitem_persidc=str_replace('>', '', $txtitem_persidc);

			if(!is_numeric($txtitem_quantity) ) {
				$error="<span style='color:red'>Quantity not Valid</span>";
			}
			else if(!is_numeric($txtitem_quantityandamounta)) {
				$error="<span style='color:red'>Some Error Occured</span>";
			}
			else if($_POST['txtitem_quantityandamountc']!=md5(md5($txtitem_quantityandamounta)) ) {
				$error="<span style='color:red'>Some Error Occured</span>";
			}
			else if($txtitem_totalprice!=($txtitem_quantity*$txtitem_quantityandamounta)){
				$error="<span style='color:red'>Some Error Occured</span>";
			}
			else if($txtitem_name=="" || strlen($txtitem_name)<4){
				$error="<span style='color:red'>Name must atleast 4 Characters</span>";
			}
			else if($txtitem_address=="" || strlen($txtitem_address)<10){
				$error="<span style='color:red'>Address must atleast 10 Characters</span>";
			}
			else if($txtitem_number=="" || strlen($txtitem_number)<5){
				$error="<span style='color:red'>Contact No. must atleast 5 Characters</span>";
			}
			else if($txtitem_persidc!=md5(md5($txtitem_persida))) {
				$error="<span style='color:red'>Some Error Occured 1001</span>";
			}
			else if($txtitem_idenc!=md5(md5($txtitem_idena))) {
				$error="<span style='color:red'>Some Error Occured 1002</span>";
			}
			else if($ctr==$txtitem_persida) {
				$error="<span style='color:red'>You cant buy your own product</span>";
			}
			else {
				$txtitem_totalprice=$txtitem_quantity*$txtitem_quantityandamounta;
				$txtitem_totaltbc=$txtitem_totalprice/$tbc_to_peso;
				$query="select * from xtbl_mytransaction".$ctr." WHERE Status='ACTIVE'";
				$rs=mysql_query($query);
				$my_amount=0;
				while($row=mysql_fetch_assoc($rs)) {
					$my_amount=$my_amount+$row['Amount'];
				}
				if(($tbc_to_peso*$my_amount)<$txtitem_totalprice){
					$error="<span style='color:red'>Insufficient Balance</span>";
				}
				else{
					$trans_id=md5(md5($ctr).md5(date('mdYHis'))).md5(md5(date('mdYHis')).md5($ctr));

					$query="insert into xtbl_product_request(From_Ctr, To_Ctr, Product_Ctr, Amount, Tbc_Value, Status, Quantity, Address, Name, Transact_Id, Datetime, Contact) values(
						'$ctr',
						'$txtitem_persida',
						'$txtitem_idena',
						'$txtitem_totalprice',
						'$txtitem_totaltbc',
						'Submitted',
						'$txtitem_quantity', '$txtitem_address', '$txtitem_name',
						 '$trans_id', '".date('Y-m-d H:i:s')."', '$txtitem_number');";
					$rs=@mysql_query($query);

					$query="insert into xtbl_mytransaction".$ctr." (Amount, Status, Transact_Id, Type, Date)
						values(
						'-$txtitem_totaltbc',
						'ACTIVE',
						'$trans_id',
						'SEND',
						'".date('Y-m-d H:i:s')."'
						)";

					$rs=@mysql_query($query);

					$query="insert into xtbl_mytransaction".$txtitem_persida." (Amount, Status, Transact_Id, Type, Date)
						values(
						'$txtitem_totaltbc',
						'ACTIVE',
						'$trans_id',
						'RECEIVE',
						'".date('Y-m-d H:i:s')."'
						)";
					$rs=@mysql_query($query);

					echo '<script>window.location.assign("https://tbcmerchantservices.com/shopping/");</script>';
				}

			}
		}

		if($email_status=='INACTIVE' || $account_status=='INACTIVE' || $card_status=='INACTIVE'){
			header("location: https://tbcmerchantservices.com/home/");
		}
		else {
			$class->doc_type();
			$class->html_start('');
				$class->head_start();
					echo '<link rel="shortcut icon" type="image/x-icon" href="https://tbcmerchantservices.com/images/tbslogo.png" />';
				$query="select * from xtbl_product WHERE Ctr='".$product."'";
				$rs=mysql_query($query);
				$row=mysql_fetch_assoc($rs);

					$class->title_page($row['Product_Name']);
echo '<meta property="og:title" content="'.$row['Product_Name'].' <b>&#8369;'.$row['Product_Price'].'</b>" />';
echo '<meta property="og:description" content="'.$row['Product_Description'].'" />';
					$class->script('https://tbcmerchantservices.com/js/jquery-3.1.1.js');
					$class->script('https://tbcmerchantservices.com/js/bootstrap.js');
					$class->link('https://tbcmerchantservices.com/css/bootstrap.css');
					$class->script('https://tbcmerchantservices.com/js/jquery1.3.js');
				$class->head_end();
				$class->body_start('');
				if($account_type=='MERCHANT') {
					$class->page_home_header_start();
						$class->page_home2_header_content();
					$class->page_home_header_end();
				}
				else { //if buyer
					$class->page_home_header_start();
						$class->page_home3_header_content();
					$class->page_home_header_end();
				}
				echo '<div class="container"><h3>Welcome back,  <b>'.$current_email.'</b></h3></div>';


				if($row['Ctr']==""){echo '<script>window.location.assign("https://tbcmerchantservices.com/shopping/");</script>';}
				$query2="select * from xtbl_main_info WHERE Ctr='".$row['Main_Ctr']."'";
				$rs2=mysql_query($query2);
				$row2=mysql_fetch_assoc($rs2);

				$query3="select * from xtbl_personal WHERE Main_Ctr='".$row['Main_Ctr']."'";
				$rs3=mysql_query($query3);
				$row3=mysql_fetch_assoc($rs3);
		?>
			<br>
				<div class="container">
					<div class="col-md-4">
						<?php
							if(file_exists('products/'.$row['Image'])) {
			            ?>
			            	<img width="100%" <?php echo 'src="https://tbcmerchantservices.com/products/'.$row['Image'].'"';?> >
			            <?php
			            	}
			            	else{
			            ?>
			            	<img width="100%" <?php echo 'src="https://tbcmerchantservices.com/products/0000.jpg"';?> >
			            <?php
			            	}
						?>
					</div>
					<div class="col-md-8">

						<h2><b><?php echo $row['Product_Name'];?></b></h2>
						<h3 style="color:red"><b><?php echo '&#8369;'.number_format($row['Product_Price'],2);?></b><br>
							<small>(<?php echo number_format($row['Product_Price']/$tbc_to_peso,8);?> TBC)</small>
						</h3>
						<h4><?php echo nl2br($row['Product_Description']);?></h4><br><br>
						<h4>Merchant Name: <b><?php echo $row2['Business_Name'];?></b></h4>
						<h4>Email: <b><?php echo $row2['Email'];?></b></h4>
						<h4>Seller Name: <b><?php echo $row3['Fname'].' '.$row3['Lname'];?></b></h4>
						<h4>Cell #: <b><?php echo $row3['Cellphone'];?></b></h4><br>

						<form method="POST" hidden>
							BUY HERE<br>
							<label>QUANTITY</label>
							<input name="txtitem_quantity" id="txtitem_quantity" class="form-control" style="width:100px;"
								<?php echo 'value="'.$txtitem_quantity.'"';?> />
							<label>TOTAL PRICE in Php</label>
							<input name="txtitem_totalprice" id="txtitem_totalprice" class="form-control" readonly style="width:200px;"
								<?php echo 'value="'.$txtitem_totalprice.'"';?> />
							<input name="txtitem_idena" hidden
								<?php echo 'value="'.$row['Ctr'].'"';?> />
							<input name="txtitem_idenc" hidden
								<?php echo 'value="'.md5(md5($row['Ctr'])).'"';?> />

							<input name="txtitem_quantityandamounta" hidden
								<?php echo 'value="'.$row['Product_Price'].'"';?> />
							<input name="txtitem_quantityandamountc" hidden
								<?php echo 'value="'.md5(md5($row['Product_Price'])).'"';?> />

							<input name="txtitem_persida" hidden
								<?php echo 'value="'.$row['Main_Ctr'].'"';?> />
							<input name="txtitem_persidc" hidden
								<?php echo 'value="'.md5(md5($row['Main_Ctr'])).'"';?> />

							<label>NAME</label>
							<input name="txtitem_name" class="form-control" style="width:250px;"
								<?php echo 'value="'.$txtitem_name.'"';?> />
							<label>ADDRESS <span style="color:blue">(Make Sure the Address is located within the Philippines)</span></label>
							<textarea name="txtitem_addressn" class="form-control" rows="2"
								style="width:300px;resize: none;"></textarea>
							<label>CONTACT Number</label>
							<input name="txtitem_number" class="form-control" style="width:250px;"/>
							<input name="txtitem_submitrequest" type="submit" hidden />
							<div><?php echo $error;?>&nbsp</div>
							<a class="btn btn-success btn-md" id="txtitem_clickrequest" style="border-radius: 0px"
								href="javascript:void(0)">BUY NOW</a>
						</form>
					</div>

				</div><br><br><br>

				<div id="modal_save_newitem" class="modal fade">
					<div class="modal-dialog modal-sm">
						<div class="modal-content" style="border-radius: 0px;">
							<div class="modal-header" style="background-color: #191970; text-align: center; color: white">
								<span class="modal-title" style="font-size: 20px">CONFIRMATION</span>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
      								<span aria-hidden="true" style="color: white">&times;</span>
    							</button>
							</div>
							<div class="modal-body">
								<b>Are you sure you want to buy this item?<br>
								</b>
							</div>
							<div class="modal-footer" style="padding:5px">
								<a href="javascript:void(0)" onclick="$('[name=txtitem_submitrequest]').click();"
									class="btn btn-primary btn-lg btn-block" style="border-radius: 0px">&nbsp YES &nbsp</a>
							</div>
						</div>
					</div>
				</div>

				<div class="container" align="center">
					<a class="btn btn-primary btn-lg" style="border-radius: 0px"
						href="https://tbcmerchantservices.com/shopping/">BACK TO SHOPPING</a>
				</div>
		<?php
			$class->page_welcome_header_content_start_footer();
				$class->body_end();
			$class->html_end();
		}
	}

?>
