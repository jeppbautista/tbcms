<?php
    session_start();
    include 'class_admin.php';  
    include_once 'templates/admin.php';
    include_once 'objects/admin.php';
    include_once 'objects/generic.php';

    $class = new mydesign;
    $class->database_connect();

    $view = new View;
    $admin = new Admin;

    date_default_timezone_set('Asia/Manila');
    $sessiondate=date('mdY');

    $limit=15;
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
    
    if(!isset($_SESSION['session_tbcmerchant_ctr_myadmin'.$sessiondate])){
      header("location: https://tbcmerchantservices.com/tbcmyadmin/");
    }

    #APPROVAL
    if(isset($_POST['temporary_value'])) {
      $temvalue=str_replace("'", '', $_POST['temporary_value']);
			$temvalue=str_replace('"', '', $temvalue);
			$temvalue=str_replace("<", '', $temvalue);
      $temvalue=str_replace('>', '', $temvalue);
      
      $admin->updatePaymentStatus($temvalue, 'APPROVED');
      $admin->updateOrderStatus($temvalue, 'SHIPPING');
    }
    elseif (isset($_POST['temporary_valueD'])) {
      $temvalue=str_replace("'", '', $_POST['temporary_valueD']);
			$temvalue=str_replace('"', '', $temvalue);
			$temvalue=str_replace("<", '', $temvalue);
      $temvalue=str_replace('>', '', $temvalue);
      
      $admin->updatePaymentStatus($temvalue, 'DENIED');
    }

    $tbc_to_peso = getAllElements("xtbl_adminaccount")['Tbc_to_Peso'];

    $class->doc_type();
    $class->html_start('');
    $class->head_start();
    echo '<link rel="shortcut icon" type="image/x-icon" href="https://tbcmerchantservices.com/images/tbslogo.png" />';
    $class->title_page('TBCMS ADMIN');
    $class->script('https://tbcmerchantservices.com/js/jquery-3.1.1.js');
    $class->script('https://tbcmerchantservices.com/js/bootstrap.js');
    $class->link('https://tbcmerchantservices.com/css/bootstrap.css');
    $class->link('https://tbcmerchantservices.com/css/style-admin.css');
    $class->script('https://tbcmerchantservices.com/js/jquery1.4.js');
    $class->head_end();
    $class->body_start('');

    $class->admin_page_header();

    $view->container_start();
    // $view->table_header();
    $query = $admin->getPendingPayments();
    $rs=@mysql_query($query);
    while($payment = @mysql_fetch_assoc($rs)){
      $orderCtr = getAllElementsWithCondition("shop_xtbl_orders", "Payment_Ctr", $payment["Ctr"])["Ctr"];
      $productsQuery = $admin->getOrderedProducts($orderCtr);
      $productsRs=@mysql_query($productsQuery);
      $products = @mysql_fetch_assoc($productsRs);

      $customerQuery = $admin->getCustomerDetails($orderCtr);
      $customerRs=@mysql_query($customerQuery);
      $customer = @mysql_fetch_assoc($customerRs);

      ?>
        <div class="col-12 col-md-12 shadow" style="margin-bottom:15px;">
          <div class="row">
            <div class="col-12 col-md-4 header-txt">
            <b>Date of Transaction: </b> <?php echo $payment["Payment_Date"] ?><br>
            <b>Mode of Payment:</b> <?php echo $payment["Payment_Type"] ?><br>
            <b>Transaction Number:</b> <?php echo $payment["Transaction"] ?><br>

            </div>

            <div class="col-12 col-md-5 header-shipping">
              <b>Billing Address: </b> <?php echo $customer["Shipping_Address"]; ?><br> 
              <b>Customer: </b> <?php echo $customer["Full_Name"]; ?><br> 
              <b>Email: </b> <?php echo $customer["Email"]; ?><br> 
              <b>Phone: </b> <?php echo $customer["Phone"]; ?><br> 
            </div>

            <div class="col-12 col-md-3 header-btn">
              <span>
                <a class="btn btn-success" href="javascript:void(0)" <?php echo "onclick=btnaccept('".$payment['Ctr']."')";?> >ACCEPT</a>
                <a class="btn btn-danger" href="javascript:void(0)" <?php echo "onclick=btndenied('".$payment['Ctr']."')";?> >DENIED</a>
              </span>
            </div>
          </div>
          <br>


      <?php
      $view->table_header();
      do{
        $temp_total = $products["Grand_Total"];
        ?>
        <tr>
            <td style="width: 50%"> 
              <div class="row">
                <div class="col-sm-2">
                  <img class="img-responsive" src=<?php echo "https://tbcmerchantservices.com/products/".$products["Image"] ?>  alt="">
                </div>
                <div class="col-sm-10">
                  <?php echo $products["Product_Name"] ?> 
                </div>
              </div>
            </td>
            <td style="width: 20%"> <?php echo $products["Quantity"] . " pcs"?> </td>  
            <td style="width: 30%"> <?php echo '&#8369;' . $products["Product_Price"] ?> </td>          
        </tr>

        <?php
      }while($products = @mysql_fetch_assoc($productsRs));

      ?>
        <tr>
          <td></td>
          <td></td>
          <td>
          <b>Total: <?php echo '&#8369;' .  $temp_total; ?></b>
          </td>
        </tr>
      <?php

      $view->table_footer();
      $view->div_end();
      
    }
    $view->container_end();

    $view->modal_accept();
    $view->modal_denied();

    

?>