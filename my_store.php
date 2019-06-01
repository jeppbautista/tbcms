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
if(isset($_POST['product_requestnumber']) && isset($_POST['product_requestcharacter']) ) {
				$product_requestnumber=str_replace("'", '', $_REQUEST['product_requestnumber']);
				$product_requestnumber=str_replace('"', '', $product_requestnumber);
				$product_requestnumber=str_replace("<", '', $product_requestnumber);
				$product_requestnumber=str_replace('>', '', $product_requestnumber);

				if(md5(md5($product_requestnumber))==$_POST['product_requestcharacter']) {
					$query="delete from xtbl_product WHERE Ctr='".$product_requestnumber."'";
					$rs=@mysql_query($query);
          echo "<script>alert('Product deleted')</script>";
					echo '<script>window.location.assign("https://tbcmerchantservices.com/my_store/");</script>';
				}
			}

      if (isset($_POST['desc_requestnumber']) && isset($_POST['desc_requestcharacter'])){

        $desc_requestnumber=str_replace("'", '', $_REQUEST['desc_requestnumber']);
        $desc_requestnumber=str_replace('"', '', $desc_requestnumber);
        $desc_requestnumber=str_replace("<", '', $desc_requestnumber);
        $desc_requestnumber=str_replace('>', '', $desc_requestnumber);


        $text_description=str_replace("'", '', $_REQUEST["txt_desc"]);
        $text_description = str_replace('"', '', $text_description);
        $text_description = str_replace("<", '', $text_description);
        $text_description = str_replace('>', '', $text_description);

				$price = str_replace("'", '',$_REQUEST["prod_price"]);
				$price = str_replace('"', '', $price);
				$price = str_replace("<", '', $price);
				$price = str_replace('>', '', $price);

				$pattern = '/^(0|[1-9]\d*)(\.\d{2})?$/';
				if (preg_match($pattern, $price) != '0') {

	        $query = "
	          UPDATE xtbl_product SET Product_Description = '$text_description'
	          WHERE Ctr = '$desc_requestnumber'
	        ";
	        @mysql_query($query);

					$query2 = "
						UPDATE xtbl_product SET Product_Price = '$price'
						WHERE Ctr = '$desc_requestnumber'
					";
					@mysql_query($query2);

					echo "<script>alert('Edit successful')</script>";
				}else {
					echo "<script>alert('Invalid price')</script>";
				}

      }

			$class->doc_type();
				$class->html_start('');
				$class->head_start();
					echo '<link rel="shortcut icon" type="image/x-icon" href="https://tbcmerchantservices.com/images/tbslogo.png" />';
					$class->title_page('TBCMS-'.$username);
					$class->script('https://tbcmerchantservices.com/js/jquery-3.1.1.js');
					$class->script('https://tbcmerchantservices.com/js/bootstrap.js');
					$class->link('https://tbcmerchantservices.com/css/bootstrap.css');
          $class->script('https://tbcmerchantservices.com/js/jquery1.5.js');
				$class->head_end();
				$class->body_start('');

					$class->page_home_header_start();
						$class->page_home2_header_content();
					$class->page_home_header_end();
					?>
					<div hidden class="alert">
					 <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
					 	Products without an uploaded image will not show on the Shopping page.
					</div>

					<?php



					echo '<div class="container"><h3>Welcome back,  <b>'.$current_email.'</b></h3></div>';

					$query="select * from xtbl_mytransaction".$ctr." WHERE Status='ACTIVE'";
					$rs=mysql_query($query);
					$my_amount=0;
					while($row=mysql_fetch_assoc($rs)) {
						$my_amount=$my_amount+$row['Amount'];
					}
?>
<style media="screen">
  body {
		background-color: #F6F7F9;
	}
	.table {
		background-color: white;
	}

	/* The alert message box */
 .alert {
   padding: 12px;
   background-color: #F2DEDE; /* Red */
   color: red;
 }

 /* The close button */
 .closebtn {
   margin-left: 15px;
   color: white;
   font-weight: bold;
   float: right;
   font-size: 22px;
   line-height: 20px;
   cursor: pointer;
   transition: 0.3s;
 }

 /* When moving the mouse over the close button */
 .closebtn:hover {
   color: black;
 }
</style>

					<div class="container">
						<div class="col-md-3">
							<h4><b>ACCOUNT BALANCE</b></h4>
							<center>
								<div style="color: #339933; font-size: 40px">
									<?php echo number_format($my_amount, 8);?>&nbsp
								</div>
								<div style="color: #339933; font-size: 20px">
									<?php echo 'Php '.number_format($tbc_to_peso*$my_amount, 2);?>&nbsp
								</div>
							</center><hr>
							<a class="btn btn-warning btn-block btn-lg" href="https://tbcmerchantservices.com/new_product/"
								style="border-radius: 0px">ADD NEW PRODUCT</a><br>
							<a class="btn btn-warning btn-block btn-lg" href="https://tbcmerchantservices.com/product_request/"
								style="border-radius: 0px">PRODUCT REQUEST</a>
						</div>
						<div class="col-md-9">
							<h3>Product List (Maximum of 50 Products)</h3>


<?php

