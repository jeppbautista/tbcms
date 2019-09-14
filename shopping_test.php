<?php
session_start();
include 'class3.php';
include_once 'templates/shopping.php';
include_once 'objects/generic.php';
$class = new mydesign;
// $class->database_connect();
$view = View;

date_default_timezone_set('Asia/Manila');
$sessiondate = date('mdY');

$limit = 12;
$page = $_SESSION['session_ppage'];
$type = $_SESSION['session_ptype'];

if(isset($_POST['pageno'])) {
    $page=str_replace("'", '', $_REQUEST['pageno']);
    $page=str_replace('"', '', $page);
    $page=str_replace("<", '', $page);
    $page=str_replace('>', '', $page);

    $_SESSION['session_ppage']=$page;
    $page=$_SESSION['session_ppage'];
    echo '<script>window.location.assign("https://tbcmerchantservices.com/shopping/");</script>';
}

if($page==""){$page=1;}

if(isset($_POST['shoptype'])) {
    $type=str_replace("'", '', $_REQUEST['shoptype']);
    $type=str_replace('"', '', $type);
    $type=str_replace("<", '', $type);
    $type=str_replace('>', '', $type);
    $_SESSION['session_ppage']=1;
    $_SESSION['session_ptype']=$type;
    $type=$_SESSION['session_ptype'];
    echo '<script>window.location.assign("https://tbcmerchantservices.com/shopping/");</script>';
}

if($type==""){$type='%%';}

$tbc_to_peso = getAllElements("xtbl_adminaccount")['Tbc_to_Peso'];

$class->doc_type();
$class->html_start('');
$class->head_start();
echo '<link rel="shortcut icon" type="image/x-icon" href="https://tbcmerchantservices.com/images/tbslogo.png" />';
$class->title_page('TBCMS:Shopping');
$class->script('https://tbcmerchantservices.com/js/jquery-3.1.1.js');
$class->script('https://tbcmerchantservices.com/js/bootstrap.js');
$class->link('https://tbcmerchantservices.com/css/bootstrap.css');
$class->link('css/style-shop.css');
$class->link('https://www.w3schools.com/w3css/4/w3.css');
$class->link('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
$class->link('https://tbcmerchantservices.com/assets/lib/fontawesome-free-5.9.0-web/css/all.min.css');
$class->script('https://tbcmerchantservices.com/js/jquery1.3.js');
$class->link('assets/css/custom.css');
$class->head_end();

$class->body_start('');
if(!isset($_SESSION['session_tbcmerchant_ctr'.$sessiondate]))
{
    $class->page_home_header_start();
    $class->page_shopping_header_content1();
    $class->page_home_header_end();
    // $class->page_shopping_navbar_content1();

}
else{
    $ctr=$_SESSION['session_tbcmerchant_ctr'.$sessiondate];
    $account_info = getAllElementsWithCondition("xtbl_account_info", "Main_Ctr", $ctr);

    
    if($account_info['Email_Status']=='INACTIVE' || 
        $account_info['Account_Status']=='INACTIVE' || 
        $account_info['Card_Status']=='INACTIVE') {
		header("location: https://tbcmerchantservices.com/home/");
    }
    else {
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
    
}
include 'nav_shop.php';
?>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <!-- <div class="fixed-top collapse show wrapper">
                <ul class="list-group bg-white menu">
                    <li>FOOOO</li>
                    <li>FOOOO</li>
                    <li>FOOOO</li>
                    <li>FOOOO</li>
                    <li>FOOOO</li>
                    <li>FOOOO</li>
                    <li>FOOOO</li>
                    <li>FOOOO</li>
                    <li>FOOOO</li>
                    <li>FOOOO</li>
                    <li>FOOOO</li>
                    <li>FOOOO</li>
                    <li>FOOOO</li>
                    <li>FOOOO</li>
                </ul>
            </div> -->
            <div class="panel-group">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="category clickable" data-toggle="collapse" href="#collapse1">Categories</a>
                            <a class="category notclickable" data-toggle="collapse" href="#collapse1">Categories</a>
                        </h4>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse in wrapper">
                        <ul class="list-group">
                            <li class="list-group-item">One</li>
                            <li class="list-group-item">Two</li>
                            <li class="list-group-item">Three</li>
                            <li class="list-group-item">One</li>
                            <li class="list-group-item">Two</li>
                            <li class="list-group-item">Three</li>
                            <li class="list-group-item">One</li>
                            <li class="list-group-item">Two</li>
                            <li class="list-group-item">Three</li>
                            <li class="list-group-item">One</li>
                            <li class="list-group-item">Two</li>
                            <li class="list-group-item">Three</li>
                            <li class="list-group-item">One</li>
                            <li class="list-group-item">Two</li>
                            <li class="list-group-item">Three</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <img src="images/SLIDE3.png" style="max-width: 100%;">
        </div>
    </div>
    <div class="row shadow">
        <div class="col-md-3" style="border-right: 1px solid #999fff">
            <h5> <b>Fast Delivery</b> </h5>
        </div>
        <div class="col-md-3" style="border-right: 1px solid #999fff">
            <h5> <b>Money Return</b> </h5>
        </div>
        <div class="col-md-3" style="border-right: 1px solid #999fff">
            <h5> <b>Support 24/7</b> </h5>
        </div>
        <div class="col-md-3">
            <h5> <b>Secured Payment</b> </h5>
        </div>
    </div>
    <br>
    <p class="subheader">Our Products</p>

    <div class="row shadow">
        <div class="col-md-3">
            <div class="shopping-product">
                
                <div class="product-img">
                    <img src="https://via.placeholder.com/180">
                </div>
                <div class="product-name">
                    <p>Test Product</p>
                </div>
                <div class="product-price">
                    <p>&#8369; 500</p>
                    <a class="btn more-info">Details</a>
                </div>
               
            </div>
        </div>
        <div class="col-md-3">
            <div class="shopping-product">
                <div class="product-img">
                    <img src="https://via.placeholder.com/180">
                </div>
                <div class="product-name">
                    <p>Test Product</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="shopping-product">
                <div class="product-img">
                    <img src="https://via.placeholder.com/180">
                </div>
                <div class="product-name">
                    <p>Test Product</p>
                </div>
            </div>
            
        </div>
        <div class="col-md-3">
            <div class="shopping-product">
                <div class="product-img">
                    <img src="https://via.placeholder.com/180">
                </div>
                <div class="product-name">
                    <p>Test Product</p>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<?php
$class->page_welcome_header_content_start_footer_new();
?>