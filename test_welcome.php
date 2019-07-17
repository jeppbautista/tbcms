<?php
session_start();
include 'class3.php';
$class = new mydesign;
include_once 'templates/product.php';
include_once 'objects/product.php';
include_once 'objects/generic.php';
$class->database_connect();
date_default_timezone_set('Asia/Manila');
$sessiondate = date('mdY');

if (!isset($_GET['product'])) {
    echo '<script>window.location.assign("https://tbcmerchantservices.com/shopping/");</script>';
} else {
    if ($_GET['product'] == "") {
        echo '<script>window.location.assign("https://tbcmerchantservices.com/shopping/");</script>';
    } else {
        $product = str_replace("'", '', $_REQUEST['product']);
        $product = str_replace('"', '', $product);
        $product = str_replace("<", '', $product);
        $product = str_replace('>', '', $product);

        $tbc_to_peso = getAllElements("xtbl_adminaccount")['Tbc_to_Peso'];
        $products = getProducts($product);

        if ($products['Ctr'] == "") {
            echo '<script>window.location.assign("https://tbcmerchantservices.com/shopping/");</script>';
        }

        $main_info = getAllElementsWithCondition("xtbl_main_info", "Ctr", $products['Main_Ctr']);
        $personal = getAllElementsWithCondition("xtbl_personal", "Main_Ctr", $products['Main_Ctr']);
    }
}

if (!isset($_SESSION['session_tbcmerchant_ctr' . $sessiondate])) {

    $class->doc_type();
    $class->html_start('');
    $class->head_start();
    echo '<link rel="shortcut icon" type="image/x-icon" href="https://tbcmerchantservices.com/images/tbslogo.png" />';

    $page_title = $products['Product_Name'];
    $class->title_page($page_title);

    echo '<meta property="og:title" content="' . $products['Product_Name'] . ' <b>&#8369;' . $products['Product_Price'] . '</b>" />';
    echo '<meta property="og:description" content="' . $products['Product_Description'] . '" />';
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

    product_details_start($products, $tbc_to_peso);
    product_forms($product);
    product_merchant_details($main_info, $personal, 0);
    product_description($products);
    floating_cart();

    $class->page_welcome_header_content_start_footer();
    $class->body_end();
    $class->html_end();


} else {

    $ctr = $_SESSION['session_tbcmerchant_ctr' . $sessiondate];

    $account_info = getAllElementsWithCondition("xtbl_account_info", "Main_Ctr", $ctr);

    $email_status = $account_info['Email_Status'];
    $account_type = $account_info['Account_Type'];
    $account_status = $account_info['Account_Status'];
    $card_status = $account_info['Card_Status'];
    $username = $account_info['Username'];
    $account_addressyou = $account_info['Crypt_Id'];
    $activation_amount  = 0;

    $current_email = getAllElementsWithCondition("xtbl_main_info", "Ctr", $ctr)['Email'];

    if ($email_status == 'INACTIVE' || $account_status == 'INACTIVE' || $card_status == 'INACTIVE') {
        header("location: https://tbcmerchantservices.com/home/");
    } else {

        $class->doc_type();
        $class->html_start('');
        $class->head_start();
        echo '<link rel="shortcut icon" type="image/x-icon" href="https://tbcmerchantservices.com/images/tbslogo.png" />';

        $page_title = $products['Product_Name'];
        $class->title_page($page_title);

        echo '<meta property="og:title" content="' . $products['Product_Name'] . ' <b>&#8369;' . $products['Product_Price'] . '</b>" />';
        echo '<meta property="og:description" content="' . $products['Product_Description'] . '" />';
        $class->script('https://tbcmerchantservices.com/js/jquery-3.1.1.js');
        $class->script('https://tbcmerchantservices.com/js/bootstrap.js');
        $class->link('https://tbcmerchantservices.com/css/bootstrap.css');
        $class->link('https://fonts.googleapis.com/css?family=Noto+Sans&display=swap');
        $class->link('https://tbcmerchantservices.com/css/style-shop.css');
        $class->script('https://tbcmerchantservices.com/js/jquery1.3.js');
        $class->link('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
        $class->head_end();
        $class->body_start('');

        if ($account_type == 'MERCHANT') {
            $class->page_home_header_start();
            $class->page_home2_header_content();
            $class->page_home_header_end();
        } else { //if buyer
            $class->page_home_header_start();
            $class->page_home3_header_content();
            $class->page_home_header_end();
        }
        include 'nav_shop.php';
        echo '<div class="container"><h3>Welcome back,  <b>' . $current_email . '</b></h3></div>';

        product_details_start($products, $tbc_to_peso);
        product_forms($product);
        product_merchant_details($main_info, $personal, 0);
        product_description($products);
        floating_cart();
        ?>

  <?php
        $class->page_welcome_header_content_start_footer();
        $class->body_end();
        $class->html_end();
    }
}?>
