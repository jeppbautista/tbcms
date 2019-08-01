<?php
    session_start();
    include 'class3.php';
    include_once 'templates/orders.php';
    include_once 'objects/generic.php';
    include_once 'objects/product.php';

    $class = new mydesign;
    $view = new View;
    $class->database_connect();

    date_default_timezone_set('Asia/Manila');
    $sessiondate=date('mdY');

    $class->doc_type();
    $class->html_start('');
    $class->head_start();
    echo '<link rel="shortcut icon" type="image/x-icon" href="https://tbcmerchantservices.com/images/tbslogo.png" />';
    $page_title = "TBCMS: Order History";
    $class->title_page($page_title);
    $class->script('https://tbcmerchantservices.com/js/jquery-3.1.1.js');
    $class->script('https://tbcmerchantservices.com/js/bootstrap.js');
    $class->link('https://tbcmerchantservices.com/css/bootstrap.css');
    $class->link('https://fonts.googleapis.com/css?family=Noto+Sans|Open+Sans&display=swap');
    $class->link('https://tbcmerchantservices.com/css/style-shop.css');
    $class->script('https://tbcmerchantservices.com/js/jquery1.3.js');
    $class->link('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    $class->head_end();

    $view->container_start();
    $view->header_text("Order History");
    $view->breakline();
    $view->table_header();
    $query = getAllElementsWithCondition("shop_xtbl_orders", "Payment_Ctr", "2");
    $view->product_row();
    $view->table_footer();
    $view->container_end();



?>