// ============== PRODUCT LIST
						$query="select * from xtbl_product WHERE Main_Ctr='$ctr' order by Datetime DESC";
						$rs=mysql_query($query);
						while($row=mysql_fetch_assoc($rs)){
?>
							<form action="" enctype="multipart/form-data" method="post" hidden>
								<input <?php echo 'id="p_upload'.$row['Ctr'].'"';?> name="p_upload"
									<?php echo 'onchange=$("#txtsubmit_p_upload'.$row['Ctr'].'").click();';?>
										type="file" accept="image/*"/>
								<input name="txtid" <?php echo 'value="'.$row['Ctr'].'"';?> />
								<input <?php echo 'id="txtsubmit_p_upload'.$row['Ctr'].'"';?>  type="submit"  name="submit" value="Submit" />
							</form>

							<table class="table table-bordered">
								<tr style="background-color: #CD853F; color: white">
									<td colspan="2">
										<div class="col-md-9"><h4><b><?php echo $row['Product_Name'];?></b></h4></div>
										<div class="col-md-3" align="right" style="padding-top: 5px">
										<form method="POST" hidden>
											<input name="product_requestnumber" <?php echo 'value="'.$row['Ctr'].'"';?> />
											<input name="product_requestcharacter" <?php echo 'value="'.md5(md5($row['Ctr'])).'"';?> />
											<input type="submit" <?php echo 'id="product_requestnumber'.md5(md5(md5($row['Ctr']))).'"';?> />
										</form>

										<?php
											$checktransact_query="select * from xtbl_product_request WHERE Product_Ctr='".$row['Ctr']."'";
											$checktransact_rs=mysql_query($checktransact_query);
											$checktransact_rows=mysql_num_rows($checktransact_rs);
											// if($checktransact_rows==0){
											// 	echo '<span class="glyphicon glyphicon-ok glyphicon-lg" style="font-size:15px"></span>';
											// 	echo '<a href="javascript:void(0)" class="btn btn-success btn-lg" onclick=edit_product("'.md5(md5(md5($row['Ctr']))).'")>
                      //     <span class="glyphicon glyphicon-pencil"></span></a>';
											// }
											// else{
												echo '<a href="javascript:void(0)" class="btn btn-success btn-lg" onclick=edit_product("'.md5(md5(md5($row['Ctr']))).'")>
                          <span class="glyphicon glyphicon-pencil"></span></a>';
												echo '<a href="javascript:void(0)" onclick=delete_product("'.md5(md5(md5($row['Ctr']))).'")
													class="btn btn-danger btn-lg"><span class="glyphicon glyphicon-trash"></span></a>';
											// }
										?>
										</div>
									</td>
								</tr>
								<tr>
									<td width="30%">
										<?php
											if(file_exists('products/'.$row['Image'])) {
												echo '<img src="https://tbcmerchantservices.com/products/'.$row['Image'].'" width="100%">';
											}
											else{
												echo '<script>$(".alert").show();</script>';
												echo '<img src="https://tbcmerchantservices.com/products/0000.jpg" width="100%">';
											}
										?>

										<a href="javascript:void(0)" <?php echo 'onclick=$("#p_upload'.$row['Ctr'].'").click();';?>
											 id="btn_upload_products" class="btn btn-primary btn-block">UPLOAD</a>
									</td>
									<td width="70%">


										<form method="post">
											<input style="width:100%" name = "prod_price" id = <?php echo "prod_price".md5(md5(md5($row['Ctr']))) ?>
											 		<?php echo 'value="'.$row['Product_Price'].'"';?>  type="text" hidden  />

											<h5 hidden class="text-left" id = <?php echo "description".md5(md5(md5($row['Ctr']))) ?> >Description</h5>

											<textarea name="txt_desc"  <?php echo 'value="'.$row['Product_Description'].'"';?>
													id = <?php echo "txt_desc".md5(md5(md5($row['Ctr']))) ?> hidden rows="7" style="width:100%"><?php echo trim($row['Product_Description']) ?></textarea>

											<input hidden name="desc_requestnumber" <?php echo 'value="'.$row['Ctr'].'"';?> />
											<input hidden name="desc_requestcharacter" <?php echo 'value="'.md5(md5($row['Ctr'])).'"';?> />
											<input hidden type="submit" <?php echo 'id="desc_requestnumber'.md5(md5(md5($row['Ctr']))).'"';?> />
										</form>

										<div class="price" id = <?php echo "price".md5(md5(md5($row['Ctr']))) ?> style="width:100%">
											<h3 style="color: red"><b> &#x20B1; <?php echo $row['Product_Price'] ?> </b></h3><br>

										</div>
                      <div class="" style="height:100%">
                        <h5 class="text-left" id = <?php echo "raw_description".md5(md5(md5($row['Ctr']))) ?> >Description</h5>

                        <br>
                        <div class="description" id = <?php echo "div_desc".md5(md5(md5($row['Ctr']))) ?> >
                          <h5> <b><?php echo nl2br($row['Product_Description']) ?></b> </h5>
                        </div>
                        <br>
                        <div id = <?php echo "edit_".md5(md5(md5($row['Ctr']))) ?> hidden>
                          <?php echo '<a href="javascript:void(0)" onclick=$("#desc_requestnumber'.md5(md5(md5($row['Ctr']))).'").click();
                          													class="btn btn-info  btn-md"> Confirm </a>'; ?>
                          <a class="btn btn-warning btn-md" onclick="cancel_edit('<?php echo md5(md5(md5($row['Ctr']))); ?>');"> Cancel </a>
                        </div>

                      </div>
									</td>
								</tr>
							</table>
<?php
						}
?>
						</div>
					</div>

					<div id="modal_shopping_announce" class="modal fade">
						<div class="modal-dialog modal-md">
							<div class="modal-content">
								<div class="modal-header"><h4>SOON</h4></div>
								<div class="modal-body">
									<b>THE REQUEST BUTTON WILL BE AVAILABLE SOON SAME AS THE SHOPPING CENTER OPEN</b>
								</div>
								<div class="modal-footer">
									<a href="javascript:void(0)" class="btn btn-danger" data-dismiss="modal">&nbsp CLOSE &nbsp</a>
								</div>
							</div>
						</div>
					</div>
<?php
					$class->page_welcome_header_content_start_footer();
				$class->body_end();
			$class->html_end();
		}
	}
?>
