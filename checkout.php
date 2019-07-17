<?php
session_start();
include 'class3.php';
include_once 'templates/checkout.php';
include_once 'objects/generic.php';
include_once 'objects/product.php';
$class=new mydesign;
$class->database_connect();

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
$class->link('https://fonts.googleapis.com/css?family=Noto+Sans|Open+Sans&display=swap');
$class->link('https://tbcmerchantservices.com/css/style-shop.css');
$class->script('https://tbcmerchantservices.com/js/jquery1.3.js');
$class->link('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
$class->head_end();
$class->body_start('');

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
  include 'nav_shop.php';
  container_start();
  header_text("Checkout Page");
  checkout_steps_head();
  details_card();
  shipping_card();
  payment_card();
  order_card();
  checkout_steps_foot();

  cart_head();

  $product_ids = array();
  foreach($_SESSION['cart'] as $id=>$value){
    array_push($product_ids, $id);
  }
  $query = readByID($product_ids);
  $rs = mysql_query($query);
  while($product = mysql_fetch_assoc($rs)) {
    $sub_total = floatval($_SESSION['cart'][$product['Ctr']]['quantity'] * $product['Product_Price']);
    $total += $sub_total;
    product_row($product, $sub_total);
  }

  cart_foot();

div_end();
$class->page_welcome_header_content_start_footer();
$class->body_end();
$class->html_end();
?>
