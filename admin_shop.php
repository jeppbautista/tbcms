<?php
    session_start();
    include 'class_admin.php';  
    include 'assets/utils/mailer/admin.php';
    include_once 'templates/admin.php';
    include_once 'objects/admin.php';
    include_once 'objects/generic.php';

    require_once('libraries/fpdf/fpdf.php');
    require_once('assets/utils/pdf/pdf_maker.php');
    require_once('assets/utils/mailer/generic_mailer.php');

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

    #APPROVAL
    if(isset($_POST['temporary_value'])) {
      $temvalue=str_replace("'", '', $_POST['temporary_value']);
			$temvalue=str_replace('"', '', $temvalue);
			$temvalue=str_replace("<", '', $temvalue);
      $temvalue=str_replace('>', '', $temvalue);
      
      $admin->updatePaymentStatus($temvalue, 'APPROVED');
      $admin->updateOrderStatus($temvalue, 'SHIPPING');
      
      $_orderCtr = getAllElementsWithCondition("shop_xtbl_orders", "Payment_Ctr", $temvalue)["Ctr"];
      $payments = getAllElementsWithCondition("shop_xtbl_payment", "Ctr", $temvalue);

      $productsQuery2 = $admin->getOrderedProducts($_orderCtr);
      $productsRs2=@mysql_query($productsQuery2);

      $customerQuery = $admin->getCustomerDetails($_orderCtr);
      $customerRs=@mysql_query($customerQuery);
      $customer = @mysql_fetch_assoc($customerRs);

      $mailer->prepareTemplate($_orderCtr, $productsRs2, $payments, $customer, "ACCEPT");
      $mailer->to = $customer["Email"];
      $mailer->subject = 'Order #OR' . str_pad($_orderCtr, 10, "0", STR_PAD_LEFT). ' has been ACCEPTED';
      $mailer->sendMail();

      $productsQuery3 = $admin->getOrderedProducts($_orderCtr);
      $productsRs3=@mysql_query($productsQuery3);

      $product_arr = array();
      while($p = @mysql_fetch_assoc($productsRs3)){
          $tempo = array($p["Product_Name"], $p["Quantity"], $p["Tax"], $p["Product_Price"], $p["Grand_Total"]);
          array_push($product_arr, $tempo);
      }


      $pdf = new PDF();

      $date = date('YmdHi', time());
      $reference = $date."".$_orderCtr."".$customer["Ctr"];
      $paymentDate = $payments["Payment_Date"];
      $paymentType = $payments["Payment_Type"];
      $name = $customer["Full_Name"];
      $email = $customer["Email"];
      $phone = $customer["Phone"];
      $address = $customer["Shipping_Address"];

      $pdf->CompileInvoice($reference,$paymentDate,$paymentDate,
                            $_orderCtr,$paymentType,$reference,
                            $paymentDate,$name,$email,
                            $phone,$address,$product_arr);

      $pdfdoc = $pdf->getFile();
      $attachment = chunk_split(base64_encode($pdfdoc));
      $attachmentName = $reference . ".pdf";
      $mailer->sendInvoice($attachment, $attachmentName);

    }
    elseif (isset($_POST['temporary_valueD'])) {
      $temvalue=str_replace("'", '', $_POST['temporary_valueD']);
			$temvalue=str_replace('"', '', $temvalue);
			$temvalue=str_replace("<", '', $temvalue);
      $temvalue=str_replace('>', '', $temvalue);
      
      $admin->updatePaymentStatus($temvalue, 'DENIED');

      $_orderCtr = getAllElementsWithCondition("shop_xtbl_orders", "Payment_Ctr", $temvalue)["Ctr"];
      $payments = getAllElementsWithCondition("shop_xtbl_payment", "Ctr", $temvalue);
      
      $customerQuery = $admin->getCustomerDetails($_orderCtr);
      $customerRs=@mysql_query($customerQuery);
      $customer = @mysql_fetch_assoc($customerRs);

      $mailer->prepareTemplate($_orderCtr, "", $payments, $customer, "DENIED");
      $mailer->to = $customer["Email"];
      $mailer->subject = 'Order #OR' . str_pad($_orderCtr, 10, "0", STR_PAD_LEFT). ' has been DENIED';
      $mailer->sendMail();

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
    $query = $admin->getPayments();
    $rs=@mysql_query($query);
    while($payment = @mysql_fetch_assoc($rs)){
      $orderCtr = getAllElementsWithCondition("shop_xtbl_orders", "Payment_Ctr", $payment["Ctr"])["Ctr"];
      $productsQuery = $admin->getOrderedProducts($orderCtr);
      $productsRs=@mysql_query($productsQuery);
      $products = @mysql_fetch_assoc($productsRs);

      $customerQuery = $admin->getCustomerDetails($orderCtr);
      $customerRs=@mysql_query($customerQuery);
      $customer = @mysql_fetch_assoc($customerRs);

      $view->orderHeader($orderCtr, $payment, $customer);
      $view->table_header();
      $temp_total = $products["Grand_Total"];

      if ($payment["Status"] == "PENDING") {
        do{
          $view->orderRow($products);
          
        }while($products = @mysql_fetch_assoc($productsRs));
        $view->orderTotal($temp_total);

      }

      $view->table_footer();
      $view->div_end();
      
    }
    $view->container_end();

    $view->modal_accept();
    $view->modal_denied();

    

?>