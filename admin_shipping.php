<?php
    session_start();
    include 'class_admin.php';  
    include 'assets/utils/mailer/admin.php';
    include_once 'templates/admin.php';
    include_once 'objects/admin.php';
    include_once 'objects/generic.php';

    $class = new mydesign;
    $class->database_connect();

    $view = new View;
    $admin = new Admin;
    $mailer = new AdminMailer;

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

    if(isset($_POST['submit'])){
      $action = $_POST['submit'];
      $orderCtr = $_POST['order-id'];

      $paymentCtr = getAllElementsWithCondition("shop_xtbl_orders", "Ctr", $orderCtr)['Payment_Ctr'];
      $payments = getAllElementsWithCondition("shop_xtbl_payment", "Ctr", $paymentCtr);

      $customerQuery = $admin->getCustomerDetails($orderCtr);
      $customerRs=@mysql_query($customerQuery);
      $customer = @mysql_fetch_assoc($customerRs);

      $productsQuery = $admin->getOrderedProducts($orderCtr);
      $productsRs=@mysql_query($productsQuery);
      // $products = @mysql_fetch_array($productsRs);

      if($action == "ON DELIVERY"){
        updateWithCondition2("shop_xtbl_orders", "Status", $action, "Ctr", $orderCtr);
        $mailer->prepareTemplate($orderCtr, $productsRs, $payments, $customer, "ON DELIVERY");
        $mailer->to = $customer["Email"];
        $mailer->subject = 'Order #OR' . str_pad($orderCtr, 10, "0", STR_PAD_LEFT). ' on delivery';
        $mailer->sendMail();

        $mailer->to = 'tbcmsapp@gmail.com';
        $mailer->sendMail();


        // $mailer->to = 'accountsaccounts@tbcmerchantservices.com';
        // $mailer->sendMail();

      }
      elseif($action == "CANCEL"){
        updateWithCondition2("shop_xtbl_orders", "Status", $action, "Ctr", $orderCtr);
        $mailer->prepareTemplate($orderCtr, $productsRs, $payments, $customer, "CANCELLED");
        $mailer->to = $customer["Email"];
        $mailer->subject = 'Order #OR' . str_pad($orderCtr, 10, "0", STR_PAD_LEFT). ' has been cancelled';
        $mailer->sendMail();

        $mailer->to = 'tbcmsapp@gmail.com';
        $mailer->sendMail();

        //email
      }
    }

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
    $query = $admin->getApprovedOrders();
    $rs = @mysql_query($query);

    while($order = @mysql_fetch_assoc($rs)){
        $orderCtr = $order['Ctr'];
        $customerQuery = $admin->getCustomerDetails($orderCtr);
        $customerRs=@mysql_query($customerQuery);
        $customer = @mysql_fetch_assoc($customerRs);

        $payment = getAllElementsWithCondition("shop_xtbl_payment", "Ctr", $order['Payment_Ctr']);

        $view->orderHeaderShipping($payment, $customer, $order);
        $view->div_end();
    }

?>