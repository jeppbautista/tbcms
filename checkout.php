<?php
session_start();
include 'class3.php';
include_once 'templates/checkout.php';
include_once 'objects/generic.php';
include_once 'objects/product.php';
$class=new mydesign;
$class->database_connect();
$view = new View;

date_default_timezone_set('Asia/Manila');
$sessiondate=date('mdY');
$GLOBALS['test'] = 0;

$class->doc_type();
$class->html_start('');
$class->head_start();
echo '<link rel="shortcut icon" type="image/x-icon" href="https://tbcmerchantservices.com/images/tbslogo.png" />';
$page_title = "Checkout";
$class->title_page($page_title);
$class->script('https://tbcmerchantservices.com/js/jquery-3.1.1.js');
$class->script('https://tbcmerchantservices.com/js/bootstrap.js');
$class->link('https://tbcmerchantservices.com/css/bootstrap.css');
$class->link('https://fonts.googleapis.com/css?family=Poppins|Noto+Sans|Open+Sans&display=swap');
$class->link('https://tbcmerchantservices.com/css/style-shop.css');
$class->script('https://tbcmerchantservices.com/js/jquery1.3.js');
// $class->script('https://tbcmerchantservices.com/js/paypal.js');
$class->link('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
$class->head_end();
$class->body_start('');

if (count($_SESSION['cart']) == 0) {
  echo '<script>window.location.assign("https://tbcmerchantservices.com/cart/");</script>';
}else{

  if(!isset($_SESSION['s'])){
    $_SESSION['s'] = true;
  }

  if((isset($_POST['btn-submit-payment'])) && ($_SESSION['s'])){
    $payment_type = $_REQUEST['txt-payment-type'];
    $form_complete = false;

    $email = trim($class->pre_process_form($_POST['check-email']));
    $phone = trim($class->pre_process_form($_POST['check-phone']));
    $lastname = trim($class->pre_process_form($_POST['check-lastname']));
    $firstname = trim($class->pre_process_form($_POST['check-firstname']));
    $address = trim($class->pre_process_form($_POST['check-address']));
    $country = trim($class->pre_process_form($_POST['check-country']));
    $city = trim($class->pre_process_form($_POST['check-city']));
    $transaction_num = trim($class->pre_process_form($_POST['txt-trans-'.$payment_type]));

    if(($email !='') && 
    ($phone !='') &&
    ($lastname!='') &&
    ($firstname!='') &&
    ($address!='') &&
    ($country!='') &&
    ($city!='') &&
    ($transaction_num!='')
    ){
      $form_complete = true;
    }
    //TODO error

    if($form_complete){

      $_SESSION['done'] = '1';
      if(isset($_SESSION['session_tbcmerchant_ctr'.$sessiondate])){
        $customer_ctr = $_SESSION['session_tbcmerchant_ctr'.$sessiondate];
      } else {
        $customer_ctr = 0;
      }
      
      $shipping_address = $address . " " . $city . " " . $country;
      $is_member = $customer_ctr==0 ? 0 : 1;
      
      @mysql_query(insertCustomer($lastname, $firstname, $shipping_address, $country, $city, $phone, $email, $is_member));
      $customer_ctr = getLatestCtr('shop_xtbl_customer');

      @mysql_query(insertCustomerDetail($customer_ctr));
      $customer_detail_ctr = getLatestCtr('shop_xtbl_customer_detail');

      @mysql_query(insertPayment($payment_type, $transaction_num));
      $payment_id = getLatestCtr('shop_xtbl_payment');

      @mysql_query(insertOrders($customer_detail_ctr, $payment_id));
      $order_ctr = getLatestCtr('shop_xtbl_orders');

      foreach($_SESSION['cart'] as $id=>$value){
        mysql_query(insertOrderDetail($id, $value['quantity'], $order_ctr));
      }

      $grandTotal = getGrandTotal($order_ctr);
      echo $grandTotal;
      @mysql_query(updateWithCondition("shop_xtbl_orders", "Grand_Total", $grandTotal, "Ctr", $order_ctr));

      $_POST["orderNumber"] = $order_ctr;
      $_POST["paymentType"] = $payment_type;
      $_POST["transactionNum"] = $transaction_num;
      $_POST["transactionDate"] = getAllElementsWithCondition("shop_xtbl_payment", "Ctr", $payment_id)["Payment_Date"];

      session_destroy();

    }
    else{
      echo "BAR";
    }
  }
  elseif((isset($_POST['btn-submit-payment'])) && (!$_SESSION['s'])){
    echo '<script>window.location.assign("https://tbcmerchantservices.com/cart/");</script>';
  }

  if(!isset($_SESSION['session_tbcmerchant_ctr'.$sessiondate])){
    $class->page_home_header_start();
    $class->page_shopping_header_content1();
    $class->page_home_header_end();
  }
  else{
    $ctr=$_SESSION['session_tbcmerchant_ctr'.$sessiondate];
    $account_type = getAllElementsWithCondition("xtbl_account_info", "Main_Ctr", $ctr)['Account_Type'];

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
  }

  ?>

  <style>
    html {
        overflow-y:scroll;
    }
    body {
      background-color: #F8F8F8;
    }
  </style>

  <?php
    $view->container_start();
    $view->header_text("Checkout Page");
    $view->checkout_steps_head();
    $view->details_card();
    $view->shipping_card();
    $view->payment_card();
    // order_card();
    $view->checkout_steps_foot();

    $view->cart_head();

    $product_ids = array();
    foreach($_SESSION['cart'] as $id=>$value){
      array_push($product_ids, $id);
    }
    $query = readByID($product_ids);
    $rs = mysql_query($query);
    while($product = mysql_fetch_assoc($rs)) {
      $sub_total = floatval($_SESSION['cart'][$product['Ctr']]['quantity'] * $product['Product_Price']);
      $total += $sub_total;
      $view->product_row($product, $sub_total);
    }

  $view->cart_foot($total);

  $view->div_end();
  $class->page_welcome_header_content_start_footer();
  $class->body_end();
  $class->html_end();

  if(isset($_SESSION['done'])){
    ?>
    <script type="text/javascript">
      $( document ).ready(function() {
          $('.div-steps').fadeOut(500,function(){});
          $('.div-discount').fadeOut(400, function(){});
          $('.div-check-cart').fadeOut(400, function(){});
          $('#header_text').hide();
          $('.div-check-cart > .table-header').html('YOUR ORDERS');
          setTimeout(function(){
            $('#checkout-finished').fadeIn(250);
            $('.div-order-final').fadeIn(250);
            $('.div-check-cart').fadeIn(250);
          },500);
      });
    </script>
    <?php
    $_SESSION['s'] = false;
  }
}



?>
