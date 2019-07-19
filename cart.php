<?php
session_start();
include 'class3.php';
include_once 'templates/cart.php';
include_once 'objects/generic.php';
include_once 'objects/product.php';
$class = new mydesign;
$class->database_connect();
date_default_timezone_set('Asia/Manila');
$sessiondate     = date('mdY');
$GLOBALS['test'] = 0;


if (isset($_POST['btn-go-to-checkout'])) {
    if (count($_SESSION['cart']) > 0) {
        foreach ($_SESSION['cart'] as $key => $value) {
            $_SESSION['cart'][$key]['quantity'] = $_POST['quantity-' . $key];
        }
        echo '<script>window.location.assign("https://tbcmerchantservices.com/checkout/");</script>';
    }
    echo '<script>window.location.assign("https://tbcmerchantservices.com/shopping/");</script>';
    #TODO empty cart checkout
}


$class->doc_type();
$class->html_start('');
$class->head_start();
echo '<link rel="shortcut icon" type="image/x-icon" href="https://tbcmerchantservices.com/images/tbslogo.png" />';
$page_title = "Cart";
$class->title_page($page_title);
$class->script('https://tbcmerchantservices.com/js/jquery-3.1.1.js');
$class->script('https://tbcmerchantservices.com/js/bootstrap.js');
$class->link('https://tbcmerchantservices.com/css/bootstrap.css');
$class->link('https://fonts.googleapis.com/css?family=Noto+Sans|Open+Sans&display=swap');
$class->link('https://tbcmerchantservices.com/css/style-shop.css');
$class->script('https://tbcmerchantservices.com/js/jquery1.3.js');
$class->link('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
$class->head_end();


if (!isset($_SESSION['session_tbcmerchant_ctr' . $sessiondate])) {
    $class->body_start('');
    $class->page_home_header_start();
    $class->page_shopping_header_content1();
    $class->page_home_header_end();
}
else {

    $ctr = $_SESSION['session_tbcmerchant_ctr' . $sessiondate];
    $total = 0.0;
    $tax  = 0.0;
    $shipping = 0.0;
    $account_type = getAllElementsWithCondition("xtbl_account_info", "Main_Ctr", $ctr)['Account_Type'];

    if ($account_type == 'MERCHANT') {
        $class->page_home_header_start();
        $class->page_home2_header_content();
        $class->page_home_header_end();
    } else { //if buyer
        $class->page_home_header_start();
        $class->page_home3_header_content();
        $class->page_home_header_end();
    }
}

include 'nav_shop.php';

if (count($_SESSION['cart']) > 0) {
    $product_ids = array();
    foreach ($_SESSION['cart'] as $id => $value) {
        array_push($product_ids, $id);
    }
    $query = readByID($product_ids);
    $rs    = mysql_query($query);
    container_start();
    header_text("Shopping Cart");
    table_header();
?>


<?php
    while ($product = mysql_fetch_assoc($rs)) {
        $sub_total = floatval($_SESSION['cart'][$product['Ctr']]['quantity'] * $product['Product_Price']);
        $total += $sub_total;
        product_row($product, $sub_total);
    }
    table_footer();
    order_summary($total, $tax, $shipping);
    div_end();
}
else {
  empty_cart();
}

$class->page_welcome_header_content_start_footer();
$class->body_end();
$class->html_end();
?>

<!-- <div class="row">
<div class="col-12 col-md-6">
<div id="discount">
<h5 style="text-align:left">ENTER YOUR DISCOUNT CODE</h5>
<div class="input-group">
<div class="form-group has-feedback has-clear">
<input type="text" class="form-control" id="discount-text" placeholder="">
<span class="form-control-clear glyphicon glyphicon-remove form-control-feedback hidden"></span>
</div>
<span class="input-group-btn">
<button type="button" class="btn" id="discount-btn" onclick="alert('Invalid discount code')">Enter</button>
</span>
</div>
</div>
</div>
</div> -->
