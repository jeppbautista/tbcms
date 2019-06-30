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
    			$page_title = $row['Product_Name'];

    		$class->title_page($page_title);
    echo '<meta property="og:title" content="'.$row['Product_Name'].' <b>&#8369;'.$row['Product_Price'].'</b>" />';
    echo '<meta property="og:description" content="'.$row['Product_Description'].'" />';
    			$class->script('https://tbcmerchantservices.com/js/jquery-3.1.1.js');
    			$class->script('https://tbcmerchantservices.com/js/bootstrap.js');
    			$class->link('https://tbcmerchantservices.com/css/bootstrap.css');
    			$class->link('https://fonts.googleapis.com/css?family=Noto+Sans&display=swap');
           $class->link('https://tbcmerchantservices.com/css/style-shop.css');
    			$class->script('https://tbcmerchantservices.com/js/jquery1.3.js');
    			$class->link('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    		$class->head_end();

    		$class->body_start('');
    			$class->page_home_header_start();
    				$class->page_shopping_header_content1();
    			$class->page_home_header_end();
    			include 'nav_shop.php';


    			if($row['Ctr']==""){echo '<script>window.location.assign("https://tbcmerchantservices.com/shopping/");</script>';}
    			$query2="select * from xtbl_main_info WHERE Ctr='".$row['Main_Ctr']."'";
    			$rs2=mysql_query($query2);
    			$row2=mysql_fetch_assoc($rs2);

    			$query3="select * from xtbl_personal WHERE Main_Ctr='".$row['Main_Ctr']."'";
    			$rs3=mysql_query($query3);
    			$row3=mysql_fetch_assoc($rs3);

    	?>		<br>
<div class="container product-div-1">
    <div class="col-md-7 product-image-outer">
        <div class="product-image">
            <?php
                if(file_exists('products/'.$row['Image'])) {
                    ?>
            <img <?php echo 'src="https://tbcmerchantservices.com/products/'.$row['Image'].'"';?> >
            <?php
                }
                else{
                ?>
            <img <?php echo 'src="https://tbcmerchantservices.com/products/0000.jpg"';?> >
            <?php
                }
                ?>
        </div>
    </div>
    <div class="col-md-5 product-details">
        <h2><b><?php echo $row['Product_Name'];?></b> <br>
            <small> <a href="https://tbcmerchantservices.com/shopping/">Back to shopping</a> </small>
        </h2>
        <h3 style="color:red">
            <b><?php echo '&#8369;'.number_format($row['Product_Price'],2);?></b><br>
            <small>(<?php echo number_format($row['Product_Price']/$tbc_to_peso,8);?> TBC)</small>
        </h3>
        <br>
        <div class="div-shop">
            <form class="" action="index.html" method="post">
            </form>
            <a href="#" class="btn btn-md btn-add-to-cart">Add to Cart</a> <br>
            <a href="#" class="btn btn-md btn-checkout">Go to Checkout</a>
        </div>
        <div class="div-merchant-details">
            <h4>Merchant Name: <b><?php echo $row2['Business_Name'];?></b></h4>
            <h4>Seller Name: <b><?php echo $row3['Fname'].' '.$row3['Lname'];?></b></h4>
        </div>
    </div>
</div>
<div class="container">
    <div class="col-md-7 col-12 product-div-2">
        <h5><?php echo nl2br($row['Product_Description']);?></h5>
        <br><br>
    </div>
</div>
<a href="https://tbcmerchantservices.com/cart/" class="float">
<i class="fa fa-shopping-cart fa-lg my-float"></i>
</a>
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

    	$page_title = $row['Product_Name'];

    $class->title_page($page_title);
    echo '<meta property="og:title" content="'.$row['Product_Name'].' <b>&#8369;'.$row['Product_Price'].'</b>" />';
    echo '<meta property="og:description" content="'.$row['Product_Description'].'" />';
    		$class->script('https://tbcmerchantservices.com/js/jquery-3.1.1.js');
    		$class->script('https://tbcmerchantservices.com/js/bootstrap.js');
    		$class->link('https://tbcmerchantservices.com/css/bootstrap.css');
    		$class->link('https://fonts.googleapis.com/css?family=Noto+Sans&display=swap');
           $class->link('https://tbcmerchantservices.com/css/style-shop.css');
    		$class->script('https://tbcmerchantservices.com/js/jquery1.3.js');
    		$class->link('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
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
    	include 'nav_shop.php';

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
<div class="container product-div-1">
<div class="col-md-7 product-image-outer">
    <div class="product-image">
        <?php
            if(file_exists('products/'.$row['Image'])) {
                ?>
        <img <?php echo 'src="https://tbcmerchantservices.com/products/'.$row['Image'].'"';?> >
        <?php
            }
            else{
            ?>
        <img <?php echo 'src="https://tbcmerchantservices.com/products/0000.jpg"';?> >
        <?php
            }
            ?>
    </div>
</div>
<div class="col-md-5 product-details">
    <h2><b><?php echo $row['Product_Name'];?></b> <br>
        <small> <a href="https://tbcmerchantservices.com/shopping/">Back to shopping</a> </small>
    </h2>
    <h3 style="color:red"><b><?php echo '&#8369;'.number_format($row['Product_Price'],2);?></b><br>
        <small>(<?php echo number_format($row['Product_Price']/$tbc_to_peso,8);?> TBC)</small>
    </h3>
    <br>
    <div class="div-shop">
        <form class="add-to-cart-form">
            <input id="quantity" type="number" name="quantity" value="1" hidden>
            <input id = "product" type="number" name="product" value='<?php echo $product ?>' hidden>
            <button type="submit" id = "btn-add-to-cart" class="btn  btn-md btn-add-to-cart">Add to Cart</button>
        </form>
        <a href="#" class="btn btn-md btn-checkout">Go to Checkout</a>
    </div>
    <div class="div-merchant-details">
        <h4>Merchant Name: <b><?php echo $row2['Business_Name'];?></b></h4>
        <h4>Email: <b><?php echo $row2['Email'];?></b></h4>
        <h4>Seller Name: <b><?php echo $row3['Fname'].' '.$row3['Lname'];?></b></h4>
        <h4>Cell #: <b><?php echo $row3['Cellphone'];?></b></h4>
        <br>
    </div>
</div>
<div class="container">
    <div class="col-md-7 col-12 product-div-2">
        <h5><?php echo nl2br($row['Product_Description']);?></h5>
        <br><br>
    </div>
</div>
<a href="https://tbcmerchantservices.com/cart/" class="float">
<i class="fa fa-shopping-cart fa-lg my-float"></i>
</a>
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
<?php
    $class->page_welcome_header_content_start_footer();
    	$class->body_end();
    $class->html_end();
    }
    }

    ?>